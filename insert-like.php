<?php 

require("config.php");

if(isset($_POST["post_id"]) && isset($_POST["user_id"])){

     $post_id = $_POST["post_id"];
     $user_id = $_POST["user_id"];

    //  $delete = $conn->prepare("DELETE FROM likes WHERE post_id='$post_id' AND user_id='$user_id'");
    //  $delete->execute();

    $update = $conn->prepare('INSERT INTO likes (post_id,user_id) VALUES (:post_id,:user_id)');
    $update->execute([
        ":post_id" => $post_id,
        ":user_id" => $user_id,    
    ]);





}
?>