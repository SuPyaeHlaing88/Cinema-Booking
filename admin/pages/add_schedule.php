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

    function end_time_cal($startTime, $duration)
    {
        $startDateTime = new DateTime(trim($startTime));
        $duration = trim($duration);
        list($hours, $minutes, $seconds) = explode(":", $duration);
        $interval = new DateInterval("PT{$hours}H{$minutes}M{$seconds}S");
        $startDateTime->add($interval);
        return $startDateTime->format("H:i:s");
    }

    function calculate_time($startTime, $duration, $operation = 'add')
    {
        $startDateTime = new DateTime(trim($startTime));
        $duration = trim($duration);
        list($hours, $minutes, $seconds) = explode(":", $duration);
        $interval = new DateInterval("PT{$hours}H{$minutes}M{$seconds}S");
        if ($operation === 'add') {
            $startDateTime->add($interval);
        } elseif ($operation === 'sub') {
            $startDateTime->sub($interval);
        } else {
            throw new Exception("Invalid operation. Use 'add' or 'sub'.");
        }
        return $startDateTime->format("H:i:s");
    }


    if (!$invalid) {
        $movie = get_movie_with_id($mysqli, $selected_movie);
        $showtime = get_showtime_with_id($mysqli, $selected_showtime);
        $movieDuration = $movie['duration'];
        $s_date = $showtime['showdate'];
        $time = $showtime['showtime'];
        $e_time = calculate_time($time, $movieDuration);
        $s_time = calculate_time($time, $movieDuration, "sub");
        $sql = "SELECT * FROM `screenings` scr INNER JOIN `showtimes` sho ON sho.id= scr.showtime_id INNER JOIN `movies` mov ON mov.id=scr.movie_id INNER JOIN `cinemas` cin ON cin.id=scr.cinema_id WHERE scr.movie_id=$selected_movie AND cin.id=$selected_cinema AND sho.showdate ='$s_date' AND sho.showtime BETWEEN '$s_time' AND '$e_time'";
        $validationResult = $mysqli->query($sql);
        $validation = $validationResult->fetch_assoc();
        var_dump($validation);
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