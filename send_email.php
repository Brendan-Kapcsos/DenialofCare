<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    $to = "brendan@newprospectllc.com";
    $bcc = "eamon@newprospectllc.com, adam@cookerly.com";
    $subject = "Vote NO on Denial of Care provision (SB 68)!";

    // please replace abc@gmail.com with the website email, which should relate to the website
    $headers = "From: constituent@denialofcare.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "BCC: $bcc\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Message:\n$message\n";

    if (mail($to, $subject, $email_body, $headers)) {
        echo "Your message has been sent successfully.";
    } else {
        echo "Error sending message. Please try again later.";
    }
} else {
    echo "Invalid request.";
}
?>
