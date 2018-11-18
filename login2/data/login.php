<?php
    session_start(); //使用session
	header("Content-Type:text/html; charset=utf-8");    //设置页面的编码格式
    if(!$_SERVER["REQUEST_METHOD"] == "POST"){
        die("错误执行");
    }
    $output = [];
    include('connect.php');//链接数据库
    $username = !empty($_POST['user_name']) ? test_input($_POST['user_name']) : null;//post获得用户名表单值
    $password = !empty($_POST['user_pwd']) ? test_input($_POST['user_pwd']) : null;//post获得用户密码单值
    $vcode = !empty($_POST['user_vcode']) ? test_input($_POST['user_vcode']) : null;

    if($vcode!=$_SESSION['VCODE']){
        $code_json = array('code'=>3,'message'=>'验证码不正确！');
        echo json_encode($code_json);
        $_SERVER['HTTP_REFERER'];
        exit;
    }

    $conn->query("set names 'utf8'");
    // $sql = "SELECT * FROM user WHERE username='$username' and password='$hashpwd'";//需要执行的sql语句
    $sql = "SELECT * FROM user WHERE username='$username'";//需要执行的sql语句
    $result = $conn->query($sql);//查询
    $row = $result->fetch(); //获取
    $hashpwd = $row['password'];
    if (password_verify($password, $hashpwd)) { //验证密码

    // if($result && $result->rowCount()){//判断结果集对象是否存在,并且结果集数量是否大于0,也就是说是否存在数据
    	//rowCount()是结果集中的一个方法，可以返回当前结果集中的记录条数
    	
    	$result->setFetchMode(PDO::FETCH_ASSOC);//设置结果集的读取方式，这里用的是关联的方式进行读取

    	//遍历方式一
	    //$row=$result->fetch();//获取记录
	    // print_r($row);
		// foreach ($row as $key => $value) {
		// $output[$key] = $value;
		// }
		// echo json_encode($output);

	    // 遍历方式二
	    // while ($row = $result->fetch()) { // 循环输出查询结果集，并且设置结果集为关联数据形式。
	    // 	$output['id'] = $row['id'];
	    // 	$output['username'] = $row['username'];
	    // }
	    // echo json_encode($output);

        $suc_json = array('code'=>1,'message'=>'登录成功','data'=>$username);
        echo json_encode($suc_json);

        $_SESSION['username']=$row['username'];
       	exit;
    }else{
	    $fail_json = array('code'=>2,'message'=>'登录失败');
		echo json_encode($fail_json);
       	exit;
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $conn->close();
?>