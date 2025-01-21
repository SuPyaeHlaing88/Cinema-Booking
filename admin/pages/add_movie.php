<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>
<?php
$title = $titleErr = "";
$description = $descriptionErr = "";
$genre = $genreErr = "";
$duration = $durationErr = "";
$poster = $posterErr = "";
$hours = $hoursErr = "";
$seconds = $secondsErr = "";
$minutes = $minutesErr = "";
$posterName = "";
$tmp = "";
$invalid = "";

// for update item 
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $movie =  get_movie_with_id($mysqli, $id);
  $title = $movie['title'];
  $description = $movie['description'];
  $genre = $movie['genre'];
  $duration = $movie['duration'];
}

// for new item 
if (isset($_POST['title'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $genre = $_POST['genre'];
  $hours = str_pad($_POST['hours'], 2, '0', STR_PAD_LEFT);
  $minutes = str_pad($_POST['minutes'], 2, '0', STR_PAD_LEFT);
  $seconds = str_pad($_POST['seconds'], 2, '0', STR_PAD_LEFT);
  $duration = date("H:i:s", mktime($hours, $minutes, $seconds));
  if (preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $duration)) {
    echo "Valid duration: $duration"; // Outputs: Valid duration: 02:15:30
} else {
      $durationErr = "Please enter in hour minute second format!";
      $invalid = "err";
}
  // $duration = "$hours:$minutes:$seconds";
  // $duration = date("H:i:s");
  // var_dump($duration);
  $poster = $_FILES['poster'];
  $posterName = $poster['name'] . date('YMDHIS');

  if (trim($title) === "") {
    $titleErr = "Title can't be blank!";
    $invalid = "err";
  }
  if (trim($description) === "") {
    $descriptionErr = "Price can't be blank!";
    $invalid = "err";
  }

  if (trim($genre) === "") {
    $genreErr = "Please select user role!";
    $invalid = "err";
  }
  // if (preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $duration)) {
  //     $durationErr = "Please enter in hour minute second format!";
  //     $invalid = "err";
  // }
  // if (trim($duration) === "") {
    
  // }
  if ($poster === "") {
    $posterErr = "Image can't be blank!";
    $invalid = "err";
  }

  if (!$invalid) {
    $tmp = $poster['tmp_name'];
    $imgfile = file_get_contents($tmp);
    $dataPoster = base64_encode($imgfile);

    // for updating item 
    if (isset($_GET['id'])) {

      $status = update_movies($mysqli, $id, $title, $description, $genre, $duration, $dataPoster);
      if ($status === true) {
        // for image's name can be save in workspace folder 
        move_uploaded_file($poster['tmp_name'], '../../assets/images/movie_posters/' . $posterName);
        echo "<script>location.replace('../pages/movie_list.php')</script>";
      } else {
        $invalid = $status;
      }
    } else {

      $status = save_movie($mysqli, $title, $description, $genre, $duration, $dataPoster);
      if ($status === true) {
        // for image's name can be save in workspace folder 
        move_uploaded_file($poster['tmp_name'], '../../assets/images/movie_posters/' . $posterName);
        echo "<script>location.replace('../pages/movie_list.php')</script>";
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
        <h3 class="page-title"> Add new Movie </h3>
        <nav aria-label="breadcrumb">
          <li class="breadcrumb-item"><a href="../pages/movie_list.php">Movie List</a></li>
        </nav>
      </div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Basic form elements</h4>
              <p class="card-description"> Basic form elements </p>
              <?php if ($invalid !== "" && $invalid !== "err") { ?>
                <div class="alert alert-danger"><?= $invalid ?></div>
              <?php } ?>
              <form class="forms-sample" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Movie Title" value="<?= $title ?>">
                  <div class="validation-message"><?= $titleErr ?></div>

                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="4" value="<?= $description ?>"></textarea>
                  <div class="validation-message"><?= $descriptionErr ?></div>

                </div>
                <div class="form-group">
                  <label for="genre">Genre</label>
                  <input type="text" class="form-control" id="genre" name="genre" placeholder="Movie Title" value="<?= $genre ?>">
                  <div class="validation-message"><?= $genreErr ?></div>

                </div>
                <div class="form-group">
                  <!-- <label for="duration">Duration</label>
                  <input type="text" class="form-control" id="duration" name="duration" value="<?= $duration ?>" placeholder="HH:MM:SS"> -->
                  <label for="hours">Hours</label>
                  <input type="number" class="form-control" id="hours" name="hours" placeholder="HH" min="0" ,max="5" required>
                  <!-- <input type="number" class="form-control" id="minutes" name="minutes" placeholder="MM" min="0" max="59" required>
                  <input type="number" class="form-control" id="seconds" name="seconds" placeholder="SS" min="0" max="59" required> -->
                  <div class="validation-message"><?= $hoursErr ?></div>
                </div>
                
                <div class="form-group">
                <label for="hours">Minutes</label>
                <input type="number" class="form-control" id="minutes" name="minutes" placeholder="MM" min="0" max="59" required>
                <div class="validation-message"><?= $minutesErr ?></div>
                </div>
                <div class="form-group">
                <label for="hours">Seconds</label>
                <input type="number" class="form-control" id="seconds" name="seconds" placeholder="MM" min="0" max="59" required>
                <div class="validation-message"><?= $secondsErr ?></div>
                </div>

                <div class="form-group">
                  <label for="poster">Poster</label>
                  <input type="file" name="poster" id="poster" value="<?= $poster ?>" class="form-control">
                  <div class="validation-message"><?= $posterErr ?></div>
                </div>

                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <?php require_once("../layouts/footer.php") ?>