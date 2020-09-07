<?php session_start(); ?>
<?php include 'connect.php'; ?>
<?php include 'admin/function.php'; ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
              <?php 
                    if(isset($_SESSION['user_name'])){
                        if(isset($_GET['pid'])){
                             $edit_id = $_GET['pid'];
                            
                echo "<a class='navbar-brand' href='admin/editpost.php?pid={$edit_id}'>Edit Post</a>";
                            
                        }
                    }
                    
                    
                    ?>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="navbar-nav nav ">

                <li class="<?php if(isset($_GET['home'])){echo 'active';} ?>"> <a class="navbar-brand" href="/cms/index?home">CMS </a></li>
                <?php  if(ifLoggedIn()): ?>
                <li class=""> <a class="navbar-brand" href="/cms/admin">Admin </a></li>
                <li class=""> <a class="navbar-brand" href="logout.php">Logout </a></li>
                <?php  else: ?>
                
                <li class="<?php if(isset($_GET['login'])){echo 'active';} ?>"> <a class="navbar-brand" href="main_login.php?login">Login </a></li>
                <?php  endif; ?>
                
                
                
                
                
                <li class="<?php if(isset($_GET['register'])){echo 'active';} ?>"><a class="navbar-brand" href="/cms/registration?register">Register </a></li>
                <li class="<?php if(isset($_GET['contact'])){echo 'active';} ?>"><a class="navbar-brand" href="/cms/contact?contact">Contact </a></li>
            
                <?php 

                 $query = "SELECT * FROM catogery";

                 $data = mysqli_query($conn , $query);
               while ($row = mysqli_fetch_assoc($data)) {
                   $cat_id = $row['cat_id'];
                   $title = $row['cat_title'];

                /*   $catagory_class = '';
                   $register = '';
                   $pageName = basename($_SERVER['PHP_SELF']);*/
                   ?>
                  <li class="<?php if(isset($_GET['catagory']) && $_GET['catagory']==$cat_id){echo 'active';} ?>" ><a href='/cms/the_catagory/<?php echo $cat_id ?>'><?php echo $title; ?></a></li>
                   <?php
                   
               }


                    ?>


              
                <!-- <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li> -->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
