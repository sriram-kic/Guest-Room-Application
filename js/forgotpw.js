$(document).ready(function() {
    $('#reset').on('submit', function(event) {
        event.preventDefault();

        var emailOrMobile = $('#emailOrMobile').val();

        $.ajax({
            url: 'php/forgot.php',
            type: 'POST',
            data: {
                emailOrMobile: emailOrMobile
            },
            success: function(data) {
                if (data === 'success') {
                    alert('A reset link has been sent to your email.');
                    // Redirect the user to a confirmation page or perform further actions
                    // window.location.href = 'confirmation.html';
                } else if (data === 'not_found') {
                    alert('Email or mobile number not found.');
                } else if (data === 'email_not_validated') {
                    alert('Please enter a valid email address.');
                } else {
                    alert('There was an error. Please try again later.');
                }
            },
            error: function() {
                alert('There was an error. Please try again later.');
            }
        });
    });
});
