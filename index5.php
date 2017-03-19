<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>タスクの一覧</title>
</head>
<body>
<h1>タスクの一覧</h1>
<a href="form5.html">タスクの新規登録</a>
<h2>未完了タスク一覧</h2>
<?php
include 'config.php';

$dbh = new PDO($db_setting, $db_user, $db_pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM task WHERE is_done=0";
$stmt = $dbh->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if(count($result)<=0) { //データがひとつもないとき
	echo '未完了タスクがありません';
} else { //データがひとつ以上あるとき
	echo "<table>\n";
	echo "<tr>\n";
	echo "<th>タイトル</th><th>予定日</th><th>完了日</th><th>優先度</th>\n";
	echo "</tr>\n";
	foreach ($result as $row) {
		echo "<tr>\n";
		echo "<td>".htmlspecialchars($row['title'],ENT_QUOTES,'UTF-8')."</td>\n";
		echo "<td>".htmlspecialchars($row['scheduled_date'],ENT_QUOTES,'UTF-8')."</td>\n";
		echo "<td>".htmlspecialchars($row['completion_date'],ENT_QUOTES,'UTF-8')."</td>\n";
		echo "<td>".htmlspecialchars($row['priority'],ENT_QUOTES,'UTF-8')."</td>\n";
		echo "<td><input type='checkbox' name=".$row['id']." value='1'></td>\n";
		echo "<td>\n";
		echo "<a href=detail5.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">詳細</a>\n";
		echo "|<a href=edit5.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
		echo "|<a href=delete5.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
		echo "</td>\n";
		echo "</tr>\n";
	}	
	echo "</table>\n";
	echo '<button onClick="clickDoneButton()" >完了</button>';
}
//これ以下はデータがあろうがなかろうが実行
echo nl2br("\n");//改行のため使用
echo nl2br("\n");//改行のため使用


$dbh = new PDO($db_setting, $db_user, $db_pass);
 $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sql = "SELECT * FROM task WHERE is_done=1";
 $stmt = $dbh->query($sql);
 $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(count($result)<=1) { //データがひとつもないとき
	echo('完了タスク一覧');
	echo nl2br("\n");//改行のため使用
	echo nl2br("\n");//改行のため使用
	echo '完了タスクがありません';
} else { //データがひとつ以上あるとき

echo('完了タスク一覧');

 echo "<table>\n";
 echo "<tr>\n";
 echo "<th>タイトル</th><th>予定日</th><th>完了日</th><th>優先度</th>\n";
 echo "</tr>\n";
 foreach ($result as $row) {
 	echo "<tr>\n";
 	echo "<td>".htmlspecialchars($row['title'],ENT_QUOTES,'UTF-8')."</td>\n";
 	echo "<td>".htmlspecialchars($row['scheduled_date'],ENT_QUOTES,'UTF-8')."</td>\n";
 	echo "<td>".htmlspecialchars($row['completion_date'],ENT_QUOTES,'UTF-8')."</td>\n";
 	echo "<td>".htmlspecialchars($row['priority'],ENT_QUOTES,'UTF-8')."</td>\n";
 	echo "<td><input type='checkbox' name=".$row['id']." value='0'></td>\n";
 	echo "<td>\n";
 	echo "<a href=detail5.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">詳細</a>\n";
 	echo "|<a href=edit5.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">変更</a>\n";
 	echo "|<a href=delete5.php?id=" . htmlspecialchars($row['id'],ENT_QUOTES,'UTF-8') . ">削除</a>\n";
 	echo "</td>\n";
 	echo "</tr>\n";
 }	
 	echo "</table>\n";	
$dbh = null;



}
?>
<script>
function clickDoneButton(e) {
	var inputs = document.getElementsByTagName("input");
	var datas = [];
	for(var i in inputs) {
		var input = inputs[i];
		if(input.checked) {
			var data = {
				id:input.name,
				is_done:input.value
			};
			datas.push(data);
		}
	}
	window.location.href = "./update_done.php?data="+JSON.stringify(datas);
}
</script>



</body>
</html>
