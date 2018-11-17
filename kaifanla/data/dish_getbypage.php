<?php
// header('Content-Type:application/json');
// $start = isset($_POST['start']) ? htmlspecialchars($_POST['start']) : '';
// $city = isset($_POST['url']) ? htmlspecialchars($_POST['url']) : '';
// echo $start;

// $configs = [
// 	'user' => '',
// 	'host' => '',
// 	'port' => '',
// 	'dbname' => '',
// 	'password' => '',
// ];

$output = [];
$output2 = [];

$dsn = 'mysql:host=localhost;port=3306;dbname=userinfo;';
$username = "root";
$password = "123";

try {
    $conn = new PDO($dsn, $username, $password);
    echo "连接成功".'</br>';
    // 设置 PDO 错误模式，用于抛出异常
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //从数据库里把表的数据提出来（获取记录集）
    $sql = "SELECT * FROM userinfo";
    //从数据库中选择数据，并将结果赋予一个变量,stutent为数据库表
    $result=$conn->prepare($sql);
    //将查询出的数据输出
    if ($result->execute()) {
        while ($row = $result->fetch()) {
        	$output['id'] = $row['id'];
        	$output['username'] = $row['username'];
        	$output['password'] = $row['password'];

        	$output2[] = $output;
        }
        echo json_encode($output2);
    }
}
catch(PDOException $e)
{
    echo $e->getMessage();
}

// $output = [];
// $count = 5;//Ò»´Î×î¶à²éÑ¯5ÌõÊý¾Ý

// $start = isset($_POST['start']) ? htmlspecialchars($_POST['start']) : '';
// // echo $start;

// // //Á¬½ÓÊý¾Ý¿â
// $conn = mysqli_connect('127.0.0.1','root','');

// // //ÉèÖÃ±àÂë
// $sql = 'SET NAMES UTF8';
// mysqli_query($conn,$sql);

// // //¶ÁÈ¡Êý¾Ý¿âÄÚÈÝ
// $sql = "SELECT did,name,price,img_sm,material FROM kf_dish LIMIT $start,$count";
// $result = mysqli_query($conn,$sql);

// //¸³Öµ¸Ä$output
// while(true)
// {
//     //´Ó½á¹ûÖÐ ¶ÁÈ¡Ò»ÐÐ¼ÇÂ¼Êý¾Ý
//     $row = mysqli_fetch_assoc($result);
//     if(!$row)//Ã»ÓÐ»ñÈ¡µ½¸ü¶àÊý¾Ý
//     {
//         break;
//     }
//     $output[] = $row;
// }
// echo json_encode($output);
?>
