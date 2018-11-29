<?php
	/**
	 * 数据访问类
	 */
	class Db{
		// 构造函数 默认执行
		public function __construct(){
			$dsn = 'mysql:host=localhost;port=3306;dbname=myblog;';
			$db_username = "root";
			$db_password = "123";
			$this->pdo = new PDO($dsn, $db_username, $db_password);
		}

		// 查询表
		public function table($table){
			$this->table = $table;
			return $this;
		}

		//指定查询字段
		public function field($field){
			$this->field = $field;
			return $this;
		}

		// 指定where条件
		public function where($where){
			$this->where = $where;
			return $this;
		}

		//指定排序条件
		public function order($order){
			$this->order = $order;
			return $this;
		}

		//指定查询数量
		public function limit($limit){
			$this->limit = $limit;
			return $this;
		}

		//返回一条数据
		public function item(){
			$sql = $this->_build_sql('select'). ' limit 1';
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return isset($rows[0]) ? $rows[0] : false;
		}

		// 返回多条数据
		public function lists(){
			$sql = $this->_build_sql('select');
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $rows;
		}

		// 添加数据
		public function insert($data){
			$sql = $this->_build_sql('insert',$data);
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute(); 
			return $this->pdo->lastInsertId();
		}

		// 构造sql语句
		private function _build_sql($type,$data=null){
			if($type=='select'){
				$where = $this->_build_where();
				// 访问mysql数据库
				$this->pdo->query("set names 'utf8'");
				$sql = "select {$this->field} from {$this->table} {$where}";
				//倒序 desc
				if($this->order){
					$sql .= " order BY {$this->order}";
				}
				if($this->limit>0){
					$sql .= " limit {$this->limit}";
				}
			}

			if($type=='insert'){
				// $sql = "insert into article()value()";
				$sql = "insert into {$this->table}";
				$fields = $values = [];
				foreach ($data as $key => $value) {
					$fields[] = $key;
					$values[] = is_string($value) ? "'".$value."'" : $value;
				}
				$sql .= "(".implode(',',$fields).")values(".implode(',',$values).")";
			}
			
			return $sql;
		}

		//组装where条件字符串
		private function _build_where(){
			$where = '';
			if(is_array($this->where)){ //数组方式
				foreach ($this->where as $key => $value) {
					$value = is_string($value) ? "'".$value."'" : $value;
					$where .= "`{$key}`={$value} and ";
				}
				$where = rtrim($where,'and ');
			}else{
				$where = $this->where;
			}
			
			$where = $where=='' ? '' : "where {$where}";
			// exit($where);
			return $where;
		}
	}
?>