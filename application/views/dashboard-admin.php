<?php
// Determine user role
$is_super = $this->session->userdata('user')['is_super'] ?? 0;
$user_name = $this->session->userdata('user')['NamaLengkap'] ?? 'User';
$role_label = $is_super == 1 ? 'Super Admin' : 'Admin';
?>

<!-- Welcome Section -->
<div class="card bg-gradient-primary text-white mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="mb-1">Selamat Datang, <strong><?= $user_name ?></strong></h2>
                <p class="mb-0"><i class="fas fa-shield-alt"></i> <strong><?= $role_label ?></strong></p>
            </div>
            <div class="col-auto">
                <div class="text-right">
                    <p class="mb-0 small text-white-50"><?= date('l, d F Y') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($is_super) { ?>
    <!-- ===== SUPERADMIN DASHBOARD ===== -->
    
    <!-- Key Metrics Row -->
    <div class="row mb-4">
        <!-- Paket Belum Proses -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-primary text-uppercase mb-1 font-weight-bold small">
                        <i class="fas fa-box"></i> Paket Belum Diproses
                    </div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800">
                        <?= $belum_proses['hasil'] ?? 0 ?>
                    </div>
                    <div class="mt-2 small">
                        <span class="text-muted">Menunggu untuk diproses</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Paket Belum Tiba -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-warning text-uppercase mb-1 font-weight-bold small">
                        <i class="fas fa-truck"></i> Paket Dalam Perjalanan
                    </div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800">
                        <?= $belum_tiba['hasil'] ?? 0 ?>
                    </div>
                    <div class="mt-2 small">
                        <span class="text-muted">Sedang dalam perjalanan</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Paket Selesai -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-success text-uppercase mb-1 font-weight-bold small">
                        <i class="fas fa-check-circle"></i> Paket Terselesaikan
                    </div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800">
                        <?= $selesai['hasil'] ?? 0 ?>
                    </div>
                    <div class="mt-2 small">
                        <span class="text-muted">Tahun <?= date('Y') ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rute Terlaris -->
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-info text-uppercase mb-1 font-weight-bold small">
                        <i class="fas fa-star"></i> Rute Terlaris
                    </div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800">
                        <?= ucwords(strtolower($tipe_kurir_terlaris['hasil'] ?? '-')) ?>
                    </div>
                    <div class="mt-2 small">
                        <span class="text-muted">Rute paling populer</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Features Row -->
    <div class="row">
        <div class="col-lg">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-list"></i> Statistik Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="small">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tingkat Keberhasilan Pengiriman</span>
                            <span class="font-weight-bold text-success">
                                <?= isset($selesai['hasil']) && isset($belum_proses['hasil']) ? 
                                    round(($selesai['hasil'] / ($selesai['hasil'] + $belum_proses['hasil'] + $belum_tiba['hasil'] + 1)) * 100, 1) : 0 ?>%
                            </span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar" 
                                 style="width: <?= isset($selesai['hasil']) && isset($belum_proses['hasil']) ? 
                                    round(($selesai['hasil'] / ($selesai['hasil'] + $belum_proses['hasil'] + $belum_tiba['hasil'] + 1)) * 100, 1) : 0 ?>%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Action & Alert Section -->
    <div class="row mb-4">
        <div class="col-12">
            <?php if ($this->session->flashdata('pin')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> 
                    <?= $this->session->flashdata('pin'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="card border-left-danger">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-danger">
                                <i class="fas fa-exclamation-triangle"></i> Manajemen PIN Hilang
                            </h6>
                            <p class="text-muted small mt-2 mb-0">Kelola PIN yang hilang atau butuh reset untuk pengiriman.</p>
                        </div>
                        <div class="col-auto">
                            <a href="<?= base_url('superadmin/generate_PIN_hilang') ?>" class="btn btn-danger btn-sm">
                                <i class="fas fa-key"></i> Generate PIN
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>
    <!-- ===== ADMIN DASHBOARD ===== -->
    <!-- Key Metrics for Regular Admin -->
    <div class="row mb-4">
        <!-- Paket Belum Proses -->
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-primary text-uppercase mb-1 font-weight-bold small">
                        <i class="fas fa-box"></i> Paket Belum Diproses
                    </div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800">
                        <?= $belum_proses['hasil'] ?? 0 ?>
                    </div>
                    <div class="mt-2 small">
                        <span class="text-muted">Menunggu untuk diproses</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Paket Belum Tiba -->
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-warning text-uppercase mb-1 font-weight-bold small">
                        <i class="fas fa-truck"></i> Paket Dalam Perjalanan
                    </div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800">
                        <?= $belum_tiba['hasil'] ?? 0 ?>
                    </div>
                    <div class="mt-2 small">
                        <span class="text-muted">Sedang dalam perjalanan</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Paket Selesai -->
        <div class="col-xl-4 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-success text-uppercase mb-1 font-weight-bold small">
                        <i class="fas fa-check-circle"></i> Paket Terselesaikan
                    </div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800">
                        <?= $selesai['hasil'] ?? 0 ?>
                    </div>
                    <div class="mt-2 small">
                        <span class="text-muted">Tahun <?= date('Y') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row">
        <div class="col-lg">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-info text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-chart-pie"></i> Statistik Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="small">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tingkat Keberhasilan Pengiriman</span>
                            <span class="font-weight-bold text-success">
                                <?= isset($selesai['hasil']) && isset($belum_proses['hasil']) ? 
                                    round(($selesai['hasil'] / ($selesai['hasil'] + $belum_proses['hasil'] + $belum_tiba['hasil'] + 1)) * 100, 1) : 0 ?>%
                            </span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar" 
                                 style="width: <?= isset($selesai['hasil']) && isset($belum_proses['hasil']) ? 
                                    round(($selesai['hasil'] / ($selesai['hasil'] + $belum_proses['hasil'] + $belum_tiba['hasil'] + 1)) * 100, 1) : 0 ?>%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<!-- Custom Styles -->
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .border-left-primary {
        border-left: 0.25rem solid #667eea !important;
    }

    .border-left-success {
        border-left: 0.25rem solid #28a745 !important;
    }

    .border-left-warning {
        border-left: 0.25rem solid #ffc107 !important;
    }

    .border-left-info {
        border-left: 0.25rem solid #17a2b8 !important;
    }

    .border-left-danger {
        border-left: 0.25rem solid #dc3545 !important;
    }

    .text-gray-800 {
        color: #2e3338;
    }

    .text-gray-700 {
        color: #5a6c7d;
    }

    .text-muted {
        color: #858796 !important;
    }

    .card {
        border: none;
        margin-bottom: 1rem;
    }

    .card-header {
        border-bottom: 1px solid #e3e6f0;
    }

    .small {
        font-size: 0.875rem;
    }
</style>
