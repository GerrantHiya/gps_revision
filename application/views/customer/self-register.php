<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('') ?>assets/vendor-login/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('') ?>assets/vendor-login/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?= base_url('') ?>assets/img/GH.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <style>
        /* Cegah seleksi teks secara umum */
        body {
            -webkit-user-select: none;
            /* Safari/Chrome */
            -moz-user-select: none;
            /* Firefox */
            -ms-user-select: none;
            /* IE/Edge */
            user-select: none;
            /* Standar */
        }

        /* Izinkan seleksi untuk input, textarea, dan elemen interaktif */
        input,
        textarea,
        button,
        select {
            -webkit-user-select: text;
            -moz-user-select: text;
            -ms-user-select: text;
            user-select: text;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        function fill(name, value) {
            // Ambil referensi ke input teks
            var textInput = document.getElementById(name);

            // Isi nilai ke dalam input teks
            textInput.value = value;
        }
    </script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&callback=initMap" async defer></script> -->
</head>

<body>
    <div class="bg-primary border-1 border-white justify-items-center align-content-center p-3" style="min-height: 100vh;">
        <div class="row">
            <div class="col"></div>
            <form action="<?= base_url('customer/registration') ?>" method="post" class="col-md card bg-white border border-dark">

                <div class="card-body">
                    <div class="mb-4 text-center">
                        <h3>
                            <strong>Registrasi Pelanggan</strong>
                        </h3>
                    </div>

                    <?php if ($this->session->flashdata('message')) : ?>
                        <div class="alert alert-success text-center">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger text-center">
                            <?= $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="mb-2">
                        <input type="text" name="ID" placeholder="NIK" maxlength="16" value="<?= set_value('ID') ?>" class="form-control text-center mb-3" style="border-radius:100px; font-size:18px">
                        <?= form_error('ID', '<div class="text-danger m-0 p-0">', '</div>') ?>
                    </div>

                    <div class="mb-2">
                        <input type="text" name="NamaLengkap" placeholder="Nama Anda" value="<?= set_value('NamaLengkap') ?>" class="form-control text-center mb-3" style="border-radius:100px; font-size:18px">
                        <?= form_error('NamaLengkap', '<div class="text-danger m-0 p-0">', '</div>') ?>
                    </div>

                    <div class="mb-2">
                        <input type="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" class="form-control text-center mb-3" style="border-radius:100px; font-size:18px">
                        <?= form_error('email', '<div class="text-danger m-0 p-0">', '</div>') ?>
                    </div>

                    <div class="mb-2">
                        <input type="tel" name="no_telp" id="no_telp" placeholder="No. Handphone" value="<?= set_value('no_telp') ?>" class="form-control text-center mb-3" style="border-radius:100px; font-size:18px">
                        <?= form_error('no_telp', '<div class="text-danger m-0 p-0">', '</div>') ?>
                    </div>

                    <div class="mb-2">
                        <input type="password" name="pass" id="newPass" placeholder="Password" value="<?= set_value('pass') ?>" class="form-control text-center mb-3" style="border-radius:100px; font-size:18px">
                        <?= form_error('pass', '<div class="text-danger m-0 p-0">', '</div>') ?>
                    </div>

                    <div class="">
                        <input type="password" name="pass2" id="newPass2" placeholder="Confirm Password" value="<?= set_value('pass2') ?>" class="form-control text-center mb-3" style="border-radius:100px; font-size:18px">
                        <label id="errorPass2" class="text-danger text-center"></label>
                    </div>

                    <div class="text-center">
                        <input id="bt" type="submit" value="Daftar!" name="login" class="btn btn-primary pl-4 pr-4 pt-2 pb-2" style="font-weight:bold; border-radius: 100px;">
                    </div>

                    <div class="text-center mt-2"><a href="<?= base_url() ?>" class="badge badge-secondary">kembali</a></div>
                </div>

            </form>
            <div class="col"></div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const newPass = document.getElementById("newPass");
            const newPass2 = document.getElementById("newPass2");
            const btn = document.getElementById("bt");
            const errorPass2 = document.getElementById("errorPass2");
            const phoneInput = document.getElementById("no_telp");

            function validatePassword() {
                if (newPass.value !== newPass2.value || newPass.value === "" || newPass2.value === "") {
                    errorPass2.textContent = "password tidak cocok.";
                    errorPass2.classList.add("text-danger"); // Warna merah untuk error
                    btn.disabled = true;
                } else {
                    errorPass2.textContent = ""; // Menghapus pesan error jika cocok
                    btn.disabled = false;
                }
            }

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
            newPass.addEventListener("input", validatePassword);
            newPass2.addEventListener("input", validatePassword);
            phoneInput.addEventListener("input", formatPhoneNumber);
        });
    </script>
</body>


</html>