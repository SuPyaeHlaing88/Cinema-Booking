<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

<?php
$userName = $userNameErr = "";
$userEmail = $userEmailErr = "";
$password = $passwordErr = "";
$confirm = $confirmErr = "";
$role = $roleErr = "";
$profile = $profileErr = "";
$profileName = "";
$tmp = "";
$invalid = "";

// for update item 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user =  get_user_with_id($mysqli, $id);
    $userName = $user['username'];
    $userEmail = $user['email'];
    $password = $user['password'];
    $role = $user['role'];
}

// for new item 
if (isset($_POST['username'])) {
    $userName = $_POST['username'];
    $userEmail = $_POST['useremail'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $role = $_POST['role'];
    $profile = $_FILES['profile'];
    $profileName = date('YMDHIS') . $profile['name'];

    if (trim($userName) === "") {
        $userNameErr = "Can't be blank!";
        $invalid = "err";
    }
    if (trim($userEmail) === "") {
        $userEmailErr = "Can't be blank!";
        $invalid = "err";
    }

    if (trim($password) === "") {
        $passwordErr = "Can't be blank!";
        $invalid = "err";
    }
    if (trim($confirm) === "") {
        $confirmErr = "Can't be blank!";
        $invalid = "err";
    } elseif ($confirm !== $password) {
        $confirmErr = "Did not match password!";
        $invalid = "err";
    }
    if ($role === "") {
        $roleErr = "Can't be blank!";
        $invalid = "err";
    }

    if ($profile === "") {
        $profileErr = "Can't be blank!";
        $invalid = "err";
    }

    if (!$invalid) {
        $tmp = $profile['tmp_name'];

        // for updating item 
        if (isset($_GET['id'])) {

            $status = update_users($mysqli, $id, $username, $userEmail, $password, $role, $profileName);
            if ($status === true) {
                move_uploaded_file($tmp, '../../assets/profile/' . $profileName);
                echo "<script>location.replace('../pages/user_list.php?update')</script>";
            } else {
                $invalid = $status;
            }
        } else {
            $user_password = password_hash($password, PASSWORD_BCRYPT);
            $status = save_user($mysqli, $userName, $userEmail, $user_password, $role, $profileName);
            if ($status === true) {
                move_uploaded_file($tmp, '../../assets/profile/' . $profileName);
                echo "<script>location.replace('../pages/user_list.php')</script>";
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
                <h3 class="page-title"> User Section </h3>
                <nav aria-label="breadcrumb">
                    <li class="breadcrumb-item"><a href="../pages/user_list.php">User List</a></li>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-10 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add User</h4>
                            <p class="card-description"> for adding new employee </p>

                            <?php if ($invalid !== "" && $invalid !== "err") { ?>
                                <div class="alert alert-danger"><?= $invalid ?></div>
                            <?php } ?>
                            <form class="forms-sample" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="username" name="username" value="<?= $userName ?>" placeholder="Username">
                                    </div>
                                    <div class="validation-message"><?= $userNameErr ?></div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="useremail" value="<?= $userEmail ?>" placeholder="Enter Your Email">
                                    </div>
                                    <div class="validation-message"><?= $userEmailErr ?></div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password" name="password" value="<?= $password ?>" placeholder="Password">
                                    </div>
                                    <div class="validation-message"><?= $passwordErr ?></div>
                                </div>

                                <div class="form-group row">
                                    <label for="confirm" class="col-sm-3 col-form-label">Confirm</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="confirm" name="confirm" value="<?= $confirm ?>" placeholder="Confirm Password">
                                    </div>
                                    <div class="validation-message"><?= $confirmErr ?></div>
                                </div>
                                <!-- for role -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">User Role</label>
                                    <div class="col-sm-9">
                                        <select name="role" class="form-select">
                                            <option value="" selected>Select user role</option>
                                            <option <?php if ($role === "1") {
                                                        echo "selected";
                                                    } ?> value="1">Admin</option>
                                            <option <?php if ($role === "2") {
                                                        echo "selected";
                                                    } ?> value="2">Cashier</option>
                                        </select>
                                    </div>
                                    <div class="validation-message"><?= $roleErr ?></div>
                                </div>

                                <div class="form-group row">
                                    <label for="profile" class="col-sm-3 col-form-label">Profile</label>
                                    <input type="file" name="profile" id="profile" value="<?= $profile ?>" class="form-control">
                                    <div class="validation-message"><?= $profileErr ?></div>
                                </div>
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"> Remember me </label>
                                </div>
                                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <?php require_once("../layouts/footer.php") ?>