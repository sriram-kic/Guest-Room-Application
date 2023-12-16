<!-- PHP code to fetch and print booking history -->
<?php
include "php/connect.php";
include "php/session.php";

// Get the logged-in user ID
$logged_user_id = $_SESSION['login_user'];

// Fetch booking history for the logged-in user
$query = "SELECT * FROM bookings WHERE user_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $logged_user_id);
$stmt->execute();
$result = $stmt->get_result();
$booking_history = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House_Owner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <!-- Add these lines before your script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include alertify CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>


    <script src="js/logout.js"></script>
    <script src="js/multipleimage.js"></script>
    <script src="js/display.js"></script>



    <link rel="icon" href="https://www.google.com/s2/favicons?domain=example.com" type="image/x-icon">


<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }

  .b-example-divider {
    width: 100%;
    height: 3rem;
    background-color: rgba(0, 0, 0, .1);
    border: solid rgba(0, 0, 0, .15);
    border-width: 1px 0;
    box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
  }

  .b-example-vr {
    flex-shrink: 0;
    width: 1.5rem;
    height: 100vh;
  }

  .bi {
    vertical-align: -.125em;
    fill: currentColor;
  }

  .nav-scroller {
    position: relative;
    z-index: 2;
    height: 2.75rem;
    overflow-y: hidden;
  }

  .nav-scroller .nav {
    display: flex;
    flex-wrap: nowrap;
    padding-bottom: 1rem;
    margin-top: -1px;
    overflow-x: auto;
    text-align: center;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
  }

  .btn-bd-primary {
    --bd-violet-bg: #712cf9;
    --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

    --bs-btn-font-weight: 600;
    --bs-btn-color: var(--bs-white);
    --bs-btn-bg: var(--bd-violet-bg);
    --bs-btn-border-color: var(--bd-violet-bg);
    --bs-btn-hover-color: var(--bs-white);
    --bs-btn-hover-bg: #6528e0;
    --bs-btn-hover-border-color: #6528e0;
    --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
    --bs-btn-active-color: var(--bs-btn-hover-color);
    --bs-btn-active-bg: #5a23c8;
    --bs-btn-active-border-color: #5a23c8;
  }

  .bd-mode-toggle {
    z-index: 1500;
  }

  .bd-mode-toggle .dropdown-menu .active .bi {
    display: block !important;
  }

  body {
padding-bottom: 20px;
}

.navbar {
margin-bottom: 20px;
}

</style>

</head>

<body>

<main>
  <nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Thirteenth navbar example">
    <div class="container-fluid">
      <a class="navbar-brand col-lg-3 me-0 ms-5" href="#">House Owner</a>
      <div class="d-lg-flex col-lg-6 justify-content-sm-end me-5">
        <!-- Button to Open Booking History Modal -->
        <button type="button" class="btn btn-info mt-3" data-bs-toggle="modal" data-bs-target="#bookingHistoryModal">
          View Booking History
        </button>
        <img width="48" height="48" src="https://img.icons8.com/color-glass/48/power-off-button.png" id="logoutBtn" alt="power-off-button"/>
      </div>
    </div>
  </nav>
</main>


<!-- Booking History Modal with Room Details -->
<div class="modal fade" id="bookingHistoryModal" tabindex="-1" aria-labelledby="bookingHistoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bookingHistoryModalLabel">Booking History with Room Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- DataTable to Display Booking History with Room Details -->
        <table id="bookingHistoryTable" class="table">
          <thead>
            <tr>
              <th>Booking ID</th>
              <th>Room Number</th>
              <th>Check-in Date</th>
              <th>Check-out Date</th>
              <th>Guest Name</th>
              <!-- Add more columns as needed from rooms_table -->
              <th>Room Type</th>
              <th>Floor Size</th>
              <!-- Add more columns as needed from rooms_table -->
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($booking_history as $booking) : ?>
              <tr>
                <td><?= $booking['booking_id']; ?></td>
                <td><?= $booking['room_number']; ?></td>
                <td><?= $booking['checkin_date']; ?></td>
                <td><?= $booking['checkout_date']; ?></td>
                <td><?= $booking['guest_name']; ?></td>
                <!-- Retrieve additional details from rooms_table -->
                <td><?= $booking['room_type']; ?></td>
                <td><?= $booking['floor_size']; ?></td>
                <!-- Retrieve additional details from rooms_table -->
                <td><?= $booking['status']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

  <div>
    <div class="bg-body-tertiaryp-5 rounded">
      <div class="col-sm-8 mx-auto">
        <button class="btn btn-sm btn-primary mb-4" type="button" data-bs-toggle="collapse" href="#collapseWidthExample"
          role="button" aria-expanded="false" aria-controls="collapseExample">
          Add Property & Room details
      </button>
        <div class="collapse collapse-horizontal" id="collapseWidthExample">
          <div class="card card-body w-100">
              <!-- Form for room management -->
              <form id="roomForm" method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                      <label for="property_name" class="form-label">Property Name:</label>
                      <input type="text" class="form-control" id="property_name" name="property_name"
                          placeholder="Enter Property name">
                  </div>
  
                  <div class="mb-3">
                      <label for="room_number" class="form-label">Room Number:</label>
                      <input type="text" class="form-control" id="room_number" name="room_number"
                          placeholder="Enter Room no">
                  </div>
  
                  <div class="mb-3">
                      <label for="room_type" class="form-label">Room Type:</label>
                      <select class="form-select" id="room_type" name="room_type">
                          <option value="single">Single Room</option>
                          <option value="double">Double Room</option>
                          <option value="suite">Suite</option>
                      </select>
                  </div>
  
                  <div class="mb-3">
                      <label for="num_of_beds" class="form-label">Number of Beds:</label>
                      <input type="number" class="form-control" id="num_of_beds" name="num_of_beds"
                          placeholder="Enter number of beds">
                  </div>
  
                  <div class="mb-3">
                      <label for="floor_size" class="form-label">Floor Size (in square feet):</label>
                      <input type="number" class="form-control" id="floor_size" name="floor_size"
                          placeholder="Enter floor size in square feet">
                  </div>
  
                  <div class="mb-3">
                      <label for="min_booking_period" class="form-label">Min Booking Period:</label>
                      <input type="number" class="form-control" id="min_booking_period" name="min_booking_period"
                          placeholder="Enter minimum booking period in days">
                  </div>
  
                  <div class="mb-3">
                      <label for="max_booking_period" class="form-label">Max Booking Period:</label>
                      <input type="number" class="form-control" id="max_booking_period" name="max_booking_period"
                          placeholder="Enter maximum booking period in days">
                  </div>
  
                  <div class="mb-3">
                      <label for="rent_per_day" class="form-label">Rent per Day:</label>
                      <input type="number" class="form-control" id="rent_per_day" name="rent_per_day"
                          placeholder="Enter rent per day">
                  </div>
  
                  <div class="mb-3">
                      <label for="address" class="form-label">Address:</label>
                      <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
                  </div>
  
                  <div class="mb-3">
                      <label for="city" class="form-label">City:</label>
                      <input type="text" class="form-control" id="city" name="city" placeholder="Enter city">
                  </div>
  
                  <div class="mb-3">
                      <label for="country" class="form-label">Country:</label>
                      <input type="text" class="form-control" id="country" name="country" placeholder="Enter country">
                  </div>
  
                  <div class="mb-3">
                      <label for="contact_name" class="form-label">Contact Name:</label>
                      <input type="text" class="form-control" id="contact_name" name="contact_name"
                          placeholder="Enter contact name">
                  </div>
  
                  <div class="mb-3">
                      <label for="contact_email" class="form-label">Contact Email:</label>
                      <input type="email" class="form-control" id="contact_email" name="contact_email"
                          placeholder="Example@gmail.com">
                  </div>
  
                  <div class="mb-3">
                      <label for="editable_contact_phone" class="form-label">Contact Phone:</label>
                      <input type="tel" class="form-control" id="contact_phone" name="contact_phone"
                          placeholder="E.g +91xxxxxxxxx">
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Amenities:</label>
                      <input type="text" class="form-control" id="editable_amenities" name="amenities[]"
                          placeholder="Enter amenities separated by commas (Wifi, Parking, Air Conditioning, etc)">
                  </div>
  
  
                  <div class="mb-3">
                      <label for="additional_details" class="form-label">Additional Details:</label>
                      <textarea class="form-control" id="additional_details" name="additional_details" rows="4"
                          placeholder="Enter additional details"></textarea>
                  </div>
  
                  <div id="photoInputs">
                      <div class="mb-3 mt-2">
                          <label for="photo_upload" class="form-label">Photo Upload:</label>
                          <input type="file" class="form-control" name="photo_upload[]" accept="image/*" multiple>
                          <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addPhotoInput()">Add More
                              Photos</button>
                      </div>
                  </div>
  
                  <div class="mb-3 mt-3">
                      <button type="submit" class="btn btn-sm btn-success">Submit</button>
                      <button class="btn btn-sm btn-dark" type="button"
                          onclick="toggleCollapse('collapseWidthExample')">Cancel</button>
                  </div>
              </form>
          </div>
      </div>
      </div>
    </div>
  </div>
</div>
</main>

    <div class="row" id="cardContainer"></div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit room details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="roomForm" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="property_name" class="form-label">Property Name:</label>
                            <input type="text" class="form-control" id="editable_property_name" name="property_name">
                        </div>

                        <div class="mb-3">
                            <label for="room_name_number" class="form-label">Room Number:</label>
                            <input type="text" class="form-control" id="editable_room_number" name="room_number">
                        </div>


                        <div class="mb-3">
                            <label for="room_type" class="form-label">Room Type:</label>
                            <select class="form-select" id="editable_room_type" name="room_type">
                                <option value="single">Single Room</option>
                                <option value="double">Double Room</option>
                                <option value="suite">Suite</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="num_of_beds" class="form-label">Number of Beds:</label>
                            <input type="number" class="form-control" id="editable_num_of_beds" name="num_of_beds">
                        </div>

                        <div class="mb-3">
                            <label for="floor_size" class="form-label">Floor Size (in square feet):</label>
                            <input type="number" class="form-control" id="editable_floor_size" name="floor_size">
                        </div>

                        <div class="mb-3">
                            <label for="min_booking_period" class="form-label">Min Booking Period:</label>
                            <input type="number" class="form-control" id="editable_min_booking_period"
                                name="min_booking_period">
                        </div>

                        <div class="mb-3">
                            <label for="max_booking_period" class="form-label">Max Booking Period:</label>
                            <input type="number" class="form-control" id="editable_max_booking_period"
                                name="max_booking_period">
                        </div>

                        <div class="mb-3">
                            <label for="rent_per_day" class="form-label">Rent per Day:</label>
                            <input type="number" class="form-control" id="editable_rent_per_day" name="rent_per_day">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="editable_address" name="address">
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">City:</label>
                            <input type="text" class="form-control" id="editable_city" name="city">
                        </div>

                        <div class="mb-3">
                            <label for="country" class="form-label">Country:</label>
                            <input type="text" class="form-control" id="editable_country" name="country">
                        </div>

                        <div class="mb-3">
                            <label for="contact_name" class="form-label">Contact Name:</label>
                            <input type="text" class="form-control" id="editable_contact_name" name="contact_name">
                        </div>

                        <div class="mb-3">
                            <label for="contact_email" class="form-label">Contact Email:</label>
                            <input type="email" class="form-control" id="editable_contact_email" name="contact_email">
                        </div>

                        <div class="mb-3">
                            <label for="editable_contact_phone" class="form-label">Mobile Phone:</label>
                            <input type="number" class="form-control" id="editable_contact_phone" name="contact_phone">
                        </div>


                        <div class="mb-3">
                            <label for="additional_details" class="form-label">Additional Details:</label>
                            <textarea class="form-control" id="editable_additional_details" name="additional_details"
                                rows="4"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-success" id="saveChangesBtn">Save changes</button>

                </div>
            </div>
        </div>
    </div>


    <!-- Your HTML content, including the modal and other elements -->

    <script>
       
 // Event listener for "Edit" button click
 $(document).on('click', '.btn-edit', function () {
    var roomId = $(this).data('room-id');
    console.log(roomId);
    // Fetch room data using AJAX
    $.ajax({
        url: 'php/fetch_room_details.php',
        method: 'GET',
        data: { room_id: roomId },
        dataType: 'json',
        success: function (response) {
            // response=JSON.parse(response);
            if (response.success) {
                // Populate modal fields with the fetched data
                populateModalFields(response.data);
                // Show the modal
                $('#editModal').modal('show');
            } else {
                console.error('Error fetching room data:', response.error);
            }
        },
        error: function (error) {
            console.error('Error fetching room data:', error);
        }
    });
});

// Event listener for Save Changes button
$('#saveChangesBtn').click(function () {
    // Get the room ID from the modal data attribute
    var roomId = $('.btn-edit').data('room-id');


    // Collect updated data from modal fields
    var updatedData = {
        property_name: $('#editable_property_name').val(),
        room_number: $('#editable_room_number').val(),
        room_type: $('#editable_room_type').val(),
        num_of_beds: $('#editable_num_of_beds').val(),
        floor_size_sqft: $('#editable_floor_size').val(),
        min_booking_period: $('#editable_min_booking_period').val(),
        max_booking_period: $('#editable_max_booking_period').val(),
        rent_per_day: $('#editable_rent_per_day').val(),
        address: $('#editable_address').val(),
        city: $('#editable_city').val(),
        country: $('#editable_country').val(),
        contact_name: $('#editable_contact_name').val(),
        contact_email: $('#editable_contact_email').val(),
        contact_phone: $('#editable_contact_phone').val(),
        additional_details: $('#editable_additional_details').val()
    };

    console.log(roomId);
    console.log(updatedData);

    $.ajax({
        url: 'php/update_room.php',
        method: 'POST',
        data: { room_id: roomId, updated_data: updatedData },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                $('#editModal').modal('hide');
                location.reload("rooms.php");
                alertify.success('Changes saved successfully!');
            } else {
                console.error('Error saving changes:', response.error);
                // Show an error message if needed
                alert('Error saving changes. Please try again.');
            }
        },
        error: function (error) {
            console.error('Error saving changes:', error);
            // Show an error message if needed
            alert('Error saving changes. Please try again.');
        }
    });
});

// Your existing code for modal population
function populateModalFields(roomData) {
    // Implement your logic to populate modal fields
    $('#editable_property_name').val(roomData.property_name);
    $('#editable_room_number').val(roomData.room_number);
    $('#editable_room_type').val(roomData.room_type);
    $('#editable_num_of_beds').val(roomData.num_of_beds);
    $('#editable_floor_size').val(roomData.floor_size_sqft);
    $('#editable_min_booking_period').val(roomData.min_booking_period);
    $('#editable_max_booking_period').val(roomData.max_booking_period);
    $('#editable_rent_per_day').val(roomData.rent_per_day);
    $('#editable_address').val(roomData.address);
    $('#editable_city').val(roomData.city);
    $('#editable_country').val(roomData.country);
    $('#editable_contact_name').val(roomData.contact_name);
    $('#editable_contact_email').val(roomData.contact_email);
    $('#editable_contact_phone').val(roomData.contact_phone);
    $('#editable_additional_details').val(roomData.additional_details);
}
    </script>


</body>

</html>