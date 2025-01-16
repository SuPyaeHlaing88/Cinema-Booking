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
    <title>Home Dashboard</title>
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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
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
            <!-- Nowshowing carousel section -->
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- loop for Nowshowing -->
                    <div class="carousel-item popular-movie-slider active" data-bs-interval="2000">
                        <img src="..." class="d-block w-100" alt=" ...">
                    </div>
                    <div class="carousel-item popular-movie-slider" data-bs-interval="2000">
                        <img src="..." class="d-block w-100" alt=" .">
                    </div>
                    <div class="carousel-item popular-movie-slider">
                        <img src="..." class="d-block w-100" alt="..">

                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="prev" data-bs-interval="2000">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- Nowshowing carousel section end   -->

            <!---slider--->
        </header>

        <section>

            <div class="movie-ticket-book">
                <div class="choose-date">
                    <p class="heading">
                        choose date:
                    </p>
                    <div class="wrapper">
                        <div class="carousel owl-carousel">

                            <div class="card card-1">
                                <p>JUN 1st</p>
                                <p>MON</p>
                            </div>
                            <div class="card card-2">
                                <p>JUN 2nd</p>
                                <p>TUE</p>
                            </div>
                            <div class="card card-3">
                                <p>JUN 3nd</p>
                                <p>wed</p>
                            </div>
                            <div class="card card-4">
                                <p>JUN 4nd</p>
                                <p>thu</p>
                            </div>
                        </div>
                        <div class="marker"></div>
                    </div>
                </div>
                <div class="choose-time">
                    <p class="heading">
                        avalible times:
                    </p>
                    <div class="wrapper">
                        <div class="carousel owl-carousel">

                            <div class="card card-1">
                                <p>3D</p>
                                <p>14:45</p>
                            </div>
                            <div class="card card-2">
                                <p>3D</p>
                                <p>11:45</p>
                            </div>
                            <div class="card card-3">
                                <p>2D</p>
                                <p>12:15</p>
                            </div>
                            <div class="card card-4">
                                <p>3D</p>
                                <p>13:00</p>
                            </div>
                        </div>
                        <div class="marker"></div>
                    </div>
                </div>
                <button>Buy ticket</button>
            </div>
            <!---movie-ticket-book-->


            <div class="filter-search-box">

                <div class="filters-box">

                    <div class="all-filters filters">
                        All formats <i class="fa fa-angle-down"></i>
                    </div>

                    <div class="date-filters filters">
                        By Date <i class="fa fa-angle-down"></i>
                    </div>

                    <div class="category-filters filters">
                        By category <i class="fa fa-angle-down"></i>
                    </div>

                    <div class="category-filters filters">
                        Coming soon
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

                <div class="card">
                    <img
                        src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTCXgCV-ZNb3InBCTaLdED58dF6iZJxIvCOBurktiWxXrwGc8DB">

                    <div class="card-content">
                        <p class="movie-name">
                            the mummy
                        </p>

                        <div class="movie-info">
                            <p class="time">11:30 <span>14:45<span class="d3">3D</span> 16:05<span
                                        class="d3">3D</span></span>
                                18:40 21:00 23:15</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img
                        src="https://m.media-amazon.com/images/M/MV5BMTYzODQzYjQtNTczNC00MzZhLTg1ZWYtZDUxYmQ3ZTY4NzA1XkEyXkFqcGdeQXVyODE5NzE3OTE@._V1_.jpg">

                    <div class="card-content">
                        <p class="movie-name">
                            Wonder Woman
                        </p>

                        <div class="movie-info">
                            <p class="time">11:30 <span>14:45 16:05</span> 18:40 21:00</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img
                        src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSZeZdWD3S9rSzfwlSsnqBWERtgBHR4h_6kHb_fR_6J-BObyxfK">

                    <div class="card-content">
                        <p class="movie-name">
                            Alien: Covenant
                        </p>

                        <div class="movie-info">
                            <p class="time">11:30<span class="d3">3D</span> <span>14:45 16:05<span
                                        class="d3">3D</span></span>
                                18:40 21:00 23:15</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTX2TBaWUUMpmbhcnr0zypXQltqtQmW9wED_Y8bYrynL98MM1Wq">

                    <div class="card-content">
                        <p class="movie-name">
                            Baywatch
                        </p>

                        <div class="movie-info">
                            <p class="time"><span>11:30 16:05<span class="d3">3D</span></span> 18:40 21:00 23:15</p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <img
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXhEeDOpouHNg3A75Ngkgl-pQdWrr8ErxSuYCbb8-Tn7KcuD79">

                    <div class="card-content">
                        <p class="movie-name">
                            Pirates of the Caribbean
                        </p>

                        <div class="movie-info">
                            <p class="time">11:30 <span>14:45<span class="d3">3D</span> 16:05<span
                                        class="d3">3D</span></span>
                                18:40 21:00</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6NX1HzM5IkUhkwR1Yq7vkd9j5dqv0_Zaz5FCa2bzyJaUx9zOa">

                    <div class="card-content">
                        <p class="movie-name">
                            transformers 5
                        </p>

                        <div class="movie-info">
                            <p class="time">11:30 <span>14:45 16:05</span> 18:40 21:00</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRJ8wYlRSHxcAyi7TijH8FjeTLKcYsKi3qCzI8r_X0xKU8LkAn_">

                    <div class="card-content">
                        <p class="movie-name">
                            Planet of the Apes
                        </p>

                        <div class="movie-info">
                            <p class="time">11:30<span class="d3">3D</span> <span>14:45 16:05<span
                                        class="d3">3D</span></span>
                                18:40 21:00 23:15</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img src="https://www.movienewsletters.net/photos/NZL_105934R1.jpg">

                    <div class="card-content">
                        <p class="movie-name">
                            Dark Tower
                        </p>

                        <div class="movie-info">
                            <p class="time"><span>11:30 16:05<span class="d3">3D</span></span> 18:40 21:00 23:15</p>
                        </div>
                    </div>
                </div>

            </div>
            <!---movie-card--->

            <div class="show">
                <div class="show-bar">
                    <div class="bar"></div>
                </div>
                <button>Show more</button>
            </div>
            <!---bar--->


        </section>

        <footer>

            <div class="logo-box">
                <p class="logo">
                    multi<span>flex</span>
                </p>
                <p><i class="fa fa-copyright"></i> 2001-2017, SIA Multiflex</p>
            </div>

            <ul>
                <li>main</li>
                <li>schedlues</li>
                <li>tickets</li>
                <li>news</li>
                <li>contact</li>
            </ul>


            <div class="socail-box">
                <i class="fa fa-facebook-f"></i>
                <i class="fa fa-twitter"></i>
                <i class="fa fa-instagram"></i>
            </div>

        </footer>

        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
        </footer>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/chart.umd.js"></script>
    <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <script src="../assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/css/UI_style.js"></script>

    <!-- End custom js for this page -->
</body>

</html>