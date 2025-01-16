<?php

$user = json_decode($_COOKIE["user"], true);
if (!$user) {
    header("Location: ../index_login.php?invalid=Please login first!");
    // exit;
}

// } else {
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

if (isset($_POST["signout"])) {
    setcookie("user", "", time() - 1, "/"); // Expire the cookie
    header("Location: ../home.php"); // Redirect to login page after signout
    exit; // Ensure no further code is executed
} 

// chatgpt
// $user = json_decode($_COOKIE["user"], true);

// if (!$user) {
// // User is not logged in, redirect to login page
// header("Location: ../index_login.php?invalid=Please login first!");
// exit; // Ensure no further code is executed
// }

// $url = $_SERVER['REQUEST_URI'];
// $arr = explode('/', $url);
// $code = "";

// // Check if the role is passed in the URL
// if ($arr[2] !== "cinema") {
// $role_name = $arr[2];
// switch ($role_name) {
// case "admin":
// $code = "admin";
// break;
// case "cashier":
// $code = "cashier";
// break;
// default:
// $code = "";
// break;
// }
// }

// // Check if the user's role matches the one required for the current page
// if ($code && $code != $user['role']) {
// // Role mismatch, redirect to 404 page
// header("Location: ../auth/error-404.php");
// exit; // Ensure no further code is executed
// }

// if (isset($_POST["signout"])) {
// setcookie("user", "", time() - 1, "/"); // Expire the cookie
// header("Location: ../../index_login.php"); // Redirect to login page after signout
// exit; // Ensure no further code is executed
// } -->