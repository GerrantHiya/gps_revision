<?php $nomor = 1 ?>
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
            <form class="modal-content" action="<?= base_url('superadmin/tambah_kategori') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="text-dark mb-0"><strong>Tambah Kategori</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col">

                            <label class="sr-only" for="kategori">Kategori</label>
                            <input type="text" class="form-control rounded-0" id="kategori" name="kategori" placeholder="Kategori">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <label class="sr-only" for="harga_display">Biaya Extra</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <label for="harga_display" class="input-group-text rounded-0"><b>Rp</b></label>
                                </div>
                                <input type="text" class="form-control rounded-0" id="harga_display" placeholder="Biaya Extra">

                                <input type="hidden" name="harga" id="harga">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('superadmin/harga-kategori') ?>" class="btn btn-warning">reset</a>
                    <input type="submit" value="simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT DATA MODAL -->
    <div class="modal fade" id="ubah" tabindex="-1" aria-labelledby="UbahHarga" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="<?= base_url('superadmin/ubah_kategori') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="text-dark mb-0"><strong>Ubah Kategori</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col">
                            <input type="hidden" name="ID" id="edit_ID">
                            <label class="sr-only" for="edit_kategori">Kategori</label>
                            <input type="text" class="form-control rounded-0" id="edit_kategori" name="kategori" placeholder="Kategori">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <label class="sr-only" for="edit_harga_display">Biaya Extra</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <label for="edit_harga_display" class="input-group-text rounded-0"><b>Rp</b></label>
                                </div>
                                <input type="text" class="form-control rounded-0" id="edit_harga_display" placeholder="Biaya Extra">

                                <input type="hidden" name="harga" id="edit_harga">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('superadmin/harga-kategori') ?>" class="btn btn-warning">reset</a>
                    <input type="submit" value="simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <!-- TABLE VIEW -->
    <table class="table table-hover text-center mt-3">
        <thead>
            <tr>
                <th scope="col" class="col-sm-1">No.</th>
                <th scope="col" class="">Nama Kategori</th>
                <th scope="col" class="">Biaya Ekstra (/unit)</th>
                <th scope="col" class="col-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($list_kategori)) { ?>
                <?php foreach ($list_kategori as $kategori) { ?>
                    <?php if ($kategori['is_deactivate'] == 0) : ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= $kategori['Nama'] ?></td>
                            <td>Rp.<?= $kategori['harga_formatted'] ?></td>
                            <td>
                                <button type="button"
                                    onclick="fill('edit_ID', '<?= $kategori['ID'] ?>');
                                    fill('edit_kategori', '<?= $kategori['Nama'] ?>');
                                    fill('edit_harga_display', '<?= $kategori['harga_formatted'] ?>');
                                    fill('edit_harga', '<?= $kategori['harga'] ?>');
                                    "
                                    data-toggle="modal" data-target="#ubah" class="badge border-0 badge-warning text-danger">edit</button>
                                <a href="<?= base_url('superadmin/harga-kategori/hapus/' . md5($kategori['ID'])) ?>" class="badge badge-danger">delete</a>
                            </td>
                        </tr>
                    <?php endif; ?>
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