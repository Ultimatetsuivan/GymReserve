<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=db2022;charset=utf8';
$dbid = 'db2022';
$dbpass = 'db2022-pass';
try{
    $pdo = new PDO($dsn, $dbid, $dbpass);
    $pdo->query('SET NAMES utf8');
}
catch(PDOException $e){
    var_dump($e->getMessage());
    exit();
}
$sql = "select * from History order by date, time";
$statement = $pdo->prepare($sql);
$statement -> execute();
?>
<!DOCTYPE html>
<html lang='ja'>
<link rel="stylesheet" href="styles.css">
    <head>
        <meta charset='utf-8'>
        <title>Admin site</title>
    </head>
    <body>
        <div style="text-align:center;">
            <h1>予約者の全リスト</h1>
            <table border="1"  align="center">
                <tr><th>学生番号</th><th>日付</th><th>時間</th></tr>
                <?php
                    foreach ($statement as $row) {
                        $gakuban=$row[gakuban];
                        $day=$row[date];
                        $time=$row[time];
                        echo "<tr><td>$gakuban</td><td>$day</td><td>$time</td></tr>";
                        echo "\n";
                    }
                ?>
            
                </table>
            <a href="menuadmin.php">戻る</a>
        </div>
    </body>
</html>