<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>welcome</title>
</head>
<body>
	<?php
		$str = '你好';
		session_start();
		$val = $_SESSION['username'];
	?>
	<h1>欢迎回来<?php echo $val ?></h1>
</body>
</html>