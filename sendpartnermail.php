<?php

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = isset($_POST['partner_fullname']) ? $_POST['partner_fullname'] : '';
    $email = isset($_POST['partner_emailid']) ? $_POST['partner_emailid'] : '';
    $mobile = isset($_POST['partner_mobilenumber']) ? $_POST['partner_mobilenumber'] : '';
    $address = isset($_POST['partner_address']) ? $_POST['partner_address'] : '';

    // Here you can send the data to email or save it to a database
    $to = 'your-email@example.com'; // Change to the recipient's email
    $subject = 'New Partner Form Submission';
    $emailBody  = "
    <html>
    <head>
        <title>New Form Submission</title>
    </head>
    <body>
        <h2>New Partner Details</h2>
        <p><strong>Name:</strong> {$fullname}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Mobile:</strong> {$mobile}</p>
        <p><strong>Address:</strong> {$address}</p>
    </body>
    </html>
    ";
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->Username = 'nirzkumar15@gmail.com'; // YOUR email username
    $mail->Password = 'mqfx inej epdh noyo'; // YOUR email password

    $mail->setFrom('nirzkumar15@gmail.com', 'Sky Home');
    $mail->addAddress('nirzkumar15@gmail.com');
    $mail->IsHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $emailBody;
    $ismailsent = $mail->send();
    if(!$ismailsent) {
        echo json_encode(['success' => false, 'message' => "Email could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    } else {
        echo json_encode(['success' => true, 'message' => 'Email has been sent']);
    }
}