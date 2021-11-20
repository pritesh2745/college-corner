<?php
    session_start();
   include("dbconn.php");
   $_SESSION["passnotmatch"] = 0;
    $_SESSION["passnot8"] = 0;
   if (isset($_POST["next"])) {
    $_SESSION["passnotmatch"] = 0;
    $_SESSION["passnot8"] = 0;
    $cpassword = mysqli_real_escape_string($conn,$_POST["cpassword"]);
    $password = mysqli_real_escape_string($conn,$_POST["password"]);
    $pass = password_hash($password,PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword,PASSWORD_BCRYPT);
    if (strlen($password) < 8) {
        // echo "Password atleast Of 8";
        $_SESSION["passnot8"] = 1;
    }
    else{
    if ($password === $cpassword) {
        if (isset($_GET["stoken"])) {
            $stoken = mysqli_real_escape_string($conn,$_GET["stoken"]);
            $emailquery = "UPDATE `loginstudent` SET `password` = '$pass' WHERE `loginstudent`.`token` = '$stoken';";
            $query = mysqli_query($conn,$emailquery);
            if ($query) {header("location:login.php");}else {echo"Error";}
        }
        if (isset($_GET["ttoken"])) {
            $ttoken = mysqli_real_escape_string($conn,$_GET["ttoken"]);
            $emailquery = "UPDATE `loginteacher` SET `password` = '$pass' WHERE `loginteacher`.`token` = '$ttoken';";
            $query = mysqli_query($conn,$emailquery);
            if ($query) {header("location:login.php");}else {echo"Error";}
        }
    }
    else{
        $_SESSION["passnotmatch"] = 1;
    }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recovery Password</title>
    <link rel="stylesheet" href="../css/forgetPassword.css">
</head>
<body>
 <?php
if ((isset($_GET["stoken"]))||(isset($_GET["ttoken"]))) {
    echo'
    <div class="forgetContainer">
    <form action="" method="post">

    <img src="../img/college Corner.png" alt="" srcset="">

    <div class="forgetInner">
    <h4>Password : </h4>
    <input type="password" class="input password email" name = "password"required>
    </div>

    <div class="forgetInner">
    <h4>Confirm : </h4>
    <input type="password" class="input password email" name = "cpassword"required>
    </div>

    <div class="forgetInner">
    <input type="submit" class="btn" value="Submit" name = "next">
    </div>

</form>
</div>
';
if ($_SESSION["passnot8"] === 1) {
    echo'<div class="alert">
        <h6>Password contain Atleat 8 char</h6>
    </div>';
}
if ($_SESSION["passnotmatch"] === 1) {
    echo'<div class="alert">
        <h6>Password And Conform Password Not Macth</h6>
    </div>';
}
}
else{
    echo'
    <div class="forgetContainer">
        <form action="">
    <img src="../img/college Corner.png" alt="" srcset="">
    <div class="forgetInner">
            <h4>Check Your Email : '.$_SESSION["email"].'</h4>
    </div>
        </form>
    </div>';
}
?>
</body>
</html>