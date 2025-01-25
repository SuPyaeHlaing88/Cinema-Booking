<?php session_start() ?>
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
    <title>Customer Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../assets/css/bootst?rap.min.css">
    <link rel="stylesheet" href="../assets/css/UI_style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png">
    <link rel="shortcut icon" href="../assets/bootstrap/css/bootstrap.min.css">

</head>

<body>
    <div class="container-scroller">
        <header>
            <nav>
                <p class="logo">
                    multi<span>flex<span>
                </p>

                <i class="fa fa-bars" id="menu"></i>

                <ul id="menu-box">
                    <div class="marker"></div>
                    <li>Home</li>
                    <li>Cinemas</li>
                    <li>Weekly </li>
                    <li>Contact</li>
                    <li>
                        <span>mr.john doe
                            <img
                                src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?cs=srgb&dl=pexels-pixabay-220453.jpg&fm=jpg">
                            <i class="fa fa-angle-down"></i>
                        </span>
                    </li>
                    <li><b>sign out</b></li>
                </ul>

            </nav>

        </header>