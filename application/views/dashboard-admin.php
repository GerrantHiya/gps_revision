<!-- <select name="" class="form-control select2" multiple="multiple" id="">
    <option value="" selected>--pilih--</option>
    <option value="">1</option>
    <option value="">2</option>
    <option value="">3</option>
</select>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script> -->

<div class="card">
    <div class="card-body">
        <h4 class="text-dark">Halo <strong><?= $this->session->userdata('user')['NamaLengkap'] ?></strong></h4>
        <small>role: <strong><?= $this->session->userdata('user')['is_super'] == 1 ? 'Super Admin' : 'Admin' ?></strong></small>
    </div>
</div>

<?php if ($this->session->userdata('user')['is_super']) { ?>

    <div class="row mb-2 mt-2">
        <div class="col-md">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <strong class="text-wrap">Paket Belum Proses</strong>
                </div>
                <div class="card-body text-dark bg-white text-center">
                    <!-- JUMLAH PAKET BELUM PROSES -->
                    <h3><strong><?= $belum_proses['hasil'] ?></strong></h3>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <strong class="text-wrap">Paket Belum Tiba</strong>
                </div>
                <div class="card-body text-dark bg-white text-center">
                    <!-- JUMLAH PAKET BELUM TIBA -->
                    <h3><strong><?= $belum_tiba['hasil'] ?></strong></h3>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <strong class="text-wrap">Paket Selesai</strong>
                    (<?= date('Y') ?>)
                </div>
                <div class="card-body text-dark bg-white text-center">
                    <!-- JUMLAH PAKET MASUK ARMADA -->
                    <h3><strong><?= $selesai['hasil'] ?></strong></h3>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <strong class="text-wrap">Piutang Belum Dibayar</strong>
                </div>
                <div class="card-body text-dark bg-white text-center">
                    <!-- JUMLAH PIUTANG -->
                    <h3><strong>Rp.<?= $piutang['total_tunggakan'] ?></strong></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <strong class="text-wrap">Transaksi Lunas</strong>
                </div>
                <div class="card-body text-dark bg-white text-center">
                    <!-- Transaksi Lunas -->
                    <h3><strong>Rp.<?= $piutang['total_bayar'] ?></strong></h3>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <strong class="text-wrap">Tipe Kurir Terlaris</strong>
                </div>
                <div class="card-body text-dark bg-white text-center">
                    <!-- TIPE KURIR TERLARIS -->
                    <h3><strong><?= ucwords(strtolower($tipe_kurir_terlaris['hasil'])) ?></strong></h3>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <strong class="text-wrap">Kota Tujuan Terbanyak</strong>
                </div>
                <div class="card-body text-dark bg-white text-center">
                    <!-- KOTA TUJUAN TERBANYAK -->
                    <h3><strong><?= ucwords(strtolower($kota_tujuan_terbanyak['kota_tujuan'])) ?></strong></h3>
                </div>
            </div>
        </div>
    </div>

<?php } ?>