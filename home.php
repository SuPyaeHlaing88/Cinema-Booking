<?php require_once("auth/isLogin.php"); ?>

<?php
session_start();
$_SESSION['user'] = ['username' => $user['username'], 'role' => $user['role'], 'profile' => $user['profile']];

if ($user['role'] == "admin") {
    header("location:admin/index.php");
} elseif ($user['role'] == "cashier") {
    header("location:cashier/index.php");
} else {
    header("location:login.php");
}
