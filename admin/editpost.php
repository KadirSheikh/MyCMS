<?php include 'includes/header.php'; ?>

    <div id="wrapper">

       
        <?php include'includes/nav.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page content -->
               <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome Admin
                            <small>Auther</small>
                        </h1>
                        
                        
                        <div class="col-xs-12">
              
    <form action="" method="post" enctype="multipart/form-data"> 
    <?php 
                                if(isset($_GET['pid']))
                                {
                                  $post_id =  escape($_GET['pid']); 
                                    
                                  $query = "SELECT * FROM posts WHERE post_id={$post_id}";
                                  $data = mysqli_query($conn , $query);
                                     
                                     while ($row = mysqli_fetch_assoc($data)) 
                                     {
                                    $post_cat_id = $row['post_cat_id'];
                                    $post_title = $row['post_title'];
                                    $post_auther = $row['post_auther'];
                                    $post_content = $row['post_content'];
                                    $post_status = $row['post_status'];
                                    $post_img = $row['post_image'];
                                    $post_tag = $row['post_tag'];
                                    $post_comment = $row['post_comment_count'];
                                    $post_date = $row['post_date'];    
                                     }
                                }
    ?>   
    
    <?php 
        
        if(isset($_POST['edit_post'])){
                                
                                $title = $_POST['title'];
                                $catagory = $_POST['catagory'];
                                $auther = $_POST['auther'];
                                $status = $_POST['status'];
                                
                                $img = $_FILES['image']['name'];
                                $img_temp = $_FILES['image']['tmp_name'];
                                
                                $tag = $_POST['tag'];
                                $date = date('d-m-y');
                                $content = $_POST['content'];
                                
                                
                                move_uploaded_file($img_temp , "../images/$img");
            
                            if(empty($img)){
                                $query = "SELECT * FROM posts WHERE post_id = $post_id";
                                $data = mysqli_query($conn , $query);
                                
                                while($row =  mysqli_fetch_assoc($data)){
                                      $img = $row['post_image'];
                                }
                            }
            
                     $query = "UPDATE `posts` SET `post_cat_id`='{$catagory}',`post_title`='{$title}',`post_auther`='{$auther}',`post_date`=now(),`post_image`='{$img}',`post_content`='{$content}',`post_tag`='{$tag}',`post_status`='{$status}' WHERE `post_id`={$post_id}";
            
                 $data = mysqli_query($conn , $query);
            
            if(!$data){
                die(mysqli_error($conn));
            }
            else{
               echo "<p class='bg-success'>Post Updated Successfully. <a href='../post.php?pid={$post_id}' class='text-info'>View Post</a></p>";
            }
                                
        }
        
        
        
        ?>
  
     <div class="form-group">
         <label for="title">Post Title</label>
         <input type="text" class="form-control" name="title"  value="<?php echo $post_title;?>">
     </div>   
     
       <div class="form-group">
         <label for="catagory">Post Catagory</label><br>
         
         <select class="form-control" name="catagory">
             <?php 
             $query = "SELECT * FROM catogery";
                $data = mysqli_query($conn , $query);
                                     
               while ($row = mysqli_fetch_assoc($data)) 
                {
               $cat_id = $row['cat_id'];
              $cat_title = $row['cat_title'];
               
                   echo "<option value='$cat_id'>$cat_title</option>";
               
               }
             
             
             ?>
             
         </select>
     </div> 
     
     
       <div class="form-group">
         <label for="auther">Post Auther</label>
         <input type="text" class="form-control" name="auther" value="<?php echo $post_auther;?>">
     </div> 
     
     
       <div class="form-group">
         <label for="status">Post Status</label>
         
         <select class="form-control" name="status" value="<?php echo $post_status;?>">
          <option>Draft</option>
         <option>Publish</option>

           </select>
     </div> 
     
     
       <div class="form-group">
         <label for="image">Post Image</label>
         <input type="file" name="image"><br>
         <img src="../images/<?php echo $post_img; ?>" width="200">
     </div> 
     
       <div class="form-group">
         <label for="tags">Post Tags</label>
         <input type="text" class="form-control" name="tag" value="<?php echo $post_tag;?>">
     </div>
     
     <div class="form-group">
         <label for="date">Post Date</label>
         <input type="date" class="form-control" name="tag" value="<?php echo $post_date;?>">
     </div>
     
     
       
        <div class="form-group">
         <label for="content">Post Content</label>
         <textarea class="form-control" name="content" cols="40" rows="10" ><?php echo str_replace('\r\n' , '<br>' , $post_content);?></textarea>
     </div> 
     
       <div class="form-group">
         <input type="submit" class="btn btn-primary" name="edit_post" value="Update">
     </div> 
     
</form>
                        </div>   
                
                    </div>
                </div>
              

            </div>
           

        </div>
     

         </div>

   <?php include'includes/footer.php'; ?>
  






































