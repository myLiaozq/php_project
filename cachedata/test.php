<? php
	class File {
		private $_dir;
		const EXT = '.txt';

		public function _constuct(){
			$this->$_dir = dirname(_FILE_).'/file/';
		}
		public function cacheData(&key,&value='',$path=''){
			$filename = $this->_dir.$path.$key.self::EXT;
			if($value!==''){
				$dir = dirname($filename);
				if(!is_dir($dir)){
					mkdir($dir,0777);
				}
				return file_put_contents($filename, json_encode($value))
			}
		}
	}

	$file = new File();

	require_once('./file.php');
	$data = array(
		'id'=>1,
		'name'=>'liaozq',
		'type'=>array(4,5,6),
		'test'=>array(1,45,6=>array(123,'hexiaolang'),),
	);

	$file = new File();

	if($file->cacheData('index_mk_cache',$data)){
		echo "success";
	}else{
		echo "fail";
	}
?>