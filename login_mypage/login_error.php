<?php
session_start();
if(isset($_SESSION['id'])){
    header("Location:mypage.php");
}
?>

<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="utf_8">
        <title>ログインエラー</title>
        <link rel="stylesheet" type="text/css" href="./login.css">
    </head>

    <body>

        <header>
        <img src="4eachblog_logo.jpg">
            <div class="login"><a href="login.php">ログイン</a></div>
        </header>

        <main>
            <form action="./mypage.php" method="POST" enctype="multipart/form-data">
                <div class="form_contents">
                    <p class="error">メールアドレスまたはパスワードが間違っています。</p>
                    <div class="mail">
                        <label>メールアドレス</label><br>
                        <input type="text" class="formbox" size="40" name="mail" pattern="^[a-z0-9.%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                        value="<?php
                        if(isset($_COOKIE['login_keep'])){
                            echo $_COOKIE['mail'];
                        }
                        ?>" required>
                    </div>
                    <div class="password">
                        <label>パスワード</label><br>
                        <input type="password" class="formbox" size="40" name="password" id="password" pattern="^[a-zA-Z0-9]{6,}$"
                        value="<?php
                        if(isset($_COOKIE['login_keep'])){
                            echo $_COOKIE['password'];
                        }
                        ?>"required>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" class="formbox" size="40" name="login_keep" value="login_keep"
                        <?php
                        if(isset($_COOKIE['login_keep'])){
                            echo "checked='checked'";
                        }
                        ?>>ログイン状態を保持する</label>
                    </div>
                    <div class="submit">
                        <input type="submit" class="submit_button" size="35" value="ログイン">
                    </div>
                </div>
            </form>
        </main>

        <footer>
            ©︎ 2018 InterNous.inc All rights reserved
        </footer>

    </body>

</html>