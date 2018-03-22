<?php
include 'token.php';
include 'Page.php';

/* 消息管理*/
try
{
	// 获取消息总数，准备分页
	$dsn = 'mysql:host=localhost;dbname=message;charset=utf8';
	$pdo = new PDO($dsn , 'root' , '123456');
	$sql = "select count(id) as c from message";
	$stmt = $pdo->query($sql);
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	$total = $data['c'];
// var_dump($total);
	// 调用分页类，对数据库查询结果进行分页
	$page = new Page(3,$total);
	// var_dump($page->limit());die;

	$sql1 = "select * from message limit " . $page->limit();
	// $sql1 = "select *from message";
	// var_dump($sql1);
	$stmt = $pdo->query($sql1);
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	// var_dump($data);
	// 将分页链接与查询结果传递给ajax
	$value['data'] = $data;
	$value['allPage'] = $page->allPage();
	echo json_encode($value);
} catch (PDOException $e) {
	echo $e->getMessage();
}
/* 消息管理*/


