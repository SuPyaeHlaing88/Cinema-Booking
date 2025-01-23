<?php require_once("../layouts/header.php") ?>
<?php require_once("../layouts/navbar.php") ?>

<div class="container-fluid page-body-wrapper">
    <?php require_once("../layouts/sidebar.php") ?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header bg-secondary p-2">
                <h2 class="page-title text-warning align-content-center"> Booking Tickets </h2>
            </div>

            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h4 class="card-title mx-5 default" style="display: inline;">Weekly Tickets</h4>
                                <h4 class="card-title mx-5" style="display: inline;">Monthly Tickets</h4>
                                <h4 class="card-title mx-5" style="display: inline;">Yearly Tickets</h4>

                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> booking ID </th>
                                            <th> booking time </th>
                                            <th> Customer </th>
                                            <th> Cinema </th>
                                            <th> Movie </th>
                                            <th> Seats </th>
                                            <th> total amout </th>
                                            <th> Method </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- loop latest 5 tikets -->
                                        <tr>
                                            <td> WD-12345 </td>
                                            <td> Dec 5, 2017 </td>
                                            <td> customer name </td>
                                            <td> cinema name </td>
                                            <td> movie tilte</td>
                                            <td>
                                                <label class="badge badge-gradient-success">A1</label>
                                                <label class="badge badge-gradient-success">A2</label>
                                            </td>
                                            <td> 12,000 MMk </td>
                                            <td>
                                                <label class="badge badge-gradient-primary">KPay</label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- content-wrapper ends -->
        <?php require_once("../layouts/footer.php") ?>