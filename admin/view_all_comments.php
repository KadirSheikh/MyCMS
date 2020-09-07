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
                                      <th>Post ID</th>
                                      <th>Auther</th>
                                      <th>Email</th>
                                      <th>Content</th>
                                      <th>Status</th>
                                      <th>Date</th>
                                      <th>Response</th>
                                     
                                      <th>Approved</th>
                                      <th>Unapproved</th>
                                      <th>Delete</th>
                                      
                                  </tr>
                              </thead>
                              
                              <tbody>
                                 <?php
                                   $query = "SELECT * FROM comments";
                                  $view_comments = mysqli_query($conn , $query);
                                     
                                     while ($result = mysqli_fetch_assoc($view_comments)) 
                                     {
                                    $comment_id = $result['comment_id'];
                                    $comment_post_id = $result['comment_post_id'];
                                    $comment_auther = $result['comment_auther'];
                                    $comment_email = $result['comment_email'];
                                    $comment_content = $result['comment_content'];
                                    $comment_status = $result['comment_status'];
                                    $comment_date = $result['comment_date'];
                                      
                                  
                                
                                  echo "<tr>";
                                      echo"<td>$comment_id </td>";
                                      echo"<td>$comment_post_id</td>";
                                      echo"<td>$comment_auther</td>";
                                         
                                    /*$query = "SELECT * FROM catogery WHERE cat_id = {$post_cat}";
                                      $data = mysqli_query($conn , $query);
                                     
                                     while ($row = mysqli_fetch_assoc($data)) 
                                     {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                        
                                    echo"<td>{$cat_title}</td>";
                                     }*/
                                         
                                      echo"<td>$comment_email</td>";
                                      echo"<td>$comment_content</td>";
                                      echo"<td>$comment_status</td>";
                                      echo"<td>$comment_date</td>";
                                       
                                         $post_query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                         $select_post = mysqli_query($conn , $post_query);
                                         while($row = mysqli_fetch_assoc($select_post)){
                                             $post_id = $row['post_id'];
                                             $post_title = $row['post_title'];
                                             echo"<td><a href='../post.php?pid=$post_id'>$post_title</a></td>";
                                         }
                                    
                                         
                                         
                                      
                                      echo"<td><a href='view_all_comments.php?approve=$comment_id' title='Approve' class='btn btn-success'>Approve</a></td>";
                                      echo"<td><a href='view_all_comments.php?unapprove=$comment_id' title='Unapprove' class='btn btn-warning'>Unapprove</a></td>";
                                      echo"<td><a href='view_all_comments.php?delete=$comment_id' title='Delete' class='btn btn-danger'>Delete</a></td>";
                                      
                                  echo "</tr>";
                                     }
                                      ?>
                                      
                                      <?php 
                                  if(isset($_GET['approve'])){
                                      $approve_comment = escape($_GET['approve']);
                                      
                                      $query = "UPDATE comments SET comment_status='approved' WHERE comment_id = {$approve_comment}";
                                      $data = mysqli_query($conn , $query);
                                      header("Location:view_all_comments.php");
                                      
                            
                                  }
                             
                                  ?>
                                     
                                     <?php 
                                  if(isset($_GET['unapprove'])){
                                      $unapprove_comment = escape($_GET['unapprove']);
                                      
                                      $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id = {$unapprove_comment}";
                                      $data = mysqli_query($conn , $query);
                                      header("Location:view_all_comments.php");
                                      
                            
                                  }
                             
                                  ?>
                                      
                                      <?php 
                                  if(isset($_GET['delete'])){
                                      $comment_id = escape($_GET['delete']);
                                      
                                      $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
                                      $data = mysqli_query($conn , $query);
                                      header("Location:view_all_comments.php");
                                      
                                      if(!$data){
                                          die(mysqli_error($conn));
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
  