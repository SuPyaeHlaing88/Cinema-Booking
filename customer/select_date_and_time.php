<?php require_once('./layout/header.php'); 

    if(isset($_GET['cinema_id'])){
        $cinema_id = $_GET['cinema_id'];
        $movie_id = $_GET['movie_id'];
        $select_showtime_data = get_showtime_data_with_movie_id_and_cinema_id($mysqli,$cinema_id,$movie_id);
        $arr = $_SESSION['screening'];
        $_SESSION['screening'] = ['movie_id' => $arr['movie_id'], 'cinema_id' => $cinema_id];
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

                <div class="search-bar
if(isset($_SESSION['screening'])){
        $cinema_id = $_GET['cinema_id'];
        $session_arr =  $_SESSION['screening'];
        $_SESSION['screening'] = ['movie_id' => $session_arr['movie_id'], 'cinema_id' => $cinema_id];  
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
            
           <?php
           if(isset($_GET['cinema_id'])){
            $cinema_id = $_GET['cinema_id'];
            $movie_id = $_GET['movie_id'];
            $select_showtime_data = get_showtime_data_with_movie_id_and_cinema_id($mysqli,$cinema_id,$movie_id);
            
           }
       
           ?>


            <table>
                <tr>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Price</th>
                    <th>Book</th>
                </tr>
                <?php while($showtime = $select_showtime_data->fetch_assoc()){ ?>
                <tr>
                    <td><?= $showtime['showdate'] ?></td>
                    <td><?= $showtime['showtime'] ?></td>
                    <td><a href="./seat.php?showtime_id=<?= $showtime['id'] ?>">Book</a></td>
                </tr>
                <?php } ?>
            </table>


           
        </section>
<?php require_once('./layout/footer.php') ?>