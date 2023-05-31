<?php require "includes/header.php"; ?>
<?php require "config.php"; ?>

<?php 

    if(isset($_GET['id'])) {

        $id = $_GET['id'];

        $onePost = $conn->query("SELECT * FROM posts WHERE id='$id'");
        $onePost->execute();

        $posts = $onePost->fetch(PDO::FETCH_OBJ);
    }


    $comments = $conn->query("SELECT * FROM comments WHERE post_id='$id'");
    $comments->execute();

    $comment = $comments->fetchAll(PDO::FETCH_OBJ);

    $like = $conn->query("SELECT * FROM likes WHERE post_id='$id'");
    $like->execute();
    $TotalLike = $like->fetchAll(PDO::FETCH_OBJ);

    $slike = $conn->query("SELECT * FROM likes WHERE post_id='$id' AND user_id='$_SESSION[user_id]'");
    $slike->execute();
    $daLike = $slike->fetch(PDO::FETCH_OBJ);

    if(isset($_SESSION['user_id'])) {
        $ratings = $conn->query("SELECT * FROM rates WHERE post_id='$id' AND user_id='$_SESSION[user_id]'");
        $ratings->execute();

        $rating = $ratings->fetch(PDO::FETCH_OBJ);
    
    }
    



?>




 <div class="row">
    <div class="card mt-5">
        
        <div class="card-body">
            <h5 class="card-title"><?php echo $posts->title; ?></h5>
            <p class="card-text"><?php echo $posts->body; ?></p>
            <form id="form-data" method="POST">
                <div class="my-rating"></div>
                <input id="rating" type="hidden" name="rating">
                <input id="post_id" type="hidden" name="post_id" value="<?php echo $posts->id; ?>">
                <input id="user_id" type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            </form>
            <?php if(isset($_SESSION["user_id"]) && isset($daLike->user_id) && $_SESSION["user_id"] == $daLike->user_id && $like->rowCount() > 0) : ?>
            <form class="mt-3" id="unlike-data" method="POST">
            <input id="post_id" type="hidden" name="post_id" value="<?php echo $posts->id; ?>">
                <input id="user_id" type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                <button id="unlike-btn" class="btn btn-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                 <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                </svg>
                <span><?= $like->rowCount(); ?></span>
                </button>
            </form>
            <?php else : ?>
            <form class="mt-3" id="like-data" method="POST">
            <input id="post_id" type="hidden" name="post_id" value="<?php echo $posts->id; ?>">
                <input id="user_id" type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                <button id="like-btn" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                </svg>
                <span><?= $like->rowCount(); ?></span>
                </button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="row">
    <form method="POST" id="comment_data">


    <div class="form-floating">
        <input name="username" type="hidden" value="<?php echo $_SESSION['username']; ?>" class="form-control" id="username">
    </div>

    <div class="form-floating">
        <input name="post_id" type="hidden" value="<?php echo $posts->id; ?>" class="form-control" id="post_id">
    </div>

    <div class="form-floating mt-4">
        <textarea rows="9" name="comment" placeholder="body" class="form-control" id="comment"></textarea> 
        <label for="floatingPassword">Comment</label>
    </div>

    <button name="submit" id="submit" class="w-100 btn btn-lg btn-primary mt-4" type="submit">Create Comment</button>
    <div id="msg" class="nothing"></div>
    <div id="delete-msg" class="nothing"></div>

    

    </form>

</div>

<div class="row">
    <?php foreach($comment as $singleComment) : ?>
    <div class="card mt-5">
        
        <div class="card-body">
            <h5 class="card-title"><?php echo $singleComment->username; ?></h5>
            <p class="card-text"><?php echo $singleComment->comment; ?></p>
            <?php if(isset($_SESSION['username']) AND $_SESSION['username'] == $singleComment->username) : ?>
             <button id="delete-btn" value="<?php echo $singleComment->id; ?>" class="btn btn-danger mt-3">Delete</button>
            <?php endif; ?>   
        </div>
    </div>
    <?php endforeach; ?>
</div>


    

<?php require "includes/footer.php"; ?>
<script>
$(document).ready(function() {
$(document).on("submit", function(e) {
        
        
        e.preventDefault();
        var formdata = $("#comment_data").serialize()+"&submit=submit";

        $.ajax({
            type: 'post',
            url: 'insert-comments.php',
            data: formdata,
            success: function() {
                $("#comment").val(null);
                $("#username").val(null);
                $("#post_id").val(null);

                $("#msg").html("Added Successfully").toggleClass('alert alert-success bg-success text-white mt-3');
                fetch();
            }
        });
       

    });

    $("#delete-btn").on("click", function(e) { 
           e.preventDefault();
           var id = $(this).val();

           $.ajax({
            type: 'post',
            url: 'delete-comment.php',
            data: {
                delete: 'delete',
                id: id
            },
            success: function() {
                $("#delete-msg").html("Deleted Successfully").toggleClass('alert alert-danger bg-danger text-white mt-3');
                fetch();
            }
           });
          
    });

    $("#like-btn").on("click", function(e) {
        e.preventDefault();
        var likedata = $("#like-data").serialize()+"&like=like";
        
            $.ajax({
            type: "POST",
            url: "insert-like.php",
            data: likedata,
           success: function() {
             
              $('#like-btn').text("Liked");
             
            
            fetch();
           },
        })
    
    });

    $("#unlike-btn").on("click", function(e) {
        e.preventDefault();
        var unlikedata = $("#unlike-data").serialize()+"&unlike=unlike";
        
            $.ajax({
            type: "POST",
            url: "un-like.php",
            data: unlikedata,
           success: function() {
             
              $('#like-btn').text("Like");
             
            
            fetch();
           },
        })
    
    });

   
     function fetch() {
        setInterval(() => {
            $('body').load("show.php?id=<?php if(isset($_GET['id'])) {
                    echo $_GET['id'];
            } else {
                echo "nothing";
            }
            ?>")
        }, 4000);
     };
    });
    </script>
