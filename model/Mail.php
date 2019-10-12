<?php
require_once '/path/to/vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
  ->setUsername('adeldoudou1996@gamil.com')
  ->setPassword('your password')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Sujet'))
  ->setFrom(['adeldoudou1996@gmail.com' => 'Adel'])
  ->setTo(['adeldoudou1996@gmail.com', 'other@domain.org' => 'A name'])
  ->setBody('Here is the message itself')
  ;

// Send the message
$result = $mailer->send($message);