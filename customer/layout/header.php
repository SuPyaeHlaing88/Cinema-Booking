<?php session_start();

if (!isset($_SESSION['user'])) {
    header("Location:./register.php");
    exit;
} else {
    $user = $_SESSION['user'];
    $name = $user['name'];
    $email = $user['email'];
    $phone = $user['phone'];
}
?>
<?php require_once("../storage/db.php"); ?>
<?php require_once("../storage/user_crud.php"); ?>
<?php require_once("../storage/customer_crud.php"); ?>
<?php require_once("../storage/movie_crud.php"); ?>
<?php require_once("../storage/cinema_crud.php"); ?>
<?php require_once("../storage/seat_crud.php"); ?>
<?php require_once("../storage/cinema_has_seat_crud.php"); ?>
<?php require_once("../storage/showtime_crud.php"); ?>
<?php require_once("../storage/screening_crud.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cinema</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../assets/css/UI_style.css">
    <link rel="stylesheet" href="../assets/css/seat.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png">

</head>

<body>
    <div class="container-scroller">
        <header>
            <nav>
                <p class="logo">
                    Cine<span>City<span>
                </p>
                <i class="fa fa-bars" id="menu"></i>
                <ul id="menu-box">
                    <div class="marker"></div>
                    <li>
                        <a href="../index.php">Home</a>
                    </li>
                    <li>Cinemas</li>
                    <li>Weekly </li>
                    <li>Bought Tickets</li>
                    <li><?= htmlspecialchars($name) ?></li>
                    <li>
                        <i class="mdi mdi-logout me-2 text-primary"></i>
                        <a href="../register.php?signout">Signout</a>
                    </li>
                </ul>
            </nav>
        </header>