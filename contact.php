<?php
include('includes/head.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$mail = new PHPMailer(true);


if(isset($_POST['send'])){
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $email = $_POST['email'];
    $message = $_POST['message'];


    $mail->setFrom('system@prudentialhost.com', 'From Elegant Wardrobe');
    $mail->addAddress('developer@pslship.com', $name);
    // $mail->addAddress('ellen@example.com');
    $mail->addReplyTo($email, $name);

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Message From Elegant Wardrobe';
    $mail->Body    = '<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Email</title>
    </head>
    <body>
    <h2 style="text-align: center;">'.$name.'From Elegant Wardrobe</h2>
    <p style="text-align: center;">'.$message.'</p>
     
    </body>
    </html>';
    $mail->send();

    if($mail){
        $_SESSION['success_msg'] = "We got your message. Our agent will contact you soon.";
    }else{
        $_SESSION['error'] = "Error while proccessing. Please try again.";
    }

}



?>
<title>Contact Us</title>
</head>

<body>

    <?php
    include('includes/main-nav.php');
    ?>

    <div class="container">


    <?php
    if (isset($_SESSION['error'])) {
    ?>
        <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error'] ?></div>
    <?php
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success_msg'])) {
    ?>
        <div class="alert alert-success" role="alert"><?php echo $_SESSION['success_msg'] ?></div>
    <?php
        unset($_SESSION['success_msg']);
        # code...
    }
    ?>

        <div class="row">
            <div class="col-md-6">
                <h4 class="text-center">Elegant Wardrobe</h4>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
            </div>
            <div class="col-md-6">
                <h4 class="text-center">Send Us a Message</h4>
                <form method="post" action="contact.php">
                <div class="mb-3">
                        <label for="yourName" class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" id="yourName">
                    </div>
                    <div class="mb-3">
                        <label for="yourSubject" class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" id="yourSubject">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                    <label for="exampleMessage" class="form-label">Message</label>
                    <textarea class="form-control" name="message" id="exampleMessage" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" name="send" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>






    <?php
    include('includes/footer.php')
    ?>