<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>
<?php
$name = $nameErr = "";
$location = $locationErr = "";
$invalid = "";

// for update item 
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $cinema =  get_cinema_with_id($mysqli, $id);
  $name = $cinema['name'];
  $location = $cinema['location'];
}

// for new item 
if (isset($_POST['name'])) {
  $name = $_POST['name'];
  $location = $_POST['location'];

  if (trim($name) === "") {
    $nameErr = "Name can't be blank!";
    $invalid = "err";
  }
  if (trim($location) === "") {
    $locationErr = "Location can't be blank!";
    $invalid = "err";
  }

  if (!$invalid) {
    // for updating item 
    if (isset($_GET['id'])) {

      $status = update_cinema($mysqli, $id, $name, $location);
      if ($status === true) {
        echo "<script>location.replace('../pages/cinema.php')</script>";
      } else {
        $invalid = $status;
      }
    } else {
      $status =  save_cinema($mysqli, $name, $location);
      if ($status === true) {
        // header("Location:./table_list.php");
        echo "<script>location.replace('../pages/cinema.php')</script>";
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
        <h3 class="page-title"> Cinema </h3>
      </div>
      <div class="row">
        <!-- for adding -->
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Add Cinema</h4>
              <p class="card-description"> Add classes like <code>.form-control-lg</code> and <code>.form-control-sm</code>. </p>
              <p class="card-description"> Basic form elements </p>
              <?php if ($invalid !== "" && $invalid !== "err") { ?>
                <div class="alert alert-danger"><?= $invalid ?></div>
              <?php } ?>
              <form class="forms-sample" method="post">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control form-control-lg" name="name" placeholder="Cinema Name" aria-label="name" value="<?= $name ?>">
                  <div class="validation-message"><?= $nameErr ?></div>
                </div>
                <div class="form-group">
                  <label>Location</label>
                  <input type="text" class="form-control form-control-sm" name="location" placeholder="Location" aria-label="location" value="<?= $location ?>">
                  <div class="validation-message"><?= $locationErr ?></div>
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
              <h4 class="card-title">Cinema lists</h4>
              <p class="card-description"> Add class <code>.table-{color}</code>
              </p>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th> # </th>
                    <th>Name </th>
                    <th> Location </th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $cinemas = get_cinemas($mysqli);
                  $i = 1;
                  ?>
                  <?php while ($cinema = $cinemas->fetch_assoc()) { ?>
                    <tr>
                      <td> <?= $i ?> </td>
                      <td> <?= $cinema['name'] ?></td>
                      <td> <?= $cinema['location'] ?></td>
                      <td>
                        <i class="bg-danger fa fa-trash"></i>
                        <a href="../pages/cinema.php?id=<?= $cinema['id'] ?>">
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