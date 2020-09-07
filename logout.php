<?php include'includes\connect.php'; ?>
<?php session_start(); ?>
<?php

        $_SESSION['user_name'] = null;
         $_SESSION['user_firstname'] = null;
         $_SESSION['user_lastname'] = null;
        $_SESSION['user_role'] = null;
session_destroy();
        header("Location:index.php");

?>
