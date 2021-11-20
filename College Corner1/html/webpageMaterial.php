<?php
include('dbconn.php');
session_start();
// IMP Note : Branch store karu data base ma to Space nai Rakh Vane 
// 1:Depstar IT  (Not vaild kem ki space che)
// 2:DepstarIT  (vaild kem ki space nathi)
// INSERT INTO `material` (`id`, `Branch`, `Sem`, `Sub`, `Type`, `File_name`, `Extension`) VALUES (NULL, '', '', '', '', '', '')

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
    $_GET["type"] = $arrayString[3];
}

if (isset($_POST["submit"])) {
    $path ="Material/".$_GET['Branch'].'/'.$_GET['sem'].'/'.$_GET['subject'].'/'.$_GET['type'];
    $filePath= explode("/", $path);
    $fname = "Material/".$filePath[1];
    if( is_dir("Material") === false ){
        mkdir("Material");
    }
    for ($i=1; $i < 4; $i++) { 
        if( is_dir($fname) === false )
        {
            mkdir($fname);
        }
        $fname = $fname.'/'.$filePath[$i+1];
        if($i == 3){
            if( is_dir($fname) === false ){
                mkdir($fname);
            }
        }
    }
    $sem = $_GET['sem'];
    $sub = $_GET['subject'] ;
    $type = $_GET['type'];
    $branch = $_GET['Branch'] ;
    $fileExits = $path.'/'. $_FILES["pdf_file"]["name"];
    // echo $fileExits;
    $temp = explode(".", $_FILES["pdf_file"]["name"]);
    $extension = end($temp);
    $upload_pdf=$_FILES["pdf_file"]["name"];
    move_uploaded_file($_FILES["pdf_file"]["tmp_name"],$fileExits);
    // echo filesize($fileExits);
    $fileSizeBytes = filesize($fileExits);
    $fileSizeMB = ($fileSizeBytes / 1024 / 1024);
    $fileSizeMB = number_format($fileSizeMB, 2);
    $tname =mysqli_real_escape_string($conn,$_SESSION["nav_name"]);
    $date = date("d M Y");
    $fsearch =mysqli_real_escape_string($conn,$_FILES["pdf_file"]["name"]);
    $sql = "SELECT * FROM `material` WHERE `Branch` LIKE '$branch' AND `Sem` LIKE '$sem' AND `Sub` LIKE '$sub' AND `Type` LIKE '$type' AND `File_name` LIKE '$upload_pdf' AND `Extension` LIKE '$extension'"; 
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if( $num === 0 ){
    $sql=mysqli_query($conn,"INSERT INTO `material` (`id`, `Branch`, `Sem`, `Sub`, `Type`, `File_name`, `Extension`, `TName`, `upload_date`, `size`) VALUES (NULL, '$branch', '$sem', '$sub', '$type', '$upload_pdf', '$extension', '$tname', '$date', '$fileSizeMB')
    ");
    if ($sql) {
        $_GET["File_msg"] = "Succesfully Added";
        header('location:Webpage3.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'@'.$_GET["subject"].'@'.$_GET['type'].'#material');
    }
    else {
        $_GET["File_msg"] = "There is Some Techincal Issuse";
    }
}
else{
    $_GET["File_msg"] = "File Allready Exits";
}
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
            <?php echo'<a href="Webpage1.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'#subject">'.$_GET["sem"].' </a>'; ?>
            <i class="fas fa-angle-right"></i>
            <?php
            $Subject = str_replace("_"," ",$_GET["subject"]);
            echo'<a href="Webpage2.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'@'.$_GET["subject"].'#Type">'.$Subject.' </a>'; ?>
            <i class="fas fa-angle-right"></i>
            <?php echo'<a href="#material">'.$_GET["type"].' </a>'; ?>
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
        <a href="webpageSubj.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'#subject" class="addSubjectIcon">
            <i class="fas fa-plus"></i>
        </a>';
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

        <!-- Final Material............................ -->
        <div class="Material" id = "material">
        <?php
        $sem =mysqli_real_escape_string($conn, $_GET["sem"]);
        $branch =mysqli_real_escape_string($conn, $_GET["Branch"]);
        $type = $_GET['type'];
        $sub = $_GET['subject'] ;
        $sql = "SELECT * FROM `material` WHERE `Branch` LIKE '$branch' AND `Sem` LIKE '$sem' AND `Sub` LIKE '$sub' AND `Type` LIKE '$type'"; 
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $path ="Material/".$_GET['Branch'].'/'.$_GET['sem'].'/'.$_GET['subject'].'/'.$_GET['type'];
           $fileExits = $path.'/'. $row["File_name"];
           echo'<div class="container">
           <div class="mobile-layout">
               <div class="actions">
                   <i class="fas fa-chevron-left"></i>
                   <i class="fas fa-bookmark"></i>
               </div>
               <div class="book-cover">';
               if ($row["Extension"] === "docx" || $row["Extension"] === "doc" || $row["Extension"] === "dot" || $row["Extension"] === "wbk" || $row["Extension"] === "docm" || $row["Extension"] === "dotx" || $row["Extension"] === "dotm" || $row["Extension"] === "docb" || $row["Extension"] === "wll" || $row["Extension"] === "wwl") {
                   echo '
                   <img class="book-top" src="../img/doc.jpg" alt="Word File" />
                   ';
                //    break;
                }
                elseif ($row["Extension"] === "pdf") {
                    echo '
                    <img class="book-top" src="../img/pdf.jpg" alt="PDF File" />
                    ';
                //    break;
                }
                elseif ($row["Extension"] === "c" || $row["Extension"] === "cpp" || $row["Extension"] === "c++" || $row["Extension"] === "java"|| $row["Extension"] === "js" || $row["Extension"] === "py" || $row["Extension"] === "html" || $row["Extension"] === "css" || $row["Extension"] === "php" || $row["Extension"] === "json") {
                    echo '
                    <img class="book-top" src="../img/coding1.jpg" alt="PDF File" />
                    ';
                //    break;
                }
                elseif ($row["Extension"] === "xlsx" || $row["Extension"] === "xls" || $row["Extension"] === "xlt" || $row["Extension"] === "xlm" || $row["Extension"] === "xll_" || $row["Extension"] === "xla_" || $row["Extension"] === "xla5" || $row["Extension"] === "xla8" || $row["Extension"] === "xlsm" || $row["Extension"] === "xltx" || $row["Extension"] === "xltm" || $row["Extension"] === "xlsb" || $row["Extension"] === "xla" || $row["Extension"] === "xlam" || $row["Extension"] === "xll" || $row["Extension"] === "xlw") {
                echo '
                <img class="book-top" src="../img/excel.jpg" alt="Excel File" />
                ';
                // break;
                }
                elseif ($row["Extension"] === "ppt" || $row["Extension"] === "pot" || $row["Extension"] === "pps" || $row["Extension"] === "ppa" || $row["Extension"] === "ppam" || $row["Extension"] === "pptx" || $row["Extension"] === "pptm" || $row["Extension"] === "potx" || $row["Extension"] === "potm" || $row["Extension"] === "ppam" || $row["Extension"] === "ppsx" || $row["Extension"] === "ppsm" || $row["Extension"] === "sldx" || $row["Extension"] === "pa") {
                echo '
                <img class="book-top" src="../img/ppt.jpg" alt="Power Point" />
                ';
                // break;
                }
                elseif ($row["Extension"] === "png"|| $row["Extension"] === "ai"|| $row["Extension"] === "bmp"|| $row["Extension"] === "gif"|| $row["Extension"] === "ico"|| $row["Extension"] === "jpeg"|| $row["Extension"] === "jpg"|| $row["Extension"] === "ps"|| $row["Extension"] === "psd"|| $row["Extension"] === "svg"|| $row["Extension"] === "tif"|| $row["Extension"] === "tiff" || $row["Extension"] === "apng" || $row["Extension"] === "avif" || $row["Extension"] === "jfif" || $row["Extension"] === "pjpeg" || $row["Extension"] === "pjp" || $row["Extension"] === "webp" || $row["Extension"] === "cur" ) {
                    echo '
                    <img class="book-top" src="../img/Image.jpg" alt="Image" />
                    ';
                    // break;
                }
                else{
                echo '
                <img class="book-top" src="../img/Other1.jpg" alt="File" />
                ';
                // break;
                }
                
             echo'
                   <img class="book-side" src="../img/book-side.png" alt="book-side" />
               </div>
               <div class="preface">
                   <div class="content">
                       <div class="header">
                           <div class="title">'.$row["File_name"].'</div>
                           <div class="icon">
                               <i class="fas fa-chevron-down"></i>
                           </div>
                       </div>
                       <div class="author">by '.$row["TName"].'</div>
                       <div class="body">
                           <p>
                           <br>
                               Uploaded Date : '.$row["upload_date"].'
                               <br>
                               <br>
                               Size : '.$row["size"].' Mb
                               <br>
                               <br>
                               <br>
                               <a href="download.php?filepath='.$fileExits.'#material"><i class="fas fa-download" id="downloadicon" style="color:#e9204f;"> Download </i></a>
                               <br>';
                               if ($_SESSION["teacher_email"] == 1) {
                               echo'
                               <a href="delete.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'@'.$_GET["subject"].'@'.$_GET['type'].'@'.$row["File_name"].'"><i class="fas fa-trash-alt" id="downloadicon" style="color:#e9204f;"> Delete</i></a>';}
                               echo'
                               <br>
                           </p>
                       </div>
                   </div>
               </div>
           </div>
       </div>';
        }
        echo'
        <a href="Webpage3.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'@'.$_GET["subject"].'@'.$_GET['type'].'#material" class="addMaterial">
        <i class="fas fa-book-open fa-2x"></i>
        <!-- <i class="fas fa-file-upload fa-2x"></i>
        <i class="fas fa-cloud-upload-alt fa-2x"></i>
        <i class="fas fa-upload fa-2x"></i> -->
    </a>';
    ?>
    <div class="BlurSubject displayNone">
                <div class="addSujectform materialAdd">
                    <h2>Marteiral</h2>
                    <form method="post" role="form" enctype="multipart/form-data">
                        <div class="subjform">
                            <input type="file" name="pdf_file" id="upload_file" accept="application/" required/>
                        </div>
                            <?php
                            if (isset($_GET["File_msg"])) {
                                echo'
                                <h3>'.$_GET["File_msg"].'</h3>';
                            }
                            ?>
                            <div class="subjform">
                            <button id="send" type="submit" name="submit">Submit</button>
                        </div>
                        <?php
                        echo'
                        <a href="Webpage3.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'@'.$_GET["subject"].'@'.$_GET['type'].'#material" class = "close">';
                        ?>
                            <i class="fas fa-times"></i>
                        </a>
                    </form>
                </div>
    </div>
    </div>
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
    <!-- Download File..................  -->
    <script src="../js/Ani1.js"></script>
</body>
</html>