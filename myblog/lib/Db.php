<?php
	/**
	 * 数据访问类
	 */
	class Db{
		public function table($table){
			$this->table = $table;
			$this->where = array();
			return $this;
		}

		public function where($where){
			$this->where = $where;
			return $this;
		}

		public function item(){
			$where = '';
			foreach ($this->where as $key => $value) {
				$value = is_string($value) ? "'".$value."'" : $value;
				$where .= "`{$key}`={$value} and ";
			}
			$where = rtrim($where,'and ');
			// exit($where);
			// 访问mysql数据库
			$dsn = 'mysql:host=localhost;port=3306;dbname=myblog;';
			$db_username = "root";
			$db_password = "123";
			$pdo = new PDO($dsn, $db_username, $db_password);
			$pdo->query("set names 'utf8'");
			$sql = "select * from {$this->table} where {$where} limit 1";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return isset($rows[0]) ? $rows[0] : false;
		}
	}
?>