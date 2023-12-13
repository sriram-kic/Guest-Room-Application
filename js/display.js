$(document).ready(function () {
    // Function to refresh room cards on the page
    function refreshCards(data) {
        $('#cardContainer').empty();

        data.forEach(function (room) {
            let cardHtml = `
                <div class="col-lg-6 mb-4">
                    <div class="card h-10">
                        <div class="row g-0">
                        <0div.class="col-lg-6">
                        </div>
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

    // Function to handle editing a room
    function editRoom(roomId) {
        // You can implement this function to open the edit modal and populate it with current details
        // For simplicity, let's assume you have an editModalContent function
        let modalContent = getEditModalContent(roomId);
        $('#editModal .modal-body').html(modalContent);

        // Show the edit modal
        $('#editModal').modal('show');
    }

    // Event listener for the "Edit" button on room cards
    $('#cardContainer').on('click', '.btn-success', function () {
        let roomId = $(this).data('room-id');
        editRoom(roomId);
    });

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
    refreshTable();

    // Example: Function to fetch edit modal content based on room ID
    function getEditModalContent(roomId) {
        // You need to implement this function to retrieve current details for editing
        // For demonstration, let's assume you have a PHP script to fetch room details by ID
        let modalContent = '';
        $.ajax({
            url: 'php/fetch_room_details.php',
            type: 'GET',
            data: { room_id: roomId },
            dataType: 'json',
            async: false, // Ensure synchronous execution
            success: function (response) {
                modalContent = response.modal_content;
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error('Error fetching room details:', errorThrown);
            }
        });
        return modalContent;
    }
});


    
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
    