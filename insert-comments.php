

<?php require "config.php"; ?>

<?php 

if(isset($_POST["submit"])){

   
  
     $username = $_POST["username"];
     $post_id = $_POST["post_id"];
     $comment = $_POST['comment'];
  
    $insert = $conn->prepare("INSERT INTO comments (username, post_id, comment) 
    VALUES (:username, :post_id, :comment)"); // insert data into database table
  
    $insert->execute(
      array(
      ':username' => $username,
      ':post_id' => $post_id,
      ':comment' => $comment,
    ));
  
   }
  
// var_dump($_POST);

?>

