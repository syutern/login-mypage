<?php
mb_internal_encoding("utf8");
session_start();

if(isset($_POST['mail'])){
    try{
        $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","root");
    }catch(PDOException $e){
        die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスできません。<br>しばらく経ってから再度ログインをしてください。</p>
        <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>"
        );
    }

    $stmt = $pdo->prepare("select * from login_mypage where mail = ? AND password = ?");
    $stmt->bindValue(1,$_POST['mail']);
    $stmt->bindValue(2,$_POST['password']);

    $stmt->execute();
    $pdo = NULL;

    $member = $stmt->fetch();
    $_SESSION['id'] = $member['id'];
    $_SESSION['name'] = $member['name'];
    $_SESSION['mail'] = $member['mail'];
    $_SESSION['password'] = $member['password'];
    $_SESSION['picture'] = $member['picture'];
    $_SESSION['comments'] = $member['comments'];

    if(!empty($_POST['login_keep'])){
        $_SESSION['login_keep']=$_POST['login_keep'];
    }
}

if(empty($_SESSION['id'])){
    header('Location:login_error.php');
}

if(!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])){
    setcookie('mail', $_SESSION['mail'], time()+60*60*24*7);
    setcookie('password', $_SESSION['password'], time()+60*60*24*7);
    setcookie('login_keep', $_SESSION['login_keep'], time()+60*60*24*7);
} else if(!empty($_SESSION['id']) && empty($_SESSION['login_keep'])){
    setcookie('mail', '', time()-1);
    setcookie('password', '', time()-1);
    setcookie('login_keep', '', time()-1);
}

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページ</title>
        <link rel="stylesheet" type="text/css" href="mypage.css">
    </head>

    <body>
        <header>
            <img src="4eachblog_logo.jpg">
            <div class="login"><a href="log_out.php">ログアウト</a></div>
        </header>

        <main>

            <div class="contents">
                <h2>会員情報</h2>
                <p>こんにちは！ <?php echo $_SESSION['name']; ?>さん</p>
                <div class="left">
                    <img class="img" src="<?php echo $_SESSION['picture']; ?>" width="100px">
                </div>
                <div class="right">
                    <p class="item">氏名: <?php echo $_SESSION['name']; ?></p>
                    <p class="item">メール: <?php echo $_SESSION['mail']; ?></p>
                    <p class="item">パスワード: <?php echo $_SESSION['password']; ?></p>
                </div>
                <p class="comments"><?php echo $_SESSION['comments']; ?></p>
                <form class="submit" method="post" action="mypage_hensyu.php">
                    <input type="submit" class="submit_button" size="35" value="編集する">
                </form>
            </div>

        </main>

        <footer>
            ©︎ 2018 InterNous.inc All rights reserved
        </footer>
    </body>
</html>