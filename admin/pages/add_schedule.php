<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

<?php
$selected_movie = $selected_movieErr = "";
$selected_cinema = $selected_cinemaErr = "";
$selected_showtime = $selected_showtimeErr = "";
$invalid = $alert = $gap = $result_gaps = "";
// $status = false;

// for new item 
if (isset($_POST['selected_movie'])) {
    $selected_movie = $_POST['selected_movie'];
    $selected_cinema = $_POST['selected_cinema'];
    $selected_showtime = $_POST['selected_showtime'];

    if (trim($selected_movie) === "") {
        $selected_movieErr = "Can't be blank!";
        $invalid = "err";
    }
    if (trim($selected_cinema) === "") {
        $selected_cinemaErr = "Can't be blank!";
        $invalid = "err";
    }

    if (trim($selected_showtime) === "") {
        $selected_showtimeErr = "Can't be blank!";
        $invalid = "err";
    }

    if (!$invalid) {
        // for same schedule
        $result = get_screening_with_cinema_and_showtime($mysqli, $selected_cinema, $selected_showtime);
        //for same cinema at the same day
        $showdate = get_showtime_with_id($mysqli, $selected_showtime);
        $selected_showdate = $showdate['showdate'];
        $movies_that_day = get_screening_with_selected_cinema_and_selected_showdate($mysqli, $selected_cinema, $selected_showdate);
        $insertmovie_duration = get_movie_duration($mysqli, $selected_movie);



        if ($result) {
            // deny the same schedule
            $alert = "This screening already exists.";

            $result_gaps = get_gap_between_screening_schedules($mysqli,  $result['showdate']);
            $gap = get_screening_with_movie_duration($mysqli, $result['movie_id']); //DURATION
        } elseif ($movies_that_day) {
            //All having movie's duration
            while ($movie_that_day = $movies_that_day->fetch_assoc()) {
                // var_dump($movie_that_day['showtime'] . "->" . $movie_that_day['duration']);
                $starttime = strtotime($movie_that_day['showtime']) - strtotime("00:00:00");
                $duration = strtotime($movie_that_day['duration']) - strtotime("00:00:00");
                // can add break time 
                $showingtime = $starttime + $duration;
                $endtime = gmdate("H:i:s", $showingtime);

                $selected_starttime = strtotime($showdate['showtime']) - strtotime("00:00:00");
                $inserted_duration = strtotime($insertmovie_duration['duration']) - strtotime("00:00:00");
                $preshowingtime = $selected_starttime + $inserted_duration;
                $inserted_endtime = gmdate("H:i:s", $preshowingtime);

                if ($endtime > $showdate['showtime']) {
                    //     $status = save_screenings($mysqli, $selected_movie, $selected_cinema, $selected_showtime);
                    //     if ($status === true) {
                    //         echo "<script> location . replace('../pages/schedule.php')</script>";
                    //     } else {
                    //         $invalid = $status;
                    //     }
                    // } else {
                    $closed = get_closed_showtimes($mysqli, $selected_showdate, $movie_that_day['showtime'], $endtime);
                    while ($cl = $closed->fetch_assoc()) {
                        if ($closed['showtime'] < $inserted_endtime) {
                            $alert = "This screenings are anaviable";
                            // below condition save many times for one
                            // } else {
                            //     $status = save_screenings($mysqli, $selected_movie, $selected_cinema, $selected_showtime);
                            //     if ($status = true) {
                            //         echo "<script> location . replace('../pages/schedule.php')</script>";
                            //     } else {
                            //         $invalid = $status;
                            //     }
                        }
                    }
                } else {
                    $status = save_screenings($mysqli, $selected_movie, $selected_cinema, $selected_showtime);
                    if ($status = true) {
                        echo "<script> location . replace('../pages/schedule.php')</script>";
                    } else {
                        $invalid = $status;
                    }
                }
            }
        } else {

            $status = save_screenings($mysqli, $selected_movie, $selected_cinema, $selected_showtime);
            if ($status = true) {
                echo "<script> location . replace('../pages/schedule.php')</script>";
            } else {
                $invalid = $status;
            }
        }
    }
}
?>

<div class="container-fluid page-body-wrapper">
    <?php require_once("../layouts/sidebar.php") ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Add New Schedule</h3>
                <nav aria-label="breadcrumb">
                    <li class="breadcrumb-item"><a href="../pages/schedule.php"> List of Schedules</a></li>
                </nav>
            </div>

            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Select</h4>
                            <p class="card-description"> Add classes like <code>.form-select-lg</code> and <code>.form-select-sm</code>. </p>

                            <?php if ($invalid !== "" && $invalid !== "err") { ?>
                                <div class="alert alert-danger"><?= $invalid ?></div>
                            <?php } else if ($alert !== "") { ?>
                                <div class="alert alert-danger"><?= $alert ?></div>
                            <?php } ?>

                            <form class="forms-sample" method="POST">
                                <div class="form-group">
                                    <label for="movie">Movie</label>
                                    <select class="form-select form-select-lg" id="movie" name="selected_movie">
                                        <option value="" selected>Select Movie</option>
                                        <?php $movies = get_movies($mysqli);
                                        while ($movie = $movies->fetch_assoc()) { ?>
                                            <option value="<?= $movie['id']; ?>">
                                                <?= $movie['title']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <div class="validation-message"><?= $selected_movieErr ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="cinema">Cinema</label>
                                    <select class="form-select" id="cinema" name="selected_cinema">
                                        <option value="" selected>Select cinema</option>
                                        <?php $cinemas = get_cinemas($mysqli);
                                        while ($cinema = $cinemas->fetch_assoc()) { ?>
                                            <option value="<?= $cinema['id']; ?>">
                                                <?= $cinema['name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <div class="validation-message"><?= $selected_cinemaErr ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="showtime">Showtime</label>
                                    <select class="form-select" id="cinema" name="selected_showtime">
                                        <option value="" selected>Select showtime</option>
                                        <?php $showtimes = get_showtime_for_all($mysqli);
                                        while ($showtime = $showtimes->fetch_assoc()) { ?>
                                            <option value="<?= $showtime['id']; ?>">
                                                <?= $showtime['showdate'] . '/' . $showtime['showtime']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <div class="validation-message"><?= $selected_showtimeErr ?></div>
                                </div>

                                <div class="form-group my-3">
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once("../layouts/footer.php") ?>