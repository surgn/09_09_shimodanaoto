<?php
$user_type = ['0'=>'管理者', '1'=>'一般ユーザ'];

foreach ($user_type as $user_type_key => $user_type_val) {
    $user_type .= "<option value='". $user_type_key;
    $user_type .= "'>". $user_type_val. "</option>";
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザ登録</title>
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
            <a class="navbar-brand" href="#">ユーザ登録</a>
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

    <form method="post" action="user_insert.php">
        <div class="form-group">
            <label for="user_name">ユーザ名</label>
            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter user name">
        </div>
        <div class="form-group">
            <label for="login_id">ログインID</label>
            <input type="text" class="form-control" id="login_id" name="login_id" placeholder="Enter login ID">
        </div>
        <div class="form-group">
            <label for="login_pass">パスワード</label>
            <input type="text" class="form-control" id="login_pass" name="login_pass" placeholder="Enter password">
        </div>
        <div class="form-group">
            <label for="user_type">ユーザタイプ</label>
            <select id="user_type" name="user_type">
                <?php echo $user_type; ?>
            </select>
        </div>



        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</body>

</html>