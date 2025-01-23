<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

<div class="container-fluid page-body-wrapper">
    <?php require_once("../layouts/sidebar.php") ?>

    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">
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
                    <strong class="text-danger"><?= $cinema['location'] ?></strong>
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
                    <hr>
                <?php } ?>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->

        <?php require_once("../layouts/footer.php") ?>