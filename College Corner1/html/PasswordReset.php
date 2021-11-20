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
            if ($query) {header("location:unlock.php");}else {echo"Error";}
        }
        if (isset($_GET["ttoken"])) {
            $ttoken = mysqli_real_escape_string($conn,$_GET["ttoken"]);
            $emailquery = "UPDATE `loginteacher` SET `password` = '$pass' WHERE `loginteacher`.`token` = '$ttoken';";
            $query = mysqli_query($conn,$emailquery);
            if ($query) {header("location:unlock.php");}else {echo"Error";}
        }
    }
    else{
        $_SESSION["passnotmatch"] = 1;
    }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
            integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php
if ((isset($_GET["stoken"]))||(isset($_GET["ttoken"]))) {
    echo'
	<img class="wave" src="../img/wave.png">
	<div class="container" style="background-color:white-somke;">
		<div class="img">
        <img src="../img/undraw_authentication_fsn5.svg" alt="">
		</div>
		<div class="login-content">
        <form action="" method="post">
				<h2 class="title">Password Recovery</h2>
           		<div class="input-div one">
           		   <div class="i">
					  <i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
                      <h5>Password</h5>
                      <input type="password" class="input email" name = "password"required>
           		   </div>
                      </div>
                      <div class="input-div one">
           		   <div class="i">
					  <i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
                      <h5>Confirm Password</h5>
                      <input type="password" class="input email" name = "cpassword"required>
           		   </div>
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
                      echo'
                     <input type="submit" class="btn" value="Next" name = "next">
                      </form>
                      </div>
                      </div>';}
                      else {
                          echo'
                          <div class="container">
                              <div class="img">
                                  <img src="../img/emailGif3.gif" alt="">
                              </div>
                              <div class="login-content">
                                  <form action="">
                                      <h2 class="title">Confirmation</h2>
                                         <div class="input-div one">
                                            <div class="i">
                                            </div>
                                            <div class="div">
                                                    <h5 >Check Your Email  '.$_SESSION["email"].'</h5>
                                            </div>
                                         </div>
                                  </form>
                              </div>
                          </div>';
    }
    ?>






    <script type="text/javascript" src="../js/main.js"></script>
</body>
</html>