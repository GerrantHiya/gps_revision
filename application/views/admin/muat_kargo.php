<div class="container">

    <div class="row">
        <div class="col-md">
            <a href="<?= base_url('superadmin/proses-kirim') ?>" class="badge badge-secondary mb-3">&laquo; kembali</a>
        </div>
        <div class="col-md"></div>
        <div class="col-md">
            <label for="" class="form-label"><strong>Nama Sopir :</strong></label>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md">
            <input type="text" value="<?= $armada['nama_jenis'] ?? '' ?>" disabled class="form-control text-center">
        </div>
        <div class="col-md">
            <input type="text" value="<?= $armada['plat_nomor'] ?? '' ?>" disabled class="form-control text-center">
        </div>
        <div class="col-md">
            <input type="text" value="<?= $armada['NamaLengkap'] ?? '' ?>" disabled class="form-control text-center">
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="m-0"><strong>Tambah Muatan</strong></h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('superadmin/proses-kirim/load/' . $id_armada_md5) ?>" method="post" class="mb-3">
                <div class="col">
                    <input type="text" name="ID_pengiriman" id="ID_pengiriman" class="form-control rounded-0" placeholder="ID Pengiriman / No. Resi">
                    <?= form_error('ID_pengiriman', '<div class="alert alert-danger mt-3">', '</div>') ?>
                </div>
                <div class="row mt-3 px-4">
                    <input type="submit" value="add item" class="btn btn-primary">
                    <input type="reset" value="clear" class="btn btn-secondary mx-2">
                    <?php if ($this->session->flashdata('error')) { ?>
                        <?= $this->session->flashdata('error') ?>
                    <?php } ?>
                </div>
            </form>

            <table class="table table-hover text-center">
                <thead>
                    <tr class="border border-1">
                        <th scope="col">Resi</th>
                        <th scope="col">Kota Tujuan</th>
                        <th scope="col">Tipe Kargo</th>
                        <th scope="col">Bobot (kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list_kargo_termuat)) { ?>
                        <?php foreach ($list_kargo_termuat as $kargo) : ?>
                            <tr class="border border-1">
                                <td><?= $kargo['no_resi'] ?></td>
                                <td><?= $kargo['kota_tujuan'] ?></td>
                                <td><?= $kargo['nama_kategori'] ?></td>
                                <td><?= $kargo['bobot'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <tr class="border border-1">
                            <td colspan="100"><?= 'tidak ada data.' ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <section class="card mb-4">
        <div class="card-header text-center bg-primary text-white">
            <h3 class="m-0"><strong>Paket Siap Kirim</strong></h3>
        </div>
        <div class="card-body">

            <div class="row mb-4">
                <div class="col-md"></div>
                <div class="col-md"></div>
                <form class="col-md-3 text-center" action="<?= base_url('superadmin/proses-kirim/load/' . $id_armada_md5) ?>" method="get">
                    <div class="row">
                        <select name="sort_kota" id="sort_kota" class="form-control select col-md mx-1">
                            <option value="">-- pilih kota --</option>
                            <?php foreach ($kota_tersedia as $kota) : ?>
                                <option value="<?= $kota['kota_tujuan'] ?>"><?= $kota['kota_tujuan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="col-1 btn btn-white mx-1 p-0">
                            <img src="<?= base_url('assets/ico/search.png') ?>" alt="" class="img-fluid">
                        </button>
                    </div>
                </form>
            </div>

            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col" class="col-md-2">Resi</th>
                        <th scope="col" class="col-md-2">Target Tiba</th>
                        <th scope="col" class="col-md">Alamat Lengkap</th>
                        <th scope="col" class="col-md-1">Bobot (kg)</th>
                        <th scope="col" class="col-md-1">Volume (m<sup>3</sup>)</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($list_kargo_tersedia)) { ?>
                        <?php foreach ($list_kargo_tersedia as $kargo) : ?>
                            <tr>
                                <td><?= $kargo['no_resi'] ?></td>
                                <td><?= $kargo['target_tiba'] != null ? date('d M Y', strtotime($kargo['target_tiba'])) : '' ?></td>
                                <td><?= $kargo['alamat_tujuan'] . ', ' . $kargo['kota_tujuan'] ?></td>
                                <td><?= $kargo['bobot'] ?></td>
                                <td><?= $kargo['volume'] ?></td>
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

        <div class="card-footer">
            <!-- PAGES -->
            <nav aria-label="Page navigation">
                <?= $pages ?>
            </nav>
        </div>

    </section>

</div>

<script>
    $(document).ready(function() {
        $('.select').select2();
    });
</script>