$(document).ready(function() {
    $('#logoutBtn').click(function() {
        $.ajax({
            url: 'php/logout.php',
            type: 'POST',
            data: { action: 'logout' }, 
            dataType: 'json', // Specify that the expected response is JSON
            success: function(response) {
                if (response.status === 'success') { // Check response.status
                    window.location.href = 'register.html';
                } else {
                    console.log('Logout failed');
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
});
