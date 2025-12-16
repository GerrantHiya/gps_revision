<div class="container">

    <?php if ($this->session->flashdata('message')) : ?>
        <div class="alert alert-danger mb-0 text-center rounded-0">
            <?= $this->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('succ')) : ?>
        <div class="alert alert-success mb-0 text-center rounded-0">
            <?= $this->session->flashdata('succ'); ?>
        </div>
    <?php endif; ?>

    <!-- tombol trigger modal -->
    <button class="badge badge-primary border-0" data-toggle="modal" data-target="#tambah">
        + Tambah
    </button>

    <!-- INPUT DATA MODAL -->
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="TambahHarga" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="<?= base_url('superadmin/tambah_kurir') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="text-dark mb-0"><strong>Tambah Tipe Kurir</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="tipe" id="tipe" class="form-control rounded-0" placeholder="Tipe Kurir">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <select name="tipe_2" required id="tipe_2" class="form-control rounded-0">
                                <option value="">-- Pilih Moda Transportasi --</option>
                                <option value="pesawat">Pesawat</option>
                                <option value="kapal laut">Kapal Laut</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <input type="number" min="0" max="14" name="durasi" id="durasi" class="form-control rounded-0" placeholder="Durasi Hari">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <label class="sr-only" for="harga_display">Harga</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <label for="harga_display" class="input-group-text rounded-0"><b>Rp</b></label>
                                </div>
                                <input type="text" class="form-control rounded-0" id="harga_display" placeholder="Biaya">

                                <input type="hidden" name="harga" id="harga">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('superadmin/kelola-tipe-kurir') ?>" class="btn btn-warning">reset</a>
                    <input type="submit" value="simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT DATA MODAL -->
    <div class="modal fade" id="ubah" tabindex="-1" aria-labelledby="UbahHarga" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="<?= base_url('superadmin/kelola-tipe-kurir/edit') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="text-dark mb-0"><strong>Ubah Rute</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ID" id="edit_ID">
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="tipe" id="edit_tipe" class="form-control rounded-0" placeholder="Tipe Kurir">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <input type="number" min="0" max="14" name="durasi" id="edit_durasi" class="form-control rounded-0" placeholder="Durasi Hari">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <label class="sr-only" for="edit_harga_display">Harga</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <label for="edit_harga_display" class="input-group-text rounded-0"><b>Rp</b></label>
                                </div>
                                <input type="text" class="form-control rounded-0" id="edit_harga_display" placeholder="Biaya">

                                <input type="hidden" name="harga" id="edit_harga">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('superadmin/kelola-tipe-kurir') ?>" class="btn btn-warning">reset</a>
                    <input type="submit" value="simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <!-- TABLE -->
    <?php $nomor = 1; ?>
    <table class="table table-hover text-center mt-3">
        <thead>
            <tr>
                <th scope="col" class="col-1">No.</th>
                <th scope="col" class="">Rute</th>
                <th scope="col" class="">Durasi (hari)</th>
                <th scope="col" class="">Biaya</th>
                <th scope="col" class="">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($list_tipekurir)) { ?>
                <?php foreach ($list_tipekurir as $tipekurir) : ?>
                    <?php if ($tipekurir['deactivate'] == 0) : ?>
                        <tr>
                            <td><?= $nomor++ ?></td> <!-- Nomor -->
                            <td class=""><?= $tipekurir['tipe'] ?></td>
                            <td class=""><?= $tipekurir['durasi_hari'] ?></td>
                            <td class="">Rp.<?= $tipekurir['biaya_formatted'] ?></td> <!-- Harga -->
                            <td class="">
                                <button type="button"
                                    onclick="
                                fill('edit_ID', '<?= $tipekurir['ID'] ?>');
                                fill('edit_tipe', '<?= $tipekurir['tipe'] ?>');
                                fill('edit_durasi', '<?= $tipekurir['durasi_hari'] ?>');
                                fill('edit_harga', '<?= $tipekurir['biaya'] ?>');
                                fill('edit_harga_display', '<?= $tipekurir['biaya_formatted'] ?>');
                                "
                                    data-toggle="modal" data-target="#ubah" class="badge border-0 badge-warning text-danger">edit</button>
                                <a href="<?= base_url('superadmin/kelola-tipe-kurir/hapus/' . md5($tipekurir['ID'])) ?>" class="badge badge-danger">delete</a>
                            </td> <!-- Button -->
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php } else { ?>
                <tr>
                    <td colspan="100">tidak ada data.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation">
        <?= $pages ?>
    </nav>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const displayInput = document.getElementById('harga_display');
        const hiddenInput = document.getElementById('harga');
        const edit_displayInput = document.getElementById('edit_harga_display');
        const edit_hiddenInput = document.getElementById('edit_harga');

        function formatRupiah(angka) {
            return angka.replace(/\D/g, '')
                .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }

        displayInput.addEventListener('input', function() {
            const raw = displayInput.value.replace(/\./g, '').replace(/\D/g, '');
            displayInput.value = formatRupiah(raw);
            hiddenInput.value = raw;
        });

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