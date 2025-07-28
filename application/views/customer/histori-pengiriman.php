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
                    <th class="col-md border">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($histori)) { ?>
                    <tr>
                        <td colspan="100">Tidak ada data.</td>
                    </tr>
                <?php } else { ?>
                    <?php foreach ($histori as $h) : ?>
                        <tr>
                            <td class="border"><?= $h['no_resi'] ?></td>
                            <td class="border"><?= $h['kota_tujuan'] ?></td>
                            <td class="border"><?= date('d/m/Y', strtotime($h['tanggal_diserahkan'])) ?></td>
                            <td class="border"><?= ($h['tanggal_diterima'] != null) ? date('d/m/Y', strtotime($h['tanggal_diterima'])) : '--belum tiba--' ?></td>
                            <td class="border"><?= $h['tipe_kurir'] ?></td>
                            <td class="border">

                                <?php if (empty($h['armada_ID']) && empty($h['received_date'])) { ?>
                                    dalam antrian
                                <?php } else if (!empty($h['armada_ID']) && empty($h['received_date'])) { ?>
                                    dalam pengiriman
                                <?php } else if (!empty($h['armada_ID']) && !empty($h['received_date'])) { ?>
                                    selesai
                                <?php } ?>

                            </td>
                            <td class="border-0">
                                <?php if (!empty($h['armada_ID']) && empty($h['received_date'])) { ?>
                                    <a href="<?= base_url('customer/lacak-pengiriman-detail/' . md5($h['no_resi'])) ?>" class="badge badge-primary">lacak</a>
                                <?php } ?>
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