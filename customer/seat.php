

<?php require_once('./layout/header.php') ?>
<?php


    if(isset($_SESSION['screening'])){
        $arr = $_SESSION['screening'];
        $showtime_id = $_GET['showtime_id'];
        $_SESSION['screening'] = ['movie_id' => $arr['movie_id'], 'cinema_id' => $arr['cinema_id'], 'showtime_id' => $showtime_id];
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
    <div class="container mt-3 rounded-3 p-3 bg-dark text-light">
        
        <div class="row">
        <?php while($price = $seat_row_price->fetch_assoc()){ ?>
            <div class="col-2 d-flex justify-content-center my-2 text-light">
                <div class="btn btn-outline-light">
                    <label><?= $price['row'] ?> - 
                    <?= number_format($price['price']) ?>Ks</label>
                </div>
            </div>
        <?php } ?>
        </div>
        
        <div class="seats" style="cursor: pointer;">
           <?php while($row = $seat_row->fetch_assoc()){ 
                
            ?>
            <?php $columns = get_seat_with_cinema_id($mysqli,$arr['cinema_id'],$row['row']) ?>
            <div class="d-flex justify-content-center align-items-center gap-3">
            <?php while($column = $columns->fetch_assoc()){ ?>
                <a class="text-center w-50 my-2 p-3 text-light border border-light rounded <?= $status ?> text-decoration-none" data-value="<?=$column['id'] ?>"><?= $row['row'] ?><?= $column['column'] ?></a>
                <?php } ?>
            </div>
            <?php } ?>
        </div>

       
        <div class="mt-3">
            <button type="submit" class="btn btn-outline-light">Buy</button>
        </div>

    </div>
  

    <script src="../assets/js/seat.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let seats = $('.seats');
        seats.on("click",()=>{
            let seat_id = event.target.getAttribute('data-value');
            event.target.classList.contains('btn-outline-primary')
            event.target.classList.remove('btn-outline-primary');
            event.target.classList.add('btn-success');
            window.location.href = `./seat.php?showtime_id=<?= $showtime_id ?>&seat_id=${seat_id}`;
        })
    </script>
</body>



</html>