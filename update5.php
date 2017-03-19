<?php
include 'config.php';
$title = $_POST['title'];
$content = $_POST['content'];
$scheduled_date = (int) $_POST['scheduled_date'];
$completion_date = (int) $_POST['completion_date'];
$priority = (int) $_POST['priority'];
try {
	if (empty($_GET['id'])) throw new Exception('Error');
	$id = (int) $_POST['id'];
$dbh = new PDO($db_setting, $db_user, $db_pass);
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "UPDATE task SET task SET (title = ?, content = ?, 
scheduled_date = ?, completion_date = ?, priority = ?, WHERE id = ?";
$stmt = $dbh->prepare($sql);
$stmt->bindvalue(1, $title, PDO::PARAM_STR);
$stmt->bindvalue(2, $content, PDO::PARAM_STR);
$stmt->bindvalue(3, $scheduled_date, PDO::PARAM_INT);
$stmt->bindvalue(4, $completion_date, PDO::PARAM_INT);
$stmt->bindvalue(5, $priority, PDO::PARAM_INT);
$stmt->bindvalue(6, $id, PDO::PARAM_INT);
$stmt->execute();
$dbh = null;
	echo "ID: " . htmlspecialchars($id,ENT_QUOTES,'UTF-8') 
	. "タスクの更新が完了しました。";
	} catch (PDOException $e) {
echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
die();
}
