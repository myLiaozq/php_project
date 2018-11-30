<?php
	session_start();
	header('Content-Type:application/json');
	if(!$_SERVER["REQUEST_METHOD"] == "POST"){
	    die("错误执行");
	}
	include "pdo.php";

	$username = $_POST['username'];//获取用户名
	$password = $_POST['password'];//获取密码
	$vcode = $_POST['vcode']; //验证码
	// echo $_SESSION["session_code"]["code"],$vcode;
	if(($_SESSION["session_code"]["code"]).toUpperCase() !== ($vcode).toUpperCase()){
	    $code_json = array('code'=>3,'message'=>'验证码不正确！');
	    echo json_encode($code_json);
	    exit;
	}

	if(!empty($_POST)){
	    // 查询数据库中是否存在用户信息
	    $sql = "select * from user where username = '{$username}' and password = '{$password}'";
	    $result = $conn->query($sql);//查询
	    if($result && $result->rowCount()){
    		echo json_encode(array('code'=>1,'message'=>'登录成功！'),JSON_UNESCAPED_UNICODE);
	    }else{
	    	echo json_encode(array('code'=>1,'message'=>'用户名或密码不正确！'),JSON_UNESCAPED_UNICODE);
	    }
	}
?>