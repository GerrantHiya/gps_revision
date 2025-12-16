<!-- <div class="container"> -->
<?php $nomor = 1 ?>
<div class="card">
    <div class="card-body">

        <table class="table text-center mb-0">
            <thead>
                <tr>
                    <th class="col-md-2 border">No. Resi</th>
                    <th class="col-md-2 border">Kota Tujuan</th>
                    <th class="col-md-2 border">Tanggal Kirim</th>
                    <th class="col-md-2 border">Tanggal Terima</th>
                    <th class="col-md-2 border">Jenis Kurir</th>
                    <th class="col-md-2 border">Nominal</th>
                    <th class="col-md border">Status</th>
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
                            if ($data_bayar['biaya_total_view'] > 0) { ?>

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