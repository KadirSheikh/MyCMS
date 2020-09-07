<?php include'includes/header.php'; ?>

    <div id="wrapper">
    
        <?php include'includes/nav.php'; ?>
        
        <?php 
        
        if(isset($_SESSION['user_name'])){
            $username = escape($_SESSION['user_name']);
            $query = "SELECT * FROM users WHERE user_name = '{$username}'";
            $select_user_query= mysqli_query($conn , $query);
              while ($result = mysqli_fetch_assoc($select_user_query)) 
                                     {
                                    $user_id = $result['user_id'];
                                    $user_name = $result['user_name'];
                                    $user_firstname = $result['user_firstname'];
                                         
                                    $user_lastname = $result['user_lastname'];
                                    $user_email = $result['user_email'];
                                    $user_image = $result['user_image'];
                                    $user_role = $result['user_role'];
                                    
                  
                                     }
        }
        
        ?>
        <?php
        if(isset($_POST['update_profile'])){
                                $user_name = $_POST['username'];
                                $first_name = $_POST['firstname'];
                                 $last_name = $_POST['lastname'];

                                /*$date = date('d-m-y');*/
                               /* $img = $_FILES['image']['name'];
                                $img_temp = $_FILES['image']['tmp_name'];*/
                                $user_role = $_POST['role'];
                                $user_email = $_POST['email'];
                                $user_password = $_POST['password'];
                                
                               /* $status = $_POST['status'];
                                move_uploaded_file($img_temp , "../images/$img");*/
                               
                $query = "UPDATE `users` SET `user_name`= '$user_name',`user_firstname`='$first_name',`user_lastname`='$last_name',`user_email`='$user_email',`user_password`='$user_password',`user_role`='$user_role'  WHERE user_name = '{$username}'";

                 $data = mysqli_query($conn , $query);
            
            if(!$data){
                die(mysqli_error($conn));
            }
                                
        }
        
        
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page content -->
               <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome Admin
                            <small><?php echo $_SESSION['user_name']; ?></small>
                        </h1>
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $_SESSION['user_name']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="firtname">First Name</label>
                                <input type="text" class="form-control" name="firstname" value="<?php echo $user_firstname; ?>">
                            </div>

                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" name="lastname" value="<?php echo $user_lastname; ?>">
                            </div>


                            <div class="form-group">
                                <label for="role">Role</label><br>

                                <select class="form-control" name="role">
                                    <option selected><?php  echo $user_role;?></option>
                                    <?php
                                       if($user_role == Subscriber){
                                       echo"<option value='admin'>Admin</option>";
                                       }else{
                                           echo"<option value='Subscriber'>Subscriber</option>";
                                       }
                                    
                                    
                                   ?>


                                </select>
                            </div>


                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo  $user_email; ?>">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" >
                            </div>


                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="update_profile" value="Update profile">
                            </div>

                        </form>
                </div>
              

            </div>
           

        </div>
     

         </div>
     </div>

   <?php include'includes/footer.php'; ?>