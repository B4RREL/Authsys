<?php require "includes/header.php"; ?>
<?php require "config.php"; ?>

<?php 

if(empty($_SESSION["username"])){
    header("location: login.php");
}

$select = $conn->query("SELECT * FROM posts");
$select->execute();

$rows = $select->fetchAll(PDO::FETCH_ASSOC);

 
?>

<main class="form-signin w-50 m-auto mt-4">
    <?php foreach($rows as $row) : ?>
    <div class="card">
    <div class="card-body">
        <h5 class="card-title"><?php echo $row["title"]; ?></h5>
        <p class="card-text"><?php echo substr($row["body"], 0, 85) . "...."; ?></p>

        
       
      
           
        
       
        <a style="float:right;" href="show.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">More</a>
    </div>
    </div>
    </br>
    <?php endforeach ; ?>
</main>

<?php require "includes/footer.php"; ?>

<script>
    $(document).ready(function() {

            $("button").click(function() {
                if($(this).text() == "Like"){
                    $(this).text("Liked");
                } else {
                    $(this).text("Like");
                };

                function withoutRef(){
                   setInterval(() => {
                     $('body').load('index.php');
                   }, 1000);
                };
                withoutRef();
            })

    })
</script>
