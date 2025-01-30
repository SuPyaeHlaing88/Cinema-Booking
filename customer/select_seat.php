<?php require_once('./layout/header.php') ?>

<?php
if (isset($_GET['showtime_id'])) {
    // $arr = $_SESSION['screening'];
    $movie_id = $_GET['movie_id'];
    $cinema_id = $_GET['cinema_id'];
    $showtime_id = $_GET['showtime_id'];
    $_SESSION['screening'] = ['movie_id' => $movie_id, 'cinema_id' => $cinema_id, 'showtime_id' => $showtime_id];

    $screening = get_screening_with_ids($mysqli, $movie_id, $cinema_id, $showtime_id);
}

// if (isset($_GET['screening_id'])) {
//     $screening_id = $_GET['screening_id'];
//     $screening = get_screening_with_id($mysqli, $screening_id);
//     die(var_dump($screening));
// }

?>
<div class="container seat_secton">
    <div class="nav bg-gradient-primary  text-secondary-emphasis align-content-center px-5 py-2">
        <span class="mx-5"><?= "Movie >> " . $screening['title'] ?></span>
        <span class="mx-5"><?= "Cinema >> " . $screening['name'] ?></span>
        <span class="mx-5"><?= "Show >> " . $screening['showdate'] . "/" . $screening['showtime'] ?></span>
    </div>
    <div class="row">
        <?php
        $seat_row = get_seat_row_with_cinema_id($mysqli, $screening['cinema_id']);
        while ($row = $seat_row->fetch_assoc()) {

        ?>
            <div class="col-2 d-flex justify-content-center my-2">
                <div class="btn btn-outline-dark">
                    <label>
                        <span id="row" value="<?= $row['row'] ?>"> <?= $row['row'] ?></span>
                        -
                        <span id="price" value="<?= $row['price'] ?>"> <?= $row['price'] ?></span>
                        ks
                    </label>
                </div>
            </div>
        <?php } ?>

    </div>
    <!-- SEAT BUTTONS  -->
    <div class="seats">
        <?php
        $seat_row = get_seat_row_with_cinema_id($mysqli, $screening['cinema_id']);
        while ($Row = $seat_row->fetch_assoc()) {
        ?>
            <?php $columns = get_seat_with_cinema_id($mysqli, $screening['cinema_id'], $Row['row']) ?>
            <div class="row">
                <?php while ($column = $columns->fetch_assoc()) { ?>
                    <div class="col seat" data-value="<?= $column['id'] ?>"><?= $Row['row'] ?><?= $column['column'] ?></div>
                <?php } ?>
            </div>
        <?php } ?>

    </div>

    <div class="display"></div>
    <form class="showselectedseats">
        Your selected seats: <span id="count">0</span>
        Total amount: <span id="total">0 </span>ks
    </form>
    <div>
        <button type="submit">Buy</button>
        <span id="text">Click to get your ticket!</span>
    </div>
</div>
<!-- for header -->
</div>
<?php require_once('./layout/footer.php') ?>