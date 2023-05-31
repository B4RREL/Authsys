<?php require("includes/header.php"); ?>
<?php require("config.php"); ?>

<?php 

if(empty($_SESSION["username"])){

header('location: index.php');

};
 
?>

<main class="form-signin w-50 m-auto">
<form method="post" action="create.php">
    <!-- <img class="mb-4 text-center" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <h1 class="h3 mt-5 fw-normal text-center">Create Post</h1>

    <div class="form-floating">
      <input name="title" type="text" class="form-control" id="floatingInput" placeholder="Title">
      <label for="floatingInput">Title</label>
    </div>
    <!-- <div class="form-floating">
      <input name="email" type="text" class="form-control" id="floatingInput" placeholder="user.name">
      <label for="floatingInput">Username</label>
    </div> -->
    <div class="form-floating mt-4">
      <textarea name="body" rows="9" class="form-control" placeholder="body"></textarea>
      <label for="floatingPassword">Body</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary mt-4" type="submit">create</button>
    
  </form>
</main>

<?php 

if(isset($_POST["submit"])){

   if($_POST["title"] == '' || $_POST["body"] == ''){

    echo '<div class="alert alert-danger col-2 offset-4 mt-3">Some inputs are empty</div>';
   } else {
    $title = $_POST["title"];
    $body = $_POST["body"];
    $username = $_SESSION["username"];

    $insert = $conn->prepare("INSERT INTO posts (title, body, username)
     VALUES (:title, :body, :username)");

    $insert->execute([
            ':title' => $title,
            ':body' => $body,
            ':username' => $username,
    ]);

   header("location: index.php");

   }

}

?>

<?php require("includes/footer.php"); ?>