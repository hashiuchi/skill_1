<?php
// 消去する処理
$dsn = 'mysql:dbname=skill_1;host=localhost';
$user = 'root';
$password='';
$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

//SQL文を実行する

$id = $_GET['id'];

$sql='DELETE FROM `tasks` WHERE `id` = ?';
$data[]=$id;
$stmt= $dbh->prepare($sql);
$stmt->execute($data);
//データベースの切断
$dbh=null;






header("Location: schedule.php");
exit();