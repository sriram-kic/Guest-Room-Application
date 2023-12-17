$(document).on('submit', '#ownerSignupForm', function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    formData.append("ownerSignupForm", true);
    $.ajax({
        type: "POST",
        url: "php/register.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            let res = JSON.parse(response);

            if (res.status == 422) {
                $('#errorMessagei').removeClass('d-none');
                $('#errorMessagei').text(res.message);
                alertify.set('notifier', 'position', 'top-right');
                alertify.error(res.message);
            } else if (res.status == 200) {
                Swal.fire(
                    'Congratulations!',
                    'Your account has been successfully created',
                    'success'
                ).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        window.location.href = "index.php";
                    }
                });
            } else if (res.status == 500) {
                $('#errorMessagei').removeClass('d-none');
                $('#errorMessagei').text(res.message);
                alertify.set('notifier', 'position', 'top-right');
                alertify.error(res.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error occurred, please try again.');
        }
    });
});

$(document).on('submit', '#customerSignupForm', function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    formData.append("customerSignupForm", true);
    $.ajax({
        type: "POST",
        url: "php/register.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            let res = JSON.parse(response);

            if (res.status == 422) {
                $('#errorMessagei').removeClass('d-none');
                $('#errorMessagei').text(res.message);
                alertify.set('notifier', 'position', 'top-right');
                alertify.error(res.message);
            } else if (res.status == 200) {
                Swal.fire(
                    'Congratulations!',
                    'Your account has been successfully created',
                    'success'
                ).then((result) => {
                    if (result.isConfirmed || result.isDismissed) {
                        window.location.href = "index.php";
                    }
                });
            } else if (res.status == 500) {
                $('#errorMessagei').removeClass('d-none');
                $('#errorMessagei').text(res.message);
                alertify.set('notifier', 'position', 'top-right');
                alertify.error(res.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error occurred, please try again.');
        }
    });
});

// Check if passwords match
$(document).on('change', '#pass, #cpass', function() {
    let pass = $('#pass').val();
    let cpass = $('#cpass').val();

    if (pass !== cpass) {
        $('#passwordMismatchAlert').removeClass('d-none');
    } else {
        $('#passwordMismatchAlert').addClass('d-none');
    }
});
