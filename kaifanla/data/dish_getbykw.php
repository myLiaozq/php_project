<?php
header('Content-Type:application/json');
$output = [];

//获取关键词（要搜索的信息）
@$kw = @$_REQUEST['kw'];
if(empty($kw)){
    echo '[]';
    return;
}

//建立数据库的连接
$conn = mysqli_connect('127.0.0.1','root','','kaifanla');

//设置编码方式utf8
$sql = 'SET NAMES UTF8';
mysqli_query($conn,$sql);

//编写sql（根据关键字查询数据库）,执行sql语句
$sql = "SELECT did,name,price,img_sm,material FROM kf_dish WHERE name LIKE '%$kw%' OR material LIKE '%$kw%'";
$result = mysqli_query($conn,$sql);

//遍历结果集（$result）,赋值给$output
while(true)
{
    //读取结果集中的一行记录
    $row = mysqli_fetch_assoc($result);
    if(!$row)
    {
        break;
    }
    $output[] = $row;
}
echo json_encode($output);
?>