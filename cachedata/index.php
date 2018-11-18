<?php
	// require_once("file.php");

	class File {
		private $_dir;
		const EXT = '.txt';

		public function __construct(){ //为对象成员变量赋初始值
			$this->_dir = dirname(__FILE__).'/file/';
		}
		public function cacheData($key,$value='',$path=''){
			$filename = $this->_dir.$path.$key.self::EXT;
			if($value!==''){ //写入缓存
				if(is_null($value)){ //删除缓存
					return @unlink($filename);
				}
				$dir = dirname($filename);
				if(!is_dir($dir)){
					mkdir($dir,0777);
				}
				return file_put_contents($filename, json_encode($value));
			}

			if(!is_file($filename)){
				return false;
			}else{//获取缓存
				return json_decode(file_get_contents($filename),true);
			}
		}
	}

	$data = array(
		'id'=>1,
		'name'=>'liaozq',
		'type'=>array(4,5,6),
		'test'=>array(1,45,6=>array(123,'hexiaolang'),),
	);

	$file = new File();

	if($file->cacheData('index_mk_cache2')){
		var_dump($file->cacheData('index_mk_cache2'));exit;
		echo "success";
	}else{
		echo "fail";
	}
?>
