<?php require_once('./layout/header.php') ?>
<?php
    if(isset($_SESSION['screening'])){
        $arr = $_SESSION['screening'];
        $showtime_id = $_GET['showtime_id'];
        $_SESSION['screening'] = ['movie_id' => $arr['movie_id'], 'cinema_id' => $arr['cinema_id'], 'showtime_id' => $showtime_id];
        // var_dump($_SESSION['screening']);
        $seat_row = get_seat_row_with_cinema_id($mysqli, $arr['cinema_id']);
        $seat_row_price = get_seat_row_with_cinema_id($mysqli, $arr['cinema_id']);
    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/seat.css">
</head>
<body>
    <div class="container movie">
        <!-- //prices get from input -->
        <div class="row ">
        <?php while($price = $seat_row_price->fetch_assoc()){ ?>
            <div class="col-2 d-flex justify-content-center my-2">
                <div class="btn btn-outline-dark">
                    <label><?= $price['row'] ?> - 
                    <?= $price['price'] ?>
                    ks</label>
                </div>
            </div>
        <?php } ?>
        </div>
        <!-- <div class="row screen"></div> -->
        <div class="seats">
           <?php while($row = $seat_row->fetch_assoc()){ ?>
            <?php $columns = get_seat_with_cinema_id($mysqli,$arr['cinema_id'],$row['row']) ?>
            <div class="row">
            <?php while($column = $columns->fetch_assoc()){ ?>
                <div class="col seat" data-value="<?= $column['id'] ?>"><?= $row['row'] ?><?= $column['column'] ?></div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>

        <div class="display"></div>
        <form class="showselectedseats" >
          Your selected seats: <span id="count">0</span>
          Total amount: <span id="total">0 </span>ks
        </form>
        <div>
            <button type="submit">Buy</button>
            <span id="text">Click to get your ticket!</span>
        </div>
        <div class="payment">
            <input type="file" id="photoInput" accept="image/*">
             <img id="preview" src="#" alt="Image Preview" style="display: none;"/>
             <button type="submit">Send</button>
        </div>

    </div>
</body>
<script src="../assets/js/seat.js"></script>
</html>