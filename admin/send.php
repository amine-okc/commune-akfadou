<?php
    
    include("../dbconn.php");

    session_start();
    if (!isset($_SESSION['AdminLoginId']))
    {
        header("location: index.php");
    }

$email = $_POST['email'];
$from = $_POST['lname'];
$subject = $_POST['subject'];
$content = $_POST['message'];
$content = str_replace("'", "\'", $content);
$content = str_replace('"', "\"", $content);
$content = str_replace("  ", "&nbsp;&nbsp;", $content);
$content = nl2br($content);
if(mail($email, $subject, $content, $from)) echo "done"; ?>
