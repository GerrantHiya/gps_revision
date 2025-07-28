<div class="container mb-3">

    <div class="">
        <a href="<?= base_url('superadmin/kontrak-sopir') ?>" class="badge badge-secondary mb-3">&laquo; kembali</a>

        <!-- tombol trigger modal -->
        <button class="badge badge-primary border-0" data-toggle="modal" data-target="#tambah">
            + upload kontrak
        </button>
    </div>

    <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('message') ?></div>
    <?php } ?>

    <form action="<?= base_url('superadmin/edit_data_sopir') ?>" method="post" class="card rounded-0" enctype="multipart/form-data">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-2">
                    <label for="NIK"><strong>NIK</strong></label>
                </div>
                <div class="col">
                    <input type="text" name="NIK" id="NIK" class="form-control rounded-0 bg-light" value="<?= $sopir['sopir_ID'] ?>" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-2">
                    <label for="NamaLengkap"><strong>Nama Lengkap</strong></label>
                </div>
                <div class="col">
                    <input type="text" name="NamaLengkap" id="NamaLengkap" class="form-control rounded-0" value="<?= $sopir['NamaLengkap'] ?>" placeholder="Nama Lengkap">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-2">
                    <label for="foto_SIM"><strong>SIM</strong></label>
                </div>
                <div class="col">
                    <div class="row">
                        <?php if (!empty($sopir['foto_SIM'])) { ?>
                            <div class="col">
                                <img src="<?= base_url('assets/img/SIM/') . $sopir['foto_SIM'] ?>" class="img-fluid border p-1" alt="<?= $sopir['NamaLengkap'] ?>">
                            </div>
                        <?php } ?>
                        <div class="col">
                            <input type="file" name="foto_sim" id="foto_sim" class="form-control rounded-0">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-2">
                    <label for="is_active"><strong>Aktif</strong></label>
                </div>
                <div class="col">
                    <input type="checkbox" name="is_active" id="is_active" <?= $sopir['is_active'] == 1 ? 'checked' : '' ?> <?= empty($sopir['kontrak_sopir']) ? 'disabled' : '' ?>>
                    <?= ($sopir['kontrak_sopir']) == 0 ? 'hanya bisa aktif jika kontrak kerja sudah di <i>upload</i>' : '' ?>
                </div>
            </div>

        </div>
        <div class="card-footer text-right">
            <input type="submit" value="save changes" class="btn btn-primary">
        </div>
    </form>

</div>

<!-- INPUT DATA MODAL -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="TambahSopir" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="<?= base_url('superadmin/tambah_kontrak_sopir') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h4 class="text-dark mb-0"><strong>Tambah Kontrak</strong></h4>
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
                    <div class="col-3">
                        <label class="" for="NIK"><strong>NIK</strong></label>
                    </div>
                    <div class="col">
                        <input maxlength="16" type="text" class="form-control rounded-0" id="NIK" value="<?= $sopir['sopir_ID'] ?>" readonly name="NIK" placeholder="Nomor Induk Kependudukan (NIK)">
                    </div>
                </div>

                <div class="row ">
                    <div class="col-3">
                        <label class="" for="NoKontrak"><strong>Nomor Kontrak</strong></label>
                    </div>
                    <div class="col">
                        <input maxlength="255" type="text" class="form-control rounded-0" id="NoKontrak" name="NoKontrak" placeholder="Nomor Surat Kontrak">
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <label class="" for="start_date"><strong>Tanggal Mulai:</strong></label>
                    </div>
                    <div class="col">
                        <input type="date" name="start_date" id="start_date" value="<?= date("Y-m-d") ?>" class="form-control rounded-0">
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <label class="" for="end_date"><strong>Tanggal Akhir:</strong></label>
                    </div>
                    <div class="col">
                        <input type="date" name="end_date" id="end_date" value="<?= date("Y-m-d", strtotime('+1 day')) ?>" class="form-control rounded-0">
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <label class="" for="file_kontrak"><strong>File Kontrak:</strong></label>
                    </div>
                    <div class="col">
                        <input type="file" class="form-control rounded-0" id="file_kontrak" name="file_kontrak">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="submit" value="simpan" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>