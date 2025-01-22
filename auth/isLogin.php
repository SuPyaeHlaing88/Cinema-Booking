<?php

$user = json_decode($_COOKIE["user"], true);
if (!$user) {
    header("Location: ../../index_login.php?invalid=Please login first!");
    exit;
}

$url = $_SERVER['REQUEST_URI'];
$arr = explode('/', $url);
$code = "";

if ($arr[2] !== "cinema") {
    $role_name = $arr[2];
    switch ($role_name) {
        case "admin":
            $code = "admin";
            break;
        case "cashier":
            $code = "cashier";
            break;
        default:
            $code = "";
            break;
    }
}
if ($code && $code != $user['role']) {
    header("location:../auth/error-404.php");
}

if (isset($_GET["signout"])) {
    setcookie("user", "",  -1, "/"); // Expire the cookie
    echo "<script>location.replace('http://localhost/Cinema/index_login.php')</script>";
    exit;
}
