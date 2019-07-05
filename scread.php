<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スクレイピング from マ〇ナビ2020</title>
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
            <a class="navbar-brand" href="#">スクレイピング from マ〇ナビ2020</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">データ登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="select.php">データ一覧</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <form method="GET" action="ScMynaviKadai.php">
        <div class="form-group">
            <label for="start_num">開始番号</label>
            <input type="number" class="form-control" id="start_num" name="start_num" placeholder="Enter start number">
        </div>
        <div class="form-group">
            <label for="end_num">終了番号</label>
            <input type="number" class="form-control" id="end_num" name="end_num" placeholder="Enter end number">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</body>