<?php
	header("Content-Type: text/html; charset=utf8");

    if(!$_SERVER["REQUEST_METHOD"] == "POST"){
        die("错误执行");
    }

    $output = [];

    include('connect.php');//链接数据库

    $name = !empty($_POST['user_name']) ? test_input($_POST['user_name']) : null;//post获得用户名表单值
    $user_pwd = !empty($_POST['user_pwd']) ? test_input($_POST['user_pwd']) : null;//post获得用户密码单值

    $sql = "INSERT INTO user(id,username,password) values (null,'$name','$password')";//需要执行的sql语句
    $result = $conn->query($sql);//返回一个PDOstatement结果集对象
    if($result && $result->rowCount()){
	    $suc_json = array('code'=>1,'message'=>'注册成功');
		echo json_encode($suc_json);
       	exit;
    }
?>