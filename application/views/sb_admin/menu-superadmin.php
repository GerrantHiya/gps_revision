<!-- Heading -->
<div class="sidebar-heading">
    Admin
</div>

<!-- Nav Item - New Customer -->
<li class="<?= ($title == 'Customer Registration') ? 'active' : '' ?> nav-item">
    <a class="nav-link" href="<?= base_url('customer/reg-by-admin') ?>">
        <i class="fas fa-fw fa-user"></i>
        <span>Tambah Customer</span></a>
</li>

<!-- Nav Item - Kirim -->
<li class="<?= ($title == 'Kirim Paket') ? 'active' : '' ?> nav-item">
    <a class="nav-link" href="<?= base_url('superadmin/kirim-paket') ?>">
        <i class="fas fa-fw fa-boxes"></i>
        <span>Kirim Paket</span></a>
</li>

<!-- Nav Item - Muat ke armada -->
<li class="<?= ($title == 'Proses Kirim - Pilih Armada') ? 'active' : '' ?> nav-item">
    <a class="nav-link" href="<?= base_url('superadmin/proses-kirim') ?>">
        <i class="fas fa-fw fa-truck"></i>
        <span>Proses Kirim</span></a>
</li>

<!-- Nav Item - Bayar -->
<li class="<?= ($title == 'Pembayaran') ? 'active' : '' ?> nav-item">
    <a class="nav-link" href="<?= base_url('superadmin/bayar') ?>">
        <i class="fas fa-fw fa-money-bill"></i>
        <span>Pembayaran</span></a>
</li>

<!-- Nav Item - Terima Kargo -->
<li class="<?= ($title == 'Terima Kargo') ? 'active' : '' ?> nav-item">
    <a class="nav-link" href="<?= base_url('superadmin/terima-kargo') ?>">
        <i class="fas fa-fw fa-boxes"></i>
        <span>Terima Kargo [NEW]</span></a>
</li>

<?php if ($this->session->userdata('user')['is_super'] == 1) { ?>
    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Super Admin
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brt"
            aria-expanded="true" aria-controls="brt">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Set Parameter</span>
        </a>
        <div id="brt" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('superadmin/harga-bobot') ?>">Harga per KG</a>
                <a class="collapse-item" href="<?= base_url('superadmin/harga-jarak') ?>">Harga per KM</a>
                <!-- <a class="collapse-item" href="<?= base_url('superadmin/harga-volume') ?>">Harga per Volume</a> -->
                <a class="collapse-item" href="<?= base_url('superadmin/harga-kategori') ?>">Kategori Paket</a>
                <a class="collapse-item" href="<?= base_url('superadmin/kelola-armada') ?>">Kelola Armada</a>
                <a class="collapse-item" href="<?= base_url('superadmin/kelola-tipe-kurir') ?>">Tipe Kurir</a>
                <a class="collapse-item" href="<?= base_url('superadmin/kelola-metode-bayar') ?>">Metode Pembayaran</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#view"
            aria-expanded="true" aria-controls="brt">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Documents</span>
        </a>
        <div id="view" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('superadmin/kontrak-sopir') ?>">Sopir Kontrak</a>
                <a class="collapse-item" href="<?= base_url('superadmin/monthly-report') ?>">Monthly Report</a>
                <a class="collapse-item" href="<?= base_url('') ?>">Performance</a>
                <a class="collapse-item" href="<?= base_url('') ?>"></a>
                <a class="collapse-item" href="<?= base_url('') ?>"></a>
                <a class="collapse-item" href="<?= base_url('') ?>"></a>
            </div>
        </div>
    </li>

    <!-- Nav Item - New Admin -->
    <li class="<?= ($title == 'Admin Account Management') ? 'active' : '' ?> nav-item">
        <a class="nav-link" href="<?= base_url('superadmin/admin-account-management') ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Admin Accounts</span></a>
    </li>

<?php } ?>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">