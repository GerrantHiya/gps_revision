<div class="container">

    <?php if ($this->session->flashdata('succ')) : ?>
        <div class="alert alert-success mb-0 text-center rounded-0">
            <?= $this->session->flashdata('succ'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-danger mb-0 text-center rounded-0">
            <?= $this->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>

    <!-- tombol trigger modal -->
    <button class="badge badge-primary border-0" data-toggle="modal" data-target="#tambah">
        + Tambah
    </button>

    <!-- EDIT DATA MODAL -->
    <div class="modal fade" id="ubah" tabindex="-1" aria-labelledby="UbahHarga" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="<?= base_url('superadmin/ubah_rute') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="text-dark mb-0"><strong>Ubah Rute</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row pt-3 mb-3">
                        <div class="col">
                            <input type="hidden" name="ID" id="edit_ID">
                            <label class="sr-only" for="edit_bbawah">Batas Bawah</label>
                            <div class="input-group mb-2">
                                <input type="number" readonly min="0" maxlength="6" class="form-control rounded-0" name="range_low" id="edit_bbawah" placeholder="Batas Bawah">
                                <div class="input-group-prepend">
                                    <label for="bbawah" class="input-group-text"><b>Kilometer</b></label>
                                </div>
                            </div>

                        </div>
                        <div class="col">

                            <label class="sr-only" for="edit_batas">Batas Atas</label>
                            <div class="input-group mb-2">
                                <input type="number" readonly min="0" maxlength="6" name="range_high" class="form-control rounded-0" id="edit_batas" placeholder="Batas Atas">
                                <div class="input-group-prepend">
                                    <label for="batas" class="input-group-text"><b>Kilometer</b></label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <label class="sr-only" for="edit_harga_display">Harga</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <label for="edit_harga_display" class="input-group-text rounded-0"><b>Rp</b></label>
                                </div>
                                <input type="text" class="form-control rounded-0" id="edit_harga_display" placeholder="Harga">

                                <input type="hidden" name="harga" id="edit_harga">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('superadmin/kelola-rute-kirim') ?>" class="btn btn-warning">reset</a>
                    <input type="submit" value="simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <!-- INPUT DATA MODAL -->
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="TambahHarga" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="<?= base_url('superadmin/tambah_rute') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="text-dark mb-0"><strong>Tambah Rute</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col">

                            <label class="sr-only" for="kode">Kode Rute</label>
                            <div class="input-group mb-2">
                                <input type="text" name="kode" maxlength="3" class="form-control rounded-0" id="kode" placeholder="Kode Rute">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <label class="sr-only" for="rute">Rute</label>
                            <div class="input-group mb-2">
                                <input type="text" name="rute" maxlength="3" class="form-control rounded-0" id="rute" placeholder="Rute">
                            </div>

                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">

                            <label for="mtds" class="sr-only">Metode</label>
                            <select name="metode" required id="mtds" class="form-control rounded-0">
                                <option value="">-- Metode Pengiriman --</option>
                                <?php foreach ($mtds as $mtd): ?>
                                    <option value="<?= $mtd['ID'] ?>"><?= $mtd['metode_kirim'] ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <label class="sr-only" for="harga_display">Harga Kg</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <label for="harga_display" class="input-group-text rounded-0"><b>Rp</b></label>
                                </div>
                                <input type="text" class="form-control rounded-0" id="harga_display" placeholder="Harga Kg">

                                <input type="hidden" name="harga" id="harga">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <label class="sr-only" for="tarif_display">Tarif Kubikasi</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <label for="tarif_display" class="input-group-text rounded-0"><b>Rp</b></label>
                                </div>
                                <input type="text" class="form-control rounded-0" id="tarif_display" placeholder="Tarif Kubikasi">

                                <input type="hidden" name="tarif" id="tarif">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('superadmin/kelola-rute-kirim') ?>" class="btn btn-warning">reset</a>
                    <input type="submit" value="simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <!-- TABLE -->
    <?php $nomor = 1; ?>
    <table class="table table-hover text-center">
        <thead>
            <tr>
                <th scope="col" class="col-sm-1">Kode</th>
                <th scope="col" class="" colspan="2">Rute</th>
                <th scope="col" class="">Harga (/kg)</th>
                <th scope="col">Tarif Kubikasi</th>
                <th scope="col">Estimasi Hari</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($rts)) { ?>
                <?php foreach ($rts as $rt) : ?>
                    <tr>
                        <td><?= $rt['kode'] ?></td>
                        <td class="col-2"><?= $rt['rute'] ?></td>
                        <td class="col-2">Rp.<?= $rt['harga_kg_formatted'] ?></td> <!-- Harga -->
                        <td>Rp.<?= $rt['tarif_kubikasi_formatted'] ?></td> <!-- Harga -->
                        <td><?= $rt['estimasi_hari'] ?></td>
                        <td class="col-2">
                            <button type="button"
                                onclick="fill('edit_ID', '<?= $rt['ID'] ?>');
                                    fill('edit_bbawah','<?= $rt['range_low'] ?>');
                                    fill('edit_batas','<?= $rt['range_high'] ?>');
                                    fill('edit_harga', '<?= $rt['harga'] ?>');
                                    fill('edit_harga_display', '<?= $rt['harga_formatted'] ?>');"
                                data-toggle="modal" data-target="#ubah" class="badge border-0 badge-warning text-danger">edit</button>
                            <a href="<?= base_url('superadmin/kelola-rute-kirim/hapus/' . md5($harga['ID'])) ?>" class="badge badge-danger">delete</a>
                        </td> <!-- Button -->
                    </tr>
                <?php endforeach; ?>
            <?php } else { ?>
                <tr>
                    <td colspan="100">tidak ada data.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const displayInput = document.getElementById('harga_display');
        const hiddenInput = document.getElementById('harga');

        function formatRupiah(angka) {
            return angka.replace(/\D/g, '')
                .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        displayInput.addEventListener('input', function() {
            const raw = displayInput.value.replace(/\./g, '').replace(/\D/g, '');
            displayInput.value = formatRupiah(raw);
            hiddenInput.value = raw;
        });

        const t_displayInput = document.getElementById('tarif_display');
        const t_hiddenInput = document.getElementById('tarif');

        function formatRupiah(angka) {
            return angka.replace(/\D/g, '')
                .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        t_displayInput.addEventListener('input', function() {
            const raw = t_displayInput.value.replace(/\./g, '').replace(/\D/g, '');
            t_displayInput.value = formatRupiah(raw);
            t_hiddenInput.value = raw;
        });

        const edit_displayInput = document.getElementById('edit_harga_display');
        const edit_hiddenInput = document.getElementById('edit_harga');

        edit_displayInput.addEventListener('input', function() {
            const raw = edit_displayInput.value.replace(/\./g, '').replace(/\D/g, '');
            edit_displayInput.value = formatRupiah(raw);
            edit_hiddenInput.value = raw;
        });
    });

    function fill(id, isi) {
        document.getElementById(id).value = isi;
    }
</script>