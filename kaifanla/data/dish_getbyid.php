<?php
header('Content-Type:application/json');
$output = [];

//获取传过来的菜品id
@$id = @$_REQUEST['id'];
if(empty($id))
{
    echo '[]';
    return;
}

//建立数据库的连接
$conn = mysqli_connect('127.0.0.1','root','','kaifanla');

//设置utf编码
$sql = 'SET NAMES UTF8';
mysqli_query($conn,$sql);

//查询数据
$sql = "SELECT did,name,price,img_lg,detail,material FROM kf_dish WHERE did=$id";
$result = mysqli_query($conn,$sql);

//将结果输出
$row = mysqli_fetch_assoc($result);
$output[] = $row;

echo json_encode($output);

?>