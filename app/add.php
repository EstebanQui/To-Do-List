<?php

if(isset($_POST['title'])){
    require '../connexion.php';

    $title = $_POST['title'];

    if(empty($title)){
        header("location: ../index.php?mess=error");
    }else {
        $stmt = $connexion->prepare("INSERT INTO faire(title) VALUE(?)");
        $res = $stmt->execute([$title]);

        if($res){
            header("location: ../index.php?mess=success");
        }else {
            header("location: ../index.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("location: ../index.php?mess=error");
}