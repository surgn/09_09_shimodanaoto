<?php
// var_dump($_POST);
// exit();

// 関数ファイルの読み込み
include('functions.php');

//postデータの取得
$company_list = $_POST['company'];

// var_dump($company_list);
// exit();

// csvファイルの読み込み
$file = fopen($company_list, 'r');

if ($file === false) {
    var_dump("エラー");
    exit();
} else {
    setlocale(LC_ALL, 'ja_JP');
    flock($file, LOCK_EX);
    
    $i=0;
    while (($csv_data = fgetcsv($file)) !== false) {
        // mb_convert_variables('UTF-8', 'sjis-win', $csv_data);
        // if($i == 0){
        // // タイトル行
        // $header = $csv_data;
        // $i++;
        // continue;
        // }

        $data[] = $csv_data;

        $i++;
    }

    // foreach ($file as $line) {
    //     $line = mb_convert_encoding($line, 'UTF-8', 'sjis-win');
    //     $data[] = str_getcsv($line);
    // }

    // while ($line = fgets($file)) {
    //     $data[] = $line;
    //     // $str .= '<p>'.$line.'</p>';
    // }
    
    flock($file, LOCK_UN);
    fclose($file);
    // var_dump($data[2]);
    // exit();
}


//DB接続
$pdo = db_conn();

// $dbn = 'mysql:dbname=gsf_d03_db09;charset=utf8;port=3306;host=localhost';
// $user = 'root';
// $pwd = '';

// try {
//     $pdo = new PDO($dbn, $user, $pwd);
// } catch (PDOException $e) {
//     exit('dbError:'.$e->getMessage());
// }

for ($i=0; $i < count($data); $i++) {
    // //データ登録SQL作成
    $sql ='INSERT INTO company_lists_table(id, mynavi_id, category, company, employee_num, company_location, contact, company_url, indate)VALUES(NULL, :a1, :a2, :a3, :a4, :a5, :a6, :a7, sysdate())';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':a1', $data[$i][0], PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':a2', $data[$i][1], PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':a3', $data[$i][2], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
    $stmt->bindValue(':a4', $data[$i][3], PDO::PARAM_STR);
    $stmt->bindValue(':a5', $data[$i][4], PDO::PARAM_STR);
    $stmt->bindValue(':a6', $data[$i][5], PDO::PARAM_STR);
    $stmt->bindValue(':a7', $data[$i][6], PDO::PARAM_STR);
    $status = $stmt->execute();
}

//４．データ登録処理後
if ($status==false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit('sqlError:'.$error[2]);
} else {
    //５．index.phpへリダイレクト
    header('Location: index.php');
}
