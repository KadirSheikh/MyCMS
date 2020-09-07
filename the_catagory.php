<?php include'includes\header.php'; ?>
<?php include'includes\nav.php'; ?>

<head>
    <style>
        img{
            height: 300px;
            width: 900px;
        }
    </style>
</head>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
       <?php 
                
                 if(isset($_GET['catagory'])){
                    $post_cat = $_GET['catagory'];
                
                     if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin'){
                     $stmt1 = mysqli_prepare($conn , "SELECT post_id,post_title,post_auther,post_date,post_image,post_content FROM posts WHERE post_cat_id = ?");
                    }
                    else{
                     $stmt2 = mysqli_prepare($conn , "SELECT post_id,post_title,post_auther,post_date,post_image,post_content FROM posts WHERE post_cat_id = ? AND post_status = ?"); 
                        $publish = 'Publish';
                    }

                    if(isset($stmt1)){
                        mysqli_stmt_bind_param($stmt1 , 'i' , $post_cat);
                        mysqli_stmt_execute($stmt1);
                        mysqli_stmt_bind_result($stmt1 , $post_id,$post_title,$post_auther,$post_date,$post_image,$post_content);
                         $stmt = $stmt1;
                    }else{
                        mysqli_stmt_bind_param($stmt2 , 'is' , $post_cat , $publish);
                        mysqli_stmt_execute($stmt2);
                        mysqli_stmt_bind_result($stmt2 , $post_id,$post_title,$post_auther,$post_date,$post_image,$post_content);
                        $stmt = $stmt2;
                    }

                
                   $count = mysqli_stmt_num_rows($stmt);  
                     if($count===0){
                         echo "<h1 class='text-center'>No Post Available</h1>";
                     }
               
                         
                   while (mysqli_stmt_fetch($stmt)):
                   

?>
              <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?pid=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_auther; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="\cms\images\<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

<?php
endwhile; mysqli_stmt_close($stmt);}
                else{
                    header('Location:index.php');
                }
?>

               
               

            </div>
<?php include'includes\starter.php'; ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php include'includes\header.php'; ?>