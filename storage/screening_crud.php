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
    $sql = "SELECT * FROM `screenings` as scr 
                LEFT JOIN cinemas ON scr.cinema_id = cinemas.id 
                LEFT JOIN movies ON movies.id = scr.movie_id
                LEFT JOIN showtimes ON showtimes.id = scr.showtime_id
                order by scr.`id` DESC";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
}

function get_screening_with_ids($mysqli, $movie_id, $cinema_id, $showtime_id)
{
    $sql = "SELECT * FROM `screenings`as scr 
                LEFT JOIN cinemas ON scr.cinema_id = cinemas.id 
                LEFT JOIN movies ON movies.id = scr.movie_id
                LEFT JOIN showtimes ON showtimes.id = scr.showtime_id 
                WHERE scr.`movie_id` = $movie_id AND scr.`cinema_id` = $cinema_id AND scr.`showtime_id` = $showtime_id";
    $result = $mysqli->query($sql);
    return $result->fetch_assoc();
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
function get_screenings_with_showdate($mysqli, $showdate)
{
    $sql = "SELECT * FROM screenings as scr 
                LEFT JOIN movies ON movies.id = scr.movie_id
                LEFT JOIN cinemas ON cinemas.id = scr.cinema_id
                LEFT JOIN showtimes ON showtimes.id = scr.showtime_id
                WHERE showtimes.showdate = '$showdate'";
    return $mysqli->query($sql);
}
function get_screenings_with_showdate_for_time($mysqli, $showtime)
{
    $sql = "SELECT DISTINCT showtime FROM screenings as scr 
                LEFT JOIN movies ON movies.id = scr.movie_id
                LEFT JOIN cinemas ON cinemas.id = scr.cinema_id
                LEFT JOIN showtimes ON showtimes.id = scr.showtime_id
                WHERE showtimes.showtime = '$showtime'";
    return $mysqli->query($sql);
}

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
// function get_screening_with_cinema_and_showtime($mysqli, $cinema_id, $showtime_id)
// {
//     $sql = "SELECT * FROM `screenings`
//             LEFT JOIN showtimes ON showtimes.id = screenings.showtime_id
//             WHERE `cinema_id` = '$cinema_id' AND `showtime_id` = '$showtime_id' ";
//     // $sql = "select screenings.* from screenings where screenings.cinema_id = $cinema_id";
//     $result = $mysqli->query($sql);
//     return $result->fetch_assoc();
// }
// shit shift
// function get_screening_with_selected_cinema_and_selected_showdate($mysqli, $selected_cinema, $selected_showdate)
// {
//     $sql = "SELECT * FROM `screenings`
//             LEFT JOIN showtimes ON showtimes.id = screenings.showtime_id
//             LEFT JOIN cinemas ON cinemas.id = screenings.cinema_id
//             LEFT JOIN movies ON movies.id = screenings.movie_id
//             WHERE screenings.`cinema_id` = $selected_cinema AND showtimes.`showdate` = '$selected_showdate'";
//     return $mysqli->query($sql);
// }

// function get_closed_showtimes($mysqli, $selected_showdate, $starttime, $endtime)
// {
//     $sql = "SELECT * FROM showtimes 
//             WHERE showtimes.`showtime`  BETWEEN '$starttime' AND '$endtime'
//             AND showtimes.`showdate` = '$selected_showdate'";
//     return $mysqli->query($sql)->fetch_assoc();
// }

// function get_screening_with_movie_duration($mysqli, $movie_id)
// {
//     $sql = "SELECT * FROM `screenings`  as src 
//                 LEFT JOIN movies ON movies.id = src.movie_id 
//                 LEFT JOIN showtimes ON showtimes.id = src.showtime_id
//                 WHERE src.`movie_id` = '$movie_id'";
//     return $mysqli->query($sql)->fetch_assoc();
// }

//    for screening_showtime_gap
// function get_gap_between_screening_schedules($mysqli,  $showdate)
// {
//     $sql = "SELECT showtime FROM `showtimes` 
//             WHERE showtimes.`showdate` = '$showdate' ";
//     return $mysqli->query($sql)->fetch_assoc();
// }
// for screening duration gap 
// function get_movie_duration($mysqli, $selected_movie)
// {
//     $sql = "SELECT duration FROM `movies` 
//             WHERE movies.`id` = '$selected_movie' ";
//     return $mysqli->query($sql)->fetch_assoc();
// }


// for movie schedules 
function get_nowshowing_movie_schedule($mysqli, $movie_id)
{
    $sql = "SELECT * FROM screenings as scr 
                LEFT JOIN movies ON movies.id = scr.movie_id
                LEFT JOIN cinemas ON cinemas.id = scr.cinema_id
                LEFT JOIN showtimes ON showtimes.id = scr.showtime_id
                WHERE scr.movie_id = '$movie_id' 
                AND showtimes.showdate >= DATE_SUB(CURDATE(), INTERVAL 2 DAY) 
                AND showtimes.showdate <= DATE_ADD(CURDATE(), INTERVAL 2 DAY)";
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
    $sql = "SELECT * FROM screenings as scr 
                LEFT JOIN movies ON movies.id = scr.movie_id
                LEFT JOIN showtimes ON showtimes.id = scr.showtime_id
                WHERE scr.movie_id = '$movie_id' 
                AND showtimes.showdate > DATE_ADD(CURDATE(), INTERVAL 2 DAY)";
    return $mysqli->query($sql);
}

function get_all_for_show($mysqli, $movie_id, $cinema_id)
{
    //     $sql = "SELECT `movies`.`title`,`movies`.`genre`,`movies`.`duration`, `movies`.`poster`, `movies`.`id` AS `movie_id`,
    // `showtimes`.`showdate` AS `show_date`,  `showtimes`.`showtime` AS `show_time`, `movies`.`poster`
    // FROM `screenings` INNER JOIN `movies` ON `movies`.`id` = `screenings`.`movie_id` 
    // INNER JOIN `showtimes` ON `showtimes`.`id` = `screenings`.`showtime_id` 
    // INNER JOIN `cinemas` ON `cinemas`.`id` = `screenings`.`cinema_id` 
    // WHERE `showtimes`.`showdate` BETWEEN CURRENT_DATE  AND DATE_ADD(CURRENT_DATE, INTERVAL 3 DAY)";

    $sql = "SELECT * FROM screenings as scr 
                LEFT JOIN showtimes as sh ON scr.showtime_id = sh.id 
                LEFT JOIN movies as m ON scr.movie_id = m.id
                LEFT JOIN cinemas as s ON scr.cinema_id = s.id
                WHERE scr.movie_id = '$movie_id' and  scr .cinema_id = '$cinema_id' AND sh.showdate > CURDATE()";
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
                AND showtimes.showdate < DATE_SUB(CURDATE(), INTERVAL 2 DAY) ";
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


function get_cinemas_with_movies_id($mysqli, $movie_id)
{
    $sql = "SELECT  DISTINCT cinemas.* FROM `screenings` LEFT JOIN cinemas ON 
screenings.cinema_id = cinemas.id WHERE screenings.movie_id = $movie_id;
";
    return $mysqli->query($sql);
}
function get_showtime_data_with_movie_id_and_cinema_id($mysqli, $cinema_id, $movie_id)
{
    $sql = "SELECT `showtimes`.`showdate`,`showtimes`.`showtime`,`showtimes`.`id` FROM `screenings` 
    INNER JOIN `showtimes` ON `screenings`.`showtime_id`= `showtimes`.`id` 
    WHERE `screenings`.`movie_id` = '$movie_id' AND `screenings`.`cinema_id` = '$cinema_id'";
    return $mysqli->query($sql);
}


?>