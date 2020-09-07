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
                    <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> -->

                    <div class="col-xs-12">

                        <?php
                                  if(isset($_GET['edit'])){
                                    $edit_id = escape($_GET['edit']);
                                    $select = "SELECT * FROM users where user_id = {$edit_id}";
                                    $view_user = mysqli_query($conn , $select);
                                     
                                     while ($result = mysqli_fetch_assoc($view_user)) 
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
        
                            if(isset($_POST['edit_user'])){
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
                               
  /*  $query = "SELECT randSalt FROM users";
    $data = mysqli_query($conn , $query);
    
    $row = mysqli_fetch_array($data);   
    $salt = $row['randSalt'];
        
    $user_password = crypt($user_password , $salt);
                                */
                                
                                if(!empty($user_password)){
                                    $query_pass = "SELECT user_password FROM users WHERE user_id = $edit_id ";
                                    $data_pass = mysqli_query($conn , $query_pass);
                                    $row = mysqli_fetch_assoc($data_pass);
                                    $db_user_password = $row['user_password'];
                                    
                                    if($db_user_password != $user_password){
                                        $hash_password = password_hash($user_password , PASSWORD_BCRYPT , array('cost' => 12));
                                    }
                                                     
                $query = "UPDATE `users` SET `user_name`= '$user_name',`user_firstname`='$first_name',`user_lastname`='$last_name',`user_email`='$user_email',`user_password`='$hash_password',`user_role`='$user_role'  WHERE user_id = {$edit_id}";

                 $data = mysqli_query($conn , $query);
            
            if(!$data){
                die(mysqli_error($conn));
            }
                                }
               
                                
        }
        
        
        
        ?>
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $user_name; ?>">
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

                            <!-- <div class="form-group">
                                <label for="image">Post Image</label>
                                <input type="file" name="image">
                            </div>-->

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo  $user_email; ?>">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" autocomplete="off">
                            </div>


                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="edit_user" value="Edit">
                            </div>

                        </form>

                    </div>

                </div>
            </div>


        </div>


    </div>


</div>

<?php include'includes/footer.php'; ?>
