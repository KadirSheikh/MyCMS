<?php include'includes\header.php'; ?>
<?php include'includes\nav.php'; ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
       <?php 

       if (isset($_POST['submit'])) {
              $search = $_POST['search'];

                 $query = "SELECT * FROM posts WHERE post_tag LIKE '%$search%'";
                 $search_post = mysqli_query($conn , $query);

                 if (!$search_post) {
                     die("Failed".mysqli_error($conn));
                 }

                 $count = mysqli_num_rows($search_post);

                 if ($count == 0) {
                   echo "<h1>NO RESULT FOUND</h1>";
                 }
                 else {
                    
               while ($row = mysqli_fetch_assoc($search_post)) {
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
                    by <a href="index.php"><?php echo $post_auther; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images\<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

<?php
}
}
}
?>
                <!-- Pager -->
                <!-- <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>
 -->
            </div>
<?php include'includes\starter.php'; ?>

        </div>
        <!-- /.row -->

        <hr>

           
        <?php include'includes\header.php'; ?>