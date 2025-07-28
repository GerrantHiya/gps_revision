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
            <div class="col-md card bg-white border border-dark">
                <!-- LOGIN -->
                <form action="<?= base_url('auth/') ?>" method="post" class="card-body p-4">
                    <h5 class="text-center mb-4"><b>LOGIN ADMIN</b></h5>
                    <input type="text" name="username" placeholder="Username" value="<?= set_value('username') ?>" class="form-control text-center mb-3" style="border-radius:100px; font-size:18px">
                    <?= form_error('username', '<div class="text-danger m-0 mb-3">', '</div>') ?>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control text-center mb-3" style="border-radius: 100px; font-size:18px">
                    <?= form_error('password', '<div class="text-danger m-0 mb-3">', '</div>') ?>
                    <?php if ($this->session->flashdata('message')) : ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('message-success')) : ?>
                        <div class="alert alert-success">
                            <?= $this->session->flashdata('message-success'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="text-center">
                        <input type="submit" value="LOGIN" name="login" class="btn btn-primary pl-4 pr-4 pt-2 pb-2" style="font-weight:bold; border-radius: 100px;">
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
    </div>
    </div>
</body>

<script>
    // Fungsi untuk merefresh hanya konten div dengan id tertentu
    function autoRefreshDiv() {
        setInterval(() => {
            // Lakukan permintaan fetch untuk memperbarui konten
            fetch(window.location.href)
                .then(response => response.text())
                .then(data => {
                    // Buat elemen DOM untuk mengambil ulang konten div
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(data, 'text/html');
                    const newContent = doc.querySelector('#main'); // Ganti 'targetDiv' dengan id yang diinginkan

                    // Perbarui div dengan konten baru
                    document.querySelector('#main').innerHTML = newContent.innerHTML;
                });
        }, 5000); // 5000 ms = 5 detik
    }

    // Panggil fungsi autoRefreshDiv saat halaman dimuat
    window.onload = autoRefreshDiv;
</script>

</html>