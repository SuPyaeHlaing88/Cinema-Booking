<?php require_once('./layout/header.php') ?>
<?php
    if(isset($_GET['movie_id'])){
        $movie_id = $_GET['movie_id'];
        $_SESSION['screening'] = ['movie_id' => $movie_id];
    }
    
?>



        <section>
            <div class="filter-search-box">

                <div class="filters-box">

                    <div class="all-filters filters">
                        All formats <i class="fa fa-angle-down"></i>
                    </div>

                    <div class="date-filters filters">
                        By Date <i class="fa fa-angle-down"></i>
                    </div>

                    <div class="category-filters filters">
                        By category <i class="fa fa-angle-down"></i>
                    </div>

                    <div class="category-filters filters">
                        Coming soon
                    </div>

                </div>

                <div class="search-filters">
                    <input type="text" placeholder="Search by name...">
                    <i class="fa fa-search"></i>
                </div>

                <div class="search-bar">
                    <div class="bar"></div>
                </div>

            </div>
            <!----filter-search-box---->
            <table>
                
            <?php if(isset($_GET['movie_id'])){
                $movie_id = $_GET['movie_id'];
                $movies_data = get_movie_with_id($mysqli,$movie_id);
                $cinemas = get_cinemas_with_movies_id($mysqli,$movie_id);
                while( $cinema= $cinemas->fetch_assoc()){?>
                <tr>
                    <td><?=$cinema['name']?></td>
                    <td><?=$cinema['name']?></td>
                    <td><a href="./select_date_and_time.php?cinema_id=<?= $cinema['id'] ?>&movie_id=<?= $movie_id ?>">select the cinema</a></td>
                </tr>

          <?php           
                }
            }
                 ?>
            
            </table>

           
        </section>
<?php require_once('./layout/footer.php') ?>