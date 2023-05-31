<?php 

require("config.php");

if(isset($_POST["post_id"]) && isset($_POST["user_id"])){

     $post_id = $_POST["post_id"];
     $user_id = $_POST["user_id"];
    $update = $conn->prepare("DELETE FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'");
    $update->execute();





}
?>