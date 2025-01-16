<!-- 
 $sql = "CREATE TABLE IF NOT EXISTS `cinemas` (
    `id` INT AUTO_INCREMENT, 
    `name` VARCHAR(50) NOT NULL, 
    `location` VARCHAR(255) NOT NULL, 
    PRIMARY KEY(`id`))";
  -->

<?php  

function save_cinema($mysqli, $name, $location)
{
    $sql = "INSERT INTO `cinemas` (`name`,`location`) VALUE ('$name','$location')";
    return $mysqli->query($sql);
}

function get_cinemas($mysqli) {
    $sql= "SELECT * FROM `cinemas`";
    return $mysqli->query($sql);
}

function get_cinema_with_id($mysqli, $id)
{
    $sql = "SELECT * FROM `cinemas` WHERE `id`=$id";
    $cinema = $mysqli->query($sql);
    return $cinema->fetch_assoc();
}

function get_cinema_with_location($mysqli, $location)
{
    $sql = "SELECT * FROM `cinemas` WHERE `location`='$location'";
    $cinema = $mysqli->query($sql);
    return $cinema->fetch_assoc();
}

function update_cinema($mysqli, $id, $name, $location)
{
    $sql = "UPDATE `cinemas` SET `name`='$name',`location`='$location' WHERE `id`= $id ";
    return $mysqli->query($sql);
}

function delete_cinemas($mysqli, $id)
{
    $sql = "DELETE FROM `cinemas` WHERE `id`= $id";
    return $mysqli->query($sql);
}