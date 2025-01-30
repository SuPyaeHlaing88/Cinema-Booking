<?php session_start();
require_once("./storage/db.php") ?>
<?php require_once("./storage/customer_crud.php") ?>
<?php
if (isset($_GET["signout"])) {
  setcookie("user", "",  -1, "/"); // Expire the cookie
  echo "<script>location.replace('./register.php')</script>";
  exit;
}

$name = $nameErr = "";
$email = $emailErr = "";
$phone = $phoneErr = "";
// $country = $countryErr = "";
// $term =
$termErr = "";
$invalid = "";

// for update item 
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $customer =  get_customer_with_id($mysqli, $id);
  $name = $customer['name'];
  $email = $customer['email'];
  $phone = $customer['phone'];
}

// for new item 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $term = $_POST['term'];

  if (trim($name) === "") {
    $nameErr = "Can't be blank!";
    $invalid = "err";
  }
  if (trim($email) === "") {
    $emailErr = "Can't be blank!";
    $invalid = "err";
  }

  if (trim($phone) === "") {
    $phoneErr = "Can't be blank!";
    $invalid = "err";
  }

  // if (trim($country) === "") {
  //   $countryErr = "Can't be blank!";
  //   $invalid = "err";
  // }

  // if ($term !== true) {
  //   $termErr = "Can't be blank!";
  //   $invalid = "err";
  // }


  if (!$invalid) {
    $_SESSION['user'] = ['name' => $name, 'email' => $email, 'phone' => $phone];
    // for updating item 
    if (isset($_GET['id'])) {
      $status =  update_customer($mysqli, $id, $name, $email, $phone);
      if ($status === true) {
        echo "<script>location.replace('./index.php?update')</script>";
      } else {
        $invalid = $status;
      }
    } else { // new customer
      $status = save_customer($mysqli, $name, $email, $phone);
      if ($status === true) {
        echo "<script>location.replace('./index.php')</script>";
      } else {
        $invalid = $status . "save";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cinema</title>
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="assets/images/logo.svg">
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <?php if ($invalid !== "" && $invalid !== "err") { ?>
                <div class="alert alert-danger"><?= $invalid ?></div>
              <?php } ?>
              <form class="pt-3 forms-sample" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="" name="name" placeholder="Your Name" value="<?= $name ?>">
                </div>
                <div class="validation-message"><?= $nameErr ?></div>

                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="" name="email" placeholder="Email" value="<?= $email ?>">
                </div>
                <div class="validation-message"><?= $emailErr ?></div>

                <!-- <div class="form-group">
                  <select class="form-select form-select-lg" id="" name="country"  value="<= $userName ?>" >
                    <option>Myanmar</option>
                    <option>United States of America</option>
                    <option>Thailand</option>
                  </select>
                </div>
                <div class="validation-message"><= $countryErr ?></div> -->

                <div class="form-group">
                  <input type="phone" class="form-control form-control-lg" id="" name="phone" placeholder="Phone Number" value="<?= $phone ?>">
                </div>
                <div class="validation-message"><?= $phoneErr ?></div>

                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" name="term" id='check' value="true" class="form-control form-control-lg form-check-input"> I agree to all Terms & Conditions </label>
                  </div>
                  <div class="validation-message"> <?= $termErr ?></div>
                </div>
                <div class="mt-3 d-grid gap-2">
                  <button type="submit" class="btn btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/misc.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <script src="assets/js/jquery.cookie.js"></script>
  <!-- endinject -->
</body>

</html>