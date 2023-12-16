<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Availability</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
</head>

<body>
    <!-- Modal for Booking -->

    <!-- Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Customer details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bookingForm">
                        <!-- Customer details fields (customize as needed) -->
                        <div class="mb-3">
                            <label for="customerName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="customerName" name="customer_name" placeholder="E.g John"required>
                        </div>
                        <div class="mb-3">
                            <label for="customerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="customerEmail" name="customer_email" placeholder="example@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="customerPhone" class="form-label">Mobile Number</label>
                            <input type="tel" class="form-control" id="customerPhone" name="customer_phone" placeholder="E.g 96xxxxxxxx"required>
                        </div>
                        <!-- Add hidden field for room_id -->
                        <input type="hidden" id="selectedRoomId" name="room_id" value="">
                       
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit Booking</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5">
    <div class="row mt-3" id="roomResults">
        <!-- FullCalendar will be inserted here -->
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <button class="btn btn-primary" onclick="checkAvailability()">Check Availability</button>
        </div>
    </div>
    <div id="availabilityDetails" class="row mt-3"></div>
</div>

<script>
    $(document).ready(function () {
        // Initialize FullCalendar
        $('#roomResults').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultView: 'month',
            defaultDate: new Date(), // Set to the current date
            validRange: {
                start: new Date(), // Current date
            },
            events: [],  // Initialize with empty events
            editable: false,
            selectable: true,
            selectHelper: true,
            select: function (start, end, jsEvent, view) {
                // Handle date selection here
                var selectedDate = start.format('YYYY-MM-DD');
                fetchAvailableRooms(selectedDate);
            }
        });
    });

    function checkAvailability() {
        // Trigger FullCalendar's select function programmatically
        $('#roomResults').fullCalendar('today');
    }

        function fetchAvailableRooms(selectedDate) {
            // Use AJAX to fetch data from the server (rooms.php)
            $.ajax({
                type: 'POST',
                url: 'php/fetch_customer.php',
                data: { date: selectedDate },
                success: function (response) {
                    // Parse the response and update the FullCalendar and details
                    var availableRooms = JSON.parse(response);

                    $('#roomResults').fullCalendar('removeEvents');
                    $('#roomResults').fullCalendar('addEventSource', availableRooms);

                    // Display availability details
                    var detailsHtml = '';
                    availableRooms.forEach(function (room) {
                        detailsHtml += `<div class="col-lg-6 mb-4">
                    <div class="card    ">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <div id="carouselExampleControls_${room.room_id}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner w-100">`;

                        detailsHtml += `<div class="row">`;
                        room.photo_paths.split(',').forEach((photo, index) => {
                            detailsHtml += `<div class="col carousel-item ${index === 0 ? 'active' : ''}">
                                        <img src="${photo}" class="d-block w-100" alt="Room Image">
                                    </div>`;
                        });

                        detailsHtml += `</div></div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_${room.room_id}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_${room.room_id}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="card-title">${property_name}</h5>
                                            <h5 class="card-title">${room_number}</h5>
                                            <p class="card-text">Room Type: ${room_type}</p>
                                            <p class="card-text">Number of Beds: ${num_of_beds}</p>
                                        </div>
                                        <div class="text-end">
                                            <p class="card-text fs-3 text-success">${rent_per_day}</p>
                                        </div>
                                    </div>
                                    <p class="card-text">Floor Size: ${floor_size_sqft} sqft</p>
                                    <p class="card-text">Min Booking Period: ${room.min_booking_period}</p>
                                    <p class="card-text">Max Booking Period: ${room.max_booking_period}</p>
                                    <p class="card-text">Address: ${room.address}, ${room.city}, ${room.country}</p>
                                    <p class="card-text">Contact: ${room.contact_name}, ${room.contact_email}, ${room.contact_phone}</p>
                                    <p class="card-text">Amenities: ${room.amenities}</p>
                                    <p class="card-text">Additional Details: ${room.additional_details}</p>
                                    <button class="btn btn-primary mt-3" onclick="bookNow(${room.room_id})">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
                    });

                    $('#availabilityDetails').html(detailsHtml);
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        // Function to handle booking
        function bookNow(roomId) {
            // Set the selected room_id in the hidden field
            $('#selectedRoomId').val(roomId);
            // Open the booking modal
            $('#bookingModal').modal('show');
        }

        // Submit booking form
        $('#bookingForm').submit(function (e) {
            e.preventDefault();
            // Implement AJAX to submit booking data to the server (booking.php)
            $.ajax({
                type: 'POST',
                url: 'php/customer_book.php',
                data: $('#bookingForm').serialize(),
                success: function (response) {
                    // Handle success, e.g., display a success message
                    alert('Booking submitted successfully!');
                    // Close the modal
                    $('#bookingModal').modal('hide');
                },
                error: function (xhr, status, error) {
                    console.error('Error submitting booking:', error);
                    // Handle error, e.g., display an error message
                    alert('Error submitting booking. Please try again.');
                }
            });
        });
    </script>
</body>

</html>