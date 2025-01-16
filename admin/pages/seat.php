<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

<?php
$row = $rowErr = "";
$column = $columnErr = "";
$invalid = $alert = "";

// for update item 
// if (isset($_GET['row'])) {
//   $row = $_GET['row'];
//   $seat =  get_seat_with_row($mysqli, $row);
//   $id = $seat['id'];
//   $column = $seat['column'];
// }

// for new item 
if (isset($_POST['row'])) {
  $row = $_POST['row'];
  $column = $_POST['column'];

  if (trim($row) === "") {
    $rowErr = "Row can't be blank!";
    $invalid = "err";
  }
  if (trim($column) === "") {
    $columnErr = "Column can't be blank!";
    $invalid = "err";
  }

  if (!$invalid) {
    // for updating item 
    // if (isset($_GET['id'])) {

    //   $status = update_seat($mysqli, $id, $row, $column)
    //   if ($status === true) {
    //     echo "<script>location.replace('../pages/cinema.php')</script>";
    //   } else {
    //     $invalid = $status;
    //   }
    // } else {

    $result = get_seat_with_row_and_column($mysqli, $row, $column);
    if ($result) {
      $alert = "This seat already exists.";
    } else {
      $status =  save_seat($mysqli, $row, $column);
      if ($status === true) {
        // header("Location:./table_list.php");
        echo "<script>location.replace('../pages/seat.php')</script>";
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
        <h3 class="page-title"> Seat </h3>
      </div>
      <div class="row">
        <!-- for adding -->
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Add Seat</h4>
              <p class="card-description"> Add classes like <code>.form-control-lg</code> and <code>.form-control-sm</code>. </p>
              <p class="card-description"> Basic form elements </p>
              <?php if ($invalid !== "" && $invalid !== "err") { ?>
                <div class="alert alert-danger"><?= $invalid ?></div>
              <?php } else if ($alert !== "") { ?>
                <div class="alert alert-danger"><?= $alert ?></div>
              <?php } ?>
              <form class="forms-sample" method="post">
                <div class="form-group">
                  <label>Row</label>
                  <input type="text" class="form-control form-control-lg" name="row" placeholder="Row type" aria-label="Row" value="<?= $row ?>">
                  <div class="validation-message"><?= $rowErr ?></div>
                </div>
                <div class="form-group">
                  <label>Column</label>
                  <input type="text" class="form-control form-control-sm" name="column" placeholder="Column qty" aria-label="Location" value="<?= $column ?>">
                  <div class="validation-message"><?= $columnErr ?></div>
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
              <h4 class="card-title">Seat lists</h4>
              <p class="card-description"> Add class <code>.table-{color}</code>
              </p>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th> # </th>
                    <th>Row </th>
                    <th> Quantity </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $rows = get_all_rows($mysqli);
                  $i = 1;

                  while ($row = $rows->fetch_assoc()) {
                    // $qty = seat_count($mysqli, $row['row']);
                    // echo $qty['qty'];
                  ?>

                    <tr>
                      <td><?= $i ?></td>
                      <td><?= $row['row'] ?> </td>
                      <td>
                        <?php $qty = seat_count($mysqli, $row['row']);
                        echo $qty['qty'];   ?>
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