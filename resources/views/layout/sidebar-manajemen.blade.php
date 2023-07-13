<div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="/manajemen">{{ $companyname }}</a>
            </div>
            <div class="sidebar-toggler x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-item {{ request()->is('manajemen') ? 'active' : '' }}">
                <a href="/manajemen" class="sidebar-link">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- <li class="sidebar-item {{ request()->is('manajemen/chat*') ? 'active' : '' }}">
                <a href="/manajemen/chat" class="sidebar-link">
                    <i class="bi bi-chat-dots-fill"></i>
                    <span>Chat</span>
                </a>
            </li> --}}

            <li class="sidebar-item {{ request()->is('manajemen/chat*') ? 'active' : '' }} has-sub">
                <a href="#" class="sidebar-link">
                    <i class="bi bi-chat-dots-fill"></i>
                    <span>Chat</span>
                </a>

                <ul class="submenu active">
                    <li class="submenu-item {{ request()->is('manajemen/chat') ? 'active' : '' }}">
                        <a href="/manajemen/chat" class="submenu-link">Chat</a>
                    </li>

                    <li class="submenu-item {{ request()->is('manajemen/chat-template') ? 'active' : '' }}">
                        <a href="/manajemen/chat-template" class="submenu-link">Template Chat</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item {{ request()->is('manajemen/obat*') ? 'active' : '' }}">
                <a href="/manajemen/obat" class="sidebar-link">
                    <i class="bi bi-capsule"></i>
                    <span>Data Obat</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('manajemen/pegawai*') ? 'active' : '' }} has-sub">
                <a href="/manajemen/pegawai" class="sidebar-link">
                    <i class="bi bi-person-fill-check"></i>
                    <span>Data Pegawai</span>
                </a>
                <ul class="submenu active">
                    <li class="submenu-item {{ request()->is('/manajemen/pegawai') ? 'active' : '' }}">
                        <a href="/manajemen/pegawai" class="submenu-link">Tambah Pegawai</a>
                    </li>
                    <li class="submenu-item {{ request()->is('/manajemen/pegawai/tambah-pegawai-ke-pasien') ? 'active' : '' }}">
                        <a href="/manajemen/pegawai/tambah-pegawai-ke-pasien" class="submenu-link">Tambah Pegawai Ke member</a>
                    </li>
                </ul>
            </li>
            


            <li class="sidebar-item {{ request()->is('manajemen/member*') ? 'active' : '' }}">
                <a href="/manajemen/member" class="sidebar-link">
                    <i class="bi bi-people-fill"></i>
                    <span>Data Member</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('manajemen/rekap-pembelian*') ? 'active' : '' }}">
                <a href="/manajemen/rekap-pembelian" class="sidebar-link">
                    <i class="bi bi-clipboard-data-fill"></i>
                    <span>Rekap Pembelian</span>
                </a>
            </li>
        </ul>
    </div>
</div>
