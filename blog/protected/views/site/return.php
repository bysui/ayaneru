<html>
<head>
	<title></title>
</head>
<body>
<p>已经登录</p>
<p id="counter"></p>
</body>
<?php echo $returnurl;?>
<script type="text/javascript">
	var counter = 5
	function countdown () {
		counter = counter - 1;
		if (counter<=0){
			clearInterval(t);
			window.location.href=<?php echo "'";echo $returnurl;echo "'";?>
		}
		document.getElementById('counter').innerHTML = counter;
	}
	var t = setInterval(countdown,1000);
</script>
</html>