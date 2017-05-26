<?php
   include('session.php');

   if($_SESSION['role'] == "Faculty")
   	header("Location: ../faculty/index.php");
   else if($_SESSION['role'] == "Admin")
   	header("Location: ../dashboard/admin.php");
   else if($_SESSION['role'] == "Student")
   	header("Location: ../dashboard/index.php");
   
?>
<html>
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Welcome <?php echo  $_SESSION['login_user']; ?></h1> 
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>
   
</html>
