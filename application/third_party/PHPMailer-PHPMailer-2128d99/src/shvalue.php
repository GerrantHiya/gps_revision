<?php
include '../../../config/connector.php';

// Mengambil nilai tbl dari inputan pengguna.
$tbl = $_GET['tbl'];

echo "<a href='admin.php'>Kembali</a>";
echo "<h3>Table Value:</h3>";
echo "<b>Table Name: $tbl</b><br><br>";
// Pastikan variabel tbl sudah di-set dan bukan inputan langsung pengguna.
if (isset($_GET['tbl'])) {

    // Membuat query untuk memilih semua data dari tabel yang ditentukan.
    $query = "SELECT * FROM $tbl";

    // Menjalankan query.
    $result = mysqli_query($dbc, $query);

    // Memeriksa apakah query berhasil dieksekusi dan ada hasilnya.
    if ($result && mysqli_num_rows($result) > 0) {
        // Membuat loop untuk menampilkan hasil.
        while ($row = mysqli_fetch_array($result)) {
            // Menampilkan isi baris saat ini.
            foreach ($row as $key => $value) {
                echo $key . ": " . $value . "<br>";
            }
            echo "<br>==============================<br>";
        }
    } else {
        // Menampilkan pesan jika tabel kosong atau query tidak berhasil.
        echo "Tabel kosong atau query tidak berhasil dieksekusi.";
    }
} else {
    // Menampilkan pesan jika tbl tidak ditentukan.
    echo "Silakan tentukan tabel yang ingin Anda tampilkan.";
}

// Link kembali ke halaman admin.
echo "<a href='admin.php'>Kembali</a>";
