<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

<div class="container-fluid page-body-wrapper">
  <?php require_once("../layouts/sidebar.php") ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Showtime </h3>
      </div>
      <div class="row">
        <!-- for list -->
        <div class="col-md-6 stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Weekly showtime lists</h4>
              <p class="card-description"> Add class <code>.table-{color}</code>
              </p>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th> # </th>
                    <th> Showtime </th>
                    <th> Showdate </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $shows = get_showtime_for_all($mysqli);
                  // $date = 0;
                  $i = 1;
                  ?>
                  <?php
                  // $latest_dates = get_showtime_just_showdate($mysqli);
                  // while ($latest = $latest_dates->fetch_assoc()) {
                  //   echo $latest['showdate'];
                  //   $date++;
                  // }
                  // echo $date;
                  // if($)
                  while ($show = $shows->fetch_assoc()) { ?>
                    <tr>
                      <td> <?= $i ?> </td>
                      <td> <?= $show['showtime'] ?></td>
                      <td> <?= $show['showdate'] ?></td>
                    </tr>
                  <?php $i++;
                  } ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <?php require_once("../layouts/footer.php") ?>