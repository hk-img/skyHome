<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    // $email = 'rahulsingh20.img@gmail.com';
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];
$mail = new PHPMailer(true);

try {
  
    $subject = 'Contact Form Submission';
    $emailBody = "<h3>New Contact Form Submission</h3>
                   <p><strong>Full Name:</strong> $fullName</p>
                   <p><strong>Email:</strong> $email</p>
                   <p><strong>Mobile:</strong> $mobile</p>
                   <p><strong>Message:</strong> $message</p>";
    $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->Username = 'nirzkumar15@gmail.com'; // YOUR email username
        $mail->Password = 'mqfx inej epdh noyo'; // YOUR email password

        $mail->setFrom('nirzkumar15@gmail.com', 'Sky Home');
        $mail->addAddress('officialskyhomes@gmail.com');
        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $emailBody;
        $ismailsent = $mail->send();
        if(!$ismailsent) {
            echo json_encode(['success' => false, 'message' => "Email could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
        } else {
            echo json_encode(['success' => true, 'message' => 'Email has been sent']);
        }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => "Email could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
}
}
?>