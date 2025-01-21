<?php

function save_showtime($mysqli, $showdate, $showtime)
{
    $sql = "INSERT INTO `showtimes` (`showdate`,`showtime`) VALUE ('$showdate','$showtime')";
    return $mysqli->query($sql);
}

function get_showtime_for_all($mysqli)
{
    $sql = "SELECT * FROM `showtimes` ORDER BY `showdate` DESC,`showtime` DESC";
    return $mysqli->query($sql);
}

function get_showtime_for_time($mysqli, $showdate)
{
    $sql = "SELECT * FROM `showtimes` WHERE `showdate`= '$showdate' ORDER BY `showtime` ASC";
    return $mysqli->query($sql);
}

function get_showtime_just_showdate($mysqli)
{
    $sql = "SELECT DISTINCT showdate FROM `showtimes` ORDER BY `showdate` DESC";
    return $mysqli->query($sql);
}

function get_showtime_with_showdate($mysqli, $showdate)
{
    $sql = "SELECT * FROM `showtimes` WHERE `showdate`= '$showdate' order by `showtime`";
    return $mysqli->query($sql);
}

function get_showtime_with_date_and_time($mysqli, $showdate, $showtime)
{
    $sql = "SELECT * FROM `showtimes` WHERE `showdate`= '$showdate' AND `showtime`= '$showtime' ";
    $showtime =  $mysqli->query($sql);
    return $showtime->fetch_assoc();
}

function get_showtime_with_id($mysqli, $id)
{
    $sql = "SELECT * FROM `showtimes` WHERE `id`=$id";
    $showtime = $mysqli->query($sql);
    return $showtime->fetch_assoc();
}

function update_showtimes($mysqli, $id, $showdate, $showtime)
{
    $sql = "UPDATE `showtimes` SET `showdate`='$showdate',`showtime`='$showtime' WHERE `id`= $id ";
    return $mysqli->query($sql);
}

function delete_showtimes($mysqli, $id)
{
    $sql = "DELETE FROM `showtimes` WHERE `id`= $id";
    return $mysqli->query($sql);
}
