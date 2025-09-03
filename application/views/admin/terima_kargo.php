<div class="container">
    <div class="card bg-white rounded-0 mb-3">
        <form method="post" action="<?= base_url('superadmin/terima-kargo') ?>" class="card-body text-dark">

            <?php if ($this->session->flashdata('succ')) : ?>
                <div class="alert alert-success">
                    <?= $this->session->flashdata('succ'); ?>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <hr class="border-1">

            <div class="row justify-content-center align-items-center mb-3">
                <div class="col-md-2">
                    <label for="no_resi" class="form-label"><strong>No. Resi</strong></label>
                </div>
                <div class="col-md">
                    <select name="no_resi" id="no_resi" class="select form-control rounded-0">
                        <option value="">-- Nomor Resi Pengiriman --</option>
                        <?php foreach ($data_kirim as $data) : ?>
                            <option value="<?= $data['no_resi'] ?>"><?= $data['no_resi'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('no_resi', '<small class="text-danger">', '</small>') ?>
                </div>
            </div>

            <hr class="border-1">

            <div class="row align-items-center">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col text-right">
                    <input type="submit" value="set status: DITERIMA" class="btn btn-primary">
                </div>
            </div>

        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select').select2();
    });
</script>