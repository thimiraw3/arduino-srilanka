<?php

include "connection.php";

$ststus = $_GET["status"];

$msg_rs = Database::search("SELECT DISTINCT `sender` FROM `message` WHERE `sender`!='1' AND `status`='$ststus' ");
$msg_num = $msg_rs->num_rows;

for ($x = 0; $x < $msg_num; $x++) {
    $msg_data = $msg_rs->fetch_assoc();

    $sender = $msg_data["sender"];

    $user_rs = Database::search("SELECT * FROM `user` WHERE `id`='" . $sender . "'");

    $user_data = $user_rs->fetch_assoc();

?>

    <div class="list-group rounded">
        <a onclick="loadAdminChat(<?php echo $sender ?>);" class="list-group-item list-group-item-action text-white rounded bg-primary">

            <div class="media">

                <div class="d-flex align-items-center justify-content-between mb-">
                    <?php
                    if (isset($user_data["profile_pic"])) {
                    ?>
                        <img src="<?php echo $user_data["profile_pic"]; ?>" width="50px" class="rounded-circle">
                    <?php
                    } else {
                    ?>
                        <img src="resources/profile_image/man.png" width="50px" class="rounded-circle">
                    <?php
                    }
                    ?>
                    <h6 class="mb-0 fw-bold"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></h6>

                </div>
            </div>
        </a>

    </div>

<?php
}
?>