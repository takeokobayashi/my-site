<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>出力結果</title>
</head>
<body>
<?php
// print_r($_POST);
echo htmlspecialchars($_POST['title'],ENT_QUOTES,'UTF-8');

echo "<br>";
if (is_numeric($_POST['scheduled_date'])) {
	echo number_format($_POST['scheduled_date']);
}

echo "<br>";
if (is_numeric($_POST['completion_date'])) {
	echo number_format($_POST['completion_date']);
}

echo "<br>";
if ($_POST['priority'] === '1') {
	echo "余裕あり";
} elseif ($_POST['priority'] === '2') {
	echo "普通";
} else {
	echo "急ぎ";
}

echo "<br>";
echo nl2br(htmlspecialchars($_POST['content'],ENT_QUOTES,'UTF-8'));
echo "<br>";
?>
</body>
</html>