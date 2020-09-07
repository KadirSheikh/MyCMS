<?php include'includes\connect.php'; ?>
<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">
    <?php 
if(ifIsMethod('POST')){
if(isset($_POST['login'])){
        
if(isset($_POST['username']) && isset($_POST['password']))
{

login($_POST['username'] , $_POST['password']);
}

else
{
redirect("/cms/index.php");
}
    }


}

?>
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" name="submit" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Login -->
    <div class="well">

        <?php if(isset($_SESSION['user_role'])): ?>

        <h4>Logged in as <b><?php echo $_SESSION['user_name'] ?></b></h4>
        <a href="/cms/logout.php" class="btn btn-warning">Logout</a>
        <?php else: ?>
        <h4>Login</h4>
        <form method="post">

            <label for="username">Username</label>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Enter username">

            </div>
            <label for="password">Password</label>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="*****">

            </div>
            <div class="form-group">
                <a href="forgot.php?forgot=<?php echo uniqid(true) ?>">forget password?</a>

            </div>
            <div class="form-group">
                <input type="submit" name="login" class="btn btn-primary" value="login">

            </div>

        </form>
        <!-- /.input-group -->
        <?php endif; ?>
    </div>


    <?php 

                 $query = "SELECT * FROM catogery";

                 $data = mysqli_query($conn , $query);
             ?>


    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php 
                                 while ($row = mysqli_fetch_assoc($data)) {
                                  $cat_title = $row['cat_title'];
                                $cat_id = $row['cat_id'];

                   echo "<li><a href='the_catagory/$cat_id'>{$cat_title}</a></li>";
               }
                                ?>

                </ul>
            </div>
            <!-- /.col-lg-6 -->
            <!-- <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div> -->
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <?php include 'widget.php'; ?>
</div>
