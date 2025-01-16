<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/seat.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="mystyle.css"> -->
</head>
<body>
    <div class="container movie">
        <!-- //prices get from input -->
        <div class="row price">
            <div class="col seatSample"><label>A - <span id="seatAprice" value="5000">5000</span>ks</label></div>
            <div class="col seatSample"><label>B - <span id="seatBprice" value="6000">6000</span>ks<label></div>
            <div class="col seatSample"><label>C - <span id="seatCprice" value="7000">7000</span>ks<label></div>
            <div class="col seatSample"><label>D - <span id="seatDprice" value="8500">8500</span>ks<label></div>
            <div class="col seatSample"><label>E - <span id="seatEprice" value="10000">10,000</span>ks</label></div> 
            <div class="col seatSample"><label>F - <span id="seatFprice" value="21000">21,000</span>ks</label></div> 
        </div>
        <div class="row screen"></div>
        <div class="seats">
           
            <div class="row">
                <div class="col seat">A1</div>
                <div class="col seat">A2</div>
                <div class="col seat">A3</div>
                <div class="col seat">A4</div>
                <div class="col seat">A5</div>
                <div class="col seat">A6</div>
                <div class="col seat">A7</div>
                <div class="col seat">A8</div>
                <div class="col seat">A9</div>
                <div class="col seat">A10</div>
            </div>
            <div class="row">
                <div class="col seat">B1</div>
                <div class="col seat">B2</div>
                <div class="col seat">B3</div>
                <div class="col seat">B4</div>
                <div class="col seat">B5</div>
                <div class="col seat">B6</div>
                <div class="col seat">B7</div>
                <div class="col seat">B8</div>
                <div class="col seat">B9</div>
                <div class="col seat">B10</div>
            </div>

            <div class="row">
                <div class="col seat">C1</div>
                <div class="col seat">C2</div>
                <div class="col seat">C3</div>
                <div class="col seat">C4</div>
                <div class="col seat">C5</div>
                <div class="col seat">C6</div>
                <div class="col seat">C7</div>
                <div class="col seat">C8</div>
                <div class="col seat">C9</div>
                <div class="col seat">C10</div>
            </div>

            <div class="row">
                <div class="col seat">D1</div>
                <div class="col seat">D2</div>
                <div class="col seat">D3</div>
                <div class="col seat">D4</div>
                <div class="col seat">D5</div>
                <div class="col seat">D6</div>
                <div class="col seat">D7</div>
                <div class="col seat">D8</div>
                <div class="col seat">D9</div>
                <div class="col seat">D10</div>
            </div>

            <div class="row">
                <div class="col seat">E1</div>
                <div class="col seat">E2</div>
                <div class="col seat">E3</div>
                <div class="col seat">E4</div>
                <div class="col seat">E5</div>
                <div class="col seat">E6</div>
                <div class="col seat">E7</div>
                <div class="col seat">E8</div>
                <div class="col seat">E9</div>
                <div class="col seat">E10</div>
            </div>

            <div class="row">
                <div class="col seat">F1</div>
                <div class="col seat">F2</div>
                <div class="col seat">F3</div>
                <div class="col seat">F4</div>
                <div class="col seat">F5</div>
            </div>
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
<!-- <script src="scriptforSeat.js"></script> -->
</html>