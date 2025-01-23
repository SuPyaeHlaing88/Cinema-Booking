<!-- 
 $sql = "CREATE TABLE IF NOT EXISTS `cinema_has_seats` (
    `id` INT AUTO_INCREMENT, 
    `cinema_id` INT NOT NULL, 
    `seat_id` INT NOT NULL, 
    `seatType` CHAR NOT NULL, 
    `price` DECIMAL(10,2) NOT NULL, 
    `status` ENUM('aviable', 'sold'), 
    PRIMARY KEY(`id`), FOREIGN KEY(`cinema_id`)  REFERENCES `cinemas`(`id`), 
    FOREIGN KEY(`seat_id`)  REFERENCES `seats`(`id`)
    )";
    if (!$mysqli->query($sql)) {
        return false;
    } 
-->
<?php
function save_cinema_has_seat($mysqli, $cinema_id, $seat_id, $seatType, $price)
{
    $sql = "INSERT INTO `cinema_has_seats`(`cinema_id`,`seat_id`,`seatType`, `price`) VALUES ('$cinema_id','$seat_id', '$seatType', '$price')";
    return $mysqli->query($sql);
}
// to check already save
function get_CHS_with_cinema_and_seat($mysqli, $cinema_id, $seat_id)
{
    $sql = "SELECT * FROM `cinema_has_seats` WHERE `cinema_id` = '$cinema_id' AND `seat_id` = '$seat_id' ";
    $seat = $mysqli->query($sql);
    return $seat->fetch_assoc();
}

// to show count of row
function get_CHS_by_row($mysqli, $cinema_id)
{
    $sql = "SELECT distinct row, price FROM `cinema_has_seats` as chs
            LEFT JOIN seats on  seats.id = chs.seat_id
          WHERE chs.`cinema_id` = $cinema_id ";
    return $mysqli->query($sql);
}

// to get seats of each cinema
function get_CHS_with_cinema_id($mysqli, $cinema_id, $row)
{
    $sql = "SELECT * FROM `cinema_has_seats` as chs
            LEFT JOIN seats on  seats.id = chs.seat_id
            WHERE chs.`cinema_id` = $cinema_id AND seats.`row`= '$row'";
    return $mysqli->query($sql);
}


function update_cinema_has_seats($mysqli, $id, $cinema_id, $seat_id, $seatType, $price, $status)
{
    $sql = "UPDATE `cinema_has_seats`  SET `cinema_id` = '$cinema_id',`seat_id` = '$seat_id',`seatType` = '$seatType', `price`= $price, `status` = $status  WHERE `id` = $id";
    return  $mysqli->query($sql);
}

function delete_booking($mysqli, $id)
{
    $sql = "DELETE FROM `cinema_has_seats` WHERE `id` = $id";
    return $mysqli->query($sql);
}

function get_seat_with_cinema_id($mysqli, $cinema_id,$row)
{
    $sql = "SELECT * FROM `cinema_has_seats` INNER JOIN seats ON seats.id = cinema_has_seats.seat_id  WHERE cinema_has_seats.cinema_id = $cinema_id AND seats.row='$row' ORDER by seats.column";
    return $mysqli->query($sql);
}


function get_seat_row_with_cinema_id($mysqli, $cinema_id)
{
    $sql = "SELECT DISTINCT seats.row,cinema_has_seats.price FROM `cinema_has_seats` INNER JOIN seats ON seats.id = cinema_has_seats.seat_id  WHERE cinema_has_seats.cinema_id = $cinema_id ORDER by seats.row";
    return $mysqli->query($sql);
}