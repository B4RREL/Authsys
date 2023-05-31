<?php require "includes/header.php"; ?>
<!-- <?php require "config.php"; ?> connet database with PDO class -->

<?php  

if(isset($_SESSION["username"])){ // if session already isset goto homepage 
  // to prevent entering login page 
  header("location: index.php");
}


// check submit button activate
if(isset($_POST["submit"])){

  // validation for empty input
  if($_POST["email"] == "" || $_POST["password"] == "") {
    echo "some inputs are empty!";
} else {

  // valid input
  $email = $_POST["email"]; // input email store in variable
  $password = $_POST["password"]; 

  $login = $conn->query("SELECT * FROM users WHERE email = '$email'"); // take data form database and check

  $login->execute(); // execute

  $data = $login->fetch(PDO::FETCH_ASSOC); // turn into arrayData with fetch later use as $data["myPassword"]

  if($login->rowCount() > 0){ 
    //  echo $login->rowCount();
    if(password_verify($password, $data["myPassword"])){ // use password_verify() to check input password 

      $_SESSION["username"] = $data["username"]; // assign data to session
      $_SESSION["email"] = $data["email"];
      $_SESSION["user_id"] = $data["id"];

      header("location: index.php"); // goto homepage

    } else {
      echo "email or password is wrong!";
   };

  } else {
     echo "email or password is wrong!";
  }

}

}

?>
<main class="form-signin w-50 m-auto">
  <form method="post" action="login.php">
    <!-- <img class="mb-4 text-center" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <h1 class="h3 mt-5 fw-normal text-center">Please sign in</h1>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <!-- <div class="form-floating">
      <input name="email" type="text" class="form-control" id="floatingInput" placeholder="user.name">
      <label for="floatingInput">Username</label>
    </div> -->
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <h6 class="mt-3">Don't have an account  <a href="register.php">Create your account</a></h6>
  </form>
</main>
<?php require "includes/footer.php"; ?>
