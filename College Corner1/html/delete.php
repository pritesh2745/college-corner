<?php
include('dbconn.php');
// IMP Note : Branch store karu data base ma to Space nai Rakh Vane 
// 1:Depstar IT  (Not vaild kem ki space che)
// 2:DepstarIT  (vaild kem ki space nathi)
// INSERT INTO `material` (`id`, `Branch`, `Sem`, `Sub`, `Type`, `File_name`, `Extension`) VALUES (NULL, '', '', '', '', '', '')

if (isset($_GET['pass'])) {
    $arrayString= explode("@", $_GET["pass"]);
    $_GET["sem"] = $arrayString[0];
    $_GET["Branch"] = $arrayString[1];
    $_GET["subject"] = $arrayString[2];
    $_GET["type"] = $arrayString[3];
    $_GET["File_name"] = $arrayString[4];
    $file_name =mysqli_real_escape_string($conn, $_GET["File_name"]);
    $insert = "DELETE FROM `material` WHERE `material`.`File_name` = '$file_name'";
    $iquery = mysqli_query($conn,$insert);
    if ($iquery) {
    $path ="./Material/".$_GET['Branch'].'/'.$_GET['sem'].'/'.$_GET['subject'].'/'.$_GET['type'].'/'.$_GET['File_name'];
    // echo $path;
    if (!unlink($path)) { 
        echo ("$path cannot be deleted due to an error"); 
    } 
    else { 
        echo ("$path has been deleted"); 
    } 
    }
    header('location:Webpage3.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'@'.$_GET["subject"].'@'.$_GET['type'].'#material');
}