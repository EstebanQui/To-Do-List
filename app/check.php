<?php

if(isset($_POST['id'])){
    require '../connexion.php';

    $id = $_POST['id'];

    if(empty($id)){
        echo 'error';
    }else {
        $todos = $connexion->prepare("SELECT id,checked FROM faire WHERE id=?");
        $todos->execute($id);

        $todo = $todos->fetch();
        $uId = $todo["id"];
        $checked = $todo['checked'];

        $uChecked = $checked ? 0 : 1;

        $res = $connexion->query("UPDATE faire SET checked=$uChecked WHERE id=$uId");

        if($res){
            echo $checked;
        }else {
            echo "error";
        }

        $connexion = null;
        exit();
    }
}else {
    header("location: ../index.php?mess=error");
}