<!-- $sql = "CREATE TABLE IF NOT EXISTS `users`(
    `id` INT AUTO_INCREMENT,
    `username` VARCHAR(45) NOT NULL,
    `email` VARCHAR(95) UNIQUE NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `role` ENUM('admin', 'casher', 'staff') NOT NULL, 
    `profile` VARCHAR(225) NOT NULL ,
    PRIMARY KEY(`id`)
    )"; -->

<?php

function save_user($mysqli, $username, $email, $password, $role, $profile)
{
    $sql = "INSERT INTO `users` (`username`,`email`,`password`,`role`,`profile`) VALUE ('$username','$email','$password',$role,'$profile')";
    return $mysqli->query($sql);
}

function get_users($mysqli)
{
    $sql = "SELECT * FROM `users`";
    return $mysqli->query($sql);
}

function get_user_with_id($mysqli, $id)
{
    $sql = "SELECT * FROM `users` WHERE `id`=$id";
    $user = $mysqli->query($sql);
    return $user->fetch_assoc();
}

function get_user_with_email($mysqli, $email)
{
    $sql = "SELECT * FROM `users` WHERE `email`='$email'";
    $user = $mysqli->query($sql);
    return $user->fetch_assoc();
}
function delete_users($mysqli, $id)
{
    $sql = "DELETE FROM `users` WHERE `id`= $id";
    return $mysqli->query($sql);
}

function update_users($mysqli, $id, $username, $email, $password, $role)
{
    $sql = "UPDATE `users` SET `username`='$username',`email`='$email',`password`='$password',`role`=$role WHERE `id`= $id ";
    return $mysqli->query($sql);
}

function have_admin($mysqli)
{
    $sql = "SELECT COUNT(`id`) as total FROM `users` WHERE `role`=1";
    $total = $mysqli->query($sql);
    $total = $total->fetch_assoc();
    if ($total['total'] > 0) {
        return false;
    }
    return true;
}
