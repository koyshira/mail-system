<?php

// Include PHPMailer.php and SMTP.php
require '../modules/PHPMailer/PHPMailer.php';
require '../modules/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;

require '../config/conf.php';
require '../handlers/get-templates.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // Create a new PHPMailer instance
  $mail = new PHPMailer(); // Instantiate the PHPMailer class

  try {
      // Set SMTP settings
      $mail->isSMTP();
      $mail->Host = $smtpHost;
      $mail->Port = $smtpPort;
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'tls';
      $mail->Username = $smtpUsername;
      $mail->Password = $smtpPassword;

      $to = $email;

      // Set sender and recipient
      $mail->setFrom($from, $fromName);
      $mail->addAddress($to, $name);

      // Set email content
      $mail->Subject = $subject;
      if ($sendCopy) {
          $mail->addCC($copyRecipient, $copyRecipient);
      }
      if ($htmlMode) {
          $mail->isHTML(true);
          if ($template) {
            $content = loadEmailTemplate($template, [
              'name' => $name,
              'email' => $email,
              'message' => $message,
              'from' => $from,
              'fromName' => $fromName,
            ]);

            $mail -> msgHTML($content);
          }
      } else {
          $mail->Body = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message";
      }
      
      // Send email
      if (!$mail->send()) {
          throw new \Exception('Mailer Error: ' . $mail->ErrorInfo);
      }

      echo $successMsg;
  } catch (\Exception $e) {
      echo 'Error: ' . $e->getMessage();
  }
} else {
    echo 'Error: Request method not accepted';
}
