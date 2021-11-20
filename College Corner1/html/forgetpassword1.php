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
        $password = mysqli_real_escape_string($conn,$_POST["password"]);
        if ($_SESSION["student_email"] === 1) {
            $body = 'Hi,'.$row["name"].'. Click here to Rest  your account Password Link =  http://localhost/Collage%20Corner/html/PasswordReset.php?stoken='.$row["token"];
        }
        elseif($_SESSION["teacher_email"] === 1){
            $body = 'Hi,'.$row["name"].'. Click here to Rest your account  Password Link = http://localhost/Collge%20Corner/html/PasswordReset.php?ttoken='.$row["token"];
        }
        if (($emailcount > 0)&&($_SESSION["personal_email"] != 1)) {
            if ($row["status"] === "active") {
                header("location:login.php");
                $subject = "Collage Coner Recovery Password ";
                $sender_email = "From: collagecorner4217@gmail.com";
                if (mail($email, $subject, $body, $sender_email)) {
                    // echo 'Email successfully sent to '.$email.'';
                    header("location:PasswordReset.php");
                    } else {echo "Email sending failed...";}
            }
            else{
                // echo "Not active";
                $subject = "Collage Coner Account Activation ";
                    $body = 'Hi,'.$row["name"].'. Click here to activate your account Link = http://localhost/Collage%20Corner/html/activate.php?token='.$row["token"];
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" href="../css/forgetPassword.css">
</head>
<body>
<div class="forgetContainer">
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
        <img src="../img/Collage Corner.png" alt="" srcset="">
        <div class="forgetInner">
        <h4>Email : </h4>
        <input type="email" class = "email" name="email" id="" required>
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
        <div class="forgetInner">
        <input type="submit" class="btn" value="Next" name = "next">
        </div>
    </form>
    </div>
</body>
</html>