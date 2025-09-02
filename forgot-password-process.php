<?php

include "connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "mail/PHPMailer.php";
require "mail/SMTP.php";
require "mail/Exception.php";

$email = $_GET["email"];

if (empty($email)) {
    echo ("Please enter your email address");
} else {

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='$email'");
    $num = $rs->num_rows;

    if ($num > 0) {

        $row = $rs->fetch_assoc();
        $vcode = uniqid();

        Database::iud("UPDATE `user` SET `vcode`='$vcode' WHERE `id`='" . $row["id"] . "'");

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'thimiraw3@gmail.com';
            $mail->Password = 'vijt hmzr rhee batp';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('thimiraw3@gmail.com', 'Arduino Sri-Lanka');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Reset your account password';
            $mail->Body = '<table style="width:100%; font-family: sans-serif;">
    <tbody>
        <tr>
            <td align="center">
                <table style="max-width: 600px;">
                    <tr>
                        <td>
                            <a href="#" style="font-size: 35px; color: #03989E; font-weight: bold; text-decoration: none;">Arduino Sri-Lanka</a>
                            <hr>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h1 style="font-size: 25px; font-weight: bold; line-height: 45px;">Reset Your Password</h1>
                            <p style="margin-bottom: 24px;">You can reset your password by clicking the button below</p>
                            <div>
                                <a href="http://localhost/arduino-srilanka/reset-password.php?code=' . $vcode . '" style="display: inline-block; background-color: #03989E; color: white  ;
                                border-radius: 8px; padding: 15px; text-decoration: none;">
                                    <span>Reset Password</span>
                                </a>
                            </div>
                            <p>If you didn\'t requested to reset password, Please ignore this email</p>
                            <hr>
                        </td>
                    </tr>

                    <tr>
                        <td align="center">
                            <p>&copy; 2024 arduino-srilanka.lk</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>';

            $mail->send();
            echo 'success';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo ("User not found with the given email");
    }
}
