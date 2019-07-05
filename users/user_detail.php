<?php
// 関数ファイルの読み込み
include('../functions.php');

// var_dump($_GET);
// exit();

$id = $_GET['id'];

//DB接続します
$pdo = db_conn();

//データ登録SQL作成，指定したidのみ表示する
$sql = 'SELECT * FROM user_table WHERE id=:id';
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
    var_dump($rs);
    // fetch()で1レコードを取得して$rsに入れる
    // $rsは配列で返ってくる．$rs["id"], $rs["task"]などで値をとれる
    // var_dump()で見てみよう
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザ更新ページ</title>
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
            <a class="navbar-brand" href="#">ユーザ更新</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="user_index.php">ユーザ登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user_select.php">ユーザ一覧</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="form-group">
        <p>ユーザタイプ(管理者: 0, 一般ユーザ: 1)</p>
        <p><?= $rs['kanri_flg'] ?>
        </p>
    </div>

    <form method="post" action="user_update.php">
        <div class="form-group">
            <label for="user_name">ユーザ</label>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <input type="text" class="form-control" id="user_name" name="user_name"
                value="<?= $rs['UserName'] ?>">
        </div>
        <div class="form-group">
            <label for="login_id">ログインID</label>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <input type="text" class="form-control" id="login_id" name="login_id"
                value="<?= $rs['lid'] ?>">
        </div>
        <div class="form-group">
            <label for="login_pass">ログインpass</label>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <input type="text" class="form-control" id="login_pass" name="login_pass"
                value="<?= $rs['lpw'] ?>">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <!-- idは変えたくない = ユーザーから見えないようにする-->
        <input type="hidden" name="id"
            value="<?= $rs['id'] ?>">
    </form>

</body>

</html>