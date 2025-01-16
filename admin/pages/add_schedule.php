<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

<?php
$selected_movie = $selected_movieErr = "";
$selected_cinema = $selected_cinemaErr = "";
$selected_showdate = $selected_showdateErr = "";
$selected_showtime = $selected_showtimeErr = "";
$invalid = $alert = "";

// for new item 
if (isset($_POST['selected_movie'])) {
    $selected_movie = $_POST['selected_movie'];
    $selected_cinema = $_POST['selected_cinema'];
    $selected_showdate = $_POST['selected_showdate'];
    $selected_showtime = $_POST['selected_showtime'];
    $showtime = $_POST['showtime'];

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
        $result = get_screening_with_cinema_and_showtime($mysqli, $selected_cinema, $selected_showdate, $selected_showtime);
        // echo $result;
        if ($result) {
            $alert = "This screening already exists.";
        } else {
            $status = save_screenings($mysqli, $selected_movie, $selected_cinema, $selected_showdate, $selected_showtime);
            if ($status === true) {
                echo "<script>location.replace('../pages/schedule.php')</script>";
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
                                <?php $showtimes = get_showtimes($mysqli); { ?>

                                    <div class="form-group">
                                        <label for="showdate">Showdate</label>
                                        <select class="form-select form-select-sm" id="showdate" name="selected_showdate">
                                            <option value="" selected>Select showdate</option>
                                            <?php
                                            while ($showtime = $showtimes->fetch_assoc()) { ?>
                                                <option value="<?= $showtime['showdate']; ?>">
                                                    <?php echo $showtime['showdate'];
                                                    $showdate = $showtime['showdate']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <div class="validation-message"><?= $selected_showdateErr ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="showtime">Showtime</label>
                                        <select class="form-select form-select-sm" id="showtime" name="selected_showtime">
                                            <option value="" selected>Select showtime</option>
                                            <?php $showtimes = get_showtime_for_time($mysqli, $showdate);
                                            while ($showtime = $showtimes->fetch_assoc()) { ?>
                                                <option value="<?= $showtime['showtime']; ?>">
                                                    <?= $showtime['showtime'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <div class="validation-message"><?= $selected_showtimeErr ?></div>
                                    </div>
                                <?php } ?>

                                <div class="form-group my-3">
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once("../layouts/footer.php") ?>