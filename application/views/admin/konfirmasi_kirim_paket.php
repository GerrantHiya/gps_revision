<div class="card">
    <div class="card-body">
        <table class="table mb-0">
            <tbody>
                <tr>
                    <td class="col-3">ID Pengiriman</td>
                    <td class="col">: <strong><?= $data_paket['ID'] ?? '' ?></strong></td>
                </tr>
                <tr>
                    <td class="col-3">Pengirim</td>
                    <td class="col">: <strong><?= $data_paket['NamaLengkap'] ?? '' ?> - <?= $data_paket['no_telp'] ?? '' ?></strong></td>
                </tr>
                <tr>
                    <td class="col-3">Penerima</td>
                    <td class="col">: <strong><?= $data_paket['receiver_name'] ?? '' ?> - <?= $data_paket['receiver_telp'] ?? '' ?></strong></td>
                </tr>
                <tr>
                    <td class="col-3">Alamat Tujuan</td>
                    <td class="col">: <strong><?= $data_paket['alamat_tujuan'] ?? '' ?></strong></td>
                </tr>
                <tr>
                    <td class="col-3">Bobot</td>
                    <td class="col">: <strong><?= $data_paket['bobot'] ?? '' ?></strong> Kg</td>
                </tr>
                <tr>
                    <td class="col-3">Volume</td>
                    <td class="col">: <strong><?= $data_paket['volume'] ?? '' ?></strong> cm<sup>3</sup></td>
                </tr>
                <tr>
                    <td class="col-3">Tanggal Tiba (Estimasi)</td>
                    <td class="col">: <strong><?= date('d M Y',strtotime($data_paket['target_tiba'])) ?? '' ?></strong></td>
                </tr>
                <tr>
                    <td class="col-3">Biaya Total</td>
                    <td class="col">: Rp.<strong><?= $data_paket['harga_format'] ?? '' ?></strong></td>
                </tr>
            </tbody>
        </table>

        <div class="row">
            <div class="col"></div>
            <div class="col">
                <a href="<?= base_url('superadmin/kirim-paket') ?>" class="btn btn-secondary form-control">&check; finish</a>
            </div>
            <div class="col"></div>
        </div>
    </div>
</div>