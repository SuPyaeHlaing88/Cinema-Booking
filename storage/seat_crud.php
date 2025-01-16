<!-- 
 $sql = "CREATE TABLE IF NOT EXISTS `seats` (
    `id` INT AUTO_INCREMENT, 
    `row` VARCHAR(25) NOT NULL,
    `column` INT NOT NULL,
     `NO.` CHAR NOT NULL,
    PRIMARY KEY(`id`)
    )";
    if (!$mysqli->query($sql)) {
        return false;
    } 
        
-->
<?php

function save_seat($mysqli, $row, $column)
{
    try {
        $sql = "INSERT INTO `seats` (`row`,`column`) VALUE ('$row',$column)";
        return $mysqli->query($sql);
    } catch (\Throwable $th) {
        if ($th->getCode() === 1062) {
            return "This row is alerady have been used!";
        } else {
            return "Internal server error!";
        }
    }
}



function get_all_rows($mysqli)
{
    $sql = "SELECT DISTINCT row FROM `seats`";
    return $mysqli->query($sql);
}

function get_all_seats($mysqli)
{
    $sql = "SELECT * FROM `seats` ORDER BY `row`, `column`";
    return $mysqli->query($sql);
}
function get_seat_with_row($mysqli, $row)
{
    $sql = "SELECT * FROM `seats` WHERE `row`=$row";
    $seat = $mysqli->query($sql);
    return $seat->fetch_assoc();
}

function get_seat_with_row_and_column($mysqli, $row, $column)
{
    $sql = "SELECT * FROM `seats` WHERE `row`='$row' and `column`= '$column'";
    $seat = $mysqli->query($sql);
    return $seat->fetch_assoc();
}

function delete_seats($mysqli, $id)
{
    $sql = "DELETE FROM `seats` WHERE `id`= $id";
    return $mysqli->query($sql);
}

function update_seat($mysqli, $id, $row, $column)
{
    $sql = "UPDATE `seats` SET `row`='$row',`column`=$column WHERE `id`= $id ";
    return $mysqli->query($sql);
}

function seat_count($mysqli, $row)
{
    $sql = "SELECT count(`id`) as qty FROM `seats` WHERE row = '$row'";
    return $mysqli->query($sql)->fetch_assoc();
}
