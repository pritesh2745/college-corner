<?php
    session_start();
include("dbconn.php");
    // $_SESSION["email"];
    if (isset($_POST["next"])) {
        $email = mysqli_real_escape_string($conn,$_POST["email"]);
        $lowerCaseEmail = strtolower($email); 
        $_SESSION["email"] = $lowerCaseEmail;
        $arrayString= explode("@", $lowerCaseEmail);
        $_SESSION["student_email"] = 0;
        $_SESSION["teacher_email"] = 0;
        $_SESSION["personal_email"] = 0;
        if ($arrayString[1] == "charusat.edu.in") {
            // echo "   Student";
            $_SESSION["student_email"] = 1;
		$emailquery = "SELECT * FROM `loginstudent` where email = '$email'";
        }
        elseif($arrayString[1] == "charusat.ac.in"){
            // echo "  Teacher";
            $_SESSION["teacher_email"] = 1;
		$emailquery = "SELECT * FROM `loginteacher` where email = '$email'";
        }
        else{
            // echo "  You are Using Personal Email Id";
            $_SESSION["personal_email"] = 1;
		$emailquery = "SELECT * FROM `loginstudent` where email = '$email'";
        }
        $query = mysqli_query($conn,$emailquery);
        $emailcount = mysqli_num_rows($query);
        $row = mysqli_fetch_assoc($query);
        if ($_SESSION["student_email"] === 1) {
            $body = 'Hi,'.$row["name"].'. Click here to Rest  your account Password Link =  http://localhost/College%20Corner/html/PasswordReset.php?stoken='.$row["token"];
        }
        elseif($_SESSION["teacher_email"] === 1){
            $body = 'Hi,'.$row["name"].'. Click here to Rest your account  Password Link = http://localhost/College%20Corner/html/PasswordReset.php?ttoken='.$row["token"];
        }
        if (($emailcount > 0)&&($_SESSION["personal_email"] != 1)) {
            if ($row["status"] === "active") {
                header("location:login.php");
                $subject = "College Coner Recovery Password ";
                $sender_email = "From: collagecorner4217@gmail.com";
                if (mail($email, $subject, $body, $sender_email)) {
                    // echo 'Email successfully sent to '.$email.'';
                    header("location:PasswordReset.php");
                    } else {echo "Email sending failed...";}
            }
            else{
                // echo "Not active";
                $subject = "College Coner Account Activation ";
                    $body = 'Hi,'.$row["name"].'. Click here to activate your account Link = http://localhost/College%20Corner/html/activate.php?token='.$row["token"];
                    $sender_email = "From: collagecorner4217@gmail.com";
                    if (mail($email, $subject, $body, $sender_email)) {
                        // echo 'Email successfully sent to '.$email.'';
                        header("location:activate.php");
                    } else {echo "Email sending failed...";}
            }
        }
        else{
            // echo "email not exits";
            $_SESSION["emailnotExits"] = 1;
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
	<!-- <img class="wave" src="../img/wave.png"> -->
	<div class="container bg_same" style="background-color: #d1dbfc;">
		<div class="img">
			<!-- <img src="img/bg.svg"> -->
            <img src="../img/forget_password.gif" alt="">
		</div>
		<div class="login-content">
			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method = "POST">
				<!-- <img src="img/avatar.svg"> -->
                <img src="../img/undraw_secure_login_pdn4.svg" alt="">
				<h2 class="title">Forget Password</h2>
           		<div class="input-div one">
           		   <div class="i" style="color: #fd0505c4;">
					  <i class="fas fa-envelope"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Email</h5>
           		   		<input type="text" class="input email" name="email" required>
                    </div>
                    </div>
                              <?php
        if(isset($_SESSION["email"])){
            echo'<script>
					var button = document.querySelector(".email");
					var count = true;
					setInterval(function () {
                        if (count) {
					button.focus();        
					button.value = "'.$_SESSION["email"].'";        
					count = false;
					}
                }, 0);
                </script>';
            }
            if ($_SESSION["emailnotExits"] === 1) {
                echo'<div class="alert">
                <h6>Email Id Not Exits</h6>
                </div>';
            }
            ?>
            	<input type="submit" class="btn" value="Next" name = "next">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/main.js"></script>
</body>
</html>