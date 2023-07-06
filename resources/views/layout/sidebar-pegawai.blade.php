<div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="/pegawai">{{ $companyname }}</a>
            </div>
            <div class="sidebar-toggler x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-item {{ request()->is('pegawai') ? 'active' : '' }}">
                <a href="/pegawai" class="sidebar-link">
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('pegawai/chat*') ? 'active' : '' }}">
                <a href="/pegawai/chat" class="sidebar-link">
                    <i class="bi bi-chat-dots-fill"></i>
                    <span>Chat</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('pegawai/obat*') ? 'active' : '' }}">
                <a href="/pegawai/obat" class="sidebar-link">
                    <i class="bi bi-capsule"></i>
                    <span>Data Obat</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('pegawai/member*') ? 'active' : '' }}">
                <a href="/pegawai/member" class="sidebar-link">
                    <i class="bi bi-people-fill"></i>
                    <span>Data Member</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('pegawai/pembelian*') ? 'active' : '' }}">
                <a href="/pegawai/pembelian" class="sidebar-link">
                    <i class="bi bi-clipboard-data-fill"></i>
                    <span>Data Pembelian</span>
                </a>
            </li>

        </ul>
    </div>
</div>
