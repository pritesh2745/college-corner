<?php
include"dbconn.php";
session_start();
// $_SESSION['student_email'] = 0;
// $_SESSION['teacher_email'] = 0;
$_SESSION["personal_email"] = 0;
$_SESSION["passnotmatch"] = 0;
$_SESSION["passnot8"] = 0;
$_SESSION["emailExits"] = 0;
if (isset($_POST["signup"])) {
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $lowerCaseEmail = strtolower($email); 
    $_SESSION["email"] = $lowerCaseEmail;
    $arrayString= explode("@", $lowerCaseEmail);
    // echo $arrayString[0]."  1::2  ";
    // echo $arrayString[1];
    $_SESSION["personal_email"] = 0;
    $_SESSION["student_email"] = 0;
    $_SESSION["teacher_email"] = 0;
    if ($arrayString[1] == "charusat.edu.in") {
        // echo "   Student";
        $_SESSION["student_email"] = 1;
    }
    elseif($arrayString[1] == "charusat.ac.in"){
        // echo "  Teacher";
        $_SESSION["teacher_email"] = 1;
    }
    else{
        // echo "  You are Usign Personal Email Id";
        $_SESSION["personal_email"] = 1;
    }
    //For Protection Of Mysqli injection (mysqli_real_escape_string)
    $username = mysqli_real_escape_string($conn,$_POST["Name"]);
    $password = mysqli_real_escape_string($conn,$_POST["password"]);
    $cpassword = mysqli_real_escape_string($conn,$_POST["cpassword"]);
    $gender = mysqli_real_escape_string($conn,$_POST["gender"]);
    $pass = password_hash($password,PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword,PASSWORD_BCRYPT);
    $emailquery = "SELECT * FROM `loginstudent` where email = '$email'";
    $query = mysqli_query($conn,$emailquery);
    $emailcount = mysqli_num_rows($query);
    $_SESSION["name"] = $username;
    if ($emailcount > 0) {
        // echo "email already exits";
        $_SESSION["emailExits"] = 1;
    }
    else{
        if (($password === $cpassword)&&($_SESSION["personal_email"] != 1)) {
            if (strlen($password) < 8) {
                // echo "Password atleast Of 8";
            $_SESSION["passnot8"] = 1;
            }
            else{
            //Finding Brach
            $Branch;
            for ($i=0; $i <10; $i++) { 
                if ($lowerCaseEmail[$i] == 'd' && $lowerCaseEmail[$i+1] == 'i' && $lowerCaseEmail[$i+2] == 't') {
                    $Branch = "DepstarIT";
                    break;
                }
                elseif ($lowerCaseEmail[$i] == 'd' && $lowerCaseEmail[$i+1] == 'c' && $lowerCaseEmail[$i+2] == 'e') {
                    $Branch = "DepstarCE";
                    break;
                }
                elseif ($lowerCaseEmail[$i] == 'd' && $lowerCaseEmail[$i+1] == 'c' && $lowerCaseEmail[$i+2] == 's') {
                    $Branch = "DepstarCSE";
                    break;
                }
                elseif ($lowerCaseEmail[$i] == 'i' && $lowerCaseEmail[$i+1] == 't') {
                    $Branch = "CspitIT";
                    break;
                }
                elseif ($lowerCaseEmail[$i] == 'c' && $lowerCaseEmail[$i+1] == 'e') {
                    $Branch = "CspitCE";
                    break;
                }
                elseif ($lowerCaseEmail[$i] == 'c' && $lowerCaseEmail[$i+1] == 's'&& $lowerCaseEmail[$i+2] == 'e') {
                    $Branch = "CspitCSE";
                    break;
                }
            }
            //Ending Find Of Branch
            // echo " Sub : ".$Subject;
            $token = bin2hex(random_bytes(15));
            $insertquery = " ";
            echo $_SESSION["student_email"];
            echo $_SESSION["teacher_email"];
            if ($_SESSION["student_email"] === 1) {
                //Student Insert Query
                // echo "Student Insert Query";
                $insertquery = "INSERT INTO `loginstudent` (`sr no`, `name`, `Branch`, `email`, `password`, `status`, `token`,`gender`) VALUES (NULL, '$username', '$Branch', '$email', '$pass', 'inactive', '$token','$gender')";
                $_SESSION["body"] = 'Hi,'.$username.'. Click here to activate your account Link = http://localhost/College%20Corner/html/activate.php?stoken='.$token;
            }
            elseif($_SESSION["teacher_email"] === 1){
                //Teacher Insert Query
                // echo "Teacher Insert Query";
                $insertquery =  "INSERT INTO `loginteacher` (`sr no`, `name`, `email`, `password`, `status`, `token`,`gender`) VALUES (NULL, '$username', '$email', '$pass', 'inactive', '$token','$gender')";
                $_SESSION["body"]  = 'Hi,'.$username.'. Click here to activate your account Link = http://localhost/College%20Corner/html/activate.php?ttoken='.$token;
            }
            $iquery = mysqli_query($conn,$insertquery);
            if ($iquery) {
                // We are Sending Email.........
                // $subject = "College Coner Account Activation ";
                // $sender_email = "From: collegecorner4217@gmail.com";
                // if (mail($email, $subject, $body, $sender_email)) {
                //     echo 'Email successfully sent to '.$email.'';
		        	header("location:loading.php");
                    // header("location:activate.php");
                // } else {echo "Email sending failed...";}
            }
            else{
                echo"signUp Fail Due To Techincal Problem";
            }
        }
    }
        else{
            // echo"Password Not Match";
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
                <!-- <img src="../img/undraw_secure_login_pdn4.svg" alt=""> -->
                <h2 class="title">Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Name</h5>
                        <input type="text" class="input name" name = "Name" value = "" required>
                <?php
                if (($_SESSION['personal_email'] === 1)||( $_SESSION["passnotmatch"] === 1)||( $_SESSION["passnot8"] === 1) ||( $_SESSION["emailExits"] === 1)) {
                echo'<script>
                var button = document.querySelector(".name");
                var count = true;
                setInterval(function () {
                if (count) {
                button.focus();        
                button.value = "'.$username.'";        
                count = false;
                }
                }, 0);
                </script>';
            }
            ?>
                    </div>
                </div>
                <div class="Gender" style="color:#32be8f; 
                    transform: translateY(-15px); margin-left: -130px;">
                    <i class="fas fa-venus-mars" style="font-size: 1.5em;"></i>
                    <input type="radio" id="gender" name="gender" value="male"  style="margin-left: 30px;" required/> Male
<input type="radio" id="gender" name="gender" value="female"  style="margin-left: 30px;" required/> Female
</div>
                <div class="input-div one">
                    <div class="i">
                    <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="text" class="input email" name = "email" required>
                    </div>
                </div>
                <?php
                if ($_SESSION['personal_email'] === 1) {
                    echo'<div class="alert">
                        <h6>Invaild Email Only Use charusat Email Id</h6>
                    </div>';
                }
                if ( $_SESSION["emailExits"] === 1) {
                    echo'<div class="alert">
                        <h6>Email Id Already Exits</h6>
                    </div>';
                }
                if ((($_SESSION["passnotmatch"] === 1)||( $_SESSION["passnot8"] === 1))&&($_SESSION['personal_email'] != 1)) {
                    echo'<script>
                    var button1 = document.querySelector(".email");
                    var count1 = true;
                    setInterval(function () {
                    if (count1) {
                    button1.focus();        
                    button1.value = "'.$email.'";        
                    count1 = false;
                    }
                    }, 0);
                    </script>';
                }
            ?>
                <?php
                if (($_SESSION['passnotmatch'] === 1)&&($_SESSION['personal_email'] != 1)) {
                    echo'<div class="alert">
                        <h6>Password does not meet</h6>
                    </div>';
                }
                if ($_SESSION['passnot8'] === 1) {
                    echo'<div class="alert">
                        <h6>Password atleast Of 8</h6>
                    </div>';
                }
                ?>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" name = "password" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Confirm Password</h5>
                        <input type="password" class="input"name = "cpassword" required>
                    </div>
                </div>
                <a class="google_icon" href="./login.php">Login</a>
                <input type="submit" class="btn" value="Sign Up" name = "signup">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../js/main.js"></script>
</body>
</html>