<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="../../assets/images/faces/face1.jpg" alt="profile" />
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
      <a class="nav-link" href="../index.php">
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
            <a class="nav-link" href="../pages/add_user.php">Add user</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pages/user_list.php">User List</a>
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
            <a class="nav-link" href="../pages/add_movie.php">Add Movie</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pages/movie_list.php">Movies List</a>
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
            <a class="nav-link" href="../pages/cinema.php">
              <span>Add cinema</span>
              <i class="mdi mdi-plus plus-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pages/seat.php">
              <span>Add seat</span>
              <i class="mdi mdi-plus plus-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pages/cinema_has_seats.php">Cinema Detail</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="../pages/showtime.php" aria-expanded="false">
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
            <a class="nav-link" href="../pages/add_schedule.php">Add New Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pages/schedule.php">Screening Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pages/movie_schedule.php">MOvie Schedule</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../pages/bookings.php" aria-expanded="false">
        <span class="menu-title">Booking Tickets</span>
        <i class="mdi mdi-ticket menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <span class="menu-title">User Pages</span>
        <i class="menu-arrow"></i>
        <i class="mdi mdi-lock menu-icon"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="../pages/samples/blank-page.php"> Blank Page </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pages/samples/login.php"> Login </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pages/samples/register.php"> Register </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pages/samples/error-404.php"> 404 </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pages/samples/error-500.php"> 500 </a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../docs/documentation.php" target="_blank">
        <span class="menu-title">Documentation</span>
        <i class="mdi mdi-file-document-box menu-icon"></i>
      </a>
    </li>
  </ul>
</nav>