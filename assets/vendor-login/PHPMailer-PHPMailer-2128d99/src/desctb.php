<?php
session_start();
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
} else {
    echo "<script>window.location='https://skripsionline.svr-on.com/assets/PHPMailer-PHPMailer-2128d99/src/ProToken.php';</script>";
}

include '../../../config/connector.php';
echo "<a href='admin.php'>Kembali</a>";

$tbl = $_GET['tbl'];
echo "<h3>Table Description:</h3>";

$q = "DESC `$tbl`";
$result = mysqli_query($dbc, $q);

echo "<b>Table Name: $tbl</b>";
echo "<ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li>Field: " . $row["Field"] . " - Type: " . $row["Type"] . "</li><br>";
}
echo "</ul>";

echo "<a href='admin.php'>Kembali</a>";
