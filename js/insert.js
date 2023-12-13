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