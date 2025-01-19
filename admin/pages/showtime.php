<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

<?php
$showdate = $showdateErr = "";
$showtime = $showtimeErr = "";
$invalid = "";
$alert = "";

// for deleting
if (isset($_GET['deleted_id'])) {
  $id = $_GET['deleted_id'];
  $status = delete_showtimes($mysqli, $id);
  if ($status === true) {
    echo "<script>location.replace('../pages/showtime.php?already_deleted')</script>";
  }
}

// for update item 
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $show =  get_showtime_with_id($mysqli, $id);
  $showdate = $show['showdate'];
  $showtime = $show['showtime'];
}

// for new item 
if (isset($_POST['showtime'])) {
  $showtime = $_POST['showtime'];
  $showdate = $_POST['showdate'];

  if ($showtime === "") {
    $showtimeErr = "showtime can't be blank!";
    $invalid = "err";
  }
  if ($showdate === "") {
    $showdateErr = "showdate can't be blank!";
    $invalid = "err";
  }

  if (!$invalid) {

    // for updating item 
    if (isset($_GET['id'])) {
      $status = update_showtimes($mysqli, $id, $showdate, $showtime);

      if ($status === true) {
        echo "<script>location.replace('../pages/showtime.php')</script>";
      } else {
        $invalid = $status;
      }
    } else {
      $result = get_showtime_with_date_and_time($mysqli, $showdate, $showtime);
      if ($result) {
        $alert = "This showtime already exists.";
      } else {
        $status =  save_showtime($mysqli, $showdate, $showtime);
        if ($status === true) {
          // header("Location:./table_list.php");
          echo "<script>location.replace('../pages/showtime.php')</script>";
        } else {
          $invalid = $status;
        }
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
        <h3 class="page-title"> Showtime </h3>
      </div>
      <div class="row">
        <!-- for adding -->
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Add showtime</h4>
              <p class="card-description"> Add classes like <code>.form-control-lg</code> and <code>.form-control-sm</code>. </p>
              <p class="card-description"> Basic form elements </p>
              <!-- alert session -->
              <?php if ($invalid !== "" && $invalid !== "err") { ?>
                <div class="alert alert-danger"><?= $invalid ?></div>
              <?php } else if ($alert !== "") { ?>
                <div class="alert alert-danger"><?= $alert ?></div>
              <?php } ?>

              <form class="forms-sample" method="post">
                <div class="form-group" method="post">
                  <label>Showtime</label>
                  <input type="time" class="form-control form-control-lg" name="showtime" placeholder="00:00pm/am" aria-label="showtime" value="<?= $showtime ?>">
                  <div class="validation-message"><?= $showtimeErr ?></div>
                </div>
                <div class="form-group">
                  <label>Showdate</label>
                  <input type="date" class="form-control form-control-sm" name="showdate" placeholder="DD/MM/YY" aria-label="showdate" value="<?= $showdate ?>">
                  <div class="validation-message"><?= $showdateErr ?></div>
                </div>
                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
              </form>
            </div>
          </div>
        </div>

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
                    <th> Actions </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $shows = get_showtime_for_all($mysqli);
                  $i = 1;
                  ?>
                  <?php while ($show = $shows->fetch_assoc()) { ?>
                    <tr>
                      <td> <?= $i ?> </td>
                      <td> <?= $show['showtime'] ?></td>
                      <td> <?= $show['showdate'] ?></td>
                      <td>
                        <a href="../pages/showtime.php?deleted_id=<?= $show['id'] ?>">
                          <i class="bg-danger fa fa-trash"></i>
                        </a>

                        <a href="../pages/showtime.php?id=<?= $show['id'] ?>">
                          <i class="bg-success fa fa-edit"></i>
                        </a>
                      </td>
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