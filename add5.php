<?php
include 'config.php';
$title = $_POST['title'];
$content = $_POST['content'];
$scheduled_date = $_POST['scheduled_date'];
$completion_date = $_POST['completion_date'];
$priority = $_POST['priority'];
try {
$dbh = new PDO($db_setting, $db_user, $db_pass);
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO task (title, content, scheduled_date, completion_date, priority) VALUES (?, ?, ?, ?, ? )"; 
$stmt = $dbh->prepare($sql);
$stmt->bindvalue(1, $title, PDO::PARAM_STR);
$stmt->bindvalue(2, $content, PDO::PARAM_INT);
$stmt->bindvalue(3, $scheduled_date, PDO::PARAM_INT);
$stmt->bindvalue(4, $completion_date, PDO::PARAM_INT);
$stmt->bindvalue(5, $priority, PDO::PARAM_STR);
$stmt->execute();
$dbh = null;
echo "タスクの登録が完了しました。<br>";
echo "<a href='index5.php'>トップページへ戻る</a>";
echo "タスクの登録が完了しました。";
} catch (PDOException $e) {
echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
die();
}
