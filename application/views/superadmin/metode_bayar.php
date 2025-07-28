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
                    <tr>
                        <td><?= $nomor++ ?></td> <!-- Nomor -->
                        <td class="text-left"><?= $metode['metode'] ?> <?= $metode['is_card'] == 1 ? '(use card)' : '' ?></td>
                        <td><?= $metode['bank'] ?? '-- tanpa bank --' ?></td>
                        <td>
                            <a href="" class="badge badge-warning text-danger">edit</a>
                            <a href="" class="badge badge-danger">delete</a>
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