<?php

session_start();

$email = "";
$password = "";

if (isset($_COOKIE["email"])) {
    $email = $_COOKIE["email"];
}
if (isset($_COOKIE["password"])) {
    $password = $_COOKIE["password"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Authentication | Teem Meet</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

</head>

<body class="bg-white">

    <div class="container-fluid d-flex justify-content-center align-items-center vh-100 ">

        <div class="d-flex align-items-center justify-content-center col-12 col-md-10 col-lg-8 gap-4">

            <div class="col-10 col-md-6 d-none d-md-none d-lg-block " data-aos="fade-right" data-aos-duration="2000">
                <h3 class="welcome">Welcome to</h3>
                <h1 class="charityName">TEAM MEET</h1>
                <p class="auth-paragraph mt-4 ">Boost teamwork with a dynamic system for real-time task management. Coordinate, assign, and track progress effortlessly, fostering seamless <span class="multi-text fs-4 fw-bold"></span> </p>

                <span class="mt-5">Follow us :</span>

                <div class="mt-3 d-flex gap-4 social-media">

                    <a href="https://www.instagram.com/"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://twitter.com/"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://www.youtube.com/"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></i></a>

                </div>

            </div>

            <!-- Sign In -->
            <div class="col-12 col-md-8 col-lg-6 d-flex flex-column justify-content-center align-items-center border border-2 rounded-4" id="signInBox" data-aos="zoom-in-down" data-aos-duration="2000">

                <div class="toggle-box d-flex mb-4">
                    <div class="d1-toggle" id="d1" onclick="changeViewD1();">Sign In</div>
                    <div class="d2" id="d2" onclick="changeViewD2();">Sign Up</div>
                </div>

                <div class="top-box d-block d-lg-none">
                    <div>
                        <span style="font-size: 12px;">Welcome to</span>
                        <h2 class="fw-bold">MY CHARITY</h2>
                    </div>
                </div>

                <div class="top-box my-3 mb-md-4 text-start text-md-center">
                    <span class="fw-semibold d-block d-md-none">Sign into your account</span>
                    <span class="fw-bold fs-4 d-none d-md-block">Sign into your account</span>
                </div>

                <div class="input-1 input-group mb-4 rounded-3 px-2 py-1">
                    <span class="input-group-text border-0 bg-transparent" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Email Address" id="loginEmail" required value="<?php echo ($email); ?>">
                </div>

                <div class="input-1 input-group mb-4 rounded-3 px-2 py-1">
                    <span class="input-group-text border-0 bg-transparent" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" class="form-control border-0 shadow-none" placeholder="Password" id="loginPassword" required value="<?php echo ($password); ?>">
                </div>

                <div class="input-2 d-flex justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input shadow-none" type="checkbox" id="rememberMe">
                        <label class="form-check-label" for="flexCheckDefault">
                            Remember Me
                        </label>
                    </div>
                    <span class="forgot-password" style="cursor:pointer;" onclick="forgotPasswordSendVerificationProcess();">Forgot Password?</span>
                </div>

                <button class="signinButton btn btn-primary mt-3 mb-5" onclick="signInProcess();">SIGN IN</button>
            </div>

            <!-- Sign Up -->
            <div class="col-12 col-md-8 col-lg-6  d-flex flex-column justify-content-center align-items-center border border-2 rounded-4 py-5 d-none" id="signUpBox" data-aos="zoom-in-up" data-aos-duration="2000">

                <div class="toggle-box d-flex mb-2 mb-md-3">
                    <div class="d1" id="d1" onclick="changeViewD1();">Sign In</div>
                    <div class="d2-toggle" id="d2" onclick="changeViewD2();">Sign Up</div>
                </div>

                <div class="top-box d-block d-lg-none">
                    <div>
                        <span style="font-size: 12px;">Welcome to</span>
                        <h2 class="fw-bold">MY CHARITY</h2>
                    </div>
                </div>

                <div class="top-box my-2 my-md-2 text-start text-md-center">
                    <span class="fw-semibold d-block d-md-none">Create an account</span>
                    <span class="fw-bold fs-4 d-none d-md-block">Create an account</span>
                </div>

                <div class="input-3 input-group mb-4 rounded-3  px-2 py-1">
                    <span class="input-group-text border-0 bg-transparent" id="basic-addon1"><i class="fa-solid fa-envelope"></i></span>
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Email Address" id="signUpEmail">
                </div>

                <div class="d-flex gap-2 ">
                    <div class="input-4 input-group mb-4 rounded-3  px-2 py-1">
                        <span class="input-group-text border-0 bg-transparent" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control border-0 shadow-none" placeholder="First Name" id="signUpFirstName">
                    </div>
                    <div class="input-4 input-group mb-4 rounded-3  px-2 py-1">
                        <span class="input-group-text border-0 bg-transparent" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Last Name" id="signUpLastName">
                    </div>
                </div>

               

                <div class="input-3 input-group mb-4 rounded-3  px-2 py-1">
                    <span class="input-group-text border-0 bg-transparent" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" class="form-control border-0 shadow-none" placeholder="Password" id="signUpPassword">
                </div>

                <div class="input-3 input-group mb-4 rounded-3  px-2 py-1">
                    <span class="input-group-text border-0 bg-transparent" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" class="form-control border-0 shadow-none" placeholder="Re Type Password" id="signUpRePassword">
                </div>

                <button class="signUpButton btn btn-primary" onclick="signUpProcess();">SIGN UP</button>

            </div>

        </div>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="userVerificationModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-circle-exclamation me-2 fs-5" style="color: #071952;"></i>Account Verification</h1>
                </div>
                <div class="modal-body d-flex flex-column justify-content-center align-items-center ">
                    <div class="w-75 my-2">
                        <span class="fw-semibold">Enter verification code</span>
                    </div>
                    <input type="text" class="verification-input w-75" id="code">
                    <div class="w-75 mt-4">
                        <p class="text-secondary">Verification code has been sent to your email. Please check your inbox.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary border-0" style="background-color: #088395;" onclick="confirmVerificationCode(document.getElementById('loginEmail').value);">Verify</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-circle-exclamation me-2 fs-5" style="color: #071952;"></i>Account Verification</h1>
                </div>
                <div class="modal-body d-flex flex-column justify-content-center align-items-center ">
                    <div class="w-75 my-1">
                        <span class="fw-semibold">Enter verification code <span class="fw-normal">(Check Your Email)</span></span>
                    </div>
                    <input type="text" class="verification-input w-75" id="forgotPwCode">
                   
                </div>

                <div class="modal-body d-flex flex-column justify-content-center align-items-center ">
                    <div class="w-75 my-1">
                        <span class="fw-semibold">New Password</span>
                    </div>
                    <input type="text" class="verification-input w-75" id="forgotPw">
                
                </div>

                <div class="modal-body d-flex flex-column justify-content-center align-items-center ">
                    <div class="w-75 my-1">
                        <span class="fw-semibold">Re Type New Password</span>
                    </div>
                    <input type="text" class="verification-input w-75" id="forgotRePw">
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary border-0" style="background-color: #088395;" onclick="forgotPasswordProcess();">Verify</button>
                </div>
            </div>
        </div>
    </div>

    <!-- loader Modal -->
    <div class="modal fade" id="loaderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body d-flex flex-column p-3 gap-3 justify-content-center align-items-center">
                    <img src="resources/loader.gif" class="mt-2">
                    <p>Sending verification email.<br> please wait a moment!</p>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/0dab43209e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
    <script>
        var typed = new Typed(".multi-text", {
            strings: ["COLLABORATION", " PRODUCTIVITY"],
            typeSpeed: 50,
            backSpeed: 50,
            backDelay: 1000,
            startDelay: 3000,
            loop: true,
        })
    </script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>