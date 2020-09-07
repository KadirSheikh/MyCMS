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
                        
                        <div class="col-xs-6">
                          <?php 
                            
                            insertcatagory();
                            ?>
                          <form method="post" action="">
                                <label>Add Catagory</label>
                                <input type="text" id="lang" name="title" class="form-control"><br>
                                <input type="submit" name="add" class="btn btn-primary" value="Add">
                            </form>
                            <br>
                          
                          
                            <?php 
                            if(isset($_GET['edit'])){
                                $cat_id = escape($_GET['edit']);
                                
                                include "includes/update_category.php";
                            }
                            
                            ?>
                              
                            
                            
                        </div>   
            
                               <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Delete</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                               
                                <tbody>
                                     <?php display();  ?>
                               
                                    <?php delete();  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              

            </div>
           

        </div>
     

         </div>

   <?php include'includes/footer.php'; ?>
  