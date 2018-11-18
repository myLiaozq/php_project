<?php
    session_start();
    header("Content-Type: text/html;charset=utf-8"); 
    if(!$_SERVER["REQUEST_METHOD"] == "POST"){
        die("错误执行");
    }
    $output = [];
    include('connect.php');//链接数据库
    $username = !empty($_POST['user_name']) ? test_input($_POST['user_name']) : null;//post获得用户名表单值
    $password = !empty($_POST['user_pwd']) ? test_input($_POST['user_pwd']) : null;//post获得用户密码单值
    $pwdconfirm = !empty($_POST['user_rpwd']) ? test_input($_POST['user_rpwd']) : null;//post获得用户密码单值
    $vcode = !empty($_POST['user_vcode']) ? test_input($_POST['user_vcode']) : null;

    if($vcode!=$_SESSION['VCODE']){
        $code_json = array('code'=>3,'message'=>'验证码不正确！');
        echo json_encode($code_json);
        exit;
    }

    //密码加密
    $hashpwd = password_hash($password, PASSWORD_DEFAULT);

    $conn->query("set names 'utf8'");
    //拿到数据后去库里查询,用户名是否已被注册过
    $result = $conn->query("SELECT * FROM user WHERE username='$username'");
    if($result && $result->rowCount()){
        echo json_encode(array('code'=>0,'message'=>'用户名已被注册'));
        exit;
    }else{
        //产生一个随机五位数做用户id，先不考虑用户id是否已经存在
        $userid = rand(9,999999);
        $sql = "INSERT INTO user(id,username,password) values($userid,'$username','$hashpwd')";//需要执行的sql语句
        $result2 = $conn->query($sql);
        if($result2 && $result2->rowCount()){
            $suc_json = array('code'=>1,'message'=>'注册成功');
            echo json_encode($suc_json);
            exit;
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $conn->close();
?>