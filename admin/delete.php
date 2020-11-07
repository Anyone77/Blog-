<?php


session_start();
require "../config/config.php";


$stmt = $pdo->prepare("DELETE FROM posts WHERE id =".$_GET['id']);
$result = $stmt->execute();

if($result){
    echo "<script>window.location.href='index.php'; </script>";
}

?>