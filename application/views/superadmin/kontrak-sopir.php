<style>
    .error-message {
        color: red;
        font-size: 0.9em;
        margin-top: 5px;
        display: none;
    }
</style>

<?php $nomor = 1 ?>

<div class="container">

    <div class="row">
        <div class="col">
            <!-- tombol trigger modal -->
            <button class="badge badge-primary border-0" data-toggle="modal" data-target="#tambah">
                + Tambah
            </button>
        </div>
        <div class="col"></div>
        <div class="col"></div>
    </div>

    <table class="table table-hover text-center mt-3">
        <thead>
            <tr>
                <th scope="col" class="col-1 border">No.</th>
                <th scope="col" class="col-2 border">NIK</th>
                <th scope="col" class="col-3 border">Nama Lengkap</th>
                <th scope="col" class="col-2 border">SIM/hire_date</th>
                <th scope="col" class="col-2 border">Surat Kontrak</th>
                <th scope="col" class="col-2 border">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($list_sopir)) { ?>
                <tr class="border">
                    <td colspan="100">Tidak ada data.</td>
                </tr>
            <?php } else { ?>
                <?php foreach ($list_sopir as $sopir) : ?>
                    <section id="<?= $sopir['ID'] ?>">
                        <tr class="border">
                            <td><?= $nomor++ ?></td>
                            <td><?= $sopir['ID'] ?></td>
                            <td>
                                <?= $sopir['NamaLengkap'] ?>
                                <?= $sopir['is_active'] == 0 ? '<div class="text-danger">inactive</div>' : '<div class="text-success">active</div>' ?>
                            </td>
                            <td>
                                <?php if (empty($sopir['foto_SIM'])) { ?>
                                    <div class="text-danger">belum ada</div>
                                <?php } else { ?>
                                    <img src="<?= base_url('assets/img/SIM/') . $sopir['foto_SIM'] ?>" class="img-fluid">
                                <?php } ?>
                                <small class="text-primary">Hired: <strong><?= date("d M Y", strtotime($sopir['hire_date'])) ?></strong></small>
                            </td>
                            <td>
                                <a href="<?= base_url('superadmin/kontrak-sopir/daftar/') . md5($sopir['ID']) ?>" title="Lihat Dokumen" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                    </svg>
                                </a>
                            </td>
                            <td>
                                <a href="<?= base_url('superadmin/kontrak-sopir/edit/') . md5($sopir['ID']) ?>" class="badge badge-warning">edit</a>
                                <!--<a href="" class="badge badge-danger">delete</a>-->
                            </td>
                        </tr>
                    </section>
                <?php endforeach ?>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- INPUT DATA MODAL -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="TambahSopir" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="<?= base_url('superadmin/tambah_sopir') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h4 class="text-dark mb-0"><strong>Tambah Sopir</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php if ($this->session->flashdata('message')) : ?>
                    <div class="alert alert-danger mb-0 text-center rounded-0">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                <?php endif; ?>

                <div class="row mb-3">
                    <div class="col">
                        <label class="sr-only" for="NIK">NIK</label>
                        <input maxlength="16" type="text" class="form-control rounded-0" id="NIK" name="NIK" required placeholder="Nomor Induk Kependudukan (NIK)">
                        <label id="nik-error" class="error-message">tidak valid, harus 16 digit</label>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="sr-only" for="NamaLengkap">Nama Lengkap</label>
                        <input type="text" class="form-control rounded-0" id="NamaLengkap" name="NamaLengkap" required placeholder="Nama Lengkap">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-3">
                        <label class="" for="foto_sim"><strong>Foto SIM:</strong></label>
                    </div>
                    <div class="col">
                        <input type="file" class="form-control rounded-0" id="foto_sim" name="foto_sim">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?= base_url('superadmin/kontrak-sopir') ?>" class="btn btn-warning">reset</a>
                <input type="submit" value="simpan" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<script>
    const nikInput = document.getElementById('NIK');
    const errorLabel = document.getElementById('nik-error');

    nikInput.addEventListener('input', function() {
        // Hapus karakter non-angka
        this.value = this.value.replace(/\D/g, '');

        // Validasi panjang 16 digit
        if (this.value.length === 0 || this.value.length === 16) {
            errorLabel.style.display = 'none';
        } else {
            errorLabel.style.display = 'block';
        }
    });
</script>