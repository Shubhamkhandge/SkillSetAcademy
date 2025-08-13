<?php
  /**
   * Newsletter form submission handler
   * Uses PHP Email Form library (Pro template only)
   * Documentation: https://bootstrapmade.com/php-email-form/
   */

  // Change this to your receiving email
  $receiving_email_address = 'khandgeshubham404@gmail.com';

  // Check if the PHP Email Form library exists
  if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
  } else {
    die('Unable to load the "PHP Email Form" library. Please ensure the file exists at: assets/vendor/php-email-form/php-email-form.php');
  }

  // Create a new form handler
  $contact = new PHP_Email_Form;
  $contact->ajax = true; // Enable AJAX

  // Validate and sanitize the email input
  if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $email = strip_tags(trim($_POST['email']));
  } else {
    die('Invalid email address.');
  }

  $contact->to = $receiving_email_address;
  $contact->from_name = $email;
  $contact->from_email = $email;
  $contact->subject = "New Newsletter Subscription";

  // Optional: SMTP settings (only if you plan to use SMTP)
  // Uncomment and update with correct credentials if needed
  /*
  $contact->smtp = array(
    'host' => 'smtp.yourserver.com',
    'username' => 'your_smtp_username',
    'password' => 'your_smtp_password',
    'port' => '587' // Use 465 for SSL, 587 for TLS
  );
  */

  // Add the message
  $contact->add_message($email, 'Subscriber Email');

  echo $contact->send();
?>
