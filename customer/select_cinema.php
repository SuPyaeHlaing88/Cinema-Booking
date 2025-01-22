<?php require_once('./layout/header.php') ?>
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
            
            <?php if(isset($_GET['movie_id'])){
                $movie_id = $_GET['movie_id'];
                $movies_data = get_movie_with_id($mysqli,$movie_id);
                var_dump($movies_data);
                $cinemas = get_cinemas_with_movies_id($mysqli,$movie_id);
                while( $cinema= $cinemas->fetch_assoc()){
                    var_dump($cinema['name']);
                }
            }
                 ?>
            

            <!-- <div class="movie-card-section">
                
                <?php 
                    $movies = get_all_movie_for_show($mysqli);
                    while($movie = $movies->fetch_assoc()){ ?>
                         <div class="card">
                    <a href="./select_cinema.php?movie_id=<?= $movie['movie_id'] ?>" style="text-decoration: none;">    
                    <img class="table-img" src="../assets/poster/americano.png">

                    <div class="card-content">
                        <p class="movie-name">
                           <?= $movie['title'] ?>
                        </p>

                        <div class="movie-info">
                            <p class="time">    
                                <span>Duration : <?= date('g:i A', strtotime($movie['duration']))  ?>
                                    <span class="d3">Time</span> <?= date('g:i A', strtotime($movie['show_time'])) ?> 
                                    <span class="d3">Start Date </span> <?= $movie['show_date'] ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                </a>    
                <?php  } ?>
            </div> -->
            <!---movie-card--j->

            <div class="show">
                <div class="show-bar">
                    <div class="bar"></div>
                </div>
                <button>Show more</button>
            </div>
            <!---bar--->
        </section>
<?php require_once('./layout/footer.php') ?>