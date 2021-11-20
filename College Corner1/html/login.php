<?php
include("dbconn.php");
session_start();
$_SESSION["Invaild password"] = 0;
$_SESSION["emailnotExits"] = 0;
$_SESSION['personal_email'] = 0;
if (isset($_POST["singin"])) {
	$email = mysqli_real_escape_string($conn,$_POST["email"]);
    $lowerCaseEmail = strtolower($email); 
    $_SESSION["email"] = $lowerCaseEmail;
    $arrayString= explode("@", $lowerCaseEmail);
    // echo $arrayString[0]."  1::2  ";
    // echo $arrayString[1];
	$_SESSION["student_email"] = 0;
    $_SESSION["teacher_email"] = 0;
    $_SESSION["personal_email"] = 0;
	$emailquery = "";
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
    //For Protection Of Mysqli injection (mysqli_real_escape_string)
    $password = mysqli_real_escape_string($conn,$_POST["password"]);
    // $pass = password_hash($password,PASSWORD_BCRYPT);
    $query = mysqli_query($conn,$emailquery);
    $emailcount = mysqli_num_rows($query);
	if (($emailcount > 0)&&($_SESSION["personal_email"] != 1)) {
		$row = mysqli_fetch_assoc($query);
		$_SESSION["name"] = $row["name"];
		if ($row["gender"] == "male") {
			$_SESSION["male"] = 1;
		}
		else {
			$_SESSION["male"] = 0;
		}
		if ($row["status"] === "active") {
			if (password_verify($password, $row["password"])) {
				// echo 'Password is valid!';
				if (isset($_POST["rememberMe"])) {
					# code...
					setcookie('emailcookie',$email,time()+86400);
					setcookie('passwordcookie',$password,time()+86400);
				}
				$_SESSION["nav_email"] = $row["email"];
				$_SESSION["nav_name"] = $row["name"];
				if ($_SESSION["teacher_email"] == 1) {
                	header('location:Webpage.php?pass=DepstarIT');
				}
				else{
                	header('location:Webpage.php?pass='.$row["Branch"]);
				}
			} else {
				// echo 'Invalid password.';
		        $_SESSION["Invaild password"] = 1;
			}
		}
		else{
			// echo "Not active";
		    // $_SESSION["emailnotExits"] = 1;
			$query = mysqli_query($conn,$emailquery);
			$row = mysqli_fetch_assoc($query);
			if ($_SESSION["student_email"] === 1) {
				//Student Insert Query
				// echo "Student Insert Query";
                $_SESSION["body"] = 'Hi,'.$row["name"].'. Click here to activate your account Link = http://localhost/College%20Corner/html/activate.php?stoken='.$row["token"];
			}
			elseif($_SESSION["teacher_email"] === 1){
				//Teacher Insert Query
				// echo "Teacher Insert Query";
                $_SESSION["body"] = 'Hi,'.$row["name"].'. Click here to activate your account Link = http://localhost/College%20Corner/html/activate.php?ttoken='.$row["token"];
			}
			header("location:loading.php");
			// header("location:activate.php");
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
	<img class="wave" src="../img/wave.png">
	<div class="container">
		<div class="img">
			<!-- <img src="img/bg.svg"> -->
            <img src="../img/undraw_authentication_fsn5.svg" alt="">
		</div>
		<div class="login-content">
			<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method = "POST">
				<!-- <img src="img/avatar.svg"> -->
                <img src="../img/undraw_secure_login_pdn4.svg" alt="">
				<h2 class="title">Welcome Back</h2>
           		<div class="input-div one">
           		   <div class="i">
					  <i class="fas fa-envelope"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Email</h5>
           		   		<input type="text" class="input email" name="email" required>
           		   </div>
           		</div>
				   <?php
                if ($_SESSION['personal_email'] === 1) {
                    echo'<div class="alert">
                        <h6>Invaild Email Only Use charusat Email Id</h6>
                    </div>';
                }
				if (isset($_COOKIE["emailcookie"])) {
					echo'<script>
					var button = document.querySelector(".email");
					var count = true;
					setInterval(function () {
					if (count) {
					button.focus();        
					button.value = "'.$_COOKIE["emailcookie"].'";        
					count = false;
					}
					}, 0);
					</script>';
				}
				if ( ($_SESSION["emailnotExits"] === 1)&&($_SESSION["personal_email"] != 1)) {
                    echo'<div class="alert">
                        <h6>Email Id Not Exits</h6>
                    </div>';
                }
				if ( $_SESSION["Invaild password"] === 1) {
                    echo'<div class="alert">
                        <h6>Invalid password</h6>
                    </div>';
					echo'<script>
					var button = document.querySelector(".email");
					var count = true;
					setInterval(function () {
					if (count) {
					button.focus();        
					button.value = "'.$email.'";        
					count = false;
					}
					}, 0);
					</script>';
                }
				?>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input password" name = "password"required>
            	   </div>
            	</div>
				<?php
				if (isset($_COOKIE["passwordcookie"])) {
					echo'<script>
					var button1 = document.querySelector(".password");
					var count1 = true;
					setInterval(function () {
					if (count1) {
					button1.focus();
					button1.value = "'.$_COOKIE["passwordcookie"].'";        
					count1 = false;
					}
					}, 0);
					</script>';
				}
				?>
				<div class="div" style = "color:#555;">
					<!-- <h5>Password</h5> -->
					<input type="checkbox" class="input" name="rememberMe"> Remember Me
			 </div>
			<a class="google_icon" href="./Singup.php">Sign Up!</a>
				
            	<a class="forgot_password" href="./forgetpassword.php">Forgot Password?</a>
            	<input type="submit" class="btn" value="Login" name = "singin">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/main.js"></script>
</body>
</html>