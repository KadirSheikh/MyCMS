<?php  include "includes/connect.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/nav.php"; ?>
    
    <?php 

if(isset($_POST['submit'])){
    $to = 'rs7246510@gmail.com';
    $from    = "From:" . $_POST['email'];
    $subject = wordwrap($_POST['subject'] , 70);
    $body = $_POST['body'];
   
    
   if(!empty($from)&&!empty($subject)&&!empty($body)){
       
       mail($to,$subject,$body,$from);
        
    echo "<p class='alert alert-success'>Form Submitted Successful.</p>";     
        
}
    else{
         echo "<p class='alert alert-danger'>Fields cannot be empty.</p>";

    }
}





?>
    
<div id="login" >
    <div class="container ">
        <div class="row  ">
           
                <div class="form-wrap col-lg-6 col-lg-offset-3">
                <h1 class="text-center">Contact Us</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email"  class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject"  class="form-control" placeholder="Enter your subject">
                        </div>
                        <div class="form-group">
                            <label for="body" class="sr-only">Body</label>
                            <textarea class="form-control" name="body" placeholder="Enter your subject" rows="10" cols="20"></textarea>
                        </div>
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
             <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</div>


        <hr>



<?php include "includes/footer.php";?>
