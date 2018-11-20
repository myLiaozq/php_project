<?php
	header("Content-type:text/html;charset=utf-8");
	include "pdo.php";

	$output = array();

	// 添加购物车
	$a=isset($_GET["a"]) ? $_GET["a"] : "";
	if($a=="addCart"){
		$buynum = $_POST["buynum"];
		$id = $_POST["id"];
		if(!empty($_COOKIE["shoppingCart"])){
		    $shoppingCart = unserialize($_COOKIE["shoppingCart"]); //反序列化获取
		}else{
		    $shoppingCart = array();
		}
		if(isset($id) && isset($buynum)){
		    $id = intval($id);
		    $buynum = intval($buynum);
		    $shoppingCart[] = array($id,$buynum);
		}
		setcookie('shoppingCart',serialize($shoppingCart));//商品属性进行序列化保存到cookie中
		echo "true";
	}else if($a=="buyNow"){
		if (!empty($_COOKIE["shoppingCart"])) {
			$totalPrice = "";
            $shoppingCart = unserialize($_COOKIE["shoppingCart"]); //反序列化获取
            foreach ($shoppingCart as $key => $value) {
                $sql = "SELECT id,title,salesprice from goods where id={intval($value[0])}";
                $result = $conn->query($sql);//查询
                $rows = $result->fetch(PDO::FETCH_ASSOC); //获取值
                $rows['productNum'] = $value[1];
                $rows['key'] = $key;
                $output[] = $rows;
            }
            echo json_encode(array('code'=>1,'message'=>'获取成功！','data'=>$output),JSON_UNESCAPED_UNICODE);
		}else{
			echo json_encode(array('code'=>0,'message'=>'没有数据！','data'=>array()),JSON_UNESCAPED_UNICODE);
		}
	}else if($a=="delone"){ //取消购物车某一项
		$key = $_GET["key"];
	    $shoppingCart = unserialize($_COOKIE["shoppingCart"]);
	    unset($shoppingCart[$key]); //销毁
	    if(empty($_COOKIE)){
	        setcookie($shoppingCart,"",time()-3600);
	    }else{
	        setcookie("shoppingCart",serialize($shoppingCart));
	    }
	    echo json_encode(array('code'=>1,'message'=>'取消成功！','data'=>array()),JSON_UNESCAPED_UNICODE);
	}else if($a=="empty"){ //清空购物车
	    //清除整个cookie保存的商品信息
	    unset($_COOKIE["shoppingCart"]);
	    setcookie("shoppingCart","",time()-3600);
	    // echo "<div class='shoppingCartempty'>您的购物车目前没有商品！3秒后跳回首页......</div>";
	    // header("Refresh:3;url=goods.php");
	}
?>