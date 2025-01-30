<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>
<?php
$deleteSuccess = $deleteFail = "";
if (isset($_GET['deleted_id'])) {
  $id = $_GET['deleted_id'];
  $status = delete_users($mysqli, $id);
  if ($status == true) {
    $report = "Deleted {$id} User Successfully";
  } else {
    $report = "Can't delete user record";
  }
}
?>
<div class="container-fluid page-body-wrapper">
  <?php require_once("../layouts/sidebar.php") ?>
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Users /Employees </h3>
        <nav aria-label="breadcrumb">
          <li class="breadcrumb-item"><a href="../pages/add_user.php">ADD NEW USER</a></li>
        </nav>
      </div>

      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body" id="movie_schedule">
              <?php if (isset($_GET['deleted_id'])) { ?>
                <span class="bg-warning align-item-center">
                  <?= $report ?>
                </span>
              <?php } ?>
              <h4 class="card-title"> User list</h4>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th> Profile </th>
                    <th> Username </th>
                    <th> Email </th>
                    <th> Role</th>
                    <th> Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $users = get_users($mysqli);
                  ?>
                  <?php while ($user = $users->fetch_assoc()) { ?>
                    <tr>
                      <td>
                        <img class="table-img" src="../../assets/profile/<?= $user['profile'] ?>">
                      </td>
                      <td> <?= $user['username'] ?></td>
                      <td> <?= $user['email'] ?></td>
                      <td> <?= $user["role"] ?></td>
                      <td>
                        <a href="../pages/user_list.php?deleted_id=<?= $user['id'] ?>">
                          <i class="bg-danger fa fa-trash"></i>
                        </a>
                        <a href="../pages/add_user.php?id=<?= $user['id'] ?>">
                          <i class="bg-success fa fa-edit"></i>
                        </a>
                      </td>
                    </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    <?php require_once("../layouts/footer.php") ?>