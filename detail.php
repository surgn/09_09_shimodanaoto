<?php
// var_dump($_GET);
// exit();

include('functions.php');

$id = $_GET['id'];

//DB接続します
$pdo = db_conn();

//データ登録SQL作成，指定したidのみ表示する
$sql = 'SELECT * FROM company_lists_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


//データ表示
if ($status==false) {
    // エラーのとき
    errorMsg($stmt);
} else {
    // エラーでないとき
    $rs = $stmt->fetch();
    // var_dump($rs);
    // fetch()で1レコードを取得して$rsに入れる
    // $rsは配列で返ってくる．$rs["id"], $rs["task"]などで値をとれる
    // var_dump()で見てみよう
}

// $mynavi_link = 'https://job.mynavi.jp/20/pc/search/corp'.strval($i).'/outline.html?func=PCtop';
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
                </ul>
            </div>

        </nav>
    </header>

    <!-- <div class="mynavi_link">
        <a href="https://job.mynavi.jp/20/pc/search/corp" .strval."/outline.html?func=PCtop"> </a>
     </div>  -->
    <form method="post" action="update.php">
        <div class="form-group">
            <label for="company">企業名</label>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <input type="text" class="form-control" id="company" name="company" value="<?= $rs['company'] ?>">
        </div>
        <div class="form-group">
            <label for="deadline">業種</label>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <input type="text" class="form-control" id="category" name="category" value="<?= $rs['category'] ?>">
        </div>
        <div class="form-group">
            <label for="contact">お問い合わせ先</label>
            <!-- 受け取った値挿入しよう -->
            <textarea class="form-control" id="contact" name="contact" rows="3"><?= $rs['contact'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="deadline">企業URL</label>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <input type="text" class="form-control" id="company_url" name="company_url"
                value="<?= $rs['company_url'] ?>">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <!-- idは変えたくない = ユーザーから見えないようにする-->
        <input type="hidden" name="id" value="<?= $rs['id'] ?>">
        <input type="hidden" name="mynavi_id" value="<?= $rs['mynavi_id'] ?>">
        <!-- <input type="hidden" name="company_location"
                value="">
            <input type="hidden" name="employee_num"
                value=""> -->
    </form>
</body>

</html>