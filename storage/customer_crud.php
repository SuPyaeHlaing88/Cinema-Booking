<!-- $sql = "CREATE TABLE IF NOT EXISTS `customers`(
     `id` INT AUTO_INCREMENT,
     `name` VARCHAR(45) NOT NULL,
     `email` VARCHAR(95) UNIQUE NOT NULL,
     `phone` VARCHAR(50) NOT NULL,
     PRIMARY KEY(`id`))"; -->
     
<?php

function save_customer($mysqli, $name, $email, $phone,)
{
    try {
        $sql = "INSERT INTO `customers` (`name`,`email`,`phone`) VALUE ('$name','$email',$phone)";
        return $mysqli->query($sql);
    } catch (\Throwable $th) {
        if ($th->getCode() === 1062) {
            return "This email is alerady have been used!";
        } else {
            return "Internal server error!";
        }
    }

}

function get_customer_with_id($mysqli, $id)
{
    $sql = "SELECT * FROM `customers` WHERE `id`=$id";
    $user = $mysqli->query($sql);
    return $user->fetch_assoc();
}

function get_customer_with_email($mysqli, $email)
{
    $sql = "SELECT * FROM `customers` WHERE `email`='$email'";
    $user = $mysqli->query($sql);
    return $user->fetch_assoc();
}
function delete_customers($mysqli, $id)
{
    $sql = "DELETE FROM `customers` WHERE `id`= $id";
    return $mysqli->query($sql);
}

function update_customer($mysqli, $id, $name, $email, $phone)
{
    $sql = "UPDATE `customers` SET `name`='$name',`email`='$email',`phone`=$phone WHERE `id`= $id ";
    return $mysqli->query($sql);
}

