<?php
mb_internal_encoding("utf8");

session_start();

if(empty($_SESSION['id'])){
    header('Location:login_error.php');
}

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページ編集</title>
        <link rel="stylesheet" type="text/css" href="mypage.css">
    </head>

    <body>
         <header>
            <img src="4eachblog_logo.jpg">
            <div class="login"><a href="log_out.php">ログアウト</a></div>
        </header>

        <main>

            <form action="mypage_update.php" method="POST" enctype="multipart/form-data">
                <div class="contents">
                    <h2>会員情報</h2>
                    <p>こんにちは！ <?php echo $_SESSION['name']; ?>さん</p>
                    <div class="left">
                        <img class="img" src="<?php echo $_SESSION['picture']; ?>" width="100px">
                    </div>
                    <div class="right">
                        <p class="item">氏名: <input type="text" class="formbox" size="40" name="name" value="<?php echo $_SESSION['name']; ?>" required></p>
                        <p class="item">メール: <input type="text" class="formbox" size="40" name="mail" pattern="^[a-z0-9.%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="<?php echo $_SESSION['mail']; ?>" required></p>
                        <p class="item">パスワード: <input type="password" class="formbox" size="40" name="password" id="password" pattern="^[a-zA-Z0-9]{6,}$" value="<?php echo $_SESSION['password']; ?>" required></p>
                    </div>
                    <p class="comments"><textarea class="formbox" rows="5" cols="80" name="comments"><?php echo $_SESSION['comments']; ?></textarea></p>
                    <div class="submit">
                        <input type="submit" class="submit_button" size="35" value="この内容に変更する">
                    </div>
                </div>
            </form>

        </main>

        <footer>
            ©︎ 2018 InterNous.inc All rights reserved
        </footer>
    </body>
</html>