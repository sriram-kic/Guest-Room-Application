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
