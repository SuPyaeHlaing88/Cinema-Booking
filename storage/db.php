<?php

try {
    $mysqli = new mysqli("127.0.0.10", "root", "");
    $sql = "CREATE DATABASE IF NOT EXISTS `cinema`";
    if ($mysqli->query($sql)) {
        if ($mysqli->select_db("cinema")) {
            create_tables($mysqli);
        }
    }
} catch (\Throwable $th) {
    echo $th . "Can not connect to Database!";
    die();
}
function create_tables($mysqli)
{
    // USERS
    $sql = "CREATE TABLE IF NOT EXISTS `users`(
    `id` INT AUTO_INCREMENT,
    `username` VARCHAR(45) NOT NULL,
    `email` VARCHAR(95) UNIQUE NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `role` ENUM('admin', 'cashier') NOT NULL, 
    `profile` VARCHAR(225) NOT NULL ,PRIMARY KEY(`id`)
    )";
    if (!$mysqli->query($sql)) {
        return false;
    }

    // COUSTOMERS `profile` VARCHAR(225) DEFAULT NULL , `password` VARCHAR(100) NOT NULL,
    $sql = "CREATE TABLE IF NOT EXISTS `customers`(
    `id` INT AUTO_INCREMENT,
    `name` VARCHAR(45) NOT NULL,
    `email` VARCHAR(95) UNIQUE NOT NULL,
    `phone` VARCHAR(50) NOT NULL,
    PRIMARY KEY(`id`)
    )";
    if (!$mysqli->query($sql)) {
        return false;
    }
    // MOVIES 
    $sql = "CREATE TABLE IF NOT EXISTS `movies` (
    `id` INT AUTO_INCREMENT, 
    `title` VARCHAR(50) NOT NULL, 
    `description` LONGTEXT NOT NULL, 
    `genre` VARCHAR(50) NOT NULL, 
    `duration` VARCHAR(50) NOT NULL, 
    `poster` VARCHAR(225) NOT NULL, 
    PRIMARY KEY(`id`)
    )";
    if (!$mysqli->query($sql)) {
        return false;
    }

    // CINEMAS 
    $sql = "CREATE TABLE IF NOT EXISTS `cinemas` (
    `id` INT AUTO_INCREMENT, 
    `name` VARCHAR(50) NOT NULL, 
    `location` VARCHAR(255) NOT NULL, 
    PRIMARY KEY(`id`)
    )";
    if (!$mysqli->query($sql)) {
        return false;
    }

    // SEATS 
    $sql = "CREATE TABLE IF NOT EXISTS `seats` (
    `id` INT AUTO_INCREMENT, 
    `row` VARCHAR(25) NOT NULL,
    `column` INT NOT NULL, 
    PRIMARY KEY(`id`)
    )";
    if (!$mysqli->query($sql)) {
        return false;
    }

    // CINEMA_SEATS
    $sql = "CREATE TABLE IF NOT EXISTS `cinema_has_seats` (
    `id` INT AUTO_INCREMENT, 
    `cinema_id` INT NOT NULL, 
    `seat_id` INT NOT NULL, 
    `seatType` ENUM('Single', 'Couple') NOT NULL, 
    `price` DECIMAL(10,2) NOT NULL, 
    `status` INT DEFAULT 0 NOT NULL, 
    PRIMARY KEY(`id`),
    FOREIGN KEY(`cinema_id`)  REFERENCES `cinemas`(`id`), 
    FOREIGN KEY(`seat_id`)  REFERENCES `seats`(`id`)
    )";
    if (!$mysqli->query($sql)) {
        return false;
    }

    // SHOWTIMES 
    $sql = "CREATE TABLE IF NOT EXISTS `showtimes` (
    `id` INT AUTO_INCREMENT, `showdate` DATE NOT NULL, 
    `showtime` TIME NOT NULL, PRIMARY KEY(`id`)
    )";
    if (!$mysqli->query($sql)) {
        return false;
    }



    // SCREENINGS 
    // `seat_id` INT NOT NULL , `showdate_id` INT NOT NULL, FOREIGN KEY(`seat_id`)  REFERENCES `seats`(`id`), FOREIGN KEY(`showdate_id`)  REFERENCES `showdates`(`id`)

    $sql = "CREATE TABLE IF NOT EXISTS `screenings` (
    `id` INT AUTO_INCREMENT, 
    `movie_id` INT NOT NULL , 
    `cinema_id` INT NOT NULL, 
    `showtime_id` INT NOT NULL,  
    PRIMARY KEY(`id`), 
    FOREIGN KEY(`movie_id`)  REFERENCES `movies`(`id`), 
    FOREIGN KEY(`cinema_id`)  REFERENCES `cinemas`(`id`),
    FOREIGN KEY(`showtime_id`)  REFERENCES `showtimes`(`id`)
    )";
    if (!$mysqli->query($sql)) {
        return false;
    }

    // BOOKINGS 
    $sql = "CREATE TABLE IF NOT EXISTS `bookings` (
     `id` INT AUTO_INCREMENT,
     `booking_time` TIMESTAMP, 
     `total_amount` INT NOT NULL, 
     `method` ENUM('KPAY', 'WAVE', 'CASH') NOT NULL, 
     `status` ENUM('pending', 'confirmed', 'cancelled') NOT NULL, 
     `screening_id` INT NOT NULL, 
     `customer_id` INT NOT NULL, 
     PRIMARY KEY(`id`), 
     FOREIGN KEY(`screening_id`)  REFERENCES `screenings`(`id`), 
     FOREIGN KEY(`customer_id`)  REFERENCES `customers`(`id`)
     )";

    if (!$mysqli->query($sql)) {
        return false;
    }

    return true;
}
