<!-- Heading -->
<div class="sidebar-heading">
    Customer
</div>

<!-- Nav Item - Lacak Pengiriman -->
<li class="<?= ($title == 'Lacak Pengiriman') ? 'active' : '' ?> nav-item">
    <a class="nav-link" href="<?= base_url('customer/lacak-pengiriman') ?>">
        <i class="fas fa-fw fa-map-pin"></i>
        <span>Lacak Pengiriman</span></a>
</li>

<!-- Nav Item - Tagihan / Hutang -->
<li class="<?= ($title == 'Tagihan Pembayaran') ? 'active' : '' ?> nav-item">
    <a class="nav-link" href="<?= base_url('customer/daftar-tagihan') ?>">
        <i class="fas fa-fw fa-money-bill-wave"></i>
        <span>Tagihan Pembayaran</span></a>
</li>

<!-- Nav Item - Pricelist -->
