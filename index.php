<?php
// ①配列にデータを設定
$company_data = ['data_kadai/ScMynavidata0_99.csv'=>'会社データNo.0～No.99',
             'data_kadai/ScMynavidata100_199.csv'=>'会社データNo.100～No.199',
             'data_kadai/ScMynavidata200_299.csv'=>'会社データNo.200～No.299'
            ];
// ②配列のデータをoptionタグに整形
foreach($company_data as $company_data_key => $company_data_val){
    $company_data .= "<option value='". $company_data_key;
    $company_data .= "'>". $company_data_val. "</option>";
}
 
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>企業登録</title>
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
            <a class="navbar-brand" href="#">企業登録</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="select.php">データ一覧</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="scread.php">スクレイピング from マ〇ナビ2020</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- <form action="insert.php" method="POST">
        <div class="form-group">
            <label for="task">Task</label>
            <input type="text" class="form-control" id="task" name="task">
        </div>
        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="date" class="form-control" id="deadline" name="deadline">
        </div>
        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form> -->

    <form action="insert.php" method="POST">
        <select name="company">
            <!-- <option value="data_kadai/ScMynavidata0_99">会社データNo.0～No.99</option>
            <option value="data_kadai/ScMynavidata100_199">会社データNo.100～No.199</option>
            <option value="data_kadai/ScMynavidata200_299">会社データNo.200～No.299</option> -->
            <?php
            echo $company_data;
            ?>
        </select>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</body>

</html>