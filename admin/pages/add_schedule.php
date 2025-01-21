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
        $result = get_screening_with_cinema_and_showtime($mysqli, $selected_cinema); //check cineam exist or not
        // var_dump($result);
        if ($result != null) {
                $showtime_data = get_showTime_with_id($mysqli, $selected_showtime);
                $showTime_date = $showtime_data['showdate'];
                $showTime = $showtime_data['showtime'];
                // var_dump("showDate".$showTime_date);
                // var_dump("showTime". $showTime);
                //check cinema and showdata exist or not in screenings db
                $get_selected_movies_duration = get_movie_with_id($mysqli, $selected_movie);
                $selected_movie_duration = $get_selected_movies_duration['duration'];
                // var_dump("selected movies duration ".$get_selected_movies_duration['duration']);
                // var_dump($selected_cinema);
                // var_dump($showTime_date);
                $check = check_exist_or_not_showDate_in_screening($mysqli,$selected_cinema,$showTime_date);
                var_dump( $check);
            if ($check != null) {
                    function timeToSeconds($time)
                    {
                        list($hours, $minutes, $seconds) = explode(':', $time);
                        return $hours * 3600 + $minutes * 60 + $seconds;
                    }
                    // Convert total seconds back to h:m:s format (no leading zeros)
                    function secondsToTime($totalSeconds)
                    {
                        $hours = floor($totalSeconds / 3600);
                        $minutes = floor(($totalSeconds % 3600) / 60);
                        $seconds = $totalSeconds % 60;
                        return "{$hours}:{$minutes}:{$seconds}"; // No leading zeros
                    }

                    // Convert times to seconds and add them
                    $totalSeconds = timeToSeconds($showTime) + timeToSeconds($selected_movie_duration);
                    $totalTime = secondsToTime($totalSeconds); // movies duration + showtime (selected value in form)
                    
                    // var_dump('date'.$showTime_date);
                    // var_dump('value'.$showTime);
                    // var_dump("That Zan:" . $totalTime);

                    // $check_exist_or_not = draw_showTime_if_exist_or_not_in_screening_table($mysqli, $showTime, $totalSeconds);
                    // $check_exist_or_not = draw_showTime_if_exist_or_not_in_screening_table($mysqli,$showTime_date,$showTime,$totalTime);
                    // Convert the total seconds back to h:m:s format

                    // $check_selected_showTime = draw_showTime_if_exist_or_not_in_screening_table($mysqli,$showTime_date,$showTime,$totalTime);
                    // var_dump($check_selected_showTime);

                    // die();
                    // var_dump($check_exist_or_not);
                    // die();
                    // if ($check_exist_or_not != null) {
                    //     var_dump("showtime does not exist allow query");
                    // } else {
                    //     var_dump("choose another time cann't duplicate show time");
                    // }
                    // var_dump($totalTime);
                    // if(date_time_validate($mysqli, $selected_movie, $selected_cinema, $selected_showtime, $showTime, $totalTime, $showTime_date)){
                        var_dump("hi");
                    // }
               
            } else {
                var_dump(" no date query save");
            }

        } else {
            var_dump("cinema does have so can query sql");
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
                            <p class="card-description"> Add classes like <code>.form-select-lg</code> and
                                <code>.form-select-sm</code>.
                            </p>

                            <?php if ($invalid !== "" && $invalid !== "err") { ?>
                                <div class="alert alert-danger"><?= $invalid ?></div>
                            <?php } else if ($alert !== "") { ?>
                                    <div class="alert alert-danger"><?= $alert;
                                    echo $result['showdate'] ?></div>
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