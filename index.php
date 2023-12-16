<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Sign in</title>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="js/login.js"></script>
<script src="js/logout.js"></script>
<script src="js/forgotpw.js"></script>
</head>

<body>

    <style>
        .divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%;
}
}
    </style>



    <section class="vh-100">
        <div class="container-fluid h-custom">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
              <img src="./image.gif"
                class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <form id="login" class="mt-1">
                    <div id="loginerrorMessage" class="alert alert-warning d-none"></div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" placeholder="name@example.com"
                                aria-describedby="emailHelp">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Password" name="pass">
                        </div>
                    </div>

                    <div class="forgot mt-3">
                        <p style="text-align: end;">
                            <a href="#" class="link-offset-2 link-underline link-underline-opacity-0"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">Forgotten password?</a>
                        </p>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-sm btn-primary" name="login">Login</button>
                    </div>
                </form>
                <!-- Button trigger modal -->

                <div class="d-grid gap-2 mt-3">
                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                        data-bs-target="#customerSignupModal">
                        Sign up as a Customer
                    </button>
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                        data-bs-target="#ownerSignupModal">
                        Sign up as a House owner
                    </button>
                </div>
            </div>
          </div>
        </div>
      </section>


      <!-- Customer Sign-up Modal -->
    <div class="modal fade" id="customerSignupModal" tabindex="-1" aria-labelledby="customerSignupModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customerSignupModalLabel">Sign Up as a Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="customerSignupForm">
                    <div id="errorMessagei" class="alert alert-warning d-none"></div>
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="mb-2">
                                <input type="email" class="form-control" id="emailInput" name="email"
                                    placeholder="example@gmail.com">
                            </div>
                            <div class="mb-2">
                                <input type="tel" class="form-control" id="contact_phone" name="contact"
                                    placeholder="E.g +91xxxxxxxxxx">
                            </div>

                            <div class="mb-2">
                                <input type="password" class="form-control" id="passwordInput" name="pass"
                                    placeholder="Password">
                                <span class="password__icon text-primary fs-4 fw-bold bi bi-eye-slash"></span>
                            </div>
                            <div class="mb-2">
                                <input type="password" class="form-control" id="passwordInput" name="cpass"
                                    placeholder="Retype the Password">
                                <span class="password__icon text-primary fs-4 fw-bold bi bi-eye-slash"></span>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="saveuser">Register</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- House Owner Sign-up Modal -->
<div class="modal fade" id="ownerSignupModal" tabindex="-1" aria-labelledby="ownerSignupModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ownerSignupModalLabel">Sign Up as a House Owner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="ownerSignupForm">
                    <div id="errorMessagei" class="alert alert-warning d-none"></div>
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="mb-2">
                                <input type="email" class="form-control" id="emailInput" name="email"
                                    placeholder="example@gmail.com">
                            </div>
                            <div class="mb-2">
                                <input type="tel" class="form-control" id="contact_phone" name="contact"
                                    placeholder="E.g +91xxxxxxxxxx">
                            </div>

                            <div class="mb-2">
                                <input type="password" class="form-control" id="passwordInput" name="pass"
                                    placeholder="Password">
                                <span class="password__icon text-primary fs-4 fw-bold bi bi-eye-slash"></span>
                            </div>
                            <div class="mb-2">
                                <input type="password" class="form-control" id="passwordInput" name="cpass"
                                    placeholder="Retype the Password">
                                <span class="password__icon text-primary fs-4 fw-bold bi bi-eye-slash"></span>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="saveuser">Register</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>



<!--Forgot password Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgot-password-modal-label">Forgot Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </button>
            </div>
            <div class="modal-body">
                <form id='reset' method="post">
                    <div class="form-group mb-2">
                        <label for="emailOrMobile">Email address</label>
                        <input type="text" class="form-control" id="emailOrMobile" name="emailOrMobile" required>
                        <small id="emailOrMobileHelp" class="form-text text-muted">
                            Enter either your email address to receive a reset link.
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
                                   
            </div>
        </div>
    </div>
</div>

</body>

</html>