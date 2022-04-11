<?php
mb_internal_encoding("utf8");

if(isset($_POST['name'])){
session_start();

try{
    $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","root");
}catch(PDOException $e){
    die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスできません。<br>しばらく経ってから再度ログインをしてください。</p>
    <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>"
    );
}

$stmt = $pdo->prepare("update login_mypage set name=?, mail=?, password=?, comments=? where id=?");
$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['comments']);
$stmt->bindValue(5,$_SESSION['id']);

$stmt->execute();

$stmt = $pdo->prepare("select * from login_mypage where id=?");
$stmt->bindValue(1,$_SESSION['id']);

$stmt->execute();

$pdo = NULL;

$member = $stmt->fetch();
$_SESSION['id'] = $member['id'];
$_SESSION['name'] = $member['name'];
$_SESSION['mail'] = $member['mail'];
$_SESSION['password'] = $member['password'];
$_SESSION['picture'] = $member['picture'];
$_SESSION['comments'] = $member['comments'];
}

header('Location:mypage.php');

?>