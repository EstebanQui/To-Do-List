<?php

if(isset($_POST['id'])){
    require '../connexion.php';

    $id = $_POST['id'];

    if(empty($id)){
       echo 0;
    }else {
        $stmt = $connexion->prepare("DELETE FROM faire WHERE id=?");
        $res = $stmt->execute([$id]);

        if($res){
            echo 1;
        }else {
            echo 0;
        }
        $connexion = null;
        exit();
    }
}else {
    header("location: ../index.php?mess=error");
}