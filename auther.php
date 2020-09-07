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

            <!-- Blog Entries Column -->
            <div class="col-md-8">
           
               <?php 
                if(isset($_GET['pid'])){
                    $post_id = $_GET['pid'];
                     $post_auther = $_GET['auther'];
                }

         $query = "SELECT * FROM posts WHERE post_auther = '{$post_auther}' ";

                 $data = mysqli_query($conn , $query);
                
                   while ($row = mysqli_fetch_assoc($data)) {
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
                    <?php echo $post_auther; ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="\cms\images\<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                

                <hr>


<?php
}
?>
                


                <hr>

                
              

              
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

        <?php include'includes\header.php'; ?>