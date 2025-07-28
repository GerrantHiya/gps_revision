<div class="container mb-3">

    <a href="<?= base_url('superadmin/kontrak-sopir#') . $sopir['sopir_ID'] ?>" class="badge badge-secondary">&laquo; kembali</a>

    <div class="card mt-2 mb-2">
        <div class="card-body">
            <div class="row px-3">
                <input type="text" class="form-control col mx-1" value="NIK: <?= $sopir['sopir_ID'] ?>" readonly>
                <input type="text" class="form-control col mx-1" value="Nama: <?= $sopir['NamaLengkap'] ?>" readonly>
            </div>
        </div>
    </div>

    <div class="row mt-1 mb-1">
        ** upload kontrak kerja sopir di menu <a href="<?= base_url('superadmin/kontrak-sopir/edit/') . md5($sopir['sopir_ID']) ?>" class="mx-1"> edit</a>
    </div>

    <?php $nomor = 1; ?>
    <table class="table table-hover text-center">
        <thead>
            <tr>
                <th scope="col" class="col-1">No</th>
                <th scope="col">Nomor Kontrak</th>
                <th scope="col" class="col-3">Tanggal Mulai</th>
                <th scope="col" class="col-3">Tanggal Selesai</th>
                <th scope="col" class="col-2">File</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($contracts)) { ?>
                <?php foreach ($contracts as $contract) : ?>
                    <tr>
                        <td><?= $nomor++ ?></td>
                        <td><?= $contract['ID'] ?></td>
                        <td><?= date("d M Y", strtotime($contract['tanggal_mulai'])) ?></td>
                        <td><?= date("d M Y", strtotime($contract['tanggal_akhir'])) ?></td>
                        <td>
                            <a href="<?= base_url('assets/docs/kontrak_sopir/') . $contract['file_kontrak'] ?>" target="_blank" class="badge badge-primary">&starf; lihat</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php } else { ?>
                <tr>
                    <td colspan="100">Tidak ada data.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>