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
                          <table class="table table-bordered table-hover">
                              <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Username</th>
                                      <th>First Name</th>
                                      <th>Last Name</th>
                                      <th>Email</th>
                                      <th>Image</th>
                                      <th>Role</th>
                                      <th>Admin</th>
                                      <th>Subscriber</th>
                                      <th>Edit</th>
                                      <th>Delete</th>
                                      
                                  </tr>
                              </thead>
                              
                              <tbody>
                                 <?php
                                   $select = "SELECT * FROM users";
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
                                   
                                      
                                  
                                
                                  echo "<tr>";
                                      echo"<td>$user_id</td>";
                                      echo"<td>$user_name</td>";
                                      echo"<td>$user_firstname</td>";
                                         
                                 /*   $query = "SELECT * FROM catogery WHERE cat_id = {$post_cat}";
                                      $data = mysqli_query($conn , $query);
                                     
                                     while ($row = mysqli_fetch_assoc($data)) 
                                     {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                        
                                    echo"<td>{$cat_title}</td>";
                                     }*/
                                         
                                      echo"<td>$user_lastname</td>";
                                      echo"<td>$user_email</td>";
                                      echo"<td><img src='../images/$user_image' width='100'></td>";
                                      echo"<td>$user_role</td>";
                                      
                                      echo"<td><a href='viewuser.php?admin={$user_id}'  class='btn '>admin</a></td>";
                                    echo"<td><a href='viewuser.php?subscriber={$user_id}'  class='btn '>subscriber</a></td>";
                                         echo"<td><a href='edituser.php?edit={$user_id}'  class='btn btn-primary'>Edit</a></td>";
                                   echo"<td><a href='viewuser.php?delete={$user_id}'  class='btn btn-danger'>Delete</a></td>";
                                  echo "</tr>";
                                     }
                                      ?>
                                      <?php 
                                  if(isset($_GET['admin'])){
                                      $admin = escape($_GET['admin']);
                                      
                                      $query = "UPDATE users SET user_role ='admin' WHERE user_id = {$admin}";
                                      $data = mysqli_query($conn , $query);
                                      header("Location:viewuser.php");
                                      
                            
                                  }
                             
                                  ?>
                                     
                                       <?php 
                                  if(isset($_GET['subscriber'])){
                                      $subscriber = escape($_GET['subscriber']);
                                      
                                      $query = "UPDATE users SET user_role ='subscriber' WHERE user_id = {$subscriber}";
                                      $data = mysqli_query($conn , $query);
                                      header("Location:viewuser.php");
                                      
                            
                                  }
                             
                                  ?>
                                      <?php 
                                  
                                  if(isset($_SESSION['user_role'])){
                                      
                                      if($_SESSION['user_role'] == 'admin'){
                                      
                                      if(isset($_GET['delete'])){
                                      $the_user_id =  escape($_GET['delete']);
                                      
                                      $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
                                      $data = mysqli_query($conn , $query);
                                      header("Location:viewuser.php");
                                      
                                      if(!$data){
                                          die(mysqli_error($conn));
                                      }
                                  }
                                  }
                                  }
                                  ?>
                              </tbody>
                          </table>
                        </div>   
                
                    </div>
                </div>
              

            </div>
           

        </div>
     

         </div>

   <?php include'includes/footer.php'; ?>
  