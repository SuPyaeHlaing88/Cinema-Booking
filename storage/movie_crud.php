<!-- $sql = "CREATE TABLE IF NOT EXISTS `movies` (
    `id` INT AUTO_INCREMENT, 
    `title` VARCHAR(50) NOT NULL, 
    `description` TEXT NOT NULL, 
    `genre` VARCHAR(50) NOT NULL, 
    `duration` VARCHAR(50) NOT NULL, 
    `poster` VARCHAR(225) NOT NULL, 
    PRIMARY KEY(`id`))"; -->

<?php
function save_movie($mysqli, $title, $description, $genre, $duration, $poster)
{
    $sql = "INSERT INTO `movies` (`title`,`description`,`genre`,`duration`,`poster`) VALUE ('$title','$description','$genre','$duration','$poster')";
    return $mysqli->query($sql);
}

function get_movies($mysqli)
{
    $sql = "SELECT * FROM `movies` ";
    return $mysqli->query($sql);
    // return $movie->fetch_assoc();
}

// get movie for schedule
// function get_movies_for_schedule($mysqli)
// {
//     $sql = "SELECT DISTINCT title FROM movies";
//     return $mysqli->query($sql);
// }
function get_movie_with_id($mysqli, $id)
{
    $sql = "SELECT * FROM `movies` WHERE `id`=$id";
    $movie = $mysqli->query($sql);
    return $movie->fetch_assoc();
}

function get_movie_with_genre($mysqli, $genre)
{
    $sql = "SELECT * FROM `movies` WHERE `genre`='$genre'";
    $movie = $mysqli->query($sql);
    return $movie->fetch_assoc();
}

function update_movies($mysqli, $id, $title, $description, $genre, $duration, $poster)
{
    $sql = "UPDATE `movies` SET `title`='$title',`description`='$description',`genre`='$genre',`duration`='$duration', `poster` = '$poster' WHERE `id`= $id ";
    return $mysqli->query($sql);
}

function delete_movies($mysqli, $id)
{
    $sql = "DELETE FROM `movies` WHERE `id`= $id";
    return $mysqli->query($sql);
}
