<?php
//共通で使うものを別ファイルにしておきましょう。

//DB接続関数（PDO）
function db_conn()
{
    //1. DB接続
    $dbn = 'mysql:dbname=gsf_d03_db09;charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = '';

    try {
        // $pdo = new PDO($dbn, $user, $pwd);
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        exit('dbError:'.$e->getMessage());
    }
}


//SQL処理エラー
function errorMsg($stmt)
{
    $error = $stmt->errorInfo();
    exit('ErrorQuery:'.$error[2]);
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// SESSIONチェック＆リジェネレイト
function chk_ssid()
{
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid']!=session_id()) {
        // ログイン失敗時の処理（ログイン画面に移動）
        header('Location: login.php');
    } else {
        // ログイン成功時の処理（一覧画面に移動）
        session_regenerate_id(true); // セッションidの再生成
        $_SESSION['chk_ssid'] = session_id(); // セッション変数に格納
    }
}
