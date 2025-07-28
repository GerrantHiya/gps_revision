<!DOCTYPE html>
<html lang="en">
<body>
    <form method='post'>
        <input type="password" name="password" id="pass" placeholder="passrand" class="textbox">
        <input type="submit" name="submit" value="lanjutt">
    </form>
</body>

<?php

if (isset($_POST['submit'])) {
    $myPIN = md5($_POST['password']);
    
    if ($myPIN == 'a4dc3a433f7cda2a6099db8e3f28643b') {
        session_start();
        $_SESSION['admin'] = true;
        echo "<script>window.location='admin.php';</script>";
    } else {
        echo "<script>window.location='ProToken.php';</script>";
    }
}
?>

</html>