<?php
header('Content-Type:application/json');
$output = [];
//解析用户信息
$user_name = $_REQUEST['user_name'];
$sex = $_REQUEST['sex'];
$address = $_REQUEST['address'];
$did = $_REQUEST['did'];
$phone = $_REQUEST['phone'];
$order_time= time()*1000;//获取当前下单的时间戳

//判断用户信息是否完整
if(empty($user_name) ||empty($sex) || empty($address) || empty($did) || empty($phone) )
{
  echo '[]';
  return;
}

//数据库操作
$conn = mysqli_connect('127.0.0.1','root','','kaifanla');

//设置编码方式
$sql = 'SET NAMES UTF8';
mysqli_query($conn,$sql);

//kf_order插入用户的数据
$sql = "INSERT INTO kf_order VALUES(NULL,'$phone','$user_name','$sex','$order_time','$address','$did')";
$result = mysqli_query($conn,$sql);


$arr = [];
if($result)//insert执行成功
{
   $arr['msg'] = 'succ';
   $arr['did'] = mysqli_insert_id($conn);
}
else
{
   $arr['msg'] = 'err';
   $arr['reason'] = "insert数据失败:$sql";
}
$output[] = $arr;
echo json_encode($output);
?>

