<?php
	header("Content-type:text/html;charset=utf-8");
	include "pdo.php";

	$output = [];
	$output2 = [];

	$id=isset($_GET["gid"]) ? $id=$_GET["gid"] : "";

	if(!empty($id)){
        $sql="SELECT * from goods where goodstypefid=$id";
    }else{
        $sql="SELECT * from goods";
    }
	
	$result = $conn->query($sql);//查询
	if($result && $result->rowCount()){
		while ($rows = $result->fetch()) {
			$output['id'] = $rows['id'];
			$output['picurl'] = $rows['picurl'];
			$output['title'] = $rows['title'];

			$output2[] = $output;
		}
		echo json_encode(array('code'=>1,'message'=>'获取成功！','data'=>$output2));
	}else{
		echo json_encode(array('code'=>0,'message'=>'没有数据！','data'=>array()));
	}
?>