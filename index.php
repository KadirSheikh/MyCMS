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
                
                $per_page = 4;
              if(isset($_GET['page'])){
                  $page = $_GET['page'];
                  
                 
              }else{
                  $page = "";
              }
                
            if($page == "" || $page== 1){
                     $page_no = 0; 
                  }else{
                      $page_no = ($page*$per_page)-$per_page;
                  }
                
                
                 if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='admin'){
                      $count_query = "SELECT * FROM posts";
                    }
                    else{
                      $count_query = "SELECT * FROM posts WHERE post_status = 'Publish'";
                    }
               
                $count_data = mysqli_query($conn , $count_query);
                $count = mysqli_num_rows($count_data);
                if($count<1){
                    echo "<h1 class='text-center'>No Post Available</h1>";
                }else{
                    
                
                $count = ceil($count/5);
                
              
                      
                $query = "SELECT * FROM posts LIMIT $page_no , $per_page";

                 $data = mysqli_query($conn , $query);

                   while ($row = mysqli_fetch_assoc($data)) {
                    $post_id = $row['post_id'];
                   $post_title = $row['post_title'];
                   $post_auther = $row['post_auther'];
                   $post_date = $row['post_date'];
                    $post_status = $row['post_status'];   
                   $post_image = $row['post_image'];
                   $post_content = substr($row['post_content'],0,100);

?>
              <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post/<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="auther/<?php echo $post_auther; ?>/<?php echo $post_id; ?>"><?php echo $post_auther; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?pid=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images\<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post/<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                


<?php
}
                }
?>
 <!-- Pager -->
                <ul class="pager">
                   <?php 
                    for($i = 1; $i<=$count; $i++){
                        
                        if($i == $page){
                            echo "<li><a href='index.php?page={$i}' class='active'>{$i}</a></li>";
                        }else{
                            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>"; 
                        }
                        
                    }
                   
                    
                    ?>
                </ul>
               

            </div>
<?php include'includes\starter.php'; ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php include'includes\header.php'; ?>