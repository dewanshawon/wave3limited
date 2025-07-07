<?php
// Initialize message and error variables for contact form submission
$message = '';
$error = '';

// Handle contact form submission: send email to support@wave3limited.com and wave3limited@gmail.com
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''), ENT_QUOTES, 'UTF-8');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject'] ?? ''), ENT_QUOTES, 'UTF-8');
    $message_content = htmlspecialchars(trim($_POST['message'] ?? ''), ENT_QUOTES, 'UTF-8');

    if ($name && $email && $subject && $message_content) {
        $to = 'support@wave3limited.com, wave3limited@gmail.com';
        $headers = [
            'From' => $name . ' <' . $email . '>',
            'Reply-To' => $email,
            'Content-Type' => 'text/plain; charset=UTF-8',
            'X-Mailer' => 'PHP/' . phpversion()
        ];
        $mail_subject = "Contact Form: " . $subject;
        $mail_body = "Name: $name\nEmail: $email\n\nMessage:\n$message_content";
        
        $headers_str = '';
        foreach ($headers as $key => $value) {
            $headers_str .= "$key: $value\r\n";
        }
        
        if (mail($to, $mail_subject, $mail_body, $headers_str)) {
            $message = "Thank you for your message! We'll get back to you soon.";
        } else {
            $error = "Sorry, there was an error sending your message. Please try again later.";
        }
    } else {
        $error = "Please fill in all required fields with valid data.";
    }
}
?>
