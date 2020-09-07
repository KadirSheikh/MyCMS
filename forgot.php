<?php  include "includes/connect.php"; ?>
 <?php  include "includes/header.php"; ?>
 

    <!-- Navigation -->
    
    <?php  include "includes/nav.php"; ?>

<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

if(!ifIsMethod('GET') && !isset($_GET['forgot'])){
    redirect('index.php');
}

if(ifIsMethod('POST')){
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));
        
        if(duplicate_email($email)){
            if($stmt = mysqli_prepare($conn , "UPDATE users SET token = '{$token}' WHERE user_email=?")){
            mysqli_stmt_bind_param($stmt , 's' , $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
                
                /*phpmailer configuration*/
                $mail = new PHPMailer();
                
                $mail->isSMTP();
                $mail-> Host = Config::SMTP_HOST;
                $mail->SMTPAuth = true;
                $mail->Username = Config::SMTP_USERNAME;
                $mail->Password = Config::SMTP_PASSWORD;
                $mail->SMTPSecure = 'tls';
                $mail->Port = Config::SMTP_PORT;
                $mail-> SMTPPath = true;
                $mail->isHTML(true);
                $mail->CharSet="UTF-8";
                    
                $mail->setFrom('rs7246510@gmail.com' , 'Kadir Sheikh');
                $mail->addReplyTo('rs7246510@gmail.com', 'Kadir Sheikh');
                $mail->addAddress($email);
                
                $mail->Subject = "Reset your password.";
                $mail->Body = "<p>
                Please click on the link below to reset your password.<br><br>
                <a href='http://localhost/cms/reset.php?email=$email&token=$token'>http://localhost/cms/reset.php?email=$email&token=$token</a>
                
                
                
                
                </p>";
                
                if($mail->send()){
                    $emailSend = true;
                }else{
                    echo "Unable to send email.Please try again.";
                       echo 'Mailer Error: ' . $mail->ErrorInfo;
                
                }
               

            }
            else{
                die(mysqli_error($conn));
            }
           
            
            
        }else{
            echo "<p class='alert alert-danger'>Email doesn't exits.</p>";
        }
    }
}



?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                              <?php if(!isset($emailSend)): ?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                                <?php else: ?>
                                <h2>Please check your email</h2>
                                      <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

