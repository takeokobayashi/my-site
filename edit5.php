<?php
include 'config.php';
try {
	if (empty($_GET['id'])) throw new Exception('Error');
	$id = (int) $_GET['id'];
$dbh = new PDO($db_setting, $db_user, $db_pass);
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM task WHERE id = ?";	
$stmt = $dbh->prepare($sql);
$stmt->bindvalue(1, $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$dbh = null;
// echo "タスクの登録が完了しました。<br>";
// echo "<a href='index5.php'>トップページへ戻る</a>";
} catch (Exception $e) {
echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
die();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>タスク登録</title>

<script type="text/javascript"> 
<!-- 

function check(){

	if(window.confirm('変更してよろしいですか？')){ // 確認ダイアログを表示

		return true; // 「OK」時は送信を実行

	}
	else{ // 「キャンセル」時の処理

		window.alert('キャンセルされました'); // 警告ダイアログを表示
		return false; // 送信を中止

	}

}

// -->
</script>

</head>
<body>
タスクの投稿<br>

<form method="POST" action="add5.php" onSubmit="return check()"><br>
タイトル：<input type="text" name="title" value="<?php echo htmlspecialchars($result['title'], ENT_QUOTES, 'UTF-8'); ?>"><br>
予定日:<input type="date" name="scheduled_date" value="<?php echo 
htmlspecialchars($result['scheduled_date'], ENT_QUOTES, 'UTF-8'); ?>">年月日
<br>
完了日:<input type="date" name="completion_date" value="<?php echo 
htmlspecialchars($result['completion_date'], ENT_QUOTES, 'UTF-8'); ?>">年月日
<br>
優先度:
<input type="radio" name="priority" value="1" <?php if($result['priority'] === "1") echo "checked" ?>>余裕あり
<input type="radio" name="priority" value="2" <?php if($result['priority'] === "2") echo "checked" ?>>普通
<input type="radio" name="priority" value="3" <?php if($result['priority'] === "3") echo "checked" ?>>急ぎ
<br>
内容：
<textarea name="content" cols="40" rows="4"><?php echo 
htmlspecialchars($result['content'], ENT_QUOTES, 'UTF-8'); ?></textarea>
<br>
<input type="hidden" name="id" value="<?php echo 
htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8'); ?>">
<input type="submit" value="登録">
</form>
</body>
</html>