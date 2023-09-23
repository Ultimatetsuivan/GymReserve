<?php
session_start();

if( !isset($_SESSION[id]) ){
    $_SESSION = array();
    session_destroy();
    echo "ログアウトしました。";
    exit();
}else{
    $day = $_POST[day];
    $time = $_POST[time];
    $gakuban = $_POST[gakuban];
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
            <h1>予約(確認)</h1>
            <h4>次の予約の内容でよければ登録ボタンを押してください。</h4>

            <p>日付：<?php echo $day; ?> </p> 
            <p>時間：<?php echo $time; ?></p>
            <p>学番：<?php echo $_SESSION[id]; ?></p>
            <p>
            
            <table align="center">
                <tr><td>
                <form action="reserve.php" method="POST">
                    <input type="submit" value="再入力">
                </form>
                </td><td>
                <form action="kanryo.php" method="POST">
                    <input type="hidden" name="day" value="<?php echo $day;?>">
                    <input type="hidden" name="time" value="<?php echo $time;?>">
                    <input type="hidden" name="gakuban" value="<?php echo $_SESSION[id];?>">
                    <input type="submit" value="登　録">
                </form>
                </td></tr>
                </table>
                </p>

        </div>
    </body>
</html>