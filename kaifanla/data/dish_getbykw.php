<?php
header('Content-Type:application/json');
$output = [];

//��ȡ�ؼ��ʣ�Ҫ��������Ϣ��
@$kw = @$_REQUEST['kw'];
if(empty($kw)){
    echo '[]';
    return;
}

//�������ݿ������
$conn = mysqli_connect('127.0.0.1','root','','kaifanla');

//���ñ��뷽ʽutf8
$sql = 'SET NAMES UTF8';
mysqli_query($conn,$sql);

//��дsql�����ݹؼ��ֲ�ѯ���ݿ⣩,ִ��sql���
$sql = "SELECT did,name,price,img_sm,material FROM kf_dish WHERE name LIKE '%$kw%' OR material LIKE '%$kw%'";
$result = mysqli_query($conn,$sql);

//�����������$result��,��ֵ��$output
while(true)
{
    //��ȡ������е�һ�м�¼
    $row = mysqli_fetch_assoc($result);
    if(!$row)
    {
        break;
    }
    $output[] = $row;
}
echo json_encode($output);
?>