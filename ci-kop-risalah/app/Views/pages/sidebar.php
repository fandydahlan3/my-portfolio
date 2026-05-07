<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?= base_url('dashboard') ?>" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="<?= base_url('assets/img/favicon/logo.png') ?>" alt="Logo" style="width: 40px;">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform: none !important;">ABATASA</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
    <li class="menu-item active">
        <a href="<?= base_url('dashboard') ?>" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="<?= base_url('auth/change_password') ?>" class="menu-link">
            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
            <div>Ganti Password</div>
        </a>
    </li>
    <?php if (in_array(strtolower(session()->get('role')), ['member', 'user'])) : ?>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Laporan Saya</span>
        </li>
        <li class="menu-item">
            <a href="<?= base_url('iuran') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-wallet"></i>
                <div>Data Iuran</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?= base_url('d_angsuran') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div>Data Angsuran</div>
            </a>
        </li>
    <?php endif; ?>
    <?php if (session()->get('role') === 'admin') : ?>
        <li class="menu-item">
            <a href="<?= base_url('member') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Data Member">Data Member</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Admin Panel (Data Master)</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Data Anggota</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= base_url('anggota') ?>" class="menu-link">
                        <div>List Anggota</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Transaksi & Laporan</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div>Iuran & Angsuran</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= base_url('iuran') ?>" class="menu-link">
                        <div>Data Iuran</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('d_angsuran') ?>" class="menu-link">
                        <div>Data Angsuran</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-trending-up"></i>
                <div>Pendapatan Koperasi</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= base_url('usaha') ?>" class="menu-link">
                        <div>Data Usaha</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('input_kop') ?>" class="menu-link">
                        <div>Input Pendapatan</div>
                    </a>
                </li>
            </ul>
        </li>
    <?php endif; ?>
</ul>
</aside>