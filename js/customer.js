
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