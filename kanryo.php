<?php
session_start();

if( !isset($_SESSION[id]) ){
    $_SESSION = array();
    session_destroy();
    echo "ログアウトしました。";
    exit();
}else{ // //セッションIDがあるとき、前ページからPOSTを使ってhidden送信されたデータを受け取る
    $day = $_POST[day];
    $time = $_POST[time];
    $gakuban = $_POST[gakuban];

// データベースへの接続処理
//    echo $_POST[day]." ".$_POST[time$timem]." ".$_POST[sub];
    $dsn = 'mysql:host=localhost;dbname=db2022;charset=utf8';
    $dbid = 'db2022';
    $dbpass = 'db2022-pass';

    //データベースの接続
    try{
        $pdo = new PDO($dsn, $dbid, $dbpass);
        $pdo->query('SET NAMES utf8'); //文字化けの解消
    }
    catch (PDOExcepton $e){
        var_dump($e->getMessage());
        exit();
    }
    
//-------------------------------------------------------------
    //プレースホルダを準備
    $sql = "INSERT INTO History VALUES(:date1,:code,:time1)";
//        echo $sql."<br>";
        //値が空のSQL文をprepare()にセットし、SQL実行の準備を行う。
        $statement = $pdo->prepare($sql);
        //実際に挿入する値を配列に格納
        $params = array(':date1'=> $day,':code'=>$gakuban,':time1'=>$time);
        $statement->execute($params);
}

?>

<!DOCTYPE html>
<html lang='ja'>
<link rel="stylesheet" href="styles.css">
    <head>
        <meta charset='utf-8'>
        <title>予約ポータルサイト</title>
    </head>
    <body>
        <div style="text-align:center;">
            <h1>予約(完了)</h1>
            <h4>次の予約内容で登録しました。</h4>

                <p>日：<?php echo $day; ?> </p> 
                <p>時間：<?php echo $time; ?> </p>
                <p>学生番号：<?php echo $gakuban; ?> </p>
                <p>
                <a href="menu.php">メニューへ戻る</a><a href="top.html">トップへ戻る</a>
                </p>
        </div>
    </body>
</html>