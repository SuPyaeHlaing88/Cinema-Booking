
let seat = $(".seat");
seat.on("click",(e)=>{
  let seatData =  e.currentTarget.getAttribute("data-value");


$.ajax({
    url: 'seat.php',
    type: 'POST',
    data: { seat_id: seatData },
    success: function() {
        console.log('Seat selected'+seatData);
    },
    error: function(error) {
        console.log('AJAX Error:', error);
    }
})
})

