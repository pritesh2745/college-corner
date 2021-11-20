<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
        body{
            width: 100%;
            height: 100vh;
            background : rgba(255,111,88,1);
        }
        #loading{
            position:fixed;
            width: 100%;
            height: 100%;
            background:url("../img/loading.gif") no-repeat center;
            z-index: 999999;
        }
    </style>
</head>
<body onload="test1()">
    <div id="loading"></div>
    <a href="./activate.php" class = "click"></a>
</body>
<script>
    function test1() {
  var button = document.querySelector(".click");
					var count = true;
					setInterval(function () {
					if (count) {
					button.click();         
					count = false;
					}
                }, 0);
}
</script>
</html>