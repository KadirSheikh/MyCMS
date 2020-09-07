

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
                        <?php  $users_query = "SELECT * FROM users WHERE user_name = '{$_SESSION['user_name']}'";
        $select_users = mysqli_query($conn,$users_query);
        while($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $_SESSION['user_id'] = $user_id;
            
        }   ?> 
                         
                         <?php 
           
                            if(isset($_POST['add_post'])){
                                $user_id = $_SESSION['user_id'];
                                $catagory_id = $_POST['catagory'];
                                $title = $_POST['title'];
                                $auther = $_POST['auther'];
                                $date = date('d-m-y');
                                $img = $_FILES['image']['name'];
                                $img_temp = $_FILES['image']['tmp_name'];
                                $content = $_POST['content'];
                                $tag = $_POST['tag'];
                                
                                $status = $_POST['status'];
                                move_uploaded_file($img_temp , "../images/$img");
                                
                                $query = "INSERT INTO `posts`(`user_id`,`post_cat_id` , `post_title`, `post_auther`,`post_date`,`post_image`, `post_content`, `post_tag`, `post_status`) VALUES ({$user_id},{$catagory_id},'{$title}','{$auther}',now(),'{$img}','{$content}','{$tag}' ,'{$status}')";
                                
                                $data = mysqli_query($conn , $query);
                                $pid = mysqli_insert_id($conn);
                                if($data){
                                    echo "<p class='bg-success'>Post Added Successfully. <a href='../post.php?pid={$pid}' class='text-info'>View Post</a></p>";
                                }else{
                                    die("Failed".mysqli_error($conn));
                                }
                    
                            }
                   
                            ?>
                          <form action="" method="post" enctype="multipart/form-data">    
  
     <div class="form-group">
         <label for="title">Post Title</label>
         <input type="text" class="form-control" name="title">
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
         <input type="text" class="form-control" name="auther">
     </div> 
     
     
       <div class="form-group">
         <label for="status">Post Status</label>
        
         <select class="form-control" name="status">
          <option selected>Draft</option>
          <option>Publish</option>
           </select>
     </div> 
     
     
       <div class="form-group">
         <label for="image">Post Image</label>
         <input type="file" name="image">
     </div> 
     
       <div class="form-group">
         <label for="tags">Post Tags</label>
         <input type="text" class="form-control" name="tag">
     </div>
     
     <div class="form-group">
         <label for="date">Post Date</label>
         <input type="date" class="form-control">
     </div>

       
        <div class="form-group" >
         <label for="content">Post Content</label>
         <textarea class="form-control" name="content" cols="40" rows="10" id="editor"></textarea>
     </div> 

       <div class="form-group">
         <input type="submit" class="btn btn-primary" name="add_post" value="Add">
     </div> 
     
</form>
                        </div>   
                
                    </div>
                </div>
              

            </div>
           

        </div>
     

         </div>

   <?php include'includes/footer.php'; ?>
  






































