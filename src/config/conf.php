<?php

require('env.php');

// SMTP settings
$smtpHost = $env['SMTP_HOST'];
$smtpPort = $env['SMTP_PORT'];
$smtpUsername = $env['SMTP_USERNAME'];
$smtpPassword = $env['SMTP_PASSWORD'];

// Sender and recipient
$from = $mailUser['MAIL'];
$fromName = $mailUser['NAME'];

// Email content
$subject = 'New message ' . date('d.m.Y H:i');

$htmlMode = true;

$template = 'main';

$sendCopy = false;
$copyRecipient = ''; 

// Success Message
$successMsg = 'Your message has been successfully sent. We will get back to you as soon as possible!';
