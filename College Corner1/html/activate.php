<?php
session_start();
include"dbconn.php";

 $subject = "College Coner Account Activation ";
 $sender_email = "From: collegecorner4217@gmail.com";
 if (mail($_SESSION["email"], $subject, $_SESSION["body"], $sender_email)) {
     // echo 'Email successfully sent to '.$email.'';
 } else {echo "Email sending failed...";}
if ((isset($_GET["stoken"]))||(isset($_GET["ttoken"]))) {
    if (isset($_GET["stoken"])) {
        $stoken = mysqli_real_escape_string($conn,$_GET["stoken"]);
        $emailquery = "UPDATE `loginstudent` SET `status` = 'active' WHERE `loginstudent`.`token` = '$stoken';";
        $query = mysqli_query($conn,$emailquery);
        if ($query) {
            header("location:login.php");
        }else {echo"Error";}
    }
    if (isset($_GET["ttoken"])) {
        $ttoken = mysqli_real_escape_string($conn,$_GET["ttoken"]);
        $emailquery = "UPDATE `loginteacher` SET `status` = 'active' WHERE `loginteacher`.`token` = '$ttoken';";
        $query = mysqli_query($conn,$emailquery);
        if ($query) {header("location:login.php");}else {echo"Error";}
    }
}
else{
    // echo"Check Your Email ".$_SESSION["email"]."  Your Email is Not Yet Activated....";
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="./fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/css/all.css">
        <link rel="stylesheet" href="../css/check.css">
    </head>
    <body onload="hi()">
        <div class="con">
            <h1>Your Account! Not Activated Yet</h1>
            <h2>Hi <strong class="name">'.$_SESSION["name"].'</strong>, Check <i class="far fa-envelope"><span class="emailcss">'.$_SESSION["email"].'</span></i> For Activate Your Account</h2>
            <img class="emailGif" src="../img/emailGif2.gif" alt="">
        </div>
    </body>
    </html>';
}
?>