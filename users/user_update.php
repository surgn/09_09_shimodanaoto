<?php
include('../functions.php');

//入力チェック(受信確認処理追加)
if (
    !isset($_POST['user_name']) || $_POST['user_name']=='' ||
    !isset($_POST['login_id']) || $_POST['login_id']=='' ||
    !isset($_POST['login_pass']) || $_POST['login_pass']==''
) {
    exit('ParamError');
}

//1. POSTデータ取得
$user_name = $_POST['user_name'];
$login_id = $_POST['login_id'];
$login_pass = $_POST['login_pass'];
$id     = $_POST['id'];

//2. DB接続します(エラー処理追加)
$pdo = db_conn();


//3．データ登録SQL作成
$sql = 'UPDATE user_table SET UserName=:a1, lid=:a2, lpw=:a3 WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $user_name, PDO::PARAM_STR);
$stmt->bindValue(':a2', $login_id, PDO::PARAM_STR);
$stmt->bindValue(':a3', $login_pass, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ登録処理後
if ($status==false) {
    errorMsg($stmt);
} else {
    header('Location: user_select.php');
    exit;
}
