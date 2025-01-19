<!-- 
    $sql = "CREATE TABLE IF NOT EXISTS `screenings` (
        `id` INT AUTO_INCREMENT, 
        `showtime_id` INT NOT NULL,  
        `movie_id` INT NOT NULL , 
        `cinema_has_seat_id` INT NOT NULL, 
        PRIMARY KEY(`id`), 
        FOREIGN KEY(`movie_id`)  REFERENCES `movies`(`id`),
        FOREIGN KEY(`showtime_id`)  REFERENCES `showtimes`(`id`), 
        FOREIGN KEY(`cinema_has_seat_id`)  REFERENCES `cinema_has_seats`(`id`)
        )"; 
-->

<?php
function save_screenings($mysqli, $movie_id, $cinema_id, $showtime_id)
{
    $sql = "INSERT INTO `screenings`(`movie_id`, `cinema_id`,`showtime_id`) values('$movie_id', '$cinema_id','$showtime_id')";
    return $mysqli->query($sql);
}

function get_all_screenings($mysqli)
{
    $sql = "SELECT * FROM `screenings`";
    return $mysqli->query($sql);
}

function get_screening_with_id($mysqli, $id)
{
    $sql = "SELECT * FROM `screenings` WHERE `id` = '$id' ";
    return  $mysqli->query($sql);
}


// for cinema schedule 
function get_screenings_with_cinema($mysqli, $cinema_id)
{
    $sql = "SELECT * FROM screenings as scr 
                LEFT JOIN cinemas ON scr.cinema_id = cinemas.id 
                LEFT JOIN movies ON movies.id = scr.movie_id
                LEFT JOIN showtimes ON showtimes.id = scr.showtime_id
                WHERE scr.cinema_id = '$cinema_id' AND showtimes.showdate > CURRENT_DATE
                ";
    return $mysqli->query($sql);
}
function get_screenings_with_cinema_id_for_title($mysqli, $cinema_id)
{
    $sql = "SELECT DISTINCT title FROM screenings as scr 
                LEFT JOIN cinemas ON scr.cinema_id = cinemas.id 
                LEFT JOIN movies ON movies.id = scr.movie_id
                LEFT JOIN showtimes ON showtimes.id = scr.showtime_id
                WHERE scr.cinema_id = '$cinema_id' AND showtimes.showdate > CURRENT_DATE
                ";
    return $mysqli->query($sql);
}
function get_screenings_with_cinema_id_for_showdate($mysqli, $cinema_id)
{
    $sql = "SELECT DISTINCT showdate FROM screenings as scr 
                LEFT JOIN cinemas ON scr.cinema_id = cinemas.id 
                LEFT JOIN movies ON movies.id = scr.movie_id
                LEFT JOIN showtimes ON showtimes.id = scr.showtime_id
                WHERE scr.cinema_id = '$cinema_id' AND showtimes.showdate > CURRENT_DATE
                ";
    return $mysqli->query($sql);
}
// AND showtimes.showdate > CURRENT_DATE AND showtimes.showdate <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
// for showtime schedule none
function get_screenings_with_showdate_for_time($mysqli, $showtime)
{
    $sql = "SELECT DISTINCT showtime FROM screenings as scr 
                LEFT JOIN movies ON movies.id = scr.movie_id
                LEFT JOIN cinemas ON cinemas.id = scr.cinema_id
                LEFT JOIN showtimes ON showtimes.id = scr.showtime_id
                WHERE showtimes.showtime = '$showtime'";
    return $mysqli->query($sql);
}
// function get_screenings_
function get_screenings_with_showdate_for_name($mysqli, $showdate)
{
    $sql = "SELECT DISTINCT name FROM screenings as scr 
                LEFT JOIN movies ON movies.id = scr.movie_id
                LEFT JOIN cinemas ON cinemas.id = scr.cinema_id
                LEFT JOIN showtimes ON showtimes.id = scr.showtime_id
                WHERE showtimes.showdate = '$showdate'";
    return $mysqli->query($sql);
}
function get_screenings_with_showdate_for_title($mysqli, $showdate)
{
    $sql = "SELECT DISTINCT title FROM screenings as scr 
                LEFT JOIN movies ON movies.id = scr.movie_id
                LEFT JOIN cinemas ON cinemas.id = scr.cinema_id
                LEFT JOIN showtimes ON showtimes.id = scr.showtime_id
                WHERE showtimes.showdate = '$showdate'";
    return $mysqli->query($sql);
}

// to check duplicate screenings 
function get_screening_with_cinema_and_showtime($mysqli, $cinema_id)
{
    // $sql = "SELECT * FROM `screenings`
    //         LEFT JOIN showtimes ON showtimes.id = screenings.showtime_id
    //         WHERE `cinema_id` = '$cinema_id' AND `showtime_id` = '$showtime_id' ";
    $sql = "select screenings.* from screenings where screenings.cinema_id = $cinema_id";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
    // return $mysqli->query($sql)->fetch_assoc();
}
// shit shift
function get_screening_with_selected_cinema_and_selected_showtimes($mysqli, $selected_cinema, $selected_showtime)
{
    $sql = "SELECT * FROM `screenings`
            LEFT JOIN showtimes ON showtimes.id = screenings.showtime_id
            LEFT JOIN cinemas ON cinemas.id = screenings.cinema_id
            LEFT JOIN cinemas ON movies.id = screenings.movie_id
            WHERE screenings.`cinema_id` = $selected_cinema AND screenings.`showtime_id` = $selected_showtime";
    // return $mysqli->query($sql);

    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}

function get_screening_with_movie_duration($mysqli, $movie_id)
{
    $sql = "SELECT * FROM `screenings`  as src 
                LEFT JOIN movies ON movies.id = src.movie_id 
                LEFT JOIN showtimes ON showtimes.id = src.showtime_id
                WHERE src.`movie_id` = '$movie_id'";
    return $mysqli->query($sql)->fetch_assoc();
}


//    for screening_showtime_gap
function get_gap_between_screening_schedules($mysqli,  $showdate)
{
    $sql = "SELECT showtime FROM `showtimes` 
                    WHERE showtimes.`showdate` = '$showdate' ";
    return $mysqli->query($sql);
}

// for movie schedules 
function get_nowshowing_movie_schedule($mysqli, $movie_id)
{
    $sql = "SELECT movies.id, movies.duration FROM screenings as scr 
                LEFT JOIN movies ON movies.id = scr.movie_id
                LEFT JOIN showtimes ON showtimes.id = scr.showtime_id
                WHERE scr.movie_id = '$movie_id' 
                -- AND showtimes.showdate >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) 
                AND showtimes.showdate >= CURDATE() 
                AND showtimes.showdate <= DATE_ADD(CURDATE(), INTERVAL 3 DAY)";
    return $mysqli->query($sql);
}
function get_nowshowing_movie_by_cinema($mysqli, $movie_id)
{
    $sql = "SELECT DISTINCT name FROM screenings as scr 
                LEFT JOIN cinemas as c ON scr.cinema_id = c.id 
                LEFT JOIN movies as m ON scr.movie_id = m.id
                WHERE scr.movie_id = '$movie_id'";
    return $mysqli->query($sql);
}

function get_nowshowing_movie_by_showdate($mysqli, $movie_id)
{
    $sql = "SELECT DISTINCT showdate FROM screenings as scr 
                LEFT JOIN showtimes as sh ON scr.showtime_id = sh.id 
                LEFT JOIN movies as m ON scr.movie_id = m.id
                WHERE scr.movie_id = '$movie_id'";
    return $mysqli->query($sql);
}

function get_upcoming_movie_schedule($mysqli, $movie_id)
{
    $sql = "SELECT movies.id FROM screenings as scr 
                LEFT JOIN movies ON movies.id = scr.movie_id
                LEFT JOIN showtimes ON showtimes.id = scr.showtime_id
                WHERE scr.movie_id = '$movie_id' 
                AND showtimes.showdate > DATE_ADD(CURDATE(), INTERVAL 3 DAY)";
    return $mysqli->query($sql);
}

function get_upcoming_movie_by_cinema($mysqli, $movie_id)
{
    $sql = "SELECT DISTINCT name FROM screenings as scr 
                LEFT JOIN cinemas as c ON scr.cinema_id = c.id 
                LEFT JOIN movies as m ON scr.movie_id = m.id
                WHERE scr.movie_id = '$movie_id'";
    return $mysqli->query($sql);
}

function get_upcoming_movie_by_showdate($mysqli, $movie_id)
{
    $sql = "SELECT DISTINCT showdate FROM screenings as scr 
                LEFT JOIN showtimes as sh ON scr.showtime_id = sh.id 
                LEFT JOIN movies as m ON scr.movie_id = m.id
                WHERE scr.movie_id = '$movie_id'";
    return $mysqli->query($sql);
}

function get_published_movie_schedule($mysqli, $movie_id)
{
    $sql = "SELECT movies.id FROM screenings as scr 
                LEFT JOIN movies ON movies.id = scr.movie_id
                LEFT JOIN showtimes ON showtimes.id = scr.showtime_id
                WHERE scr.movie_id = '$movie_id' 
                AND showtimes.showdate < DATE_SUB(CURDATE(), INTERVAL 1 DAY) ";
    return $mysqli->query($sql);
}
function get_published_movie_by_cinema($mysqli, $movie_id)
{
    $sql = "SELECT DISTINCT name FROM screenings as scr 
                LEFT JOIN cinemas as c ON scr.cinema_id = c.id 
                LEFT JOIN movies as m ON scr.movie_id = m.id
                WHERE scr.movie_id = '$movie_id'";
    return $mysqli->query($sql);
}

function get_published_movie_by_showdate($mysqli, $movie_id)
{
    $sql = "SELECT DISTINCT showdate FROM screenings as scr 
                LEFT JOIN showtimes as sh ON scr.showtime_id = sh.id 
                LEFT JOIN movies as m ON scr.movie_id = m.id
                WHERE scr.movie_id = '$movie_id'";
    return $mysqli->query($sql);
}

?>