<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

<div class="container-fluid page-body-wrapper">
  <?php require_once("../layouts/sidebar.php") ?>
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Schedules </h3>
        <nav aria-label="breadcrumb">
          <li class="breadcrumb-item"><a href="../pages/add_schedule.php">Add new schedule</a></li>
        </nav>
      </div>
      <div>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <a href="#cinema_schedule">Cinema Schedules</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              <a href="#showtime_schedule">Weekly Schedules</a>
            </li>
          </ol>
        </nav>
      </div>

      <div class="row">
        <!-- start cinema schedule  -->
        <div class="col-lg-12 grid-margin stretch-card" id="cinema_schedule">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Cinema Schedule</h4>
              <p class="card-description"> Upcoming List <code>.table-bordered</code>
              </p>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Cinema </th>
                    <th> Location </th>
                    <th> Movies </th>
                    <th> Show Dates </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $cinemas = get_cinemas($mysqli);
                  $c = 1;
                  while ($cinema = $cinemas->fetch_assoc()) {
                    $screenings = get_screenings_with_cinema($mysqli, $c);
                    while ($screening = $screenings->fetch_assoc()) { ?>
                      <tr>

                        <td> <?= $c ?></td>
                        <td> <?= $screening['name'] ?> </td>
                        <td> <?= $screening['location'] ?> </td>
                        <td>
                          <?php
                          $screenings = get_screenings_with_cinema_id_for_title($mysqli, $c);
                          while ($screening = $screenings->fetch_assoc()) { ?>
                            <ol><?= $screening['title'] ?></ol>
                          <?php
                          } ?>
                        </td>
                        <td>
                          <?php
                          $screenings = get_screenings_with_cinema_id_for_showdate($mysqli, $c);
                          while ($screening = $screenings->fetch_assoc()) { ?>
                            <ol><?= $screening['showdate'] ?></ol>
                          <?php
                          } ?>
                        </td>
                      </tr>
                  <?php $c++;
                    }
                  } ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- end cinema schedule  -->

        <!-- start showtime schedule  -->
        <div class="col-lg-12 grid-margin stretch-card" id="showtime_schedule">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"> Showdate Schedule</h4>
              <p class="card-description"> Next Week <code>.table-striped</code>
              </p>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Date </th>
                    <th> Showtime </th>
                    <th> Cinema </th>
                    <th> Movie </th>
                    <th> Condition </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $shows = get_showtimes($mysqli);
                  $sh = 1;
                  $showdate = "";
                  while ($show = $shows->fetch_assoc()) {
                  ?>
                    <tr>
                      <td> <?= $sh ?></td>
                      <td> <?php $showdate = $show['showdate'];
                            echo $showdate; ?></td>
                      <td>
                        <?php
                        $showtimes = get_showtime_with_showdate($mysqli, $showdate);
                        while ($showtime = $showtimes->fetch_assoc()) { ?>
                          <ol><?= $showtime['showtime'] ?></ol>
                        <?php
                        } ?>
                      </td>
                      <td>
                        <?php
                        $screenings = get_screenings_with_showdate_for_name($mysqli, $showdate);
                        while ($screening = $screenings->fetch_assoc()) { ?>
                          <ol><?= $screening['name'] ?></ol>
                        <?php   } ?>
                      </td>
                      <td>
                        <?php
                        $screenings = get_screenings_with_showdate_for_title($mysqli, $showdate);
                        $i = 1;
                        while ($screening = $screenings->fetch_assoc()) { ?>
                          <ol><?= $screening['title'] ?></ol>
                        <?php $i++;
                        } ?>
                      </td>
                      <td>
                        <?php
                        if (strtotime($showdate) > strtotime(date('Y-m-d')))
                          echo "Upcoming!";
                        elseif (strtotime($showdate) < strtotime(date('Y-m-d')))
                          echo "Done!";
                        else echo "Now Showing!";
                        ?>
                      </td>
                    </tr>
                  <?php $sh++;
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- end showtime schedule  -->

      </div>
    </div>
    <!-- content-wrapper ends -->
    <?php require_once("../layouts/footer.php") ?>