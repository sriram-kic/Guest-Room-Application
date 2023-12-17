<!-- PHP code to fetch and print booking history -->
<?php
include "php/connect.php";
include "php/session.php";

// Get the logged-in user ID
$logged_user_id = $_SESSION['login_user'];

// Fetch booked history for the logged-in user with room details
$query = "
    SELECT
        b.booking_id,
        r.room_number,
        b.checkin_date,
        b.checkout_date,
        b.adults,
        b.children,
        b.property_name,
        b.booking_date,
        b.status,
        r.contact_name,
        r.contact_email,
        r.contact_phone
    FROM
        bookings b
    JOIN
        rooms r ON b.room_number = r.room_number
    WHERE
        b.user_id = ?
";

$stmt = $db->prepare($query);
$stmt->bind_param("i", $logged_user_id);
$stmt->execute();
$result = $stmt->get_result();
$booked_history = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Availability</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>


    <script src="js/logout.js"></script>
    <!--SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


</head>

<body>

    <main>
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Thirteenth navbar example">
            <div class="container-fluid">
                <a class="navbar-brand col-lg-3 me-0 ms-5" href="#">Customer</a>
                <div class="d-flex justify-content-between col-lg-6 me-5">
                    <!-- Booked History Modal -->
                    <button type="button" class="btn btn-info mt-3" data-bs-toggle="modal" data-bs-target="#bookedHistoryModal">
                        View Booked History
                    </button>
                    <div class="d-lg-flex col-lg-3 justify-content-sm-end me-5">
                        <img width="48" height="48" src="https://img.icons8.com/color-glass/48/power-off-button.png" id="logoutBtn" alt="power-off-button" />
                        <span class="ms-2" id="logoutSpan">Logout</span>
                    </div>
                </div>
            </div>
        </nav>
    </main>




    <!-- Booked History Modal -->
    <div class="modal fade" id="bookedHistoryModal" tabindex="-1" aria-labelledby="bookedHistoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookedHistoryModalLabel">Booked History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <style>
                        #bookedHistoryModal {
                            background: rgba(0, 0, 0, 0.5);
                            /* Semi-transparent background */
                        }

                        #bookedHistoryModal .modal-content {
                            background-color: #fff;
                            /* White background */
                            border-radius: 10px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                            /* Box shadow for a subtle lift */
                        }

                        #bookedHistoryTable {
                            width: 100%;
                            border-collapse: collapse;
                        }

                        #bookedHistoryTable th,
                        #bookedHistoryTable td {
                            border: 1px solid #ddd;
                            /* Border between cells */
                            padding: 8px;
                            text-align: left;
                        }

                        #bookedHistoryTable th {
                            background-color: #3498db;
                            /* Blue background for header cells */
                            color: #fff;
                            /* White text color */
                        }

                        #bookedHistoryTable tbody tr:hover {
                            background-color: #f5f5f5;
                            /* Light gray background on hover */
                        }

                        #bookedHistoryTable .status-booked {
                            color: #27ae60;
                            /* Green color for 'booked' status */
                            font-weight: bold;
                        }

                        #bookedHistoryModal .modal-footer {
                            border-top: 1px solid #ddd;
                            /* Border above the modal footer */
                        }

                        #bookedHistoryModal .modal-footer button {
                            background-color: #3498db;
                            /* Blue background for buttons */
                            color: #fff;
                            /* White text color */
                        }
                    </style>

                    <!-- Display Booked History -->
                    <table id="bookedHistoryTable" class="table">
                        <thead>
                            <tr>
                                <th>Room Number</th>
                                <th>Guest House name</th>
                                <th>Guest House Email</th>
                                <th>Guest House Mobile</th>
                                <th>Check-in Date</th>
                                <th>Check-out Date</th>
                                <th>Guests</th> <!-- Combined Adults and Children -->
                                <th>Booking date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($booked_history as $booking) : ?>
                                <tr>
                                    <td><?= $booking['room_number']; ?></td>
                                    <td><?= $booking['property_name']; ?></td>
                                    <td><?= $booking['contact_email']; ?></td>
                                    <td><?= $booking['contact_phone']; ?></td>
                                    <td><?= $booking['checkin_date']; ?></td>
                                    <td><?= $booking['checkout_date']; ?></td>
                                    <td><?= $booking['adults'] + $booking['children']; ?></td>
                                    <td><?= $booking['booking_date']; ?></td>
                                    <td class="<?= $booking['status'] === 'Booked' ? 'status-booked' : ''; ?>"><?= $booking['status']; ?></td>
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





    <!-- Modal for Booking -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Booking Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="bookingForm">
                        <div class="mb-3">
                            <label for="propertyName" class="form-label">Property Name</label>
                            <input type="text" class="form-control" id="propertyName" name="property_name" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="roomNumber" class="form-label">Room Number</label>
                            <input type="text" class="form-control" id="roomNumber" name="room_number" readonly>
                        </div>
                        <!-- Customer details fields-->
                        <div class="mb-3">
                            <label for="customerName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="customerName" name="customer_name" placeholder="E.g John" required>
                        </div>
                        <div class="mb-3">
                            <label for="customerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="customerEmail" name="customer_email" placeholder="example@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="customerPhone" class="form-label">Mobile Number</label>
                            <input type="tel" class="form-control" id="customerPhone" name="customer_phone" placeholder="E.g 96xxxxxxxx" required>
                        </div>
                        <div class="mb-3">
                            <label for="checkinDate" class="form-label">Check-in Date</label>
                            <input type="date" class="form-control" id="checkinDate" name="checkin_date" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="checkoutDate" class="form-label">Check-out Date</label>
                            <input type="date" class="form-control" id="checkoutDate" name="checkout_date" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="adults" class="form-label">Number of Adults</label>
                            <input type="number" class="form-control" id="adults" name="adults" placeholder="Enter number of adults" required>
                        </div>
                        <div class="mb-3">
                            <label for="children" class="form-label">Number of Children</label>
                            <input type="number" class="form-control" id="children" name="children" placeholder="Enter number of children" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit Booking</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <!-- Check Availability button -->
        <button class="btn btn-primary" id="checkAvailabilityBtn">Check Availability</button>

        <div class="row mt-3" id="roomResults"></div>
        <div class="row mt-3">
        </div>
        <div id="availabilityDetails" class="row mt-3"></div>
    </div>


    <script>
        $(document).ready(function() {
            // DataTable for Booked History
            $('#bookedHistoryTable').DataTable();
        });
    </script>


<script>
    
$(document).ready(function() {
    // FullCalendar
    $('#roomResults').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultView: 'month',
        defaultDate: new Date(),
        validRange: {
            start: new Date(),
        },
        events: [],
        editable: false,
        selectable: true,
        selectHelper: true,
        select: function(start, end, jsEvent, view) {
            var selectedDate = start.format('YYYY-MM-DD');
            fetchAvailableRooms(selectedDate);
        }
    });

    // click event to Check Availability button
    $('#checkAvailabilityBtn').click(function() {
        // Get the selected date from the calendar
        var selectedDate = $('#roomResults').fullCalendar('getDate').format('YYYY-MM-DD');
        // Call the function to handle availability check
        checkAvailability(selectedDate);
    });
});

function fetchAvailableRooms(selectedDate) {
    $.ajax({
        type: 'POST',
        url: 'php/fetch_customer.php',
        data: {
            date: selectedDate,

        },
        success: function(response) {
            try {
                var availableRooms = JSON.parse(response);

                // Clear existing events and add new ones
                $('#roomResults').fullCalendar('removeEvents');
                $('#roomResults').fullCalendar('addEventSource', availableRooms);

                var detailsHtml = '';
                availableRooms.forEach(function(room) {
                    detailsHtml += `
            <div class="col-lg-6 mb-4">
<div class="card mb-3 position-relative">
<!-- Room details in two columns -->
<div class="row g-0">
    <div class="col-md-6">
        <h5 class="card-title">${room.property_name}</h5>
        <p class="card-text mb-3">Room Number: ${room.room_number}</p>
        <p class="card-text mb-3">Room Type: ${room.room_type}</p>
        <p class="card-text mb-3">Number of Beds: ${room.num_of_beds}</p>
        <p class="card-text mb-3">Floor Size: ${room.floor_size_sqft} sqft</p>
        <p class="card-text mb-3">Min Booking Period: ${room.min_booking_period} day</p>
        <p class="card-text mb-3">Max Booking Period: ${room.max_booking_period} days</p>
        <p class="card-text mb-3">Address: ${room.address}, ${room.city}, ${room.country}</p>
        <p class="card-text mb-3">Contact: ${room.contact_name}, ${room.contact_email}, ${room.contact_phone}</p>
        <p class="card-text mb-3">Amenities: ${room.amenities}</p>
        <p class="card-text mb-3">Additional Details: ${room.additional_details}</p>
        <h5 class="card-title text-success">${room.rent_per_day}.00/per day</h5>
    </div>
    <div class="col-md-6">
        <div id="carouselExampleControls_${room.id}" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner w-100">
                <div class="row">
                    ${room.photo_paths.split(',').map((photo, index) => `
                        <div class="col carousel-item ${index === 0 ? 'active' : ''}">
                            <img src="php/image.php?file=${encodeURIComponent(photo)}" class="d-block w-100" alt="Room Image" style="object-fit: fill; width:100%; height:500px">
                        </div>
                    `).join('')}
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls_${room.id}" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls_${room.id}" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Booking button -->
    <button class="btn btn-primary" onclick="bookNow(${room.id}, '${room.property_name}', '${room.room_number}')">Book Now</button>

</div>
</div>
</div>
`;
                });

                $('#availabilityDetails').html(detailsHtml);
            } catch (error) {
                console.error('Error parsing response:', error);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', error);
        }
    });
}

// ...
function bookNow(roomId, propertyName, roomNumber) {
    // Set the values in the modal
    $('#selectedRoomId').val(roomId);
    $('#propertyName').val(propertyName).prop('readonly', true);
    $('#roomNumber').val(roomNumber).prop('readonly', true);

    // Add the room_id to the form data
    $('#bookingForm').append('<input type="hidden" name="room_id" value="' + roomId + '">');

    // Show the modal
    $('#bookingModal').modal('show');
}
// ...



$('#bookingForm').submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'php/customer_book.php',
        data: $('#bookingForm').serialize(),
        success: function(response) {
            console.log('Success:', response);

            // Trigger SweetAlert on success
            Swal.fire({
                title: 'Booking Confirmed!',
                text: 'Your room booking has been confirmed.',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Optionally, you can redirect or perform other actions here
                    $("#bookedHistoryTable").load(" #bookedHistoryTable > *");
                    $('#bookingModal').modal('hide');
                    window.location.href = "customer.php";
                }
            });
        },
        error: function(xhr, status, error) {
            console.error('Error submitting booking:', error);
            alert('Error submitting booking. Please try again.');
        }
    });
});
</script>

   
</body>

</html>