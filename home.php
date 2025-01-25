<?php require_once("auth/isLogin.php"); ?>

<?php
// var_dump($user['role']);
// die();
if ($user['role'] == "admin") {
    header("location:admin/index.php");
} elseif ($user['role'] == "cashier") {
    header("location:cashier/index.php");
} else {
    header("location:index_login.php");
}
