<? php
	class File {
		private $_dir;
		const EXT = '.txt';

		public function __construct(){ //为对象成员变量赋初始值
			$this->_dir = dirname(__FILE__).'/file/';
		}
		public function cacheData($key,$value='',$path=''){
			$filename = $this->_dir.$path.$key.self::EXT;
			if($value!==''){ //写入缓存
				$dir = dirname($filename);
				if(!is_dir($dir)){
					mkdir($dir,0777);
				}
				return file_put_contents($filename, json_encode($value));
			}

			if(!is_file($filename)){
				return false;
			}else{
				return json_decode(file_get_contents($filename),true);
			}
		}
	}
?>