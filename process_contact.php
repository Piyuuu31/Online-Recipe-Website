<?php
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.PHP';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Set up the email parameters
    $to = "balajidevtar5@gmail.com"; // Replace with your email address
    $subject = "New Contact Form Submission";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    $mail = newPHPMailer(true);
    $mail->isSMTP();
    $mail->HOST ="balajidevtar555@gmail.com";
    $mail->SMTPAuth=true;
    $mail->username ="balajidevtar5@gmail.com";
    $mail->Password='lygwsxqvhtljrjpv';
    $mail->Port=465;
    $mail->SMTPSecure="ssl";
    $mail->isHtml(true);
    $mail->setFrom($email,$name);
    $mail->addAddress("balajidevtar5@gmail.com");
    $mail->Subject = ("$email ($subject");
    $mail->Body = $message;
    $mail ->send();


    header("Location:contactus.php");


}
?>
