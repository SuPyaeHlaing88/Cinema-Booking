<?php require_once("../auth/isLogin.php") ?>
<?php require_once("../storage/db.php"); ?>
<?php require_once("../storage/user_crud.php"); ?>
<?php require_once("../storage/customer_crud.php"); ?>
<?php require_once("../storage/movie_crud.php"); ?>
<?php require_once("../storage/cinema_crud.php"); ?>
<?php require_once("../storage/seat_crud.php"); ?>
<?php require_once("../storage/cinema_has_seat_crud.php"); ?>
<?php require_once("../storage/showtime_crud.php"); ?>
<?php require_once("../storage/screening_crud.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Home Dashboard</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- nav start  -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo" href="index.php"><img src="../assets/images/logo.svg" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="index.php"><img src="../assets/images/logo-mini.svg" alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <div class="search-field d-none d-md-block">
          <form class="d-flex align-items-center h-100" action="#">
            <div class="input-group">
              <div class="input-group-prepend bg-transparent">
                <i class="input-group-text border-0 mdi mdi-magnify"></i>
              </div>
              <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
            </div>
          </form>
        </div>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="nav-profile-img">
                <img src="../assets/images/faces/face1.jpg" alt="image">
                <span class="availability-status online"></span>
              </div>
              <div class="nav-profile-text">
                <p class="mb-1 text-black">David Greymaax</p>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="#">
                <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="?signout" name="signout">
                <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
            </div>
          </li>
          <li class="nav-item d-none d-lg-block full-screen-link">
            <a class="nav-link">
              <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
              <i class="mdi mdi-bell-outline"></i>
              <span class="count-symbol bg-danger"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <h6 class="p-3 mb-0">Notifications</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-calendar"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                  <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-cog"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                  <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-link-variant"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                  <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <h6 class="p-3 mb-0 text-center">See all notifications</h6>
            </div>
          </li>
          <li class="nav-item nav-logout d-none d-lg-block">
            <a class="nav-link" href="#">
              <i class="mdi mdi-power"></i>
            </a>
          </li>
          <li class="nav-item nav-settings d-none d-lg-block">
            <a class="nav-link" href="#">
              <i class="mdi mdi-format-line-spacing"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- navbar End -->

    <div class="container-fluid page-body-wrapper">

      <!-- side bar start  -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="../assets/images/faces/face1.jpg" alt="profile" />
                <span class="login-status online"></span>
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2">David Grey. H</span>
                <span class="text-secondary text-small">Project Manager</span>
              </div>
              <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form_user" aria-expanded="false" aria-controls="form_user">
              <span class="menu-title">Users</span>
              <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="form_user">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="../admin/pages/add_user.php">Add user</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../admin/pages/user_list.php">User List</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">
              <span class="menu-title">Movie</span>
              <i class="mdi mdi-movie menu-icon"></i>
            </a>
            <div class="collapse" id="forms">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="../admin/pages/add_movie.php">Add Movie</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../admin/pages/movie_list.php">Movies List</a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form_cinema" aria-expanded="false" aria-controls="form_cinema">
              <span class="menu-title">Cinema</span>
              <i class="mdi mdi-contacts menu-icon"></i>
            </a>
            <div class="collapse" id="form_cinema">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="../admin/pages/cinema.php">
                    <span>Add cinema</span>
                    <i class="mdi mdi-plus plus-icon"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../admin/pages/seat.php">
                    <span>Add seat</span>
                    <i class="mdi mdi-plus plus-icon"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../admin/pages/cinema_has_seats.php">Cinema Detail</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/pages/showtime.php" aria-expanded="false">
              <span class="menu-title">Showtime</span>
              <i class="mdi mdi-clock menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#schedules" aria-expanded="false" aria-controls="schedules">
              <span class="menu-title">Schedules</span>
              <i class="mdi mdi-table-large menu-icon"></i>
            </a>
            <div class="collapse" id="schedules">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="../admin/pages/add_schedule.php">Add New Schedule</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../admin/pages/schedule.php">Screening Schedules</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../admin/pages/movie_schedule.php">Movie Schedules</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../admin/pages/bookings.php" aria-expanded="false">
              <span class="menu-title">Booking Tickets</span>
              <i class="mdi mdi-ticket menu-icon"></i>
            </a>
          </li>
        </ul>
      </nav>
      <!-- side bar end-->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
              </span> Dashboard
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
              </ul>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                  <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Weekly Sales <i class="mdi mdi-chart-line mdi-24px float-end"></i>
                  </h4>
                  <!-- weekly booking total amount  -->
                  <h2 class="mb-5">$ booking total amount</h2>
                  <!-- 
                  (now - Lastamount ) / last * 100%
                   if (-) decreased;
                  -->
                  <h6 class="card-text">Increased by 60%</h6>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                  <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Weekly Orders <i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                  </h4>
                  <!-- weekly booking total qty  -->
                  <h2 class="mb-5">count of bookin_id</h2>
                  <h6 class="card-text">Decreased by 10%</h6>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                  <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Weekly Customers <i class="mdi mdi-diamond mdi-24px float-end"></i>
                  </h4>
                  <h2 class="mb-5">count of customer(email dist)</h2>
                  <h6 class="card-text">Increased by 5%</h6>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <!-- from booking crud -->
                <div class="card-body">
                  <h4 class="card-title">Recent Tickets</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th> booking ID </th>
                          <th> booking time </th>
                          <th> Customer </th>
                          <th> Cinema </th>
                          <th> Movie </th>
                          <th> Seats </th>
                          <th> total amout </th>
                          <th> Method </th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- loop latest 5 tikets -->
                        <tr>
                          <td> WD-12345 </td>
                          <td> Dec 5, 2017 </td>
                          <td> customer name </td>
                          <td> cinema name </td>
                          <td> movie tilte</td>
                          <td>
                            <label class="badge badge-gradient-success">A1</label>
                            <label class="badge badge-gradient-success">A2</label>
                          </td>
                          <td> 12,000 MMk </td>
                          <td>
                            <label class="badge badge-gradient-primary">KPay</label>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body p-0 d-flex">
                  <div id="inline-datepicker" class="datepicker datepicker-custom"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-7 grid-margin stretch-card">
              <div class="card">
                <?php
                $latest_screening = get_all_screenings($mysqli); { ?>
                  <div class="card-body">
                    <h4 class="card-title">Recent Update</h4>
                    <div class="d-flex">
                      <div class="d-flex align-items-center me-4 text-muted font-weight-light">
                        <i class="mdi mdi-home icon-sm me-2"></i>
                        <span><?= $latest_screening['name'] . " Cinema" ?></span>
                      </div>
                      <div class="d-flex align-items-center text-muted font-weight-light">
                        <i class="mdi mdi-clock icon-sm me-2"></i>
                        <span><?= "Showdate " . $latest_screening['showdate'] ?></span>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-12 ps-1">
                        <img src="../assets/images/dashboard/img_2.jpg" class="mb-2 mw-100 w-100 rounded" alt="image">
                        <!-- <img src="<= $latest_screening['poster'] ?>" class="mb-2 mw-100 w-100 rounded" alt="image"> -->
                      </div>
                    </div>
                    <div class="d-flex mt-5 align-items-top">
                      <div class="mb-0 flex-grow">
                        <h5 class="me-2 mb-2"><?= $latest_screening['title'] ?></h5>
                        <p class="mb-0 font-weight-light"><?= $latest_screening['description'] ?></p>
                      </div>
                    </div>
                    <div class="d-flex">
                      <div class="d-flex align-items-center me-4 text-muted font-weight-light">
                        <i class="mdi mdi-menu icon-sm me-2"></i>
                        <span><?= $latest_screening['genre'] ?></span>
                      </div>
                      <div class="d-flex align-items-center text-muted font-weight-light">
                        <i class="mdi mdi-clock icon-sm me-2"></i>
                        <span><?= "Duration " . $latest_screening['duration'] ?></span>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Now showing Movies Status</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Title </th>
                          <th> Show Date </th>
                          <th> Progress </th>
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
                              <td><?= $nowMovie['title'] ?></td>
                              <td>
                                <?php
                                $screenings = get_nowshowing_movie_by_showdate($mysqli, $movie['id']);
                                while ($screening = $screenings->fetch_assoc()) { ?>
                                  <ol><?= $screening['showdate'] ?></ol>
                                <?php } ?>
                              </td>
                              <td>
                                <div class="progress">
                                  <?php
                                  $screenings = get_nowshowing_movie_by_showdate($mysqli, $movie['id']);
                                  $temp = new DateTime(date('Y-m-d'));

                                  while ($screening = $screenings->fetch_assoc()) {
                                    $date = new DateTime($screening['showdate']);
                                    if ($date >= $temp) {
                                      $interval = $temp->diff($date);
                                      $dayCount = $interval->days;
                                    }
                                  }
                                  $value = 100 - ($dayCount * 20);
                                  ?>
                                  <div class="progress-bar bg-gradient-success" role="progressbar" style="width: <?= $value ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
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
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-dark">Todo List</h4>
                  <div class="add-items d-flex">
                    <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?">
                    <button class="add btn btn-gradient-primary font-weight-bold todo-list-add-btn" id="add-task">Add</button>
                  </div>
                  <div class="list-wrapper">
                    <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                      <li>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox"> Meeting with Alisa </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                      </li>
                      <li class="completed">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" checked> Call John </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                      </li>
                      <li>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox"> Create invoice </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                      </li>
                      <li>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox"> Print Statements </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                      </li>
                      <li class="completed">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" checked> Prepare for presentation </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                      </li>
                      <li>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox"> Pick up kids from school </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../assets/vendors/chart.js/chart.umd.js"></script>
  <script src="../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>
  <script src="../assets/js/jquery.cookie.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="../assets/js/dashboard.js"></script>
  <!-- End custom js for this page -->
</body>

</html>