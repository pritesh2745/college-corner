<?php
include('dbconn.php');
session_start();
// IMP Note : Branch store karu data base ma to Space nai Rakh Vane 
// 1:Depstar IT  (Not vaild kem ki space che)
// 2:DepstarIT  (vaild kem ki space nathi)
if (isset($_POST['taddsub'])) {
    $arrayString= explode("@", $_GET["pass"]);
    $_GET["sem"] = $arrayString[0];
    $_GET["Branch"] = $arrayString[1];
    $nameSapce =mysqli_real_escape_string($conn, $_POST['tname']);
    $sem =mysqli_real_escape_string($conn, $_GET["sem"]);
    $Branch =mysqli_real_escape_string($conn, $_GET["Branch"]);
    $name = str_replace(" ","_",$nameSapce);
    $insert = "INSERT INTO `subject` (`sr no`, `Branch`, `Sem`, `subject`) VALUES (NULL, '$Branch', '$sem', '$name');";
    $iquery = mysqli_query($conn,$insert);
}
if (isset($_GET['pass'])) {
    $arrayString= explode("@", $_GET["pass"]);
    $_GET["sem"] = $arrayString[0];
    $_GET["Branch"] = $arrayString[1];
    $_GET["subject"] = $arrayString[2];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College | Corner</title>
        <link rel="stylesheet" href="../css/nav.css">
        <link rel="stylesheet" href="../css/webpage.css">
        <link rel="stylesheet" href="../css/triangle.css">
        <link rel="stylesheet" href="../css/material.css">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
            integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
        <!-- Boxiocns CDN Link -->
    <link rel="stylesheet" href="../css/aboutus.css">

</head>
<body>
<div class="sidebar close">
            <div class="logo-details navProfile">
            <?php
                if ($_SESSION["male"] == 1) {
                    echo'<img src="../img/user.png" alt="">';
                }
                else {
                    echo'<img src="../img/user-female.png" alt="">';
                }
                echo'
                <h3>'.$_SESSION["nav_name"] .'</h3>
                <h4 style="width: 88%;word-wrap: break-word;color:rgba(0,0,0,0.6);">'.$_SESSION["nav_email"].'</h4>
                ';
                ?>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="https://charusat.edu.in:912/eGovernance/" target="_">
                        <i class="far fa-address-card"></i>
                        <span class="link_name">Dashboard</span>
                    </a>
                </li>
                <?php
                if ($_SESSION["teacher_email"] == 1) {
                    echo'
                <li>
                    <div class="iocn-link">
                        <a href="#">
                            <i class="bx bx-collection"></i>
                            <span class="link_name">Branch</span>
                        </a>
                        <!-- <i class="bx bxs-chevron-down arrow"></i> -->
                        <i class="fas fa-angle-down arrow"></i>
                    </div>
                    <ul class="sub-menu">
                    <li><a href="Webpage.php?pass=DepstarIT#Sem">Depstar IT</a></li>
                    <li><a href="Webpage.php?pass=DepstarCE#Sem">Depstar CE</a></li>
                    <li><a href="Webpage.php?pass=DepstarCSE#Sem">Depstar CSE</a></li>
                    </ul>
                </li>';
                }
                ?>
                <li>
                    <a href="./logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="link_name">Sign Out</span>
                    </a>
                </li>
                <li>
            </ul>
        </div>
        <!-- navigation bar -->
        <div class="nav home-section" style="height: 10vh;">
            <div class="home-content">
                <i class="fas fa-user-circle fa-2x  bx-menu"></i>
            </div>
            <ul>
                <div class="location" style="transform: translateY(-40px);">
                    <?php echo'<a href="Webpage.php?pass='.$_GET["Branch"].'#Sem">'.$_GET["Branch"].' </a>'; ?>
                    <i class="fas fa-angle-right"></i>
                    <?php echo'<a href="Webpage1.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'#subject">'.$_GET["sem"].' </a>'; ?>
                    <i class="fas fa-angle-right"></i>
                    <?php
    $Subject = str_replace("_"," ",$_GET["subject"]);
    echo'<a href="#Type">'.$Subject.' </a>'; ?>
    <i class="fas fa-angle-right"></i>
</div>
</ul>
 </div>
    <div class="homebox" id="home">
        <div class="punchline">
              <h1>A initiative to help students</h1>
            </div>
            <div class="homeimg">
                </div>
            </div>
            <!-- Sem............................... -->
            <div class="ExtarSem" id="Sem"></div>
            <div class="sem" >
                <?php
            for ($i=1; $i <=8 ; $i++) { 
                echo'
                <a href="Webpage1.php?pass=Sem-'.$i.'@'.$_GET["Branch"].'#subject">
                <div class="sem'.$i.' part"><h5>Sem - '.$i.'</h5><p>';
          ?>
          <?php
            $sem = 'Sem-'.$i;
            $branch =mysqli_real_escape_string($conn, $_GET["Branch"]);
            $sql = "SELECT * FROM `subject` WHERE `Branch` LIKE '$branch' AND `Sem` LIKE '$sem'"; 
            $result = mysqli_query($conn, $sql);
            $subcount = mysqli_num_rows($result);
            // echo $subcount;
            $j = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $Subject = str_replace("_"," ",$row["subject"]);
                if ($j == $subcount) {echo $Subject;break;}
                else{echo $Subject.' | ';}
                $j++;
            }
            ?>
          <?php
          echo'</p></div></a>';
        }
        ?>
      </div>
      <!-- Subject................................... -->
      <div class="ExtarSem" id="subject"></div>
      <div class="subject" >
          <div class="subjectTitle">
              <h2>Subject.</h2>
            </div>
            <div class="subjectContent">
                <?php
        $sem =mysqli_real_escape_string($conn, $_GET["sem"]);
        $branch =mysqli_real_escape_string($conn, $_GET["Branch"]);
        $sql = "SELECT * FROM `subject` WHERE `Branch` LIKE '$branch' AND `Sem` LIKE '$sem'"; 
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            echo'
            <a href="Webpage2.php?pass='.$row["Sem"].'@'.$_GET["Branch"].'@'.$row["subject"].'#Type">
            <div class="sub">';
            ?>
            <?php
             $Subject = str_replace("_"," ",$row["subject"]);
             echo'
             <h5>'.$Subject.'</h5>
             <div class="fas fa-angle-double-right"></div>
             </div>
             </a>';
            }
        if ($_SESSION["teacher_email"] == 1) {
            echo'
        <a href="webpageSubj.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'#subject" class="addSubjectIcon">
            <i class="fas fa-plus fa-2x"></i>
        </a>';
        }
            ?>
        </div>
    </div>
    
    <!-- Type Of Material............................ -->
    <div class="ExtarSem" id="Type"></div>
    <div class="TrinagleOut">
        <div class="Triangle">
            <?php
            echo'
            <a class="Type" href="Webpage3.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'@'.$_GET["subject"].'@book#material">
            <h1>Book</h1>
            </a>
            <a class="Type" href="Webpage3.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'@'.$_GET["subject"].'@pdf#material">
            <h1>PDF</h1>
            </a>
            <a class="Type" href="Webpage3.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'@'.$_GET["subject"].'@quepaper#material">
            <h1>Old Paper</h1>
            </a>
            <a class="Type" href="Webpage3.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'@'.$_GET["subject"].'@notes#material">
                    <h1>Notes</h1>
                    </a>
                    ';
                    ?>
        </div>
    </div>
    <script src="../js/Ani1.js"></script>
</body>
</html>
