<?php require_once('./layout/header.php') ?>

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
                    <a href="./select_cinema.php?movie_id=<?= $nowMovie['movie_id'] ?>" style="text-decoration: none;">
                        <img class="table-img" src="../assets/poster/<?= $nowMovie['poster'] ?>">
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
            $nowMovies = get_upcoming_movie_schedule($mysqli, $movie['id']);
            $nowMovie = $nowMovies->fetch_assoc();
            if ($nowMovie) { ?>
                <div class="card">
                    <a href="./select_cinema.php?movie_id=<?= $nowMovie['movie_id'] ?>" style="text-decoration: none;">
                        <img class="table-img" src="../assets/poster/<?= $nowMovie['poster'] ?>">
                        <div class="card-content">
                            <p class="movie-name">
                                <?= $nowMovie['title'] ?>
                            </p>
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