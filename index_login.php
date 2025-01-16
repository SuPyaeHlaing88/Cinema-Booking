<?php require_once("storage/db.php") ?>
<?php require_once("storage/user_crud.php") ?>

<?php
if (isset($_COOKIE['user'])) {
  header("location:home.php");
}

// $user = get_user_with_id($mysqli, 1);
// if (!$user) {
//     save_user($mysqli, "admin", "admin@gmail.com", "password", 1);
// }
// $users = get_users($mysqli);
// $users = $users->fetch_all();
// $admin_user = array_filter($users, function ($user) {
//     return $user[4] == 1; 
// });
// if (!$admin_user) {
//     $admin_password = password_hash("password", PASSWORD_BCRYPT);
//     save_user($mysqli, "admin", "admin@gmail.com", $admin_password, 1);
// }
if (have_admin($mysqli)) {
  $admin_password = password_hash("password", PASSWORD_BCRYPT);
  save_user($mysqli, "admin", "admin@gmail.com", $admin_password, 1, "profile.png");
}

$email = $email_err = $password = $password_err = "";

if (isset($_POST['email'])) {
  $email = $mysqli->real_escape_string($_POST['email']);
  $password = $mysqli->real_escape_string($_POST['password']);
  if ($email === "") {
    $email_err = "Email cann't be blank!";
  }
  if ($password === "") {
    $password_err = "Password cann't be blank!";
  }
  if ($email_err === "" && $password_err === "") {
    $user = get_user_with_email($mysqli, $email);
    if (!$user) {
      $email_err = "User does not exist!";
    } else {
      if (password_verify($password, $user['password'])) {
        setcookie("user", json_encode($user), time() + 1000 * 60 * 60 * 24 * 14, "/");
        header("Location:home.php");
      } else {
        $password_err = "Password does not match!";
      }
    }
  }
}
?>

<!-- for new login form -->
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cinema</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.png">
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
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <h2 class="text-center">Login Form</h2>
              <?php if (isset($_GET['invalid'])) { ?>
                <div class="alert alert-danger"><?= $_GET['invalid'] ?></div>
              <?php } ?>
              <!-- form start -->
              <form class="pt-3" method="post">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" name="email" value="<?= $email ?>" placeholder="Your Email">
                  <label for="email">Email address</label>
                  <div class="text-danger" style="font-size:12px;"><?= $email_err ?></div>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" value="<?= $password ?>" placeholder="Password">
                  <label for="password">Password</label>
                  <div class="text-danger" style="font-size:12px;"><?= $password_err ?></div>
                </div>
                <div class="form-check">
                  <input type="checkbox" id="show" class="form-check-input">
                  <label class="form-check-label" for="show">
                    Show Password
                  </label>
                </div>
                <div class="mt-3 d-grid gap-2">
                  <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
              </form>
              <!-- form end -->
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
</body>

<script>
  let show = $("#show");
  let password = $("#password");
  show.on("click", () => {
    if (show.is(":checked")) {
      password.get(0).type = "text";
    } else {
      password.get(0).type = "password";
    }
  })
</script>
</html> 