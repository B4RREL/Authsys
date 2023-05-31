</div>
<script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity=""
  crossorigin=""></script>
  <script src="rating-plugin/src/jquery.star-rating-svg.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js
"></script>
<script>

$(document).ready(function() {
    
   

$(".my-rating").starRating({
    starSize: 25,
    initialRating: "<?php 
            if(isset($rating->rating) && isset($rating->user_id) && $rating->user_id == $_SESSION["user_id"]){
                echo $rating->rating;
            } else {
                echo '0';
            }
      ?>",

    callback: function(currentRating, $el){
        // make a server call here
        $('#rating').val(currentRating);

        $('.my-rating').click(function(e) {
            e.preventDefault();

            var formdata = $("#form-data").serialize()+"&insert=insert";

            $.ajax({
                type: "POST",
                url: "insert-ratings.php",
                data: formdata,
                success: function() {
                    alert(formdata);
                }
            });
        })
    }
});


$("#search_data").keyup(function() {
          var search = $(this).val();
          // alert(search)

          if(search !== ''){
            $('.row').css('display','none');
            $('main').css('display','none');
            $.ajax({
              type: "POST",
              url: "search.php",
              data: {
                search : search
              },
              success: function(data) {
                    $("#search-data").html(data);  
                    
              }
            });
          } else {
            $("#search-data").css('display', 'none');  
            $('.row').css('display','block');
            $('main').css('display','block');  
          }
        });
});
</script>
</body>
</html>