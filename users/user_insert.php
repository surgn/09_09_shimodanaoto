<?php
// var_dump($_POST);
// exit();

include('../functions.php');

// 入力チェック
if (
    !isset($_POST['user_name']) || $_POST['user_name']=='' ||
    !isset($_POST['login_id']) || $_POST['login_id']=='' ||
    !isset($_POST['login_pass']) || $_POST['login_pass']=='' ||
    !isset($_POST['user_type']) || $_POST['user_type']==''
) {
    exit('ParamError');
}


//POSTデータの取得
$user_name = $_POST['user_name'];
$login_id = $_POST['login_id'];
$login_pass = $_POST['login_pass'];
$user_type = $_POST['user_type'];

// var_dump($user_name);
// var_dump($login_id);
// var_dump($login_pass);
// var_dump($user_type);
// exit();

//DB接続
$pdo = db_conn();

//ユーザデータ登録SQL作成
$sql ='INSERT INTO user_table(id, UserName, lid, lpw, kanri_flg, life_flg)
VALUES(NULL, :a1, :a2, :a3, :a4, "0")';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $user_name, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $login_id, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $login_pass, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $user_type, PDO::PARAM_INT);
// $stmt->bindValue(':a5', $life, PDO::PARAM_INT);
$status = $stmt->execute();

//データ登録処理後
if ($status==false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit('sqlError:'.$error[2]);
} else {
    //index.phpへリダイレクト
    var_dump('ユーザを登録しました！');
    header('Location: user_index.php');
}
