<?php
$user = "kobayashi";
$pass = "@jc6831@777";
try {
	if (empty($_GET['id'])) throw new Exception('Error');
	$id = (int) $_GET['id'];
$dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $pass);
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
$sql = "SELECT * FROM task WHERE id = ?";	
$stmt = $dbh->prepare($sql);
$stmt->bindvalue(1, $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
echo "タイトル:" . htmlspecialchars($result['title'],ENT_QUOTES,'UTF-8') . "<br>\n";
echo "予定日:" . htmlspecialchars($result['scheduled_date'],ENT_QUOTES,'UTF-8') . "<br>\n";
echo "完了日:" . htmlspecialchars($result['completion_date'],ENT_QUOTES,'UTF-8') . "<br>\n";
echo "優先度:" . htmlspecialchars($result['priority'],ENT_QUOTES,'UTF-8') . "<br>\n";
echo "内容:<br>" . nl2br(htmlspecialchars($result['content'],ENT_QUOTES,'UTF-8')) . "<br>\n";
$dbh = null;
echo "タスクの登録が完了しました。<br>";
echo "<a href='index5.php'>トップページへ戻る</a>";

} catch (Exception $e) {
echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
die();
}	
