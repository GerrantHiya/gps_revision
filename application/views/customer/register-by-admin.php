<form class="container mb-3" action="<?= base_url('customer/reg-by-admin') ?>" method="post" enctype="multipart/form-data">

    <?php if ($this->session->flashdata('error')) { ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php } ?>

    <div class="card rounded-0">
        <div class="card-body text-dark">

            <div class="row align-items-center mb-1">
                <div class="col-md-2 mt-0">
                    <label for="ID"><strong>NIK</strong></label>
                </div>
                <div class="col-md">
                    <input type="text" name="ID" id="ID" placeholder="Nomor Induk Kependudukan (16 digit)" maxlength="16" class="form-control mt-0 rounded-0">
                    <?= form_error('ID', '<div class="text-danger">', '</div>') ?>
                </div>
            </div>

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
                    <label for="no_telp"><strong>No. Telepon</strong></label>
                </div>
                <div class="col-md">
                    <input type="tel" name="no_telp" id="no_telp" placeholder="No. Telepon (15 digit)" maxlength="15" class="form-control mt-0 rounded-0">
                    <?= form_error('no_telp', '<div class="text-danger">', '</div>') ?>
                </div>
            </div>

            <hr class="mt-3">

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
                <strong>Default Password:</strong> Customer's Email
            </p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const phoneInput = document.getElementById("no_telp");

            function formatPhoneNumber() {
                let phoneNumber = phoneInput.value.replace(/\D/g, ""); // Hanya biarkan angka, hapus karakter selain digit

                if (phoneNumber.startsWith("0")) {
                    phoneNumber = "62" + phoneNumber.slice(1); // Ubah awalan "0" menjadi "62"
                } else if (!phoneNumber.startsWith("62")) {
                    phoneNumber = "62" + phoneNumber; // Jika tidak diawali "62", tambahkan "62"
                }

                phoneInput.value = phoneNumber; // Set kembali nilai input dengan format yang benar
            }

            // Event listeners
            phoneInput.addEventListener("input", formatPhoneNumber);
        });
    </script>

</form>