<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form values
    $email = isset($_POST['emailid']) ? $_POST['emailid'] : '';
    $mobile = isset($_POST['mobilenumber']) ? $_POST['mobilenumber'] : '';
    $currentEmployer = isset($_POST['current_employer']) ? $_POST['current_employer'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $yearExp = isset($_POST['yearexp']) ? $_POST['yearexp'] : '';
    $monthExp = isset($_POST['monthexp']) ? $_POST['monthexp'] : '';
    $qualification = isset($_POST['qualification']) ? $_POST['qualification'] : '';
    $presentSalary = isset($_POST['present_salary']) ? $_POST['present_salary'] : '';
    $expectedSalary = isset($_POST['expected_salary']) ? $_POST['expected_salary'] : '';
    $applyingPost = isset($_POST['applying_post']) ? $_POST['applying_post'] : '';
    $file = isset($_FILES['file']) ? $_FILES['file'] : '';


    $subject = 'New Job Application: ' . $applyingPost;

    // Email body
    $emailBody = "
    <html>
    <head>
        <title>New Job Application</title>
    </head>
    <body>
        <h2>Job Application Details</h2>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Mobile Number:</strong> {$mobile}</p>
        <p><strong>Current Employer:</strong> {$currentEmployer}</p>
        <p><strong>Address:</strong> {$address}</p>
        <p><strong>Years of Experience:</strong> {$yearExp}</p>
        <p><strong>Months of Experience:</strong> {$monthExp}</p>
        <p><strong>Qualification:</strong> {$qualification}</p>
        <p><strong>Present Salary:</strong> {$presentSalary}</p>
        <p><strong>Expected Salary:</strong> {$expectedSalary}</p>
        <p><strong>Applying for Post:</strong> {$applyingPost}</p>
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
    $mail->addAddress('officialskyhomes@gmail.com');
    $mail->IsHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $emailBody;

    if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
        $mail->addAttachment($file['tmp_name'], $file['name']);
    }

    $ismailsent = $mail->send();
    if(!$ismailsent) {
        echo json_encode(['success' => false, 'message' => "Email could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    } else {
        echo json_encode(['success' => true, 'message' => 'Email has been sent']);
    }

}

?>