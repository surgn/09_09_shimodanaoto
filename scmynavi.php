<?php
    set_time_limit(4000);
    require_once("./phpQuery-onefile.php");

    $company_start_id = 180000;
    $company_end_id = 190000;
    // companyid: 200,000 to 250,000

    for ($i=$company_start_id; $i < $company_end_id; $i++) {
        # code...
        // $html = file_get_contents("https://job.mynavi.jp/20/pc/search/corp111417/outline.html?func=PCtop");
        $html = file_get_contents("https://job.mynavi.jp/20/pc/search/corp".strval($i)."/outline.html?func=PCtop");
        
        // echo phpQuery::newDocument($html)->find("h1")->text();
        // $str = phpQuery::newDocument($html)->find(".dataTable02")->text();
        // $str = phpQuery::newDocument($html)->find(".corpDescDtoListDescTitle110")->text();

        // $str1 = phpQuery::newDocument($html)->find("#nolink")->text();
        // $str2 = phpQuery::newDocument($html)->find("h1")->text();
        // $str3 = phpQuery::newDocument($html)->find(".sameSize:eq(34)")->text();
        // $str4 = phpQuery::newDocument($html)->find(".sameSize:eq(11)")->text();
        // $str5 = phpQuery::newDocument($html)->find(".sameSize:eq(35)")->text();
    
        // $str = $str1.",".$str2.",".$str3.",".$str4.",".$str5;
        // $str = phpQuery::newDocument($html)->find("h1")->text();

        $doc = phpQuery::newDocument($html);

        // $str1 = $doc[".category"]->find("span")->text();
        // $str2 = $doc->find("h1")->text();
        // $str3 = $doc["table:eq(5)"]->find("tr:eq(6)")->find(".sameSize")->text();
        // $str4 = $doc["table:eq(6)"]->find("tr:eq(0)")->find(".sameSize")->text();
        // $str5 = $doc["table:eq(6)"]->find("tr:eq(1)")->find(".sameSize")->text();
   
        // $str = $str1.",".$str2.",".$str3.",".$str4.",".$str5;

        // 社名
        $company = $doc["h1"]->text();
        // 業種
        $category = $doc[".category"]->find("li")->find("span")->text();
        // 従業員数
        $employee_number = $doc[".companySec"]->find("table")->find("th:contains('従業員') + td")->text();
        // 本社住所
        $location = $doc[".companySec"]->find("table")->find("th:contains('本社所在地') + td")->text();
        // 問い合わせ
        $contact = $doc[".companySec"]->find("table")->find("th:contains('問い合わせ先') + td")->text();
        // URL
        $link = $doc[".companySec"]->find("table")->find("th:contains('URL') + td")->text();

        // strに格納
        $str = $i."\n".$category.",".$company.",".$employee_number.",".$location.",".$contact.",".$link."\n";
        
        // csvへのはきだし処理
        $file = fopen('data_mynavi/ScMynavidata'.strval($company_start_id).strval('_').strval($company_end_id-1).'.csv', 'a');
        flock($file, LOCK_EX);
        fwrite($file, $str."\n");
        flock($file, LOCK_UN);
        fclose($file);
    }

    // $html = file_get_contents("https://job.mynavi.jp/20/pc/search/corp210442/outline.html?func=PCtop");
    // // echo phpQuery::newDocument($html)->find("h1")->text();
    // // $str = phpQuery::newDocument($html)->find(".dataTable02")->text();
    // // $str = phpQuery::newDocument($html)->find(".corpDescDtoListDescTitle110")->text();

    // // $str1 = phpQuery::newDocument($html)->find("#nolink")->text();
    // // $str2 = phpQuery::newDocument($html)->find("h1")->text();
    // // $str3 = phpQuery::newDocument($html)->find(".sameSize:eq(34)")->text();
    // // $str4 = phpQuery::newDocument($html)->find(".sameSize:eq(11)")->text();
    // // $str5 = phpQuery::newDocument($html)->find(".sameSize:eq(35)")->text();
    
    // // $str = $str1.",".$str2.",".$str3.",".$str4.",".$str5;
    // // $str = phpQuery::newDocument($html)->find("h1")->text();

    // $doc = phpQuery::newDocument($html);

    // $str1 = $doc[".category"]->find("span")->text();
    // $str2 = $doc->find("h1")->text();
    // // $str3 = $doc["table:eq(5)"]->find("tr:eq(6)")->find(".sameSize")->text();
    // // $str4 = $doc["table:eq(6)"]->find("tr:eq(0)")->find(".sameSize")->text();
    // // $str5 = $doc["table:eq(6)"]->find("tr:eq(1)")->find(".sameSize")->text();

    // $str3 = $doc["table:eq(4)"]->find("tr:eq(6)")->find(".sameSize")->text();
    // $str4 = $doc["table:eq(5)"]->find("tr:eq(0)")->find(".sameSize")->text();
    // $str5 = $doc["table:eq(5)"]->find("tr:eq(1)")->find(".sameSize")->text();
   
    
    // $str = $str1.",".$str2.",".$str3.",".$str4.",".$str5;



    // $file = fopen('data/data.csv', 'a');
    // flock($file, LOCK_EX);
    // fwrite($file, $str."\n");
    // flock($file, LOCK_UN);
    // fclose($file);
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
    <div>
        <p class="text-left">書き込みました！</p>
    </div>
</body>

</html>