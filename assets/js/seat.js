const container = document.querySelector(".seats");
const seats = document.querySelectorAll(".row .seat");
const priceElement = document.getElementById("price");
const count = document.getElementById("count");
const total = document.getElementById("total");

function populateUI() {
  //getitem from updateSelectedcount
  const selectedSeats = JSON.parse(localStorage.getItem("selectedSeats"));

  if (selectedSeats !== null && selectedSeats.length > 0) {
    seats.forEach((seat, index) => {
      if (selectedSeats.indexOf(index) > -1) {
        //this is new class adding
        console.log(seat.classList.add("selected"));
      }
    });
  } else if (selectedSeats === null && selectedSeats.length === 0) {
    seats.classList.remove("selected");
  }
}
// Update count
function updateSelectedCount() {
  const selectedSeats = document.querySelectorAll(".row .seat.selected");

  const seatsIndex = [...selectedSeats].map((seat) => [...seats].indexOf(seat));
  console.log("seatsIndex: " + seatsIndex);

  count.innerText = selectedSeats.length;
  // prices
  var price = [];
  // test condition  prices'types by method in selectedseatdata
  for (var i = 0; i < selectedSeats.length; i++) {
    if (seatsIndex[i]) {
      console.log("Row:" + rowElement.getAttribute("value"));
      console.log(price.push(priceElement.getAttribute("value")));
    }
  }
  //total amount
  var totalprice = 0;
  for (var j = 0; j < price.length; j++) {
    totalprice += Number(price[j]);
  }
  total.innerText = totalprice;
  console.log("totalprice: " + totalprice);

  // Initialize an empty string to build the HTML content
  let ticketsHTML = "";

  // Loop through each selected seat
  for (var k = 0; k < selectedSeats.length; k++) {
    // Append the HTML for the current seat and price to the string
    ticketsHTML += `
      <div class="ticket">
        <span>Seat- ${selectedSeats[k].textContent}</span>
        <span>Price- ${price[k]} ks</span>
      </div>
    `;
  }

  // Update the innerHTML of the display element once
  document.querySelector(".display").innerHTML = ticketsHTML;
}

//for payment photo
document
  .getElementById("photoInput")
  .addEventListener("change", function (event) {
    const file = event.target.files[0]; // Get the selected file
    if (file) {
      const reader = new FileReader(); // Create a FileReader object

      reader.onload = function (e) {
        const photoData = e.target.result; // Base64 encoded photo data
        console.log(photoData); // Log the photo data (Base64 string)

        // Display the image as a preview
        const imgElement = document.getElementById("preview");
        imgElement.src = photoData;
        imgElement.style.display = "block";
      };

      reader.readAsDataURL(file); // Read the file as a data URL
    }
  });

// Seat click event
container.addEventListener("click", (e) => {
  if (
    e.target.classList.contains("seat") &&
    !e.target.classList.contains("selected")
  ) {
    e.target.classList.toggle("selected");

    updateSelectedCount();
  } else if (
    e.target.classList.contains("seat") &&
    e.target.classList.contains("selected")
  ) {
    e.target.classList.remove("selected");

    updateSelectedCount();
  }
});

// Initial count and total set
updateSelectedCount();
