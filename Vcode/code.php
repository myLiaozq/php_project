<?php 
	//创建一个画布
	$width = 85;
	$height = 30;
	$type = 2;
	$length = 4;
	$line = 5;	//线的个数
	$pix = 50; //点的个数
	$img = imagecreatetruecolor($width, $height);

	//准备填充的颜色
	$white = imagecolorallocate($img,255,255,255);
	$black = imagecolorallocate($img,0,0,0);

	//向画布填充图形或者文字
	imagefilledrectangle($img,1,1,$width-2,$height-2,$white);
	$chars = rangeString($type,$length);
	for($i=0;$i<$length;$i++){
		$size = mt_rand(14,18);
		$x = 5+$size*$i;
		$y = mt_rand(8,$length*2);
		$text = substr($chars,$i,1);
		$color = imagecolorallocate($img,mt_rand(50,90),mt_rand(90,200),mt_rand(80,120));
		imagestring($img,$size,$x,$y,$text,$color);
	}
	//障碍物像素点
	for($i=0;$i<$pix;$i++){
	 $px = mt_rand(1,$width-2);
	 $py = mt_rand(1,$height-2);
	 $color = imagecolorallocate($img,mt_rand(50,90),mt_rand(90,200),mt_rand(80,120));
	 imagesetpixel($img, $px, $py, $color);
	}
	//障碍物横线
	for($i=0;$i<$line;$i++){
	 $color = imagecolorallocate($img,mt_rand(50,90),mt_rand(90,200),mt_rand(80,120));
		imageline($img,mt_rand(1,$width-2), mt_rand(1,$height-2),mt_rand(1,$width-2), mt_rand(1,$height-2),$color);
	}


	//输出图像
	header("content-type:image/png");
	imagepng($img);

	//销毁资源
	imagedestroy($img);

	/**
	 * 随机字符串
	 * @param [type] $type int [1:数字;2:字母;3:数字加字母]
	 * @param [type] $length int 4
	 * @return [type] string
	 */
	function rangeString($type,$length){
		if($type==1){
		 $chars = join("",range(0,9));
		}elseif($type==2){
		 $chars = join("",array_merge(range("a","z"),range("A","Z")));
		}if($type==3){
			$chars = join("",array_merge(range(0,9),range("a","z"),range("A","Z")));
		}
		$chars = str_shuffle($chars);
		$chars = substr($chars,0,$length);
		return $chars;
	}
?>