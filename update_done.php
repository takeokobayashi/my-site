<?php
include 'config.php';
$json = $_GET['data'];
$datas = json_decode($json);

foreach ($datas as $data) {
    try {
        $data = (array)$data;
        $dbh = new PDO($db_setting, $db_user, $db_pass);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE task SET is_done = ? WHERE id = ?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindvalue(1, $data['is_done'], PDO::PARAM_STR);
        $stmt->bindvalue(2, $data['id'], PDO::PARAM_INT);
        $stmt->execute();
        $dbh = null;
        echo "ID: " . htmlspecialchars($data['id'],ENT_QUOTES,'UTF-8') 
            . "タスクの更新が完了しました。";
    } catch (PDOException $e) {
        echo "エラー発生: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
        die();
    }
}
