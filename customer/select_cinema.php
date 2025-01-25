<?php require_once('./layout/header.php') ?>
<?php
if (isset($_GET['movie_id'])) {
    $movie_id = $_GET['movie_id'];
    // $_SESSION['screening'] = ['movie_id' => $movie_id];
};
$movies_data = get_movie_with_id($mysqli, $movie_id); { ?>

    <section>
        <div class="filter-search-box">
            <div class="filters-box">
                <div class="category-filters filters">
                    Cinemas for Movie <?= $movies_data['title'] ?>
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
        <div class="row">
            <?php
            $cinemas = get_cinemas_with_movies_id($mysqli, $movie_id);
            while ($cinema = $cinemas->fetch_assoc()) { ?>
                <div class="col-lg-4 col-md-6">
                    <div>
                        <h5 class="bg-danger" style="display: inline;"><?= $cinema['name'] ?></h5>
                        <strong><?= $cinema['location'] ?></strong>
                    </div>
                    <?php
                    $showtimes = get_all_for_show($mysqli, $movie_id, $cinema['id']);
                    while ($eachTime = $showtimes->fetch_assoc()) { ?>
                        <div class="movie_cinema_showtimes">

                            <strong><a href="./select_seat.php?movie_id=<?= $eachTime['movie_id'] ?>&cinema_id=<?= $eachTime['cinema_id'] ?>&showtime_id=<?= $eachTime['showtime_id'] ?>">
                                    <!-- <strong><a href="./select_seat.php?screening_id=<= $eachTime['id'] ?>"> -->
                                    <?= $eachTime['showdate'] . "  \t  " .  $eachTime['showtime'] ?></a>
                            </strong>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>


    <?php }  ?>

    </section>
    <?php require_once('./layout/footer.php') ?>