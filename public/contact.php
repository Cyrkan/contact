<?php
header("Access-Control-Allow-Origin: https://bastiol.com");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['name'], $_POST['message'])) {
    $to = "support@bastiol.com"; 
    $from = $_POST['email'];
    $first_name = $_POST['name'];
    $subject = "Contact Form Submission";
    $message = "Message from " . $first_name . ":\n\n" . $_POST['message'];

    $headers = "From:" . $from . "\r\n" .
               'Reply-To: ' . $from . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    $telegram_token = 'YOUR_TELEGRAM_BOT_TOKEN';
    $telegram_chat_id = 'YOUR_CHAT_ID';

    $telegram_message = "📬 New Contact Form:\n\n";
    $telegram_message .= "👤 Name: $first_name\n";
    $telegram_message .= "✉ Email: $from\n";
    $telegram_message .= "📝 Message:\n" . $_POST['message'];

    file_get_contents("https://api.telegram.org/bot$telegram_token/sendMessage?chat_id=$telegram_chat_id&text=" . urlencode($telegram_message));
}

echo "OK";
?>