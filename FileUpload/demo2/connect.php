<?php
	header('Content-Type:application/json');
	$dsn = 'mysql:host=localhost;port=3306;dbname=saveimages;';
	$db_username = "root";
	$db_password = "123";
	try {
	    $conn = new PDO($dsn, $db_username, $db_password);
	    // echo '连接成功' . '</br>';
	    // 设置 PDO 错误模式，用于抛出异常
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
	    echo $e->getMessage();
	}
?>