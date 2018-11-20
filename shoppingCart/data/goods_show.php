<?php
	header("Content-type:text/html;charset=utf-8");
	include "pdo.php";

	$output = [];
	$output2 = [];

	$id=isset($_GET["id"]) ? $id=$_GET["id"] : 1;
	// 更新点击次数
	$sql="update goods set hits=hits+1 where id={$id}";
	$conn->query($sql);//查询

    $sql="SELECT id,picurl,title,marketprice,salesprice,content from goods where id={$id}";

	$result = $conn->query($sql);//查询

	if($result && $result->rowCount()){
		//fetch()和fetchAll()方法均接受fetch_style参数, 键组: FETCH_ASSOC  数字键: FETCH_NUM  默认：FETCH_BOTH
		$rows = $result->fetch(PDO::FETCH_ASSOC);

		//,JSON_UNESCAPED_UNICODE 让中文不转unicode码
		echo json_encode(array('code'=>1,'message'=>'获取成功！','data'=>$rows),JSON_UNESCAPED_UNICODE);
	}else{
		echo json_encode(array('code'=>0,'message'=>'没有数据！','data'=>array()),JSON_UNESCAPED_UNICODE);
	}
?>