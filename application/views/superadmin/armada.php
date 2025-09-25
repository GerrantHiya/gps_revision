<?php $nomor = 1 ?>
<div class="container">

    <!-- tombol trigger modal -->
    <button class="badge badge-primary border-0" data-toggle="modal" data-target="#tambah">
        + Tambah
    </button>

    <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert alert-danger mt-2 mb-2"><?= $this->session->flashdata('message') ?></div>
    <?php } ?>

    <!-- TABLE -->
    <table class="table table-hover text-center mt-3 mb-3">
        <thead>
            <tr>
                <th scope="col" class="col-md-1">No.</th>
                <th scope="col" class="">Jenis-No. Polisi</th>
                <th scope="col" class="">Sopir</th>
                <th scope="col" class="col-md-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($list_armada)) { ?>
                <?php foreach ($list_armada as $armada) { ?>
                    <tr>
                        <td><?= $nomor++ ?></td>
                        <td>
                            <?= $armada['nama_jenis'] ?>-<?= $armada['plat_nomor'] ?>
                            <?php if ($this->session->flashdata('id_armada' . $armada['armada_ID'])): ?>
                                <div class="alert alert-primary"><?= $this->session->flashdata('id_armada' . $armada['armada_ID']) ?></div>
                            <?php endif ?>
                        </td>
                        <form action="<?= base_url('superadmin/pilih_sopir?nopol=') . $armada['plat_nomor'] ?>" method="post">
                            <td>
                                <select name="sopir" id="sopir" class="form-control rounded-0 border-0 p-1">
                                    <option value="">- Pilih Sopir -</option>
                                    <?php foreach ($list_sopir as $sopir) { ?>
                                        <?php if ($sopir['ID'] == $armada['sopir_ID']) { ?>
                                            <option value="<?= $sopir['ID'] ?>" selected><?= $sopir['NamaLengkap'] ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $sopir['ID'] ?>"><?= $sopir['NamaLengkap'] ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="badge badge-primary border-0">save</button>
                                <a href="<?= base_url('superadmin/showarmadaid?id=' . md5($armada['armada_ID'])) ?>" class="badge badge-secondary">show ID</a>
                                <a href="<?= base_url('superadmin/kelola-armada/detail/') . $armada['plat_nomor'] ?>" class="badge badge-warning">lacak</a>
                                <a href="<?= base_url('superadmin/kelola-armada/hapus/' . md5($armada['armada_ID'])) ?>" class="badge badge-danger">delete</a>
                            </td>
                        </form>
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

<!-- INPUT DATA MODAL -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="TambahHarga" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="<?= base_url('superadmin/kelola-armada') ?>" method="post" enctype="multipart/form-data">
            <div class="modal-header">
                <h4 class="text-dark mb-0"><strong>Tambah Armada</strong></h4>
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

                <div class="row">
                    <div class="col">
                        <label class="sr-only" for="nopol">No. Polisi</label>
                        <input type="text" class="form-control rounded-0" id="nopol" required name="nopol" oninput="formatNopol(this)" maxlength="9" placeholder="No. Polisi">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label class="sr-only" for="jenis">Jenis Armada</label>
                        <select name="jenis" id="jenis" class="form-control rounded-0" required>
                            <option value="">-- Pilih Jenis Armada --</option>
                            <?php foreach ($list_jenis as $jenis) { ?>
                                <option value="<?= $jenis['id_jenis_armada'] ?>"><?= $jenis['nama_jenis'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label class="sr-only" for="sopir">Sopir</label>
                        <select name="sopir" id="sopir" class="form-control rounded-0">
                            <option value="">-- Pilih Sopir Armada --</option>
                            <?php foreach ($list_sopir as $sopir) { ?>
                                <option value="<?= $sopir['ID'] ?>"><?= $sopir['NamaLengkap'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label for="keterangan" class="sr-only">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control rounded-0" rows="3" placeholder="Keterangan"></textarea>
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
<script>
    function formatNopol(input) {
        // Ambil nilai saat ini
        let value = input.value;
        // Hapus semua karakter kecuali huruf dan angka
        value = value.replace(/[^a-zA-Z0-9]/g, '');
        // Ubah ke huruf kapital
        input.value = value.toUpperCase();
    }
</script>