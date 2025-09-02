<?php

include "connection.php";
session_start();

if (isset($_SESSION["arduino_user"])) {

    $userId = $_SESSION["arduino_user"]["id"];
    $rs = Database::search(("SELECT * FROM `user` WHERE `id`='$userId'"));

    if ($rs->num_rows < 1) {
        header("Location:sign-in.php");
    }

    $userDetails = $rs->fetch_assoc();

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile | Arduino Sri-Lanka</title>
        <link rel="icon" href="resources/logo/logo.png" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body class="overflow-x-hidden">

        <?php include "header.php" ?>


        <div class="container">

        <div class="row w-100 mt-3">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item"><a >User Profile</a></li>
                </ol>
            </nav>
        </div>

            <div class="row vh-90 d-flex justify-content-center align-items-start mt-4">

                <div class="col-11 col-lg-4 text-center">

                    <?php
                    $profile = "resources/profile_image/man.png";
                    if (isset($userDetails["profile_pic"])) {
                        $profileImg = $userDetails["profile_pic"];
                    }
                    ?>

                    <img src="<?php echo ($profileImg); ?>" alt="" height="200px" id="pImg">
                    <div class="my-3 text-start">
                        <label for="" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="profileImg">
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-secondary" onclick="uploadProfileImg();">UPLOAD</button>
                    </div>
                </div>

                <div class="col-11 col-lg-8 mt-3 mt-lg-0">
                    <div class="row">

                        <div class="col-12 mb-2">
                            <div class="row">
                                <div class="col-8"><u>
                                        <h4>Personal Details</h4>
                                    </u>
                                </div>
                                <div class="col-4 d-flex justify-content-end mt-1">
                                    <a href="user-signout.php" class="text-dark text-decoration-none bg-dark-subtle px-3 pt-1 rounded-2">Log Out &nbsp; <i class="bi bi-box-arrow-right"></i></a>
                                </div>
                            </div>

                        </div>

                        <div class="col-6 mb-2">
                            <label for="" class="form-label">First Name</label>
                            <input id="fname" type="text" class="form-control" value="<?php echo ($userDetails["fname"]); ?>">
                        </div>

                        <div class="col-6 mb-2">
                            <label for="" class="form-label">Last Name</label>
                            <input id="lname" type="text" class="form-control" value="<?php echo ($userDetails["lname"]); ?>">
                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Email</label>
                            <input type="text" class="form-control" value="<?php echo ($userDetails["email"]); ?>" disabled>
                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Mobile</label>
                            <input id="mobile" type="text" class="form-control" value="<?php echo ($userDetails["mobile"]); ?>">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-12 mb-2 mt-4">
                            <h4>Billing Details</h4>
                        </div>


                        <?php

                        $userAddressRs = Database::search("SELECT * FROM `user_address` INNER JOIN `destrict` ON `user_address`.`destrict_destrict_id`=`destrict`.`destrict_id`
                        INNER JOIN `province` ON `destrict`.`province_province_id`=`province`.`province_id` WHERE `user_id` = '$userId'");

                        $no = "";
                        $line1 = "";
                        $line2 = "";
                        $city = "";
                        $destrict = "";
                        $province = "";
                        $postalCode = "";

                        if ($userAddressRs->num_rows > 0) {
                            $address = $userAddressRs->fetch_assoc();

                            $no = $address["no"];
                            $line1 = $address["line1"];
                            $line2 = $address["line2"];
                            $city = $address["city"];
                            $destrict_id = $address["destrict_id"];
                            $destrict_name = $address["destict_name"];
                            $province = $address["province_name"];
                            $postalCode = $address["postal_code"];
                        }

                        ?>

                        <div class="col-3 mb-2">
                            <label for="" class="form-label">No</label>
                            <input id="no" type="text" class="form-control" value="<?php echo ($no); ?>">
                        </div>

                        <div class="col-9 mb-2">
                            <label for="" class="form-label">Address Line 1</label>
                            <input id="line1" type="text" class="form-control" value="<?php echo ($line1); ?>">
                        </div>

                        <div class="col-12 mb-2">
                            <label for="" class="form-label">Address Line 2 (Optional)</label>
                            <input id="line2" type="text" class="form-control" value="<?php echo ($line2); ?>">
                        </div>

                        <div class="col-6 mb-2">
                            <label for="" class="form-label">City</label>
                            <input id="city" type="text" class="form-control" value="<?php echo ($city); ?>">
                        </div>

                        <div class="col-6 mb-2">
                            <label class="form-label">Destrict</label>
                            <select class="form-select" id="destrict">
                                <option value="0">Select Destrict</option>
                                <?php
                                $rs = Database::search("SELECT * FROM `destrict`");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $d = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo ($d["destrict_id"]); ?>
                                    " <?php
                                        if (!empty($address["destrict_id"])) {
                                            if ($address["destrict_id"] == $d["destrict_id"]) {
                                        ?> selected <?php
                                                }
                                            }
                                                    ?>>
                                        <?php

                                        echo ($d["destict_name"]);
                                        ?>
                                    </option>
                                <?php
                                }

                                ?>

                            </select>
                        </div>

                        <div class="col-6 mb-2">
                            <label for="" class="form-label">Province</label>
                            <input type="text" class="form-control" value="<?php echo ($province); ?>" disabled>
                        </div>

                        <div class="col-6 mb-2">
                            <label for="" class="form-label">Postal Code</label>
                            <input id="pcode" type="text" class="form-control" value="<?php echo ($postalCode); ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mt-4">
                            <button class="btn btn-success w-100" onclick="updateProfile();">UPDATE PROFILE</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>


        <?php
        include "footer.php";
        ?>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="script.js"></script>
        <script src="bootstrap.min.js"></script>
        <script src="bootstrap.bundle.js"></script>

    </body>

    </html>


<?php

} else {
    header("Location:sign-in.php");
}

?>