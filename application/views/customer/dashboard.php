<div class="container">

    <div class="card">
        <div class="card-body">
            <h4 class="mb-0">Selamat Datang,</h4>
            <h2 class="text-center"><strong><?= $this->session->userdata('user')['NamaLengkap'] ?></strong></h2>
        </div>
    </div>
    <div class="text-right">
        <small class="text-primary">"If you don't understand the details of your business you are going to fail"<br><strong>Jeff Bezos, CEO of Amazon</strong></small>
    </div>

    <div class="row mt-2 mb-2">
        <div class="col-md">
            <div class="card">
                <div class="card-header bg-primary">
                    <strong class="text-light">Tunggakan Tagihan</strong>
                </div>
                <div class="card-body text-center">
                    <h3><strong>Rp.<?= $total_hutang['total_tunggakan'] ?? 0 ?></strong></h3>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card">
                <div class="card-header bg-primary">
                    <strong class="text-light">Tagihan Lunas</strong>
                </div>
                <div class="card-body text-center">
                    <h3><strong>Rp.<?= $total_hutang['total_bayar'] ?? 0 ?></strong></h3>
                </div>
            </div>
        </div>
        <div class="col-md"></div>
    </div>

</div>