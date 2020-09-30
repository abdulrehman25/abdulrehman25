<?php
// Information to be modified

$your_email = "abdulrehmankhokhar25@gmail.com"; // email address to which the form data will be sent
$subject = "Portfolio Contact Us:"; // subject of the email that is sent
$thanks_page = "index.html"; // path to the thank you page following successful form submission
$contact_page = "index.html"; // path to the HTML contact page where the form appears


// Nothing needs to be modified below this line

if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['message'])) {
    header( "Location: $contact_page" );
}
else{
    $nam = $_POST["name"];
    $ema = trim($_POST["email"]);
    $msg = $_POST["message"];
    $web = $_POST["website"];

    $error_msg=array();

    if (empty($nam) || !preg_match("/^[\s.'\-\pL]{1,60}$/u", $nam)) {
        $error_msg[] = "The name field must contain only letters, spaces and basic punctuation (.&nbsp;-&nbsp;')";
    }

    if (empty($ema) || !filter_var($ema, FILTER_VALIDATE_EMAIL)) {
        $error_msg[] = "Your email must have a valid format, such as name@mailhost.com";
    }

    $limit = 1000;

    if (empty($msg) || !preg_match("/^[0-9\/\-\s'\(\)!\?\.,:;\pL]+$/u", $msg) || (strlen($msg) > $limit)) {
        $error_msg[] = "The Message field must contain only letters, digits, spaces and basic punctuation (&nbsp;'&nbsp;-&nbsp;,&nbsp;.&nbsp;:&nbsp;;&nbsp;/ and parentheses), and has a limit of 1000 characters";
    }

    if (!empty($spa) && !($spa == "4" || strtolower($spa) == "four")) {
        echo "You failed the bot test!";
        exit ();
    }
    if ($error_msg) {
        header( "Location: $contact_page" );
    }


    $email_body =
        "Name of sender: $nam\n\n" .
        "Email of sender: $ema\n\n" .
        "Website of the Sender : $web\n\n" .
        "MESSAGE:\n\n" .
        "$msg" ;

// Assuming there's no error, send the email and redirect to Thank You page

    if (isset($_REQUEST['message']) && !$error_msg) {
        if (mail ($your_email, $subject, $email_body, "From: $nam <$ema>" . "\r\n" . "Reply-To: $nam <$ema>" . "Content-Type: text/plain; charset=utf-8"))
        {
            echo "success";
        }
        else{
            echo "";
        }

    }
}