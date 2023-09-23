<?php
session_start();
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
$flag=0;
if( isset($_POST[disp]) ){
    if( $_POST[gakuban]){
    $gakuban = $_POST[gakuban];
    $sql = "SELECT * FROM History NATURAL JOIN Gakusei36 where gakuban =:gakuban ORDER BY date,time;";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':gakuban', $gakuban, PDO::PARAM_STR);
    $statement->execute();
    $flag=1;
    
}
if( $_POST[dates]){
    $dates=$_POST[dates];
    $sql = "SELECT * FROM History NATURAL JOIN Gakusei36 where date = :dates ORDER BY date,time;";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':dates', $dates, PDO::PARAM_STR);
    $statement->execute();
    $flag=1;
}
if( $_POST[dates] && $_POST[gakuban]){
    $dates=$_POST[dates];
    $gakuban = $_POST[gakuban];
    $sql = "SELECT * FROM History NATURAL JOIN Gakusei36 where date = :dates and gakuban =:gakuban ORDER BY date,time;";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':dates', $dates, PDO::PARAM_STR);
    $statement->bindValue(':gakuban', $gakuban, PDO::PARAM_STR);
    $statement->execute();
    $flag=1;
}
}
/**** 
    int PDO::PARAM_INT 
    char,string,double PDO::PARAM_STR
****/
?>

<!DOCTYPE html>
<html lang='ja'>
<link rel="stylesheet" href="styles.css">
    <head>
        <meta charset='utf-8'>
        <title>筋トレ予約</title>
    </head>
    <body>
        <div style="text-align:center;">
            <h1>フィルタで探す</h1>
            <form action="#" method="POST">
                日にち：
                <input type="date" name="dates" ><br>
                学生番号：
                <input type="text" size="10" name="gakuban" >
                <input type="submit" name="disp" value="表示">
            </form>
<!--
            <p>検索結果を出力</p>
-->
<?php
if( $flag ){
    echo '<table border="1"  align="center">';
    echo '<tr><th>学生番号</th><th>学科</th><th>名前</th><th>日にち</th><th>時間</th></tr>';
    
    $cnt=0;
    foreach($statement as $row) {
        $gakuban=$row[gakuban];
            $day=$row[date];
            $time=$row[time];
            $name = $row[name];
            if( $row[sub]== "I" )
            $sub="情報";
        else
            $sub="総合";
            echo "<tr><td>$gakuban</td><td>$sub</td><td>$name</td><td>$day</td><td>$time</td></tr>";
        $cnt++;
    }
    echo "</table>";
    if( !$cnt )
        echo "<p>該当データがありません</p>\n";
}
?>


            <a href="menuadmin.php">戻る</a>
        </div>
    </body>
</html>