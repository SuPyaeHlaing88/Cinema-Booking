<!-- 
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
     FOREIGN KEY(`customer_id`)  REFERENCES `customers`(`id`))";
-->

<?php
    function save_bookings($mysqli,$total_amount,$booking_time,$method,$status,$screening_id,$customer_id){
        $sql = "INSERT INTO `bookings`(`total_amount`,`booking_time`,`method`,`status`,`screening_id`,`customer_id`) VALUES ('$total_amount','$booking_time','$method','$status','$screening_id','$customer_id')";
        return $mysqli->query($sql);
    }

    function get_all_bookings($mysqli){
    $sql = "SELECT * FROM `bookings`";
    return $mysqli->query($sql);
    } 

    function get_booking_with_id($mysqli,$id){
    $sql = "SELECT * FROM `bookings` WHERE `id` = $id ";
    $booking =  $mysqli->query($sql);
    return $booking->fetch_assoc();
    } 

    function get_booking_with_screening_id($mysqli,$screening_id){
        $sql= "SELECT * from bookings bk LEFT JOIN screenings src on bk.screening_id = src.id WHERE bk.screening_id = $screening_id";
        return $mysqli->query($sql);
    }

    function get_screenings_with_customer_id($mysqli,$customer_id){
        $sql= "SELECT * from bookings bk LEFT JOIN customers c on bk.customer_id = c.id WHERE bk.customer_id = $customer_id";
        return $mysqli->query($sql);
    }

    function update_booking($mysqli,$id,$total_amount,$booking_time,$method,$status,$screening_id,$customer_id){
        $sql = "UPDATE `bookings`  SET `total_amount` ='$total_amount',`booking_time`='$booking_time', `method` = '$method', `status` = $status, `screening_id` = '$screening_id',`customer_id` = '$customer_id'  WHERE `id` = $id"; 
        return  $mysqli->query($sql);
    }
    function delete_booking($mysqli,$id){
        $sql = "DELETE FROM `bookings` WHERE `id` = $id";
        return $mysqli->query($sql);
    }

    function count_bookings($mysqli){
        $sql = "SELECT COUNT(`id`) as number_of_bookings FROM `bookings`";
        return $mysqli->query($sql);
    }

    
    // function get_unique_name($mysqli,$batch_name){
    //     $sql = "SELECT batch_name FROM `batch` WHERE batch_name LIKE '%$batch_name%'";
    //     $student_batch_id =  $mysqli->query($sql);
    //     return $student_batch_id->fetch_assoc();
    // }
    // function search_batch_with_class_teacher($mysqli,$search){
    //     $sql =  "SELECT batch.*, class.class_name as CLASS_NAME, teacher.teacher_name as TEACHER_NAME FROM `batch` join class on batch.class_id = class.class_id join teacher on batch.teacher_id = teacher.teacher_id WHERE batch_name LIKE '%$search%' OR teacher_name LIKE '%$search%' OR class_name LIKE '%$search%' OR fees LIKE '%$search%' OR start_date LIKE '%$search%' OR end_date LIKE '%$search%'";
    //     return $mysqli->query($sql);
    //    }