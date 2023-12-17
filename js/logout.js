    // To logout from their respective page
$(document).ready(function() {
    $('#logoutBtn').click(function() {
        $.ajax({
            url: 'php/logout.php',
            type: 'POST',
            data: { action: 'logout' }, 
            dataType: 'json', 
            success: function(response) {
                if (response.status === 'success') { 
                    window.location.href = 'index.php';
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
