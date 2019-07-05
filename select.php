<?php
// 関数ファイルの読み込み
include('functions.php');

//1. DB接続
$pdo = db_conn();

// $dbn = 'mysql:dbname=gsf_d03_db09;charset=utf8;port=3306;host=localhost';
// $user = 'root';
// $pwd = '';

// try {
//     $pdo = new PDO($dbn, $user, $pwd);
// } catch (PDOException $e) {
//     exit('dbError:'.$e->getMessage());
// }

//2. データ表示SQL作成
$sql = 'SELECT * FROM company_lists_table';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();


//3. データ表示
$view='';
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('sqlError:'.$error[2]);
} else {
    //Selectデータの数だけ自動でループしてくれる
    //http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<li class="list-group-item">';
        // $view .= '<p>'.$result['company'].'-'.$result['category'].'</p>';
        $view .= '<h5>'.$result['company'].'</h5>';
        $view .= '<p>'.$result['category'].'</p>';
        $view .= '<p>従業員数：'.$result['employee_num'].'</p>';
        $view .= '<p>お問い合わせ先<br>'.$result['contact'].'</p>';
        // $view .= '<p>'.$result['contact'].'</p>';
        $view .= '<p>企業URL：<a href="'.$result['company_url'].'">'.$result['company_url'].'</a></p>';
        
        $view .= '<a href="detail.php?id='.$result['id'].'" class="badge badge-primary">Edit</a>';
        $view .= '<a href="delete.php?id='.$result['id'].'" class="badge badge-danger">Delete</a>';
        $view .= '</li>';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>企業表示</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">企業一覧</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">企業登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="scread.php">スクレイピング from マ〇ナビ2020</a>
                    </li>
                </ul>
            </div>

        </nav>
    </header>

    <div>
        <ul class="list-group">
            <!-- ここにDBから取得したデータを表示しよう -->
            <?=$view?>
        </ul>
    </div>

</body>

</html>