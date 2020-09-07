<?php include'includes\header.php'; ?>
<?php include'includes\nav.php'; ?>

<head>
    <style>
        img{
            height: 100px;
            width: 100px;
            float: left;
        }
        .img-responsive{
             height: 300px;
            width: 800px;
        }
    </style>
</head>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
<?php 
            
            if(isset($_POST['liked'])){
                $post_id = $_POST['post_id'];
                $user_id = $_POST['user_id'];
                $query = "SELECT * FROM posts WHERE post_id = $post_id";
                $data = mysqli_query($conn , $query);
                $result = mysqli_fetch_assoc($data);
                $likes = $result['likes'];
                
                $update = mysqli_query($conn , "UPDATE posts SET likes = $likes+1");
                
               $insert = mysqli_query($conn , "INSERT INTO `likes`(`post_id`, `user_id`) VALUES ($post_id , $user_id)");
            }
            
                 if(isset($_POST['unliked'])){
                $post_id = $_POST['post_id'];
                $user_id = $_POST['user_id'];
                $query = "SELECT * FROM posts WHERE post_id = $post_id";
                $data = mysqli_query($conn , $query);
                $result = mysqli_fetch_assoc($data);
                $likes = $result['likes'];
                
                $update = mysqli_query($conn , "UPDATE posts SET likes = $likes-1");
                
               $delete = mysqli_query($conn , "DELETE FROM `likes` WHERE post_id = $post_id AND user_id = $user_id");
            }
            
            
            
            
            
            
            ?>
            <!-- Blog Entries Column -->
            <div class="col-md-8">
           
               <?php 
                if(isset($_GET['pid'])){
                    $post_id = $_GET['pid'];
              
        $view_post_query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = {$post_id}";
         $view_post=  mysqli_query($conn , $view_post_query); 
                    
                    if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin'){
                    $query = "SELECT * FROM posts WHERE post_id = {$post_id} ";
                    }
                    else{
                       $query = "SELECT * FROM posts WHERE post_id = {$post_id} AND post_status='Publish'"; 
                    }
                    
                 $data_post = mysqli_query($conn , $query);
                if(mysqli_num_rows($data_post)<1){
                    echo "<h1 class='text-center'>No Post Available</h1>";
                }
                    else{
                   while ($row = mysqli_fetch_assoc($data_post)) {
                   $post_title = $row['post_title'];
                   $post_auther = $row['post_auther'];
                   $post_date = $row['post_date'];
                   $post_image = $row['post_image'];
                   $post_content = $row['post_content'];

?>
              <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="/cms/auther/<?php echo $post_id; ?>"><?php echo $post_auther; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="\cms\images\<?php echo $post_image; ?>" alt="">
                <hr>
                
              
                
                <p><?php echo $post_content; ?></p>
                
                <?php if(ifLoggedIn()){
                       ?>
                       
                        <?php if(userLikePostOrNot($_GET['pid'])){
                       ?>
                <div class="row">
                    <p class="pull-right"><a class="unlike" href="" data-toggle="tooltip" title="I like this before!" data-placement="top"><span class="glyphicon glyphicon-thumbs-down" ></span> Unlike</a></p>
                
                </div>
                       <?php
                       
                   }else{
                       ?>
                         <div class="row">
                    <p class="pull-right"><a class="like" href="" data-toggle="tooltip" title="Want to like it!" data-placement="top"><span class="glyphicon glyphicon-thumbs-up" ></span> Like</a></p>
                
                </div>
                       <?php
                   } ?>

                       <?php
                   } else{
                       ?>
                       
                        <div class="row">
                    <p class="pull-right">You need to <a href="/cms/main_login.php"> Login</a> to like it!</p>
                
                </div>
                       
                    <?php   
                       
                   }?>
                
                                  <!--<div class="row">
                    <p class="pull-right"><a class="<?php echo userLikePostOrNot($_GET['pid']) ? 'unlike' : 'like' ?>" href=""><span class="glyphicon glyphicon-thumbs-up"></span>&nbsp;<?php echo userLikePostOrNot($_GET['pid']) ? 'Unlike' : 'Like' ?></a></p>
                
                </div>-->
                   
              
              
                <div class="row">
                <p class="pull-right">Likes : <?php 
                    
                       echo totalLikes($_GET['pid']);
                    ?></p>
                </div>
                <hr>


<?php
}}}
                else{
                    header("Location:index.php");
                }
                
?>
               
                
                 
                  
                    <?php 
                
                if(isset($_POST['submit'])){
                     
                    $post_id = $_GET['pid'];
                    $auther = $_POST['auther'];
                    $email = $_POST['email'];
                    $comment = $_POST['comment'];
                    
                    
                    if(!empty($auther) && !empty($email) && !empty($comment)){
                        
                        
                    $query = "INSERT INTO `comments`(`comment_post_id`, `comment_auther`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES ($post_id,'{$auther}','{$email}','{$comment}','unapproved',now())";
                    
                    $add = mysqli_query($conn , $query);
                  /*  if(!$add){
                        mysqli_error($conn);
                    }*/
                    
               /* $count = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = {$post_id}";
                $update_comment_count = mysqli_query($conn , $count);*/
                
                    
                }
                else{
                    echo "<p class='alert alert-danger'>Fields cannot be empty.</p>";
                }
                }
                ?>
                <div class="well">
                    <h4>Leave a Comment:</h4>

                    <form role="form" action="" method="post">
                       <div class="form-group">
                         <label for="auther">Name:</label>
                          <input type="text" name="auther" placeholder="Your Name" class="form-control"> 
                        </div>
                        <div class="form-group">
                         <label for="Email">Email:</label>  
                            <input type="email" name="email" placeholder="Your Name" class="form-control"> 
                        </div>
                        <div class="form-group">
                          <label for="Comment">Comment:</label> 
                            <textarea class="form-control" rows="3" name="comment" placeholder="Type your comment here..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>

                <hr>

                <?php 
                $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} AND comment_status='approved' ORDER BY comment_id DESC";
                $select_comment = mysqli_query($conn , $query);
                
                if(!$select_comment){
                    mysqli_error($conn);
                }
                
               
                
                while($result = mysqli_fetch_assoc($select_comment)){
                    $auther = $result['comment_auther'];
                    $content = $result['comment_content'];
                    $date = $result['comment_date'];
                    
                    ?>
                      <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $auther; ?><br>
                            <small><?php echo $date; ?></small>
                        </h4>
                        <?php echo $content; ?>
                    </div>
                </div>
                    <?php
                }
                
                ?>
              

              
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>
<?php include'includes\starter.php'; ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php include'includes\footer.php'; ?>
        <script>
        
        $(document).ready(function(){
            
            $('[data-toggle="tooltip"]').tooltip();
            
            var post_id = <?php echo $post_id; ?>;
            var user_id = <?php  echo returnUserAjax(); ?>;
            
            //like
            $('.like').click(function(){
                
            $.ajax({
               url : "/cms/post.php?pid=<?php echo $post_id; ?>&uid=<?php  echo returnUserAjax(); ?>",
                type : 'post' , 
                data : {
                    'liked' : 1,
                    'post_id' : post_id , 
                    'user_id' : user_id
                }
                
                
                
            });
            });
            
            
            //unlike
             $('.unlike').click(function(){
                
            $.ajax({
               url : "/cms/post.php?pid=<?php echo $post_id; ?>&uid=<?php  echo returnUserAjax(); ?>",
                type : 'post' , 
                data : {
                    'unliked' : 1,
                    'post_id' : post_id , 
                    'user_id' : user_id
                }
                
                
                
            });
            });
            
            
            
            
            
            
            
        });
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        </script>