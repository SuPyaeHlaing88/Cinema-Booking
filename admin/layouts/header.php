<?php require_once("../../auth/isLogin.php") ?>
<?php require_once("../../storage/db.php"); ?>
<?php require_once("../../storage/user_crud.php"); ?>
<?php require_once("../../storage/customer_crud.php"); ?>
<?php require_once("../../storage/movie_crud.php"); ?>
<?php require_once("../../storage/cinema_crud.php"); ?>
<?php require_once("../../storage/seat_crud.php"); ?>
<?php require_once("../../storage/cinema_has_seat_crud.php"); ?>
<?php require_once("../../storage/showtime_crud.php"); ?>
<?php require_once("../../storage/screening_crud.php"); ?>
<?php
session_start();
if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  $username = $user['username'];
  $role = $user['role'];
  $profile = $user['profile'];
}
?>
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cinema</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
  <!-- endinject -->
  <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="../../assets/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../../assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">