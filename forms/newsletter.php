<?php
// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  exit('Method Not Allowed');
}

// Receiving email
$receiving_email_address = 'khandgeshubham404@gmail.com';

// Include email form library
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
  include($php_email_form);
} else {
  die('Unable to load PHP Email Form library.');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  $email = strip_tags(trim($_POST['email']));
} else {
  die('Invalid email address.');
}

$contact->to = $receiving_email_address;
$contact->from_name = $email;
$contact->from_email = $email;
$contact->subject = "New Newsletter Subscription";

$contact->add_message($email, 'Subscriber Email');

echo $contact->send();
?>
