<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

<?php
$selected_cinema = $selected_cinemaErr = "";
$selected_seat = $selected_seatErr = "";
$seatType = $seatType_Err = "";
$price = $priceErr = "";
$invalid = $alert = "";

// for new item 
if (isset($_POST['selected_cinema'])) {
    $selected_cinema = $_POST['selected_cinema'];
    $selected_seat = $_POST['selected_seat'];
    $seatType = $_POST['seatType'];
    $price = $_POST['price'];

    if (trim($selected_cinema) === "") {
        $selected_cinemaErr = "Can't be blank!";
        $invalid = "err";
    }

    if (trim($selected_seat) === "") {
        $selected_seatErr = "Can't be blank!";
        $invalid = "err";
    }

    if (trim($seatType) === "") {
        $seatTypeErr = "Can't be blank!";
        $invalid = "err";
    }

    if (trim($price) === "") {
        $priceErr = "Can't be blank!";
        $invalid = "err";
    }
    if (!$invalid) {
        // check for already save
        $result = get_CHS_with_cinema_and_seat($mysqli, $selected_cinema, $selected_seat);
        if ($result) {
            $alert = "This seat already exists.";
        } else {
            // to save new seat 
            $status = save_cinema_has_seat($mysqli, $selected_cinema, $selected_seat, $seatType, $price);
            if ($status === true) {
                echo "<script>location.replace('../pages/cinema_has_seats.php')</script>";
            } else {
                $invalid = $status;
            }
        }
    }
}
?>


<div class="container-fluid page-body-wrapper">
    <?php require_once("../layouts/sidebar.php") ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <!-- for link with cinemas -->
            <div class="page- absolute">
                <?php
                if (isset($_GET['name'])) {
                    $name = $_GET['name'];
                    var_dump($name);
                } { ?>
                    <h3 class="page-title"> Cinema has Seats</h3>

                <?php } ?>
            </div>
            <!-- to update seats into above cinema -->
            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Select</h4>
                            <p class="card-description"> Add classes like <code>.form-select-lg</code> and <code>.form-select-sm</code>. </p>

                            <?php if ($invalid !== "" && $invalid !== "err") { ?>
                                <div class="alert alert-danger"><?= $invalid ?></div>
                            <?php } else if ($alert !== "") { ?>
                                <div class="alert alert-danger"><?= $alert ?></div>
                            <?php } ?>

                            <form class="forms-sample" method="POST">
                                <div class="form-group">
                                    <label for="cinema">Cinema</label>
                                    <select class="form-select" id="cinema" name="selected_cinema">
                                        <?php $cinemas = get_cinemas($mysqli);
                                        while ($cinema = $cinemas->fetch_assoc()) { ?>
                                            <option value="<?= $cinema['id']; ?>">
                                                <?= $cinema['name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <div class="validation-message"><?= $selected_cinemaErr ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="seat">Seat</label>
                                    <select class="form-select form-select-sm" id="seat" name="selected_seat">
                                        <?php $seats = get_all_seats($mysqli);
                                        while ($seat = $seats->fetch_assoc()) { ?>
                                            <option value="<?= $seat['id']; ?>">
                                                <?= $seat['row'] . "/" . $seat['column']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <div class="validation-message"><?= $selected_seatErr ?></div>
                                </div>

                                <div class="form-group">
                                    <label for="seatType">Seat Type</label>
                                    <select class="form-select form-select-sm" id="seatType" name="seatType">
                                        <option <?php if ($seatType === "1") {
                                                    echo "selected";
                                                } ?> value="1">Single</option>
                                        <option <?php if ($seatType === "2") {
                                                    echo "selected";
                                                } ?> value="2">Couple</option>
                                    </select>
                                    <div class="validation-message"><?= $seatType_Err ?></div>
                                </div>

                                <div class="form-group ">
                                    <label for="price">Price</label>
                                    <div class="input-group mb-3">
                                        <input type="number" id="price" class="form-control form-control-sm" name="price" placeholder="Enter Price" aria-label="price" value="<?= $price ?>">
                                        <span class="input-group-text">mmk</span>
                                    </div>
                                    <div class="validation-message"><?= $priceErr ?></div>
                                </div>

                                <div class="form-group my-3">
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="px-lg-3">
                    <h2 class="bg-danger text-center">Lists of Cinemas' seats</h2>
                </div>
                <!-- to get cinema  -->
                <?php
                $cinemas = get_cinemas($mysqli);
                while ($cinema = $cinemas->fetch_assoc()) { ?>
                    <h4 class="text-success">
                        <?= $cinema['name'] ?>
                    </h4>

                    <div class="col-lg-12 grid-margin stretch-card">
                        <table>
                            <tbody>
                                <?php
                                $ROWS = get_CHS_by_row($mysqli, $cinema['id']);
                                while ($row = $ROWS->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <th class="text-primary">
                                            <?= $row['price'] ?>
                                        </th>
                                        <td></td>
                                        <?php
                                        $seatsAtCinemas = get_CHS_with_cinema_id($mysqli, $cinema['id'], $row['row']);
                                        while ($seatsAtCinema = $seatsAtCinemas->fetch_assoc()) {
                                        ?>
                                            <td>
                                                <?=
                                                $seatsAtCinema['row'] . $seatsAtCinema['column'] ?>
                                            </td>
                                        <?php } ?>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <strong>
                        <label class="badge badge-gradient-danger">Delete</label>
                    </strong>
                    <div><br></div>
                    <hr>
                <?php } ?>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->

        <?php require_once("../layouts/footer.php") ?>