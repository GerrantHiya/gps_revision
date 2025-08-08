.<form class="container mb-3" action="<?= base_url('superadmin/admin-account-management') ?>" method="post" enctype="multipart/form-data">

    <?php if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php } ?>
    <?php if ($this->session->flashdata('success')) { ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php } ?>

    <div class="card rounded-0">
        <div class="card-body text-dark">

            <div class="row align-items-center mb-1">
                <div class="col-md-2 mt-0">
                    <label for="NamaLengkap"><strong>Nama Lengkap</strong></label>
                </div>
                <div class="col-md">
                    <input type="text" name="NamaLengkap" id="NamaLengkap" placeholder="Nama Lengkap (30 digit)" maxlength="30" value="<?= set_value('NamaLengkap') ?>" class="form-control mt-0 rounded-0">
                    <?= form_error('NamaLengkap', '<div class="text-danger">', '</div>') ?>
                </div>
            </div>

            <div class="row align-items-center mb-1">
                <div class="col-md-2 mt-0">
                    <label for="email"><strong>Email</strong></label>
                </div>
                <div class="col-md">
                    <input type="email" name="email" id="email" placeholder="your@email.domain [use for login]" maxlength="255" value="<?= set_value('email') ?>" class="form-control mt-0 rounded-0">
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

<div class="container mb-3">
    <div class="card bg-white rounded-0">
        <div class="card-header">
            <h4 class="mb-0"><strong>Accounts</strong></h4>
        </div>
        <div class="card-body">

            <table class="table table-hover text-center mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="col-4 border">Email</th>
                        <th scope="col" class="border">Nama Lengkap</th>
                        <th scope="col" class="border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($accs)): ?>
                        <?php foreach ($accs as $acc): ?>
                            <tr>
                                <td class="border"><?= $acc['email'] ?></td>
                                <td class="border"><?= $acc['NamaLengkap'] ?></td>
                                <td class="border">
                                    <a href="<?= base_url('superadmin/hapus_admin') ?>" class="btn btn-danger">hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="border">Tidak Ada Data</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <nav aria-label="Page navigation">
                <?= $pages ?>
            </nav>
        </div>
    </div>
</div>