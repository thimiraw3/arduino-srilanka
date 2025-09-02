<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Arduino Sri-Lanka</title>
    <link rel="icon" href="resources/logo/logo.png" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
</head>

<body class="background">

    <div class="container">
        <div class="row vh-100 d-flex justify-content-center align-items-center">

            <!-- Sign in box -->
            <div class="col-10 col-lg-4" id="signinBox">
                <div class="row card opacity-75 rounded-5">
                    <div class="card-body">

                        <div class="col-12">
                            <h2 class="text-center">Forgot Password</h2>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="">Email Address</label>
                            <input id="email" class="form-control" type="email" />
                        </div>

                        <div class="d-grid mb-3">
                            <button class="btn btn-secondary" onclick="forgotPassword();">SEND</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- sign in box -->

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
</body>

</html>