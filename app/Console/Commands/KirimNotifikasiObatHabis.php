<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\Member;
use Illuminate\Support\Carbon;
use App\Models\User;

class KirimNotifikasiObatHabis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kirim:notifikasi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirim notifikasi obat habis ke member dan pegawai';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $waktuhabisobat = Transaction::where('waktu_habis', '=', Carbon::yesterday()->toDateString())->get();
        $setting = Setting::first();
        $tokenfonnte = $setting->token_fonnte;

        foreach ($waktuhabisobat as $cek) {
            $member = Member::where('id', $cek->id_member)->first();
            $pegawai = User::where('id', $cek->id_users)->first();
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
                    'target' => $member->no_member.",".$pegawai->no,
                    'message' => "Halo ".$member->nama_member."! Obat Anda telah habis, apakah ada yang perlu kami bantu?",
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
