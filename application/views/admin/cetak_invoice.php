<div class="container">

    <div id="printArea">
        <div class="card bg-white rounded-0 mb-3">
            <h4 class="card-header text-center text-dark bg-white">
                <strong>BUKTI BAYAR</strong>
            </h4>

            <div class="card-body">
                <!-- DATA KIRIM -->
                <div class="row p-2">
                    <div class="col-md bg-light p-2 border mb-1">
                        <div class="mb-3">
                            <strong>PENGIRIM</strong>
                        </div>
                        <div class="row align-items-center mb-2">
                            <div class="col-sm-3">
                                <strong>Nama</strong>
                            </div>
                            <div class="col-sm">
                                <input readonly type="text" value="<?= $data_bayar['nama_pengirim'] ?>" class="form-control rounded-0">
                            </div>
                        </div>
                        <div class="row align-items-center mb-2">
                            <div class="col-sm-3">
                                <strong>Tanggal</strong>
                            </div>
                            <div class="col-sm">
                                <input readonly type="text" value="<?= date('d/m/Y', strtotime($data_bayar['tanggal_kirim'])) ?>" class="form-control rounded-0">
                            </div>
                        </div>
                    </div>

                    <div style="width: 10px;"></div>

                    <div class="col-md bg-light p-2 border mb-1">
                        <div class="mb-3">
                            <strong>PENERIMA</strong>
                        </div>
                        <div class="row align-items-center mb-2">
                            <div class="col-sm-3">
                                <strong>Nama</strong>
                            </div>
                            <div class="col-sm">
                                <input readonly type="text" value="<?= $data_bayar['nama_penerima'] ?>" class="form-control rounded-0">
                            </div>
                        </div>
                        <div class="row align-items-center mb-2">
                            <div class="col-sm-3">
                                <strong>Alamat</strong>
                            </div>
                            <div class="col-sm">
                                <input readonly type="text" value="<?= $data_bayar['alamat_tujuan'] ?>" class="form-control rounded-0">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DATA PAKET -->
                <div class="row p-2">
                    <div class="col mb-2 bg-light border p-2">
                        <div class="mb-3">
                            <strong>DATA PAKET</strong>
                        </div>

                        <div class="row mb-2 align-items-center">
                            <div class="col-md-2">
                                <strong>Kategori</strong>
                            </div>
                            <div class="col-md">
                                <input type="text" readonly value="<?= $data_bayar['nama_kategori'] ?>" class="form-control rounded-0">
                            </div>
                        </div>
                        <div class="row mb-2 align-items-center">
                            <div class="col-md-2">
                                <strong>Bobot</strong>
                            </div>
                            <div class="col-md-4">
                                <input type="text" readonly value="<?= $data_bayar['bobot'] ?> Kg" class="form-control rounded-0">
                            </div>
                        </div>
                        <div class="row mb-2 align-items-center">
                            <div class="col-md-2">
                                <strong>Volume</strong>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" readonly value="<?= number_format((float)($data_bayar['Volume'] ?? 0), 2) ?>" class="form-control rounded-0">
                                    <span class="input-group-text rounded-0">M<sup>3</sup></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DATA PEMBAYARAN -->
                <div class="row p-2">
                    <div class="col bg-light border p-2">
                        <div class="mb-3">
                            <strong>PEMBAYARAN</strong><br>
                            <small>No Kwitansi: <?= $data_bayar['ID_bayar'] ?></small><br>
                            <small><?= date('d/m/Y') ?></small>
                        </div>

                        <div class="row mb-2 align-items-center">
                            <div class="col-md-2">
                                <strong>Dibayar Oleh</strong>
                            </div>
                            <div class="col-md">
                                <input type="text" readonly value="<?= $data_bayar['atas_nama_bayar'] ?>" class="form-control rounded-0">
                            </div>
                        </div>
                        <div class="row mb-2 align-items-center">
                            <div class="col-md-2">
                                <strong>Tipe Kurir</strong>
                            </div>
                            <div class="col-md">
                                <input type="text" readonly value="<?= $data_bayar['tipe_kurir'] ?>" class="form-control rounded-0">
                            </div>
                        </div>
                        <div class="row mb-2 align-items-center">
                            <div class="col-md-2">
                                <strong>Metode Bayar</strong>
                            </div>
                            <div class="col-md">
                                <input type="text" readonly value="<?= $data_bayar['metode_bayar'] ?>" class="form-control rounded-0">
                            </div>
                        </div>
                        <div class="row mb-2 align-items-center">
                            <div class="col-md-2">
                                <strong>Jumlah</strong>
                            </div>
                            <div class="col-md">
                                <input type="text" readonly value="Rp.<?= $data_bayar['jumlah_bayar'] ?>" class="form-control rounded-0">
                            </div>
                        </div>
                        <div class="row mb-2 align-items-center">
                            <div class="col-md-2">
                                <strong>Sisa Tunggakan</strong>
                            </div>
                            <div class="col-md">
                                <input type="text" readonly value="Rp.<?= $data_bayar['tunggakan'] ?>" class="form-control rounded-0">
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($data_bayar['tunggakan'] == '0') { ?>
                    <div class="text-center bg-white mt-2">
                        <div class="border border-2 border-danger pt-2 mx-5 text-danger">
                            <h3><strong>L U N A S</strong></h3>
                        </div>
                    </div>
            </div>
        <?php } else { ?>
        </div>
    <?php } ?>
    </div>
</div>

<div class="mb-3 text-center">
    <a href="<?= base_url('superadmin/bayar') ?>" class="btn btn-secondary rounded">kembali</a>
    <button class="btn btn-primary rounded" onclick="printDiv('printArea')">cetak bukti bayar</button>
</div>

</div>

<script>
    function printDiv(divId) {
        const printContents = document.getElementById(divId).innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(); // supaya semua JS jalan lagi setelah body di-replace
    }
</script>