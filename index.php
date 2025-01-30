<?php require_once("./storage/db.php"); ?>
<?php require_once("storage/user_crud.php"); ?>
<?php require_once("storage/movie_crud.php"); ?>
<?php require_once("storage/customer_crud.php"); ?>
<?php require_once("storage/cinema_crud.php"); ?>
<?php require_once("storage/seat_crud.php"); ?>
<?php require_once("storage/cinema_has_seat_crud.php"); ?>
<?php require_once("storage/showtime_crud.php"); ?>
<?php require_once("storage/screening_crud.php"); ?>
<?php
session_start();
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

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cinema</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="assets/css/UI_style.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png">

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
                        <a href="./index.php">Home</a>
                    </li>
                    <li>Cinemas</li>
                    <li>Weekly </li>
                    <li>Bought Tickets</li>
                    <li><?= htmlspecialchars($name) ?></li>
                    <li>
                        <i class="mdi mdi-logout me-2 text-primary"></i>
                        <a href="./register.php?signout">Signout</a>
                    </li>
                </ul>

            </nav>
        </header>
        <!-- sesssions start  -->
        <section>
            <div class="filter-search-box">

                <div class="filters-box">

                    <div class="all-filters filters">
                        Now Showing
                    </div>
                    <div class="category-filters filters">
                        By category <i class="fa fa-angle-down"></i>
                    </div>

                </div>

                <div class="search-filters">
                    <input type="text" placeholder="Search by name...">
                    <i class="fa fa-search"></i>
                </div>

                <div class="search-bar">
                    <div class="bar"></div>
                </div>

            </div>
            <!----filter-search-box---->

            <div class="movie-card-section">

                <!-- su -->
                <?php
                $movies = get_movies($mysqli);
                $m = 1;
                while ($movie = $movies->fetch_assoc()) {
                    $nowMovies = get_nowshowing_movie_schedule($mysqli, $movie['id']);
                    $nowMovie = $nowMovies->fetch_assoc();
                    if ($nowMovie) { ?>
                        <div class="card">
                            <a href="./customer/select_cinema.php?movie_id=<?= $nowMovie['movie_id'] ?>" style="text-decoration: none;">
                                <img class="movie-img" src="assets/poster/<?= $nowMovie['poster'] ?>">
                                <div class="card-content">
                                    <h4 class="movie-name">
                                        <?= $nowMovie['title'] ?>
                                    </h4>
                                    <div class="movie-info">
                                        <p class="time">
                                            <span class="d3">Duration : </span>
                                            <?= $nowMovie['duration'] ?>
                                            <span class="d3">Time</span>
                                            <?= date('g:i A', strtotime($nowMovie['showtime'])) ?>
                                            <span class="d3">Start Date </span>
                                            <?= $nowMovie['showdate'] ?>
                                        </p>
                                    </div>
                                </div>
                        </div>
                        </a>
                <?php }
                } ?>
            </div>
        </section>
        <!-- upcoming  -->
        <section>
            <div class="filter-search-box">

                <div class="filters-box">

                    <div class="all-filters filters">
                        Coming Soon..
                    </div>

                    <div class="date-filters filters">
                        By Date <i class="fa fa-angle-down"></i>
                    </div>

                    <div class="category-filters filters">
                        By category <i class="fa fa-angle-down"></i>
                    </div>

                </div>

                <div class="search-filters">
                    <input type="text" placeholder="Search by name...">
                    <i class="fa fa-search"></i>
                </div>

                <div class="search-bar">
                    <div class="bar"></div>
                </div>

            </div>
            <!----filter-search-box---->

            <div class="movie-card-section">

                <!-- su -->
                <?php
                $movies = get_movies($mysqli);
                $m = 1;
                while ($movie = $movies->fetch_assoc()) {
                    $upMovies = get_upcoming_movie_schedule($mysqli, $movie['id']);
                    $upMovie = $upMovies->fetch_assoc();
                    if ($upMovie) { ?>
                        <div class="card">
                            <a href="./customer/select_cinema.php?movie_id=<?= $upMovie['movie_id'] ?>" style="text-decoration: none;">
                                <img class="movie-img" src="assets/poster/<?= $upMovie['poster'] ?>">
                                <div class="card-content">
                                    <p class="movie-name">
                                        <?= $upMovie['title'] ?>
                                    </p>
                                    <div class="movie-info">
                                        <p class="time">
                                            <span class="d3">Duration : </span>
                                            <?= $upMovie['duration'] ?>
                                            <span class="d3">Time</span>
                                            <?= date('g:i A', strtotime($upMovie['showtime'])) ?>
                                            <span class="d3">Publish Date</span>
                                            <?= $upMovie['showdate'] ?>
                                        </p>
                                    </div>
                                </div>
                        </div>
                        </a>
                <?php }
                } ?>
            </div>
        </section>
        <!-- sessions end  -->
        <footer>
            <div class="logo-box">
                <p class="logo">
                    Cine<span>City</span>
                </p>
                <p><i class="fa fa-copyright"></i> 2001-2017, SIA Cine City</p>
            </div>

            <ul>
                <li>About Us</li>
                <li>Contact</li>
            </ul>


            <div class="socail-box">
                <i class="fa fa-facebook-f"></i>
                <i class="fa fa-twitter"></i>
                <i class="fa fa-instagram"></i>
            </div>

        </footer>
        <!-- partial -->
    </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/css/UI_style.js"></script>

    <!-- End custom js for this page -->
</body>

</html>