<?php
header('Content-Type:application/json');
$output = [];

//获取手机号
$phone = $_REQUEST['phone'];
if(empty($phone))
{
    echo '[]';
    return;
}

//访问数据库
$conn = mysqli_connect('127.0.0.1','root','','kaifanla');

//编码设置
$sql = 'SET NAMES UTF8';
mysqli_query($conn,$sql);

//通过跨表查询
$sql = "SELECT kf_order.oid,kf_order.user_name,kf_order.addr,kf_order.order_time,kf_dish.img_sm FROM kf_order,kf_dish WHERE kf_order.did=kf_dish.did AND kf_order.phone='$phone'";
$result = mysqli_query($conn,$sql);

while(true)
{
    $row = mysqli_fetch_assoc($result);
    if(!$row)
        {
            break;
        }
    $output[] = $row;
}
echo json_encode($output);
?>