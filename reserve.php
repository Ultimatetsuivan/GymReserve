<?php
session_start();

if( !isset($_SESSION[id]) ){
    $_SESSION = array();
    session_destroy();
    echo "ログアウトしました。";
    exit();
}
//echo "+".$_SESSION[id];

?>


<!DOCTYPE html>
<html lang='ja'>
<link rel="stylesheet" href="styles.css">
    <head>
        <meta charset='utf-8'>
        <title>予約するポータル</title>
    </head>
    <body>
        <div style="text-align:center;">
            <h1>予約するポータル</h1>
            <form action="kakunin.php" method="POST">
                <p>日を選ぶ：
                <input type="date" id="date" name="day"></p> 
                <p>時間を選ぶ：
                <select id="time" name="time">
                <option value=1500>15:00</option>
                <option value=1600>16:00</option>
                <option value=1700>17:00</option>
                <option value=1800>18:00</option>
                <option value=1900>19:00</option>
                </select></p>
                <p><input type="submit" value="完了"></p>
            </form>

            <p></p>
            <a href="menu.php">戻る</a>
        </div>
    </body>
</html>