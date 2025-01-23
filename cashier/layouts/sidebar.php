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
      <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">
        <span class="menu-title">Movie</span>
        <i class="mdi mdi-movie menu-icon"></i>
      </a>
      <div class="collapse" id="forms">
        <ul class="nav flex-column sub-menu">

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
            <a class="nav-link" href="../pages/schedule.php">Screening Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pages/movie_schedule.php">MOvie Schedule</a>
          </li>
        </ul>
      </div>
    </li>

  </ul>
</nav>