<?php
$_SESSION = array();
session_destroy();
$sw=0;


if( isset($_POST[disp]) ){
    $uname = $_POST[uname];
    $pass = $_POST[pass];

    if( !empty(uname) and !empty($pass) ){
        session_start();
        $_SESSION[id]=$uname;
        $_SESSION[pass]=md5($pass);
        header('Location: menuadmin.php');
    }else{
        $sw=1;
    }

}
/*

INSERT INTO `Kanri`(`id`, `pass`) VALUES ('tabusa',md5('tabusa'));

*/
?>

<!DOCTYPE html>
<html lang='ja'>
<link rel="stylesheet" href="styles.css">
    <head>

        <meta charset='utf-8'>
        <title>担任管理簿</title>
    </head>
    <body>
        <div style="text-align:center;">
            <h1>管理者メニュー</h1>
            <form action="#" method="POST">
                ユーザ名：
                <input type="text" size="10" name="uname" ><br>
                パスワード：
                <input type="password" size="10" name="pass" ><br>
                <input type="submit" name="disp" value="ログイン">
            </form>

            <p></p>
            <a href="top.html">トップへ戻る</a>
            <?php
                if( $sw == 1 )
                    echo "<p>IDもしくはパスワードを入力してください。</p>\n";
            ?>
        </div>
    </body>
</html>