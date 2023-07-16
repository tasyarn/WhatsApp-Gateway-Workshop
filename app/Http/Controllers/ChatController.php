<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatTemplate;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\JoinClause;

class ChatController extends Controller
{
  public function indexchatmanajemen()
  {
    $setting = Setting::first();
    $companyname = $setting->nama_perusahaan;
    $chat = DB::table('chats')->join('members', function (JoinClause $join) {
      $join->on('chats.no_pengirim', '=', 'members.no_member')->orOn('chats.no_penerima', '=', 'members.no_member');
    })->join('users', 'members.id_users', '=', 'users.id')->groupBy('members.id')->get();
    return view('manajemen.chat.index', [
      'companyname' => $companyname,
      'chat' => $chat,
    ]);
  }

  public function indextemplatechatmanajemen()
  {
    $setting = Setting::first();
    $companyname = $setting->nama_perusahaan;
    $templatechat = DB::table('chat_templates')->get();
    return view('manajemen.chat.indextemplate', [
      'companyname' => $companyname,
      'templatechat' => $templatechat,
    ]);
  }

  public function store(Request $request)
  {
    $validate = [
      'template_chat' => 'required',
    ];

    $template = $request->validate($validate);
    ChatTemplate::create($template);
    return back()->with('pesan', 'Template Chat berhasil ditambahkan');
  }

  public function ubah(Request $request)
  {
    $data = $request->validate([
      'id' => 'required',
      'templatechat' => 'required',
    ]);
    $id = $request->input('id');
    $updatetemplatechate = ChatTemplate::where(['id' => $id])->update([
      'template_chat' => $request->input('templatechat'),
    ]);

    return back()->with('pesan', 'Template Chat berhasil diubah');
  }

  public function hapus(Request $request)
  {
    ChatTemplate::where('id', $request->input('id'))->delete();
    return back()->with('pesan', 'Template Chat berhasil dihapus');
  }

  public function indexchatpegawai()
  {
    $setting = Setting::first();
    $companyname = $setting->nama_perusahaan;
    $chat = DB::table('chats')->join('members', function (JoinClause $join) {
      $join->on('chats.no_pengirim', '=', 'members.no_member')->orOn('chats.no_penerima', '=', 'members.no_member');
    })->where('members.id_users', Auth::user()->id)->groupBy('members.id')->get();
    return view('pegawai.chat.index', [
      'companyname' => $companyname,
      'chat' => $chat,
      // 'nopenerima' => $nopenerima
    ]);
  }

  public function chatmembermanajemen($nopenerima)
  {
    $setting = Setting::first();
    $companyname = $setting->nama_perusahaan;
    $member = Member::where('no_member', $nopenerima)->first();
    if ($member != null) {
      $chat = DB::table('chats')->where('no_penerima', $nopenerima)->orWhere('no_pengirim', $nopenerima)->latest()->get();
      $user = User::where('id', $member->id_users)->first();
      return view('manajemen.chat.chat', [
        'companyname' => $companyname,
        'chat' => $chat,
        'nopenerima' => $nopenerima,
        'member' => $member,
        'user' => $user,
      ]);
    } else {
      return redirect('/manajemen/chat/')->with('salah', 'Nomor telepon member tidak ditemukan!');
    }
  }

  public function chatmemberpegawai($nopenerima)
  {
    $setting = Setting::first();
    $companyname = $setting->nama_perusahaan;
    $member = Member::where('no_member', $nopenerima)->first();
    if ($member != null) {
      if ($member->id_users == Auth::user()->id) {
        $chat = DB::table('chats')->where('no_penerima', $nopenerima)->orWhere('no_pengirim', $nopenerima)->latest()->get();
        return view('pegawai.chat.chat', [
          'companyname' => $companyname,
          'chat' => $chat,
          'nopenerima' => $nopenerima,
          'member' => $member,
        ]);
      } else {
        return redirect('/pegawai/chat/')->with('salah', 'Pastikan nomor telepon adalah member Anda!');
      }
    } else {
      return redirect('/pegawai/chat/')->with('salah', 'Nomor telepon member tidak ditemukan!');
    }
  }

  public function kirimchat(Request $request)
  {
    $setting = Setting::first();
    $tokenfonnte = $setting->token_fonnte;

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.fonnte.com/send',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array(
        'target' => $request['nopenerima'],
        'message' => $request['pesan'],
        // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
        // 'filename' => 'filename',
        'schedule' => '0',
        'typing' => false,
        'delay' => '2',
        'countryCode' => '62',
      ),
      CURLOPT_HTTPHEADER => array(
        'Authorization: ' . $tokenfonnte
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $data = json_decode($response, true); // Menguraikan respons JSON menjadi array

    $status = $data['status']; // Mendapatkan nilai "status" dari array
    if ($status == 1) {
      $chat = new Chat();
      $chat->no_pengirim = $request->input('nopengirim');
      $chat->no_penerima = $request->input('nopenerima');
      $chat->isi_pesan = $request->input('pesan');

      $chat->save();
      return back()->with('pesan', 'Pesan berhasil dikirim!');
    } else {
      return back()->with('salah', 'Pesan tidak terkirim!');
    }
  }

  public function ambilchat($input_source = "php://input")
  {

    $json = file_get_contents($input_source);
    $data = json_decode($json, true);
    if ($data != null) {
      if (substr($data['sender'], 0, 2) == 62) {
        $sender = preg_replace('/^62/', '0', $data['sender']);
      } else if (substr($data['sender'], 0, 1) == 0) {
        $sender = $data['sender'];
      }
      $message = $data['message'];
      $member = Member::where('no_member', $sender)->first();
      $user = User::where('no', $sender)->first();
      $noperusahaan = Setting::where('no_penerima_pesan', $sender)->first();
      $setting = Setting::first();
      $tokenfonnte = $setting->token_fonnte;

      if ($member != null) {
        $getpegawai = User::where('id', $member->id_users)->first();
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.fonnte.com/send',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array(
            'target' => $getpegawai->no,
            'message' => $sender . " (" . $member->nama_member . ")\n" . $message,
            // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
            // 'filename' => 'filename',
            'schedule' => '0',
            'typing' => false,
            'delay' => '2',
            'countryCode' => '62',
          ),
          CURLOPT_HTTPHEADER => array(
            'Authorization: ' . $tokenfonnte
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true); // Menguraikan respons JSON menjadi array
        $status = $data['status']; // Mendapatkan nilai "status" dari array

        if ($status == 1) {
          $chat = new Chat();
          $chat->no_pengirim = $sender;
          $chat->no_penerima = $getpegawai->no;
          $chat->isi_pesan = $message;
          $chat->save();
        }
      } else if ($user != null) {
        if ($message == "/Template") {
          $chattemplate = ChatTemplate::get();
          $jumlahtemplate = count($chattemplate);
          for ($i = 0; $i < $jumlahtemplate; $i++) {
            $pesan = str_replace('\n', "\n", $chattemplate[$i]->template_chat);
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.fonnte.com/send',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array(
                'target' => $sender,
                'message' => $pesan,
                // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
                // 'filename' => 'filename',
                'schedule' => '0',
                'typing' => false,
                'delay' => '2',
                'countryCode' => '62',
              ),
              CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $tokenfonnte
              ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
          }
        } else {
          $tempgetmember = preg_match("/\d+/", $message, $tempnomember);
          if ($tempnomember != null) {
            $nomember = $tempnomember[0];
            $cekmember = Member::where('no_member', $nomember)->first();
            if ($cekmember != null) {
              if ($cekmember->id_users == $user->id) {
                $temppesan = explode($nomember, $message);
                $temppesan2 = explode("\n", $temppesan[1], 2);
                if (count($temppesan2) == 2) {
                  $pesan = $temppesan2[1];
                  $curl = curl_init();
                  curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.fonnte.com/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                      'target' => $nomember,
                      'message' => $pesan,
                      // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
                      // 'filename' => 'filename',
                      'schedule' => '0',
                      'typing' => false,
                      'delay' => '2',
                      'countryCode' => '62',
                    ),
                    CURLOPT_HTTPHEADER => array(
                      'Authorization: ' . $tokenfonnte
                    ),
                  ));
                  $response = curl_exec($curl);
                  curl_close($curl);
                  $data = json_decode($response, true); // Menguraikan respons JSON menjadi array
                  $status = $data['status']; // Mendapatkan nilai "status" dari array

                  if ($status == 1) {
                    $chat = new Chat();
                    $chat->no_pengirim = $sender;
                    $chat->no_penerima = $nomember;
                    $chat->isi_pesan = $pesan;
                    $chat->save();
                  }
                } else {
                  $curl = curl_init();
                  curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.fonnte.com/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                      'target' => $sender,
                      'message' => "Pesan tidak terkirim, Masukkan sesuai dengan Format!",
                      // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
                      // 'filename' => 'filename',
                      'schedule' => '0',
                      'typing' => false,
                      'delay' => '2',
                      'countryCode' => '62',
                    ),
                    CURLOPT_HTTPHEADER => array(
                      'Authorization: ' . $tokenfonnte
                    ),
                  ));
                  $response = curl_exec($curl);
                  curl_close($curl);
                }
              } else {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://api.fonnte.com/send',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => array(
                    'target' => $sender,
                    'message' => "No yang Anda kirimkan bukan member Anda",
                    // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
                    // 'filename' => 'filename',
                    'schedule' => '0',
                    'typing' => false,
                    'delay' => '2',
                    'countryCode' => '62',
                  ),
                  CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $tokenfonnte
                  ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
              }
            } else {
              $curl = curl_init();
              curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                  'target' => $sender,
                  'message' => "No yang Anda kirimkan bukan member",
                  // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
                  // 'filename' => 'filename',
                  'schedule' => '0',
                  'typing' => false,
                  'delay' => '2',
                  'countryCode' => '62',
                ),
                CURLOPT_HTTPHEADER => array(
                  'Authorization: ' . $tokenfonnte
                ),
              ));
              $response = curl_exec($curl);
              curl_close($curl);
            }
          } else {
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api.fonnte.com/send',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array(
                'target' => $sender,
                'message' => "Pesan tidak terkirim",
                // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
                // 'filename' => 'filename',
                'schedule' => '0',
                'typing' => false,
                'delay' => '2',
                'countryCode' => '62',
              ),
              CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $tokenfonnte
              ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
          }
        }
      } else if ($noperusahaan != null) {
        $tempgettarget = preg_match("/\d+/", $message, $tempnotarget);
        if ($tempnotarget != null) {
          $notarget = $tempnotarget[0];
          $temppesan = explode($notarget, $message);
          $temppesan2 = explode("\n", $temppesan[1]);
          $pesan = $temppesan2[1];
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
              'target' => $notarget,
              'message' => $pesan,
              // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
              // 'filename' => 'filename',
              'schedule' => '0',
              'typing' => false,
              'delay' => '2',
              'countryCode' => '62',
            ),
            CURLOPT_HTTPHEADER => array(
              'Authorization: ' . $tokenfonnte
            ),
          ));
          $response = curl_exec($curl);
          curl_close($curl);
        } else {
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
              'target' => $sender,
              'message' => "Pesan tidak terkirim",
              // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
              // 'filename' => 'filename',
              'schedule' => '0',
              'typing' => false,
              'delay' => '2',
              'countryCode' => '62',
            ),
            CURLOPT_HTTPHEADER => array(
              'Authorization: ' . $tokenfonnte
            ),
          ));
          $response = curl_exec($curl);
          curl_close($curl);
        }
      } else {
        if ($setting->no_penerima_pesan != null) {
          $curl = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
              'target' => $setting->no_penerima_pesan,
              'message' => $sender . "\n" . $message,
              // 'url' => 'https://md.fonnte.com/images/wa-logo.png',
              // 'filename' => 'filename',
              'schedule' => '0',
              'typing' => false,
              'delay' => '2',
              'countryCode' => '62',
            ),
            CURLOPT_HTTPHEADER => array(
              'Authorization: ' . $tokenfonnte
            ),
          ));
          $response = curl_exec($curl);
          curl_close($curl);
        }
      }
    }
  }
}
