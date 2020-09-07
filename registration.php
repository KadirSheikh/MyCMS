<?php  include "includes/connect.php"; ?>
<?php  include "includes/header.php"; 

error_reporting(0);
?>


<!-- Navigation -->

<?php  include "includes/nav.php"; ?>

<?php 


require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$app_cluster = array(
    'cluster' => 'ap2',
    'useTLS' => true
  );

$pusher = new Pusher\Pusher(getenv(APP_KEY), getenv(APP_SECRET), getenv(APP_ID),  $app_cluster);


if($_SERVER["REQUEST_METHOD"] == "POST"){
$username = trim($_POST['username']);
$firstname= trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);
$email    = trim($_POST['email']);
$password = trim($_POST['password']);
    
    
    $error = [
        'username' => '',
        'firstname' => '',
        'lastname' => '',
        'email' => '',
        'password' => ''
    ];
    
    if(strlen($username)<4){
        $error['username']='Username should not be less than 4 characters';
    }
    
    if(empty($username)){
        $error['username']='Username should not be empty';
    }
    if(empty($firstname)){
        $error['firstname']='Firstname should not be empty';
    }
    if(empty($lastname)){
        $error['lastname']='Lastname should not be empty';
    }
     if(empty($password)){
        $error['password']='Password should not be empty';
    }
    
    if(duplicate_user($username)){
        $error['username']='Username already exists';
    }
    
    if(empty($email)){
        $error['email']='Email should not be empty';
    }
    
    if(duplicate_email($email)){
        $error['email']='Email already exists';
    }
    
    foreach($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
            
        }
    }
    if(empty($error)){
        register($username,$firstname,$lastname,$email,$password);
        
        $pusher->trigger( 'notification', 'new_user', $username );
        //login($username,$password);
    }
}





?>
<?php 

if($_GET['lan'] && !empty($_GET['lan'])){
$_SESSION['lan'] = $_GET['lan'];

if(isset($_SESSION['lan']) && $_SESSION['lan']!=$_GET['lan']){
echo "<script type='text/javascript'>location.reload()</script>";
}
    
}
if(isset($_SESSION['lan'])){
include "language/".$_SESSION['lan'].".php";
}else{
  include "language/en.php";  
}



?>
<div id="login">
    <div class="container">
        <form action="" method="get" class="navbar-form navbar-right" id="language">
            <div class="form-group">
                Select Language:
                <select name="lan" onchange="changeLanguage()" class="form-control">
                    <option value="en" <?php if(isset($_SESSION['lan']) && $_SESSION['lan']=='en'){echo 'selected';} ?>>English</option>
                    <option value="hindi" <?php if(isset($_SESSION['lan']) && $_SESSION['lan']=='hindi'){echo 'selected';} ?>>Hindi</option>

                </select>
            </div>

        </form>
        <div class="row">

            <div class="form-wrap col-lg-6 col-lg-offset-3">
                <h1 class="text-center"><?php echo _REGISTER; ?></h1>
                <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                    <div class="form-group">
                        <label for="username" class="sr-only">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo _USER; ?>" autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">
                        <p class="text-danger"><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                    </div>
                    <div class="form-group">
                        <label for="username" class="sr-only">Firstname</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="<?php echo _FIRSTNAME; ?>" autocomplete="on" value="<?php echo isset($firstname) ? $firstname : '' ?>">
                        <p class="text-danger"><?php echo isset($error['firstname']) ? $error['firstname'] : '' ?></p>
                    </div>
                    <div class="form-group">
                        <label for="username" class="sr-only">Lastname</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="<?php echo _LASTNAME; ?>" autocomplete="on" value="<?php echo isset($lastname) ? $lastname : '' ?>">
                        <p class="text-danger"><?php echo isset($error['lastname']) ? $error['lastname'] : '' ?></p>
                    </div>
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL; ?>" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>">
                        <p class="text-danger"><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">Password</label>
                        <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo _PASSWORD; ?>">
                        <p class="text-danger"><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                    </div>

                    <input type="submit" name="register" id="btn-login" class="btn btn-primary btn-lg btn-block" value="<?php echo _REGISTER; ?>">
                </form>

            </div>
            <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</div>


<hr>



<?php include "includes/footer.php";?>


<script>
    function changeLanguage() {
        document.getElementById('language').submit();
    }

</script>
