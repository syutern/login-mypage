<?php
mb_internal_encoding("utf8");
//プロフィール写真のテンポラリファイル名を取得
$temp_pic_name = $_FILES['picture']['tmp_name'];
//元のファイル名を取得、保存先を指定
$original_pic_name = $_FILES['picture']['name'];
if(empty($original_pic_name)){
    $original_pic_name = 'default.png';
}
$path_filename = './image/'.$original_pic_name;
//仮ファイルを元のファイル名でimageフォルダに移動
move_uploaded_file($temp_pic_name, $path_filename);

if(empty($_POST['name'])){
    header('Location:register.html');
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf=8">
        <title>会員登録確認</title>
        <link rel="stylesheet" type="text/css" href="./register_confirm.css">
    </head>

    <body>
    
        <header>
            <img src="4eachblog_logo.jpg">
            <div class="login"><a href="login.php">ログイン</a></div>
        </header>

        <main>
            
            <div class="contents">
                <h2>会員登録 確認</h2>
                <p id="ok">こちらの内容で登録してもよろしいでしょうか？</p>
                <p class="item">氏名: <?php echo $_POST['name']; ?> </p>
                <p class="item">メール: <?php echo $_POST['mail']; ?> </p>
                <p class="item">パスワード: <?php echo $_POST['password']; ?> </p>
                <p class="item">プロフィール写真:
                <?php
                if ($path_filename != "./image/default.png") {
                    echo '</p><p class="item"><img src="'.$path_filename.'" width="128px"></p>';
                } else{
                    echo ' なし</p>';
                }
                ?>
                <p class="item">コメント: <?php echo $_POST['comments']; ?> </p>
 
                <div class="center">
                    <form action="register.html">
                        <input type="submit" class="back_button" value="戻って修正する">
                    </form>

                    <form action="register_insert.php" method="post" enctype="multipart/form-data">
                        <input type="submit" class="submit_button" value="登録する">
                        <input type="hidden" value="<?php echo $_POST['name']; ?>" name="name">
                        <input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail">
                        <input type="hidden" value="<?php echo $_POST['password']; ?>" name="password">
                        <input type="hidden" value="<?php echo $path_filename; ?>" name="path_filename">
                        <input type="hidden" value="<?php echo $_POST['comments']; ?>" name="comments">
                    </form>
                </div>

            </div>

        </main>

        <footer>
            ©︎ 2018 InterNous.inc All rights reserved
        </footer>

    </body>
</html>