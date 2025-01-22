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
           
        </header>

        <section>

           

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
                
                <?php 
                    $movies = get_all_movie_for_show($mysqli);
                    while($movie = $movies->fetch_assoc()){ ?>
                         <div class="card">
                    <a href="./select_cinema.php?movie_id=<?= $movie['movie_id'] ?>" style="text-decoration: none;">    
                    <img class="table-img" src="../assets/poster/americano.png">

                    <div class="card-content">
                        <p class="movie-name">
                           <?= $movie['title'] ?>
                        </p>

                        <div class="movie-info">
                            <p class="time">    
                                <span>Duration : <?= date('g:i A', strtotime($movie['duration']))  ?>
                                    <span class="d3">Time</span> <?= date('g:i A', strtotime($movie['show_time'])) ?> 
                                    <span class="d3">Start Date </span> <?= $movie['show_date'] ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                </a>    
                <?php  } ?>
               
               
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

        <!-- <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
        </footer> -->
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