<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

<div class="container-fluid page-body-wrapper">
  <?php require_once("../layouts/sidebar.php") ?>
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Movie Schedules </h3>
        <nav aria-label="breadcrumb">
          <li class="breadcrumb-item"><a href="../pages/add_schedule.php">Add new schedule</a></li>
        </nav>
      </div>
      <div>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <a href="#nowshowing">Now Showing Schedule</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              <a href="#upcoming">Upcoming Schedule</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              <a href="#published">Published Schedule</a>
            </li>
          </ol>
        </nav>
      </div>

      <div class="row">
        <!-- start now showing schedule -->
        <div class="col-lg-12 grid-margin stretch-card" id="nowshowing">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"> Now Showing Schedule </h4>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th> Qty </th>
                    <th> Poster </th>
                    <th> Movie title </th>
                    <th> Duration </th>
                    <th> Cinemas </th>
                    <th> Showdates</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $movies = get_movies($mysqli);
                  $m = 1;
                  while ($movie = $movies->fetch_assoc()) {
                    $nowMovies = get_nowshowing_movie_schedule($mysqli, $movie['id']);
                    $nowMovie = $nowMovies->fetch_assoc();
                    if ($nowMovie) { ?>
                      <tr>
                        <td><?= $m ?></td>
                        <td>
                          <img class="table-img" src="../../assets/poster/<?= $movie['poster'] ?>">
                        </td>
                        <td><?= $movie['title'] ?></td>
                        <td><?= $nowMovie['duration'] ?></td>
                        <td>
                          <?php
                          $screenings = get_nowshowing_movie_by_cinema($mysqli, $nowMovie['movie_id']);
                          while ($screening = $screenings->fetch_assoc()) { ?>
                            <ol><?= $screening['name'] ?></ol>
                          <?php } ?>
                        </td>
                        <td>
                          <?php
                          $screenings = get_nowshowing_movie_by_showdate($mysqli, $nowMovie['movie_id']);
                          while ($screening = $screenings->fetch_assoc()) { ?>
                            <ol><?= $screening['showdate'] ?></ol>
                          <?php } ?>
                        </td>
                      </tr>

                  <?php }
                    $m++;
                  }  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- end now showing  -->
        <!-- start upcoming schedule -->
        <div class="col-lg-12 grid-margin stretch-card" id="upcoming">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"> Upcoming Schedule</h4>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th> Qty </th>
                    <th> Poster </th>
                    <th> Movie title </th>
                    <th> Cinemas </th>
                    <th> Showdates</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $movies = get_movies($mysqli);
                  $m = 1;

                  while ($movie = $movies->fetch_assoc()) {
                    $upMovies = get_upcoming_movie_schedule($mysqli, $movie['id']);
                    $upMovie = $upMovies->fetch_assoc();
                    if ($upMovie) { ?>
                      <tr>
                        <td><?= $m ?></td>
                        <td>
                          <img class="table-img" src="data:image/' . $type . ';base64,<?= $movie['poster'] ?>">
                        </td>
                        <td><?= $movie['title'] ?></td>
                        <td>
                          <?php
                          $screenings = get_upcoming_movie_by_cinema($mysqli, $upMovie['movie_id']);
                          while ($screening = $screenings->fetch_assoc()) { ?>
                            <ol><?= $screening['name'] ?></ol>
                          <?php } ?>
                        </td>
                        <td>
                          <?php
                          $screenings = get_upcoming_movie_by_showdate($mysqli, $upMovie['movie_id']);
                          while ($screening = $screenings->fetch_assoc()) { ?>
                            <ol><?= $screening['showdate'] ?></ol>
                          <?php } ?>
                        </td>
                      </tr>
                  <?php $m++;
                    }
                  }  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- end upmovie schedule  -->
        <!-- start published schedule -->
        <div class="col-lg-12 grid-margin stretch-card" id="published">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"> Published Schedule</h4>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th> Qty </th>
                    <th> Poster </th>
                    <th> Movie title </th>
                    <th> Cinemas </th>
                    <th> Showdates</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $movies = get_movies($mysqli);
                  $m = 1;
                  while ($movie = $movies->fetch_assoc()) {
                    $pubMovies = get_published_movie_schedule($mysqli, $movie['id']);
                    $pubMovie = $pubMovies->fetch_assoc();
                    if ($pubMovie) { ?>
                      <tr>
                        <td><?= $m ?></td>
                        <td>
                          <img class="table-img" src="data:image/' . $type . ';base64,<?= $movie['poster'] ?>">
                        </td>
                        <td><?= $movie['title'] ?></td>
                        <td>
                          <?php
                          $screenings = get_published_movie_by_cinema($mysqli, $pubMovie['id']);
                          while ($screening = $screenings->fetch_assoc()) { ?>
                            <ol><?= $screening['name'] ?></ol>
                          <?php } ?>
                        </td>
                        <td>
                          <?php
                          $screenings = get_published_movie_by_showdate($mysqli, $pubMovie['id']);
                          while ($screening = $screenings->fetch_assoc()) { ?>
                            <ol><?= $screening['showdate'] ?></ol>
                          <?php } ?>
                        </td>
                      </tr>
                  <?php $m++;
                    }
                  }  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- end published schedule  -->
      </div>
    </div>
    <!-- content-wrapper ends -->
    <?php require_once("../layouts/footer.php") ?>