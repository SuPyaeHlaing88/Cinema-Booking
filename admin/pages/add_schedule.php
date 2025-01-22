<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

<?php
$selected_movie = $selected_movieErr = "";
$selected_cinema = $selected_cinemaErr = "";
// $selected_showdate = $selected_showdateErr = "";
$selected_showtime = $selected_showtimeErr = "";
$invalid = $alert = $gap = $result_gaps = "";

// for new item 
if (isset($_POST['selected_movie'])) {
    $selected_movie = $_POST['selected_movie'];
    $selected_cinema = $_POST['selected_cinema'];
    // $selected_showdate = $_POST['selected_showdate'];
    $selected_showtime = $_POST['selected_showtime'];
    // $showtime = $_POST['showtime'];

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
        // var_dump($selected_movie);
        // var_dump($selected_cinema);
        // var_dump($selected_showtime);

        // $result = get_screening_with_cinema_and_showtime($mysqli, $selected_cinema, $selected_showdate, $selected_showtime);
        $result = get_screening_with_cinema_and_showtime($mysqli, $selected_cinema);
        // var_dump($result);
        if ($result != null) {
            $showtime_id =  $result['showtime_id'];
            $showtime_data =  get_showTime_with_id($mysqli, $showtime_id);
            $showTime_date = $showtime_data['showdate'];
            $showTime = $showtime_data['showtime'];
            var_dump($showTime_date);
            $selected_showtime_data =  get_showTime_with_id($mysqli, $selected_showtime);
            $selected_showTime_date = $selected_showtime_data['showdate']; // formdate
            $selected_showTime_hour = $selected_showtime_data['showtime']; //formtime
            var_dump($selected_showTime_hour);
            var_dump($selected_showTime_date);

            // checking section
            if ($showTime_date == $selected_showTime_date) {
                $already_screenig =  get_screening_with_selected_cinema_and_selected_showtimes($mysqli, $selected_cinema, $selected_showtime);
                var_dump($already_screenig);
                $hours = get_showtime_for_time($mysqli, $selected_showTime_date);
                if ($already_screenig) {
                    var_dump("already have!");
                } elseif ($hours) {

                    var_dump("to check duration");
                } //alreadyduration

                var_dump("That Zan");
            } else {
                var_dump("save");
            }
            // var_dump($showtime_id);
        } else {
            var_dump("query save");
        }
        // $result_gaps = get_gap_between_screening_schedules($mysqli,  $result['showdate']);
        // var_dump($result_gaps['showtime']);
        // $gap = get_screening_with_movie_duration($mysqli, $result['movie_id']); //DURATION
        // if ($result) {
        //     $alert = "This screening already exists.";
        // } else {
        //     $status = save_screenings($mysqli, $selected_movie, $selected_cinema, $selected_showtime);
        //     if ($status === true) {
        //         echo "<script>location.replace('../pages/schedule.php')</script>";
        //     } else {
        //         $invalid = $status;
        //     }
        // }
    }
}
?>

<div class="container-fluid page-body-wrapper">
    <?php require_once("../layouts/sidebar.php") ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Add New Schedule</h3>
                <!-- <?php var_dump($selected_movie);
                        var_dump($selected_cinema);
                        var_dump($selected_showtime);
                        ?> -->
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
                                <div class="alert alert-danger"><?= $alert;
                                                                echo $result['showdate']     ?></div>
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
                <!-- <?php { ?>
                    <div>
                        <?= $gap['duration'] . $gap['showtime'] ?>
                    </div>
                <?php } ?>
                <?php while ($result_gap = $result_gaps->fetch_assoc()) { ?>
                    <div>
                        <?= $result_gap['showtime'] ?>
                    </div>
                <?php } ?>
            </div> -->
                <?php require_once("../layouts/footer.php") ?>