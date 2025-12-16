<!-- <div class="container"> -->
<?php $nomor = 1 ?>
<div class="card">
    <div class="card-body">

        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <table class="table text-center mb-0">
            <thead>
                <tr>
                    <th class="col-md-2 border">No. Resi</th>
                    <th class="col-md-2 border">Kota Tujuan</th>
                    <th class="col-md-2 border">Tanggal Kirim</th>
                    <th class="col-md-2 border">Tanggal Terima</th>
                    <th class="col-md-1 border">Jenis Kurir</th>
                    <th class="col-md-2 border">Nominal</th>
                    <th class="col-md-1 border">Status</th>
                    <th class="col-md-1 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftar_pengiriman)) { ?>
                    <tr>
                        <td colspan="100">Tidak ada data.</td>
                    </tr>
                <?php } else { ?>
                    <?php foreach ($daftar_pengiriman as $pengiriman) : ?>
                        <tr>
                            <td class="border"><?= $pengiriman['no_resi'] ?></td>
                            <td class="border"><?= $pengiriman['kota_tujuan'] ?></td>
                            <td class="border"><?= date('d/m/Y', strtotime($pengiriman['tanggal_diserahkan'])) ?></td>
                            <td class="border"><?= ($pengiriman['tanggal_diterima'] != null) ? date('d/m/Y', strtotime($pengiriman['tanggal_diterima'])) : '--belum tiba--' ?></td>
                            <td class="border"><?= $pengiriman['tipe_kurir'] ?></td>

                            <?php
                            $data_bayar = $this->Superadmin_Model->get_kargo_specific_by_id($pengiriman['no_resi']);
                            $is_lunas = ($data_bayar['biaya_total_view'] <= 0);
                            if (!$is_lunas) { ?>

                                <td class="border">
                                    Tunggakan: <?= 'Rp.' . $data_bayar['biaya_total_view'] ?><br>
                                </td>

                            <?php } else { ?>
                                <td class="border">
                                    <div class="border border-danger p-1 text-center text-danger">
                                        <strong>LUNAS</strong>
                                    </div>
                                    <?= 'Rp.' . $data_bayar['biaya_total_formatted'] ?>
                                </td>
                            <?php } ?>

                            <td class="border">

                                <?php
                                if (empty($pengiriman['armada_ID']) and empty($pengiriman['tanggal_diterima'])) {
                                    echo 'dalam antrian';
                                } else if (!empty($pengiriman['armada_ID']) and empty($pengiriman['tanggal_diterima'])) {
                                    if ($pengiriman['hilang'] == '1') {
                                        echo '<b class="text-danger">hilang</b>';
                                    } else if ($pengiriman['hilang'] == '0') {
                                        echo 'dalam pengiriman';
                                    }
                                } else if (!empty($pengiriman['armada_ID']) and !empty($pengiriman['tanggal_diterima'])) {
                                    echo 'selesai';
                                }
                                ?>

                            </td>

                            <td class="border">
                                <?php if ($is_lunas) : ?>
                                    <a href="<?= base_url('customer/download-invoice/' . $pengiriman['no_resi']) ?>" 
                                       class="btn btn-sm btn-success" 
                                       title="Download Invoice PDF">
                                        <i class="fas fa-file-pdf"></i> Invoice
                                    </a>
                                <?php else : ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php } ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation">
            <?= $pages ?>
        </nav>

    </div>
</div>

<!-- </div> -->