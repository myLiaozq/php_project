<?php
// echo '<pre>';
// print_r($_SERVER['HTTP_REFERER'].'lib/Db.php');EXIT; //报错
// print_r(__DIR__);EXIT;  //dirname(__FILE__)
include('pdo.php');
require_once(__DIR__.'/lib/Db.php');

$db = new Db();
$res = $db->table('article')->field('id,title')->order('id desc')->where('id>0')->lists();

print_r($res);

?>