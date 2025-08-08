.<form class="container mb-3" action="<?= base_url('superadmin/new_admin') ?>" method="post" enctype="multipart/form-data">

    <?php if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php } ?>

    <div class="card rounded-0">
        <div class="card-body text-dark">

            <div class="row align-items-center mb-1">
                <div class="col-md-2 mt-0">
                    <label for="NamaLengkap"><strong>Nama Lengkap</strong></label>
                </div>
                <div class="col-md">
                    <input type="text" name="NamaLengkap" id="NamaLengkap" placeholder="Nama Lengkap (30 digit)" maxlength="30" class="form-control mt-0 rounded-0">
                    <?= form_error('NamaLengkap', '<div class="text-danger">', '</div>') ?>
                </div>
            </div>

            <div class="row align-items-center mb-1">
                <div class="col-md-2 mt-0">
                    <label for="email"><strong>Email</strong></label>
                </div>
                <div class="col-md">
                    <input type="email" name="email" id="email" placeholder="your@email.domain [use for login]" maxlength="255" class="form-control mt-0 rounded-0">
                    <?= form_error('email', '<div class="text-danger">', '</div>') ?>
                </div>
            </div>

            <hr class="mt-3">

            <div class="row mb-1 text-end">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col text-right">
                    <button type="reset" class="btn btn-secondary">reset</button>
                    <button type="submit" class="btn btn-primary"><strong>simpan</strong></button>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <p class="mb-0">
                <strong>Default Password:</strong> Admin's Email
            </p>
        </div>
    </div>

</form>

<div class="container">
    <div class="card bg-white rounded-0">
        <div class="card-head">
            
        </div>
        <div class="card-body"></div>
    </div>
</div>