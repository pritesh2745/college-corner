<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unlock</title>
    <style>
        body{
            width: 100%;
            height: 100vh;
            background : rgb(128 119 231);
        }
        .unlock_div{
            height: 100%;
            width: 100%;
            background:url("../img/unlock.gif") no-repeat center;
            z-index: 999999;
        }
    </style>
</head>
<body>
    <div class="unlock_div"></div>
    <a href="./login.php" class = "click"></a>
</body>
<script>
	var count = true;
  var button = document.querySelector(".click");
	   setInterval(function () {
			if (count) {
					button.click();         
					count = false;
			}
        }, 3000);
</script>
</html>