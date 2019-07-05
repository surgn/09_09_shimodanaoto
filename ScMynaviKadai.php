<?php
    set_time_limit(4000);
    require_once("./phpQuery-onefile.php");

    $company_start_id = $_GET['start_num'];
    $company_end_id = $_GET['end_num'];

    // $company_start_id = 200;
    // $company_end_id = 300;
    // companyid: 200,000 to 250,000

    for ($i=$company_start_id; $i < $company_end_id; $i++) {
        # code...
        // $html = file_get_contents("https://job.mynavi.jp/20/pc/search/corp208451/outline.html?func=PCtop");
        $html = file_get_contents("https://job.mynavi.jp/20/pc/search/corp".strval($i)."/outline.html?func=PCtop");
        
        // echo phpQuery::newDocument($html)->find("h1")->text();

        $doc = phpQuery::newDocument($html);

        // $str1 = $doc[".category"]->find("span")->text();
        // $str2 = $doc->find("h1")->text();
        // $str3 = $doc["table:eq(5)"]->find("tr:eq(6)")->find(".sameSize")->text();
        // $str4 = $doc["table:eq(6)"]->find("tr:eq(0)")->find(".sameSize")->text();
        // $str5 = $doc["table:eq(6)"]->find("tr:eq(1)")->find(".sameSize")->text();
   
        // $str = $str1.",".$str2.",".$str3.",".$str4.",".$str5;

        
        // 社名
        $company = $doc["h1"];
        $company_child = $company->find("span")->text();

        var_dump($company_child);
        // exit();
        if (strlen($company_child) == 0) {
        
            // $company = $doc["h1"];
            // pq("span")->remove();
            // $company = pq("h1");

            $company = $company->text();
            // 業種
            $category = $doc[".category"]->find("li:eq(0)")->find("span")->text();
            // 従業員数
            $employee_number = $doc[".companySec"]->find("table")->find("th:contains('従業員'):first + td")->text();
            // 本社住所
            $location = $doc[".companySec"]->find("table")->find("th:contains('本社所在地'):first + td")->text();
            // $location = $doc[".companySec"]->find("table")->find("tr:first('事業内容') + tr")->text();
            // $location = $doc[".companySec"]->find("table")->find("#corpDescDtoListDescTitle50")->find("td")->text();
            // 問い合わせ
            $contact = $doc[".companySec"]->find("table")->find("th:contains('問い合わせ先'):first + td")->text();
            // URL
            $link = $doc[".companySec"]->find("table")->find("th:contains('URL'):first + td")->text();


            $turn_number = str_replace(',', '', $employee_number);

            // strに格納
            $str = $i.",".$category.",".$company.",".$turn_number.",".$location.",".$contact.",".$link;
        
            // csvへのはきだし処理
            $file = fopen('data_kadai/ScMynavidata'.strval($company_start_id).strval('_').strval($company_end_id-1).'.csv', 'a');
            flock($file, LOCK_EX);
            fwrite($file, $str."\n");
            flock($file, LOCK_UN);
            fclose($file);
        }
    }

    ?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>todo登録</title>
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
    <!-- 
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">データ登録練習</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="txt_form.php">登録ページ</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="txt_read.php">一覧ページ</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header> -->
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
    <div>
        <p class="text-left">書き込みました！</p>
    </div>
</body>

</html>