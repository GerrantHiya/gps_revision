<div class="container">

    <!-- tombol trigger modal -->
    <button class="badge badge-primary border-0" data-toggle="modal" data-target="#tambah">
        + Tambah
    </button>

    <!-- INPUT DATA MODAL -->
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="TambahHarga" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="<?= base_url('superadmin/tambah_harga_kg') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="text-dark mb-0"><strong>Tambah Harga</strong></h4>
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

                    <div class="row pt-3 mb-3">
                        <div class="col">

                            <label class="sr-only" for="bbawah">Batas Bawah</label>
                            <div class="input-group mb-2">
                                <input type="number" min="0" maxlength="6" class="form-control rounded-0" name="range_low" id="bbawah" placeholder="Batas Bawah">
                                <div class="input-group-prepend">
                                    <label for="bbawah" class="input-group-text"><b>Kilogram</b></label>
                                </div>
                            </div>

                        </div>
                        <div class="col">

                            <label class="sr-only" for="batas">Batas Atas</label>
                            <div class="input-group mb-2">
                                <input type="number" min="0" maxlength="6" name="range_high" class="form-control rounded-0" id="batas" placeholder="Batas Atas">
                                <div class="input-group-prepend">
                                    <label for="batas" class="input-group-text"><b>Kilogram</b></label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                            <label class="sr-only" for="harga_display">Harga</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <label for="harga_display" class="input-group-text rounded-0"><b>Rp</b></label>
                                </div>
                                <input type="text" class="form-control rounded-0" id="harga_display" placeholder="Harga">

                                <input type="hidden" name="harga" id="harga">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('superadmin/harga-bobot') ?>" class="btn btn-warning">reset</a>
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
                <th scope="col" class="col-sm-1">No.</th>
                <th scope="col" class="" colspan="2">Range Jarak</th>
                <th scope="col" class="">Harga (/kg)</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($list_harga)) { ?>
                <?php foreach ($list_harga as $harga) : ?>
                    <tr>
                        <td><?= $nomor++ ?></td> <!-- Nomor -->
                        <td class="col-2">lowest: <?= $harga['range_low'] ?> kg</td> <!-- Low -->
                        <td class="col-2">highest: <?= $harga['range_high'] ?> kg</td> <!-- High -->
                        <td>Rp.<?= $harga['harga_formatted'] ?></td> <!-- Harga -->
                        <td class="col-2">
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
    });
</script>