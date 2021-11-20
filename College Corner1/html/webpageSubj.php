<?php
include('dbconn.php');
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
    header('location:Webpage1.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'#subject');
}
if (isset($_GET['pass'])) {
    $arrayString= explode("@", $_GET["pass"]);
    $_GET["sem"] = $arrayString[0];
    $_GET["Branch"] = $arrayString[1];
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
                <img src="../img/user.png" alt="">
                <h3>Malav Patel</h3>
                <h4>20dit059@gmail.com</h4>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="https://charusat.edu.in:912/eGovernance/" target="_">
                        <i class="far fa-address-card"></i>
                        <span class="link_name">Dashboard</span>
                    </a>
                </li>
                <li>
                    <div class="iocn-link">
                        <a href="#">
                            <i class='bx bx-collection'></i>
                            <span class="link_name">Branch</span>
                        </a>
                        <!-- <i class='bx bxs-chevron-down arrow'></i> -->
                        <i class="fas fa-angle-down arrow"></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a href="#">Depstar IT</a></li>
                        <li><a href="#">Depstar CSE</a></li>
                        <li><a href="#">Depstar CE</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="link_name">Sign Out</span>
                    </a>
                </li>
                <li>
            </ul>
        </div>
        <!-- navigation bar -->
        <div class="nav home-section">
            <div class="home-content">
                <i class="fas fa-user-circle fa-2x  bx-menu"></i>
            </div>
            <ul>
                <li><a href="#home" id="btn1" class="btn">Home</a></li>
                <li><a href="#footer" class="btn">About</a></li>
                <!-- <li><a href="#Sem" class="btn">Semester</a></li> -->
            </ul>
            <div class="location">
                <?php echo'<a href="Webpage.php?#Sem">'.$_GET["Branch"].' </a>'; ?>
                <i class="fas fa-angle-right"></i>
                <?php echo'<a href="#subject">'.$_GET["sem"].' </a>'; ?>
                <i class="fas fa-angle-right"></i>
            </div>
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
        echo'
        <a href="Webpage1.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'#subject" class="addSubjectIcon">
            <i class="fas fa-plus"></i>
        </a>';
    ?>
    </div>
    <?php
    echo'
    <div class="BlurSubject displayNone">
                <div class="addSujectform">
                    <h2>ADD Subject</h2>
                    <form method="post">
                        <div class="subjform">
                            <h4>Branch </h4>
                            <h5>: '.$_GET["Branch"].'</h5>
                        </div>
                        <div class="subjform">
                            <h4>Semester </h4>
                            <h5>: '.$_GET["sem"].'</h5>
                        </div>
                        <div class="subjform">
                            <h4>Subject </h4>
                            <h5>: <input type="text" name="tname" id="" required></h5>
                        </div>
                        <div class="subjform">
                            <input type="submit" class="addBtn" name="taddsub" value="ADD">
                        </div>
                        <a href="Webpage1.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'#subject" class="clsoeSubjectIcon">
                            <i class="fas fa-times"></i>
                        </a>
                    </form>
                </div>
    </div>';
    ?>
        <div class="aboutus" id="footer">
        <div class="about_box">
            <div class="about_dp">
                <img src="../img/Book-1.gif" alt="">

            </div>
            <div class="about_para">
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officiis neque distinctio iure. Provident
                    amet illo fugiat molestiae modi aut autem alias pariatur facilis sint? Blanditiis, quod. Blanditiis
                    repudiandae voluptate, laboriosam assumenda odio voluptates saepe?
                </p>
            </div>

            <div class="about_name">
                <h2>
                    Raj Tejani
                </h2>
            </div>
            <div class="about_designation">
                <h4>ceo of tencent gaming</h4>
            </div>
        </div>
        <div class="about_box">
            <div class="about_dp">
                <img src="../img/Book-1.gif" alt="">

            </div>
            <div class="about_para">
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officiis neque distinctio iure. Provident
                    amet illo fugiat molestiae modi aut autem alias pariatur facilis sint? Blanditiis, quod. Blanditiis
                    repudiandae voluptate, laboriosam assumenda odio voluptates saepe?
                </p>
            </div>

            <div class="about_name">
                <h2>
                    Malav Patel
                </h2>
            </div>
            <div class="about_designation">
                <h4>ceo of tencent gaming</h4>
            </div>
        </div>
        <div class="about_box">
            <div class="about_dp">
                <img src="../img/Book-1.gif" alt="">

            </div>
            <div class="about_para">
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officiis neque distinctio iure. Provident
                    amet illo fugiat molestiae modi aut autem alias pariatur facilis sint? Blanditiis, quod. Blanditiis
                    repudiandae voluptate, laboriosam assumenda odio voluptates saepe?
                </p>
            </div>

            <div class="about_name">
                <h2>
                    Pritesh vandra
                </h2>
            </div>
            <div class="about_designation">
                <h4>ceo of tencent gaming</h4>
            </div>
        </div>
    </div>
    <script src="../js/Ani1.js"></script>
</body>
</html>