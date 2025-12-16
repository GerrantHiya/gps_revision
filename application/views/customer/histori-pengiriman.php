<?php
// Helper function untuk get status badge
function getStatusBadge($status, $is_lost = false) {
    if ($is_lost) {
        return '<span class="badge badge-danger"><i class="fas fa-exclamation-circle"></i> Hilang</span>';
    }
    
    switch($status) {
        case 'dalam_antrian':
            return '<span class="badge badge-secondary"><i class="fas fa-clock"></i> Dalam Antrian</span>';
        case 'dalam_pengiriman':
            return '<span class="badge badge-warning"><i class="fas fa-truck"></i> Dalam Pengiriman</span>';
        case 'selesai':
            return '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Selesai</span>';
        default:
            return '<span class="badge badge-secondary">-</span>';
    }
}

// Helper function untuk determine status
function determineStatus($h) {
    if (empty($h['armada_ID']) && empty($h['tanggal_diterima'])) {
        return 'dalam_antrian';
    } else if (!empty($h['armada_ID']) && empty($h['tanggal_diterima'])) {
        return 'dalam_pengiriman';
    } else if (!empty($h['armada_ID']) && !empty($h['tanggal_diterima'])) {
        return 'selesai';
    }
}
?>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="card bg-gradient-info text-white mb-4">
        <div class="card-body">
            <h1 class="h3 mb-0">
                <i class="fas fa-history"></i> Riwayat Pengiriman
            </h1>
            <p class="text-white-50 mb-0 mt-2">Lihat detail semua pengiriman Anda</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="card shadow mb-5">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-list"></i> Daftar Pengiriman
            </h6>
        </div>
        <div class="card-body p-0">
            <?php if (empty($histori)) { ?>
                <div class="p-4 text-center">
                    <div class="mb-3">
                        <i class="fas fa-inbox fa-3x text-muted"></i>
                    </div>
                    <h5 class="text-muted">Tidak Ada Data Pengiriman</h5>
                    <p class="text-muted small">Belum ada riwayat pengiriman untuk ditampilkan.</p>
                </div>
            <?php } else { ?>
                <!-- Desktop View -->
                <div class="table-responsive d-none d-md-block">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3"><i class="fas fa-barcode"></i> No. Resi</th>
                                <th class="py-3"><i class="fas fa-location-dot"></i> Kota Tujuan</th>
                                <th class="py-3"><i class="fas fa-calendar-send"></i> Tanggal Kirim</th>
                                <th class="py-3"><i class="fas fa-calendar-check"></i> Tanggal Terima</th>
                                <th class="py-3"><i class="fas fa-truck-moving"></i> Tujuan dan Moda</th>
                                <th class="py-3 text-center"><i class="fas fa-info-circle"></i> Status</th>
                                <th class="py-3 text-center"><i class="fas fa-cogs"></i> Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($histori as $h) : ?>
                                <?php
                                $status = determineStatus($h);
                                $is_lost = $h['hilang'] == '1';
                                $tgl_kirim = date('d/m/Y', strtotime($h['tanggal_diserahkan']));
                                $tgl_terima = ($h['tanggal_diterima'] != null) ? date('d/m/Y', strtotime($h['tanggal_diterima'])) : '--belum tiba--';
                                ?>
                                <tr>
                                    <td class="py-3">
                                        <strong class="text-primary"><?= $h['no_resi'] ?></strong>
                                    </td>
                                    <td class="py-3">
                                        <?= htmlspecialchars($h['kota_tujuan']) ?>
                                    </td>
                                    <td class="py-3">
                                        <small class="text-muted"><?= $tgl_kirim ?></small>
                                    </td>
                                    <td class="py-3">
                                        <small class="text-muted"><?= $tgl_terima ?></small>
                                    </td>
                                    <td class="py-3">
                                        <span class="badge badge-info"><?= htmlspecialchars($h['tipe_kurir']) ?></span>
                                    </td>
                                    <td class="py-3 text-center">
                                        <?= getStatusBadge($status, $is_lost) ?>
                                    </td>
                                    <td class="py-3 text-center">
                                        <?php if ($status === 'dalam_pengiriman' && !$is_lost && !empty($h['armada_ID']) && empty($h['received_date'])) { ?>
                                            <a href="<?= base_url('customer/lacak-pengiriman-detail/' . md5($h['no_resi'])) ?>" 
                                               class="btn btn-sm btn-primary" title="Lacak Pengiriman">
                                                <i class="fas fa-map-location-dot"></i> Lacak
                                            </a>
                                        <?php } else { ?>
                                            <span class="text-muted small">-</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile View -->
                <div class="d-md-none">
                    <div class="list-group list-group-flush">
                        <?php foreach ($histori as $h) : ?>
                            <?php
                            $status = determineStatus($h);
                            $is_lost = $h['hilang'] == '1';
                            $tgl_kirim = date('d/m/Y', strtotime($h['tanggal_diserahkan']));
                            $tgl_terima = ($h['tanggal_diterima'] != null) ? date('d/m/Y', strtotime($h['tanggal_diterima'])) : '--belum tiba--';
                            ?>
                            <div class="list-group-item p-3">
                                <div class="row mb-2">
                                    <div class="col-8">
                                        <h6 class="mb-1">
                                            <strong class="text-primary"><?= $h['no_resi'] ?></strong>
                                        </h6>
                                        <small class="text-muted">
                                            <i class="fas fa-location-dot"></i> <?= htmlspecialchars($h['kota_tujuan']) ?>
                                        </small>
                                    </div>
                                    <div class="col-4 text-right">
                                        <?= getStatusBadge($status, $is_lost) ?>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <small class="text-muted d-block">
                                            <i class="fas fa-calendar-send"></i> Kirim: <?= $tgl_kirim ?>
                                        </small>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">
                                            <i class="fas fa-calendar-check"></i> Terima: <?= $tgl_terima ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <small class="text-muted d-block">
                                            <i class="fas fa-truck-moving"></i> <span class="badge badge-info"><?= htmlspecialchars($h['tipe_kurir']) ?></span>
                                        </small>
                                    </div>
                                </div>
                                <?php if ($status === 'dalam_pengiriman' && !$is_lost && !empty($h['armada_ID']) && empty($h['received_date'])) { ?>
                                    <div class="mt-2">
                                        <a href="<?= base_url('customer/lacak-pengiriman-detail/' . md5($h['no_resi'])) ?>" 
                                           class="btn btn-sm btn-primary btn-block">
                                            <i class="fas fa-map-location-dot"></i> Lacak Pengiriman
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Pagination -->
        <?php if (!empty($pages)) { ?>
            <div class="card-footer bg-light p-3">
                <nav aria-label="Page navigation">
                    <?= $pages ?>
                </nav>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .bg-gradient-info {
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

    .text-white-50 {
        color: rgba(255, 255, 255, 0.5) !important;
    }

    .card {
        border: none;
        border-radius: 0.35rem;
    }

    .card-header {
        border-bottom: 1px solid #e3e6f0;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table thead th {
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-top: none;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .list-group-item {
        border-left: 3px solid transparent;
    }

    .list-group-item:hover {
        border-left-color: #667eea;
    }

    .badge {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .card {
            margin-bottom: 1rem;
        }
    }
</style>
