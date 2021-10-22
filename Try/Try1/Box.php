<?php
include('dbconn.php');
$_GET["Branch"] = "DepstarIT";
// IMP Note : Branch store karu data base ma to Space nai Rakh Vane 
// 1:Depstar IT  (Not vaild kem ki space che)
// 2:DepstarIT  (vaild kem ki space nathi)
if (isset($_POST['tsignup'])) {
    $nameSapce =mysqli_real_escape_string($conn, $_POST['tname']);
    $sem =mysqli_real_escape_string($conn, $_GET["sem"]);
    $name = str_replace(" ","_",$nameSapce);
    echo $name." ".$nameSapce;
    $insert = "INSERT INTO `subject` (`sr no`, `Branch`, `Sem`, `subject`) VALUES (NULL, 'DepstarIT', '$sem', '$name');";
    $iquery = mysqli_query($conn,$insert);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Box</title>
    <link rel="stylesheet" href="./Box.css">
</head>
<body>
 <!-- SEM start Here -->
<div class="container">
        <div class="Sem">
            <?php
            for ($i=1; $i <=8 ; $i++) { 
                echo '<a href="Box1.php?pass=Sem-'.$i.'@'.$_GET["Branch"].'#Subject" class = "SemBtn Sem-'.$i.'">
                <div class="servicebox" style="--i:#4eb7ff">
                 <div class="icon"><h1>Sem - '.$i.'</h1></div>
                 <div class="contain"></div>
                 </div>
             </a> ';
            }
            ?>
        </div>
</div>
    <script src="./Box.js"></script>
</body>
</html>