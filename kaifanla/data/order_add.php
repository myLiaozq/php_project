<?php
header('Content-Type:application/json');
$output = [];
//�����û���Ϣ
$user_name = $_REQUEST['user_name'];
$sex = $_REQUEST['sex'];
$address = $_REQUEST['address'];
$did = $_REQUEST['did'];
$phone = $_REQUEST['phone'];
$order_time= time()*1000;//��ȡ��ǰ�µ���ʱ���

//�ж��û���Ϣ�Ƿ�����
if(empty($user_name) ||empty($sex) || empty($address) || empty($did) || empty($phone) )
{
  echo '[]';
  return;
}

//���ݿ����
$conn = mysqli_connect('127.0.0.1','root','','kaifanla');

//���ñ��뷽ʽ
$sql = 'SET NAMES UTF8';
mysqli_query($conn,$sql);

//kf_order�����û�������
$sql = "INSERT INTO kf_order VALUES(NULL,'$phone','$user_name','$sex','$order_time','$address','$did')";
$result = mysqli_query($conn,$sql);


$arr = [];
if($result)//insertִ�гɹ�
{
   $arr['msg'] = 'succ';
   $arr['did'] = mysqli_insert_id($conn);
}
else
{
   $arr['msg'] = 'err';
   $arr['reason'] = "insert����ʧ��:$sql";
}
$output[] = $arr;
echo json_encode($output);
?>

