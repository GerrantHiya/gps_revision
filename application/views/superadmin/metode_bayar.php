<div class="container">

    <!-- tombol trigger modal -->
    <button class="badge badge-primary border-0" data-toggle="modal" data-target="#tambah">
        + Tambah
    </button>

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

    <!-- EDIT DATA MODAL -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="EditHarga" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="<?= base_url('superadmin/ubah_metode_bayar') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="text-dark mb-0"><strong>Edit Metode</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="ID" id="edit_ID">

                    <div class="row mb-2">
                        <div class="col">

                            <label class="sr-only" for="metode_bayar">Nama Metode</label>
                            <div class="mb-2">
                                <input type="text" required class="form-control rounded-0" name="metode_bayar" id="edit_nama" placeholder="Jenis Metode">
                            </div>

                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">

                            <label class="sr-only" for="nama_bank">Nama Bank</label>
                            <div class="mb-2">
                                <input type="text" class="form-control rounded-0" name="nama_bank" id="edit_bank" placeholder="Nama Bank">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <label class="sr-only" for="is_card">Apakah Menggunakan Kartu?</label>
                            <div class="mb-2">
                                <select name="is_card" required id="edit_is_card" class="form-control rounded-0">
                                    <option value="">-- Apakah Menggunakan Kartu? --</option>
                                    <option value="1">Ya, Menggunakan Kartu</option>
                                    <option value="0">Tidak, Tanpa Kartu</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <!-- INPUT DATA MODAL -->
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="TambahHarga" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="<?= base_url('superadmin/tambah_metode_bayar') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="text-dark mb-0"><strong>Tambah Metode</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row mb-2">
                        <div class="col">

                            <label class="sr-only" for="metode_bayar">Nama Metode</label>
                            <div class="mb-2">
                                <input type="text" required class="form-control rounded-0" name="metode_bayar" id="metode_bayar" placeholder="Jenis Metode">
                            </div>

                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">

                            <label class="sr-only" for="nama_bank">Nama Bank</label>
                            <div class="mb-2">
                                <input type="text" class="form-control rounded-0" name="nama_bank" id="nama_bank" placeholder="Nama Bank">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <label class="sr-only" for="is_card">Apakah Menggunakan Kartu?</label>
                            <div class="mb-2">
                                <select name="is_card" required id="is_card" class="form-control rounded-0">
                                    <option value="">-- Apakah Menggunakan Kartu? --</option>
                                    <option value="1">Ya, Menggunakan Kartu</option>
                                    <option value="0">Tidak, Tanpa Kartu</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
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
                <th scope="col" class="col-1">No.</th>
                <th scope="col" class="col-4">Metode</th>
                <th scope="col" class="">Bank</th>
                <th scope="col" class="col-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($metode_bayar)) { ?>
                <?php foreach ($metode_bayar as $metode) : ?>
                    <?php if ($metode['deactivate'] == 0) : ?>
                        <tr>
                            <td><?= $nomor++ ?></td> <!-- Nomor -->
                            <td class="text-left"><?= $metode['metode'] ?> <?= $metode['is_card'] == 1 ? '(use card)' : '' ?></td>
                            <td><?= $metode['bank'] ?? '-- tanpa bank --' ?></td>
                            <td>
                                <button type="button"
                                    onclick="fill('edit_ID', '<?= $metode['ID'] ?>'); fill('edit_nama', '<?= $metode['metode'] ?>'); fill('edit_bank', '<?= $metode['bank'] ?>'); fill('edit_is_card','<?= $metode['is_card'] ?>')"
                                    data-toggle="modal" data-target="#edit" class="badge badge-warning text-danger border-0">edit</button>
                                <a href="<?= base_url('superadmin/kelola-metode-bayar/hapus/' . md5($metode['ID'])) ?>" class="badge badge-danger">delete</a>
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

</div>

<script>
    function fill(id, isi) {
        document.getElementById(id).value = isi;
    }
</script>