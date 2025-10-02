<div class="container">

    <?php $nomor = 1 ?>
    <!-- TABLE -->
    <table class="table table-hover text-center mt-3 mb-3">
        <thead>
            <tr>
                <th scope="col" class="col-1">No.</th>
                <th scope="col" class="">Jenis-No. Polisi</th>
                <th scope="col" class="">Sopir</th>
                <th scope="col" class="col-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($list_armada)) { ?>
                <?php foreach ($list_armada as $armada) { ?>
                    <tr>
                        <td><?= $nomor++ ?></td>
                        <td><?= $armada['nama_jenis'] ?>-<?= $armada['plat_nomor'] ?></td>
                        <td><?= $armada['NamaLengkap'] ?? '-- belum siap --' ?></td>
                        <td>
                            <?php if (!empty($armada['NamaLengkap'])) { ?>
                                <a href="<?= base_url('superadmin/proses-kirim/load/') . md5($armada['armada_ID']) ?>" class="badge badge-primary">muat kargo</a>
                                <!-- <a href="<?= base_url('superadmin/berangkat/') . md5($armada['armada_ID']) ?>" class="badge badge-success">berangkat</a> -->
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="100">Tidak ada data.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- PAGES -->
    <nav aria-label="Page navigation">
        <?= $pages ?>
    </nav>

</div>