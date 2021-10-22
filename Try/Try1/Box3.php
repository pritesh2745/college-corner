<?php
include('dbconn.php');
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
if (isset($_GET['pass'])) {
    $arrayString= explode("@", $_GET["pass"]);
    $_GET["sem"] = $arrayString[0];
    $_GET["Branch"] = $arrayString[1];
    $_GET["subject"] = $arrayString[2];
    $_GET["type"] = $arrayString[3];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Box-3</title>
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
    <!-- Subject HTMl Start Here -->
    <div class="Subject container" id="Subject">
    <?php
        $sem =mysqli_real_escape_string($conn, $_GET["sem"]);
        $branch =mysqli_real_escape_string($conn, $_GET["Branch"]);
        $sql = "SELECT * FROM `subject` WHERE `Branch` LIKE '$branch' AND `Sem` LIKE '$sem'"; 
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
        echo'
         <a href="Box2.php?pass='.$row["Sem"].'@'.$_GET["Branch"].'@'.$row["subject"].'#typematerial" class="SubBtn '.$row["subject"].'">
             <div class="servicebox" style="--i:#43f390">';
             ?>
            <?php
             $Subject = str_replace("_"," ",$row["subject"]);
             echo'
                <div class="icon"><H1>'.$Subject.'</H1></div>
                 <div class="contain"></div>
             </div>
             </a>';
        }
    ?>
            <div class="servicebox" style="--i:#4eb7ff">
               <div class="icon"><h1>+</h1></div>
                <div class="contain">
                    <form action="" method="post" >
                    <label for="tname">Name</label>
                    <input type="name" name="tname" id="tname" required>
                    <button type="submit" name="tsignup">Add</button>
                    </form>
                </div>
            </div>
    </div>
        <!-- Type Material Start Here -->
        <div class="TypeMaterial  container" id="typematerial">
    <?php
    echo'
    <a href="Box3.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'@'.$_GET["subject"].'@book#last"  class="TypeBtn" >
             <div class="servicebox" style="--i:#43f390">
                 <div class="icon"><H1>BOOK</H1></div>
                 <div class="contain"></div>
             </div>
    </a>
    <a href="Box3.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'@'.$_GET["subject"].'@pdf#last"  class="TypeBtn" >
             <div class="servicebox" style="--i:#43f390">
                 <div class="icon"><H1>PDF</H1></div>
                 <div class="contain"></div>
             </div>
    </a>
    <a href="Box3.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'@'.$_GET["subject"].'@quepaper#last"  class="TypeBtn" >
             <div class="servicebox" style="--i:#43f390">
                 <div class="icon"><H1>Question Paper</H1></div>
                 <div class="contain"></div>
             </div>
    </a>
    <a href="Box3.php?pass='.$_GET["sem"].'@'.$_GET["Branch"].'@'.$_GET["subject"].'@notes#last"  class="TypeBtn" >
             <div class="servicebox" style="--i:#43f390">
                 <div class="icon"><H1>Notes</H1></div>
                 <div class="contain"></div>
             </div>
    </a>';
    ?> 
    </div>
    <div class="Last visbsle" id="last">
        <h1>🤟HEY🤟</h1>
        <p>tara ma jetle takahoy aatlu add kar </p>
    </div>
    <script src="./Box.js"></script>
</body>
</html>