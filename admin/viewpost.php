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
                        <?php include 'delete_modal.php'; ?>
                    </h1>
                    <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                            
                        </ol> -->
                    <?php 
                    if(isset($_POST['checkBoxArr'])){
                        
                        foreach($_POST['checkBoxArr'] as  $checkoption){
                            $select = $_POST['select'];
                            
                           switch($select) {
                      case 'publish':
        
              $query = "UPDATE posts SET post_status = 'Publish' WHERE post_id = {$checkoption}";
        
           $update_to_published_status = mysqli_query($conn,$query);       
      
           if(!$update_to_published_status){
               die(mysqli_error($conn));
           }

            
         break;
                                   
            case 'draft':
        
              $query = "UPDATE posts SET post_status = 'Draft' WHERE post_id = {$checkoption}";
        
           $update_to_draft_status = mysqli_query($conn,$query);       
      
           if(!$update_to_draft_status){
               die(mysqli_error($conn));
           }

            
         break;
           
                case 'delete':
        
              $query = "DELETE FROM posts WHERE post_id = {$checkoption}";
        
           $delete = mysqli_query($conn,$query);       
      
           if(!$delete){
               die(mysqli_error($conn));
           }

            
         break;
             case 'clone':


                              $query = "SELECT * FROM posts WHERE post_id={$checkoption}";
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
                 
     $query_insert = "INSERT INTO `posts`(`post_cat_id` , `post_title`, `post_auther`,`post_date`,`post_image`, `post_content`, `post_tag`, `post_status`) VALUES ({$post_cat_id},'{$post_title}','{$post_auther}',now(),'{$post_img}','{$post_content}','{$post_tag}' ,'{$post_status}')";
                                
                                $data_insert = mysqli_query($conn , $query_insert);
               if(!$data_insert ) {

                die("QUERY FAILED" . mysqli_error($conn));
               }   
                 
                 break;
                        }
                    }
                    
                    }
                    
                    
                    
                    ?>

 
                    <form action="" method="post">

                        <div class="col-xs-12">
                            <table class="table table-bordered table-hover">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <select class="form-control" name="select">
                                            <option value="">Select</option>
                                            <option value="publish">Publish</option>
                                            <option value="draft">Draft</option>
                                            <option value="clone">Clone</option>
                                            <option value="delete">Delete</option>

                                        </select>

                                    </div>
                                    <div class="col-xs-4">
                                        <input type="submit" value="Apply" class="btn btn-success">&nbsp;&nbsp;&nbsp;
                                        <a class="btn btn-primary" href="addpost.php">Add new</a>
                                    </div>
                                </div>
                                <br>
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select_all"></th>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Auther</th>
                                        <th>Catagory</th>
                                        <th>Content</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Tags</th>
                                        <th>Comments</th>
                                        <th>Date</th>
                                        <th>Views</th>
                                        <th>View Post</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                   $select = "SELECT posts.post_id,posts.post_id,posts.post_title,posts.post_auther,posts.post_cat_id,posts.post_content,posts.post_status,posts.post_image,posts.post_tag,posts.post_comment_count,posts.post_date,posts.post_view_count,catogery.cat_id, catogery.cat_title FROM posts LEFT JOIN catogery ON post_cat_id = cat_id ORDER BY posts.post_id DESC";
                                  $view_post = mysqli_query($conn , $select);
                                     
                                     while ($result = mysqli_fetch_assoc($view_post)) 
                                     {
                                    $post_id = $result['post_id'];
                                    $post_title = $result['post_title'];
                                    $post_auther = $result['post_auther'];
                                         
                                    $post_cat = $result['post_cat_id'];
                                    $post_content = $result['post_content'];
                                    $post_status = $result['post_status'];
                                    $post_img = $result['post_image'];
                                    $post_tag = $result['post_tag'];
                                    $post_comment = $result['post_comment_count'];
                                    $post_date = $result['post_date'];
                                    $post_view_count = $result['post_view_count'];
                                      $cat_id = $result['cat_id'];
                                    $cat_title = $result['cat_title'];
 
                                  
                                
                                      echo "<tr>";
                                      echo"<td><input type='checkbox' name='checkBoxArr[]' class='checkbox' value='$post_id'></td>";
                                      echo"<td>$post_id</td>";
                                      echo"<td>$post_title</td>";
                                      echo"<td>$post_auther</td>";
                                         
                                  /*  $query = "SELECT * FROM catogery WHERE cat_id = {$post_cat}";
                                      $data = mysqli_query($conn , $query);
                                     
                                     while ($row = mysqli_fetch_assoc($data)) 
                                     {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];*/
                                        
                                    echo"<td>{$cat_title}</td>";
                                    /* }*/
                                         
                                      echo"<td>$post_content</td>";
                                      echo"<td>$post_status</td>";
                                      echo"<td><img src='../images/$post_img' width='100'></td>";
                                      echo"<td>$post_tag</td>";
                                         
                                         $query_comment_count = "SELECT * FROM comments WHERE comment_post_id = {$post_id}";
                                         $data_count = mysqli_query($conn , $query_comment_count);
                                         $count_comments = mysqli_num_rows($data_count);
                                         
                                      echo"<td><a href='viewcomments.php?id={$post_id}'>$count_comments</a></td>";
                                         
                                      echo"<td>$post_date</td>";
                                      echo"<td><a href='viewpost.php?reset={$post_id}'>$post_view_count</a></td>";
                                    echo"<td><a href='../post.php?pid={$post_id}' title='View Post' class='btn btn-info'>View</a></td>";
                                      echo"<td><a href='javascript:void(0)' rel='$post_id' title='Delete' class='btn btn-danger delete_link'>Delete</a></td>";
                                         
                                         //echo"<td><a onClick=\" javascript:return confirm('Are you sure want to delete this post?'); \" href='viewpost.php?delete={$post_id}' title='Delete' class='btn btn-danger'>Delete</a></td>";
                                    echo"<td><a href='editpost.php?pid={$post_id}' title='Edit or Update' class='btn btn-primary'>Edit</a></td>";
                                  echo "</tr>";
                                     }
                                      ?>

                                    <?php 
                                  if(isset($_GET['delete'])){
                                      $post_id = escape($_GET['delete']);
                                      
                                      $query = "DELETE FROM posts WHERE post_id = {$post_id}";
                                      $data = mysqli_query($conn , $query);
                                      header("Location:viewpost.php");
                                      
                                      if(!$data){
                                          die(mysqli_error($conn));
                                      }
                                  }
                                    if(isset($_GET['reset'])){
                                      $post_id = escape($_GET['reset']);
                                      
                 $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = ". mysqli_real_escape_string($conn , $post_id) ."";
                                      $data = mysqli_query($conn , $query);
                                      header("Location:viewpost.php");
                                      
                                      if(!$data){
                                          die(mysqli_error($conn));
                                      }
                                  }
          
                                  ?>
                                </tbody>
                            </table>
                    </form>
                </div>


            </div>
        </div>


    </div>


</div>


</div>
<script>
    var select_all = document.getElementById("select_all"); //select all checkbox
    var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

    //select all checkboxes
    select_all.addEventListener("change", function(e) {
        for (i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = select_all.checked;
        }
    });


    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', function(e) { //".checkbox" change 
            //uncheck "select all", if one of the listed checkbox item is unchecked
            if (this.checked == false) {
                select_all.checked = false;
            }
            //check "select all" if all checkbox items are checked
            if (document.querySelectorAll('.checkbox:checked').length == checkboxes.length) {
                select_all.checked = true;
            }
        });
    }

</script>

<script>
    $(document).ready(function() {
        $(".delete_link").on('click', function() {
            var id = $(this).attr('rel');
            var delete_link = "viewpost.php?delete=" + id + "";
            $(".modal_delete_link").attr("href", delete_link);

            $("#myModal").modal('show');
            /*alert(delete_link);*/
        });
    });

</script>
<?php include'includes/footer.php'; ?>
