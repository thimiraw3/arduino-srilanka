<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Arduino Sri-Lanka</title>
    <link rel="icon" href="resources/logo/logo.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
</head>

<body class="background">

    <div class="container">

        <div class="row vh-100 d-flex justify-content-center align-items-center">

            <!-- Sign in box -->
            <div class="d-none col-10 col-md-6 col-lg-5" id="signinBox">
                <div class="row card opacity-75 rounded-5">
                    <div class="card-body">

                        <div class="col-12">
                            <h2 class="text-center">Sign In</h2>
                        </div>

                        <?php

                        $email = "";
                        $password = "";

                        if (isset($_COOKIE["email"])) {
                            $email = $_COOKIE["email"];
                        }

                        if (isset($_COOKIE["password"])) {
                            $password = $_COOKIE["password"];
                        }

                        ?>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="">Email Address</label>
                            <input id="em" class="form-control rounded-5" type="email" value="<?php echo ($email); ?>" />
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="">Password</label>
                            <input id="pw" class="form-control rounded-5" type="password" value="<?php echo ($password); ?>" />
                        </div>

                        <div class="col-12 mb-3">
                            <input id="rmb" class="form-check-input" type="checkbox" <?php
                                                                                        if (isset($_COOKIE["email"])) {
                                                                                            echo ("checked");
                                                                                        }

                                                                                        ?> />
                            <label for="form-check-label">Remember Me</label>
                        </div>

                        <div class="d-grid mb-3">
                            <button class="btn btn-secondary rounded-5" onclick="signin();">SIGN IN</button>
                        </div>

                        <div class="text-center">
                            <a class="link-danger text-decoration-none" href="forgot-password.php">Forgot Password?</a>
                        </div>

                        <div class="text-center">
                            <a class="link-light text-decoration-none" onclick="changeView();">Don't have an account? Sign Up</a>
                        </div>

                    </div>
                </div>
            </div>
            <!-- sign in box -->

            <!-- Sign up box -->
            <div class=" col-10 col-md-6 col-lg-5" id="signupBox">
                <div class="row card opacity-75 rounded-5">
                    <div class="card-body">

                        <div class="col-12 mb-3">
                            <h2 class="text-center">Sign Up</h2>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label" for="">First Name</label>
                                <input class="form-control rounded-5" type="text" id="fname" />
                            </div>

                            <div class="col-6 mb-3">
                                <label class="form-label" for="">Last Name</label>
                                <input class="form-control rounded-5" type="text" id="lname" />
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="">Mobile</label>
                            <input class="form-control rounded-5" type="email" id="mobile" />
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="">Email Address</label>
                            <input class="form-control rounded-5" type="email" id="email" />
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="">Password</label>
                            <input class="form-control rounded-5" type="password" id="password" />
                        </div>

                        <div class="d-grid mb-3">
                            <button class="btn btn-secondary rounded-5" onclick="signup();">SIGN UP</button>
                        </div>

                        <div class="text-center">
                            <a class="link-light text-decoration-none" onclick="changeView();">Already have an account? Sign In</a>
                        </div>

                    </div>
                </div>
            </div>
            <!-- sign up box -->
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>

</body>

</html>