    <form action="" method="post">
      <div class="form-group">
        
         
         
         <?php

        if(isset($_GET['edit'])){

            $cat_id = $_GET['edit'];

        $query = "SELECT * FROM catogery WHERE cat_id = $cat_id ";
        $select_categories_id = mysqli_query($conn,$query);  

            while($row = mysqli_fetch_assoc($select_categories_id)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
                
            ?>
<label for="cat-title">Edit Category</label> 
 <input value="<?php echo $cat_title; ?>" type="text" class="form-control" name="cat_title">
        
        
        
       <?php }} ?>
       
     <?php   

       

            if(isset($_POST['update'])) {

                $the_cat_title = $_POST['cat_title'];

                $stmt = mysqli_prepare($conn, "UPDATE catogery SET cat_title = ? WHERE cat_id = ?");
                mysqli_stmt_bind_param($stmt , 'si' , $the_cat_title , $cat_id);
                mysqli_stmt_execute($stmt); 
               
         }

    ?>
       
     
         
      </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update" value="Edit">
      </div>

    </form>
