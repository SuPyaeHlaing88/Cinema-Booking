<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>
// for deleting
<?php
$deleteSuccess = $deleteFail = "";
if (isset($_GET['deleted_id'])) {
  $id = $_GET['deleted_id'];
  $status = delete_movies($mysqli, $id);
  if ($status == true) {
    $deleteSuccess = "Deleted movie Successfully";
  } else {
    $deleteFail = "Can't delete movie record";
  }
}
?>
<div class="container-fluid page-body-wrapper">
  <?php require_once("../layouts/sidebar.php") ?>
  <!-- partial -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Movie LIsts </h3>
        <?php if ($deleteSuccess !== "") { ?>
          <div class="alert alert-warning alert-dismissible fade show w-50" role="alert">
            <strong><?= $deleteSuccess ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php } ?>
        <?php if ($deleteFail !== "") { ?>
          <div class="alert alert-warning alert-dismissible fade show w-50" role="alert">
            <strong><?= $deleteFail ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php } ?>
        <nav aria-label="breadcrumb">
          <li class="breadcrumb-item"><a href="../pages/add_movie.php">ADD NEW MOVIE</a></li>
        </nav>
      </div>
      <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body" id="movie_schedule">
              <h4 class="card-title"> Movies</h4>
              </p>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th> #</th>
                    <th> Poster </th>
                    <th> Movie title </th>
                    <th> Description</th>
                    <th> Genre</th>
                    <th> Duration</th>
                    <th> Actions </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $movies = get_movies($mysqli);
                  ?>
                  <?php $i = 1;
                  while ($movie = $movies->fetch_assoc()) { ?>
                    <tr>
                      <td> <?= $i ?> </td>
                      <td>
                        <img class="table-img" src="../../assets/poster/<?= $movie['poster'] ?>">
                      </td>
                      <td> <?= $movie['title'] ?></td>
                      <td style="word-wrap: break-word; white-space: normal;"> <?= $movie['description'] ?></td>
                      <td> <?= $movie["genre"] ?></td>
                      <td> <?= $movie["duration"] ?> </td>
                      <td>
                        <!-- that's not work cause of foriegn key -->
                        <a href="../pages/movie_list.php?deleted_id=<?= $movie['id'] ?>">
                          <i class="bg-success fa fa-trash"></i>
                        </a>
                        <a href="../pages/add_movie.php?id=<?= $movie['id'] ?>">
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
    <?php require_once("../layouts/footer.php") ?>