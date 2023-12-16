$(document).on('submit', '#login', function(e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("login", true);

    $.ajax({
        type: "POST",
        url: "php/login.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            var res = JSON.parse(response);
            if (res.status == 422 || res.status == 500) {
                $('#loginerrorMessage').removeClass('d-none').text(res.message);
            } else if (res.status == 300) {
                Swal.fire({
                    icon: 'success',
                    title: 'Login successfully',
                    text: 'success'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        if (res.user_role === 'OWNER') {
                            window.location.href = "owner.php";
                        } 
                        else if (res.user_role === 'CUSTOMER') {
                            window.location.href = "customer.php";
                        } 
                       else {
                            window.location.href = "index.php";
                        } 
                    }
                });
            }
        },
        
        error: function() {
            console.log("An error occurred during the AJAX request.");
        }
    });
});
