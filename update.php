<?php
// 関数ファイル読み込み
include('functions.php');

// var_dump($_POST);
// exit();

//入力チェック(受信確認処理追加)
if (
    !isset($_POST['company']) || $_POST['company']==''
) {
    exit('ParamError');
}

// var_dump($_POST);
// exit();

//POSTデータ取得
$company = $_POST['company'];
$category = $_POST['category'];
$contact = $_POST['contact'];
$company_url = $_POST['company_url'];
$id = $_POST['id'];
$mynavi_id = $_POST['mynavi_id'];

//DB接続します(エラー処理追加)
$pdo = db_conn();

// データ登録SQL作成
// $sql = 'UPDATE company_lists_table SET mynavi_id=:a2, category=:a3, company=:a1, contact=:a4, company_url=:a5 WHERE id=:id';
$sql = 'UPDATE company_lists_table SET category=:a3, company=:a1, contact=:a4, company_url=:a5 WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $company, PDO::PARAM_STR);
// $stmt->bindValue(':a2', $mynavi_id, PDO::PARAM_STR);
$stmt->bindValue(':a3', $category, PDO::PARAM_STR);
$stmt->bindValue(':a4', $contact, PDO::PARAM_STR);
$stmt->bindValue(':a5', $company_url, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ登録処理後
if ($status==false) {
    errorMsg($stmt);
} else {
    header('Location: select.php');
    exit;
}
