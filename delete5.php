<?php
$user = "kobayashi";
$pass = "@jc6831@777";
try {
	if (empty($_GET['id'])) throw new Exception('Error');
	$id = (int) $_GET['id'];
$dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "DELETE FROM task WHERE id = ?";
$stmt = $dbh->prepare($sql);
$stmt->bindvalue(1, $id, PDO::PARAM_INT);
$stmt->execute();
$dbh = null;
echo "タスクの登録が完了しました。<br>";
echo "<a href='index5.php'>トップページへ戻る</a>";
	echo "ID: " . htmlspecialchars($id,ENT_QUOTES,'UTF-8') ."の削除が完了しました。";
} catch (Exception $e) {
echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
die();
}	
