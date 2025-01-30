<?php require_once('./layout/header.php') ?>
<?php
if (isset($_GET['movie_id'])) {
    $movie_id = $_GET['movie_id'];
    // $_SESSION['screening'] = ['movie_id' => $movie_id];
};
$movies_data = get_movie_with_id($mysqli, $movie_id); { ?>

    <section>
        <div class="row">

            <div class="card col-6 align-items-center">
                <img class="w-75 h-75" src="../assets/poster/<?= $movies_data['poster'] ?>">
                <div class="card-content">
                    <strong class="movie-name ">
                        <?= $movies_data['description'] ?>
                    </strong>
                </div>
            </div>
            <!-- cinema section  -->
            <div class="card col-6 align-items-center">
                <?php
                $cinemas = get_cinemas_with_movies_id($mysqli, $movie_id);
                while ($cinema = $cinemas->fetch_assoc()) { ?>
                    <h5 class="bg-danger px-2 py-1 w-75" style="display: inline;"><?= $cinema['name'] ?>
                        <strong class="float-end "><?= $cinema['location'] ?></strong>
                    </h5>

                    <?php
                    $showtimes = get_all_for_show($mysqli, $movie_id, $cinema['id']);
                    while ($eachTime = $showtimes->fetch_assoc()) { ?>
                        <div class="movie_cinema_showtimes w-75">
                            <strong><a href="./select_seat.php?movie_id=<?= $eachTime['movie_id'] ?>&cinema_id=<?= $eachTime['cinema_id'] ?>&showtime_id=<?= $eachTime['showtime_id'] ?>">
                                    <!-- <strong><a href="./select_seat.php?screening_id=<= $eachTime['id'] ?>"> -->
                                    <?= $eachTime['showdate'] . "  \t  " .  $eachTime['showtime'] ?></a>
                            </strong>
                        </div>
                    <?php } ?>
                    <hr>
                <?php } ?>

            </div>

        </div>


    <?php }  ?>

    </section>
    <?php require_once('./layout/footer.php') ?>