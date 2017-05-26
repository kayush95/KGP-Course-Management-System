<?php


function sessionconnectToDatabase()
{
   include('info.php');
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   if(! $conn ) {
     die('Could not connect: ' . mysql_error());
   }
   
   mysql_select_db('dbms');
      //echo 'Connected successfully <br>';
   return $conn;
}

function sessionendDatabaseConnection($conn)
{
    mysql_close($conn);
}

   session_start();

    $conn=sessionconnectToDatabase();
   
   $user_check = $_SESSION['login_user'];

   $sql = "SELECT userid,id,fname,email FROM members where userid = '".$_SESSION['login_id']."' ";

     $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: session.php' . mysql_error());
   }
   $row=mysql_fetch_assoc($retval);

   sessionendDatabaseConnection($conn);
   
   $login_session = $row['fname'];
  	
   $_SESSION['my_email'] = $row['email'];
   $_SESSION['my_fname'] = $row['fname'];
   $_SESSION['my_mname'] = $row['mname'];
   $_SESSION['my_lname'] = $row['lname'];
  // echo "login id : " .$_SESSION['login_id'];
  // echo "<br> email : ".$_SESSION['my_email'];
   
   if(!isset($_SESSION['login_user']) && basename($_SERVER['REQUEST_URI'])!="parent.php" && basename($_SERVER['REQUEST_URI'])!="performance.php"){
       
      header("location:../login/login.php");
   }

?>
