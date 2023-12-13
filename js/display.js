$(document).ready(function () {
    // Function to refresh room cards on the page
    function refreshCards(data) {
        $('#cardContainer').empty();

        data.forEach(function (room) {
            let cardHtml = `
                <div class="col-lg-6 mb-4">
                    <div class="card h-10">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <div id="carouselExampleControls_${room.id}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        ${room.photo_paths.split(',').map((photo, index) => `
                                            <div class="carousel-item ${index === 0 ? 'active' : ''}">
                                                <img src="php/image.php?file=${encodeURIComponent(photo)}" class="d-block w-100" alt="Room Image">
                                            </div>
                                        `).join('')}
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
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="card-title">${room.property_name}</h5>
                                            <h5 class="card-title">${room.room_number}</h5>
                                            <p class="card-text">Room Type: ${room.room_type}</p>
                                            <p class="card-text">Number of Beds: ${room.num_of_beds}</p>
                                            <p class="card-text">Amenities: ${room.amenities}</p>
                                        </div>
                                        <div class="text-end">
                                            <p class="card-text fs-3 text-success">${room.rent_per_day}</p>
                                        </div>
                                    </div>
                                    <p class="card-text">Floor Size: ${room.floor_size_sqft} sqft</p>
                                    <p class="card-text">Min Booking Period: ${room.min_booking_period}</p>
                                    <p class="card-text">Max Booking Period: ${room.max_booking_period}</p>
                                    <p class="card-text">Address: ${room.address}, ${room.city}, ${room.country}</p>
                                    <p class="card-text">Contact: ${room.contact_name}, ${room.contact_email}, ${room.contact_phone}</p>
                                    <p class="card-text">Additional Details: ${room.additional_details}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal" data-room-id="${room.id}">Edit</button>
                                        <button type="button" class="btn btn-danger" data-room-id="${room.id}">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
            $('#cardContainer').append(cardHtml);
        });
    }

    // Fetch room data on initial page load
    function refreshTable() {
        $.ajax({
            url: "php/fetch_data.php",
            type: "GET",
            dataType: "json",
            success: function (response) {
                refreshCards(response.data);
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error('Error fetching data:', errorThrown);
            }
        });
    }

    // Call refreshTable on document ready
    refreshTable();

    // Event listener for modal show event
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var roomId = button.data('room-id'); // Extract room ID from data attribute

        // Fetch room data using AJAX
        $.ajax({
            url: 'update_room.php',
            method: 'GET',
            data: { room_id: roomId },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Populate modal fields with the fetched data
                    populateModalFields(response.data);
                    // Store room ID in the modal for reference
                    $('#editModal').data('room-id', roomId);
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
        // Implement your logic to save changes here
        // You may want to use AJAX to send updated data to the server
        // and update the database.
    });

    // Your existing code for inserting new room
    $(document).on('submit', '#roomForm', function (event) {
        event.preventDefault();

        var formData = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            url: 'php/process_room.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#roomForm')[0].reset();
                refreshTable();
                alertify.success('Data inserted successfully!');
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error('Error inserting data:', errorThrown);
            }
        });
    });

    // Your existing code for deleting a room
    $(document).on('click', '.btn-danger', function () {
        let roomId = $(this).data('room-id');

        $.ajax({
            type: 'POST',
            url: 'php/delete_room.php',
            data: { roomId: roomId },
            success: function (response) {
                console.log('Room deleted successfully.');
                refreshTable();
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error('Error deleting room:', errorThrown);
            }
        });
    });

    // Your existing code for modal population
    function populateModalFields(roomData) {
        // Implement your logic to populate modal fields
    }
});
