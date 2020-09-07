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

                        <?php 
                            if(isset($_POST['add_user'])){
                                
                                $user_name = $_POST['username'];
                                $first_name = $_POST['firstname'];
                               $last_name = $_POST['lastname'];

                                /*$date = date('d-m-y');*/
                               /* $img = $_FILES['image']['name'];
                                $img_temp = $_FILES['image']['tmp_name'];*/
                                $user_role = $_POST['role'];
                                $user_email = $_POST['email'];
                                $user_password = $_POST['password'];
                                $user_password = password_hash($user_password , PASSWORD_BCRYPT , array('cost' => 10));
                               /* $status = $_POST['status'];
                                move_uploaded_file($img_temp , "../images/$img");*/
                                
                                $query = "INSERT INTO `users` (`user_name`, `user_firstname`, `user_lastname`, `user_email`, `user_password`,  `user_role`) VALUES ( '$user_name', '$first_name', '$last_name', '$user_email', '$user_password','$user_role')";
                                
                                $data = mysqli_query($conn , $query);
                                
                                if(!$data){
                                    die("Failed".mysqli_error($conn));
                                }
                    
                            }
                   
                            ?>
                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username">
                            </div>

                            <div class="form-group">
                                <label for="firtname">First Name</label>
                                <input type="text" class="form-control" name="firstname">
                            </div>

                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" name="lastname">
                            </div>


                            <div class="form-group">
                                <label for="role">Role</label><br>

                                <select class="form-control" name="role">

                                    <option value="admin">Admin</option>
                                    <option value="subscriber">Subscriber</option>
                                    <option value="select" selected>Select role</option>


                                </select>
                            </div>







                            <!-- <div class="form-group">
                                <label for="image">Post Image</label>
                                <input type="file" name="image">
                            </div>-->

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>


                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="add_user" value="Add user">
                            </div>

                        </form>
                    </div>

                </div>
            </div>


        </div>


    </div>


</div>

<?php include'includes/footer.php'; ?>
