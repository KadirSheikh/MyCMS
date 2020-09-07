<?php 


$conn = mysqli_connect('localhost' , 'root' , '' , 'cms');

if ($conn) {
	//echo "connected";
}
else{
	die('Failed'.mysqli_error());
}





?>