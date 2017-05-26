<?php
include 'helper_modules.php';

   session_start();

   if($_POST["signup"])
	{
		//echo "hello";
		header( "Location: signup.php");
	}
   if($_POST["Username"] || $_POST["Password"] ||$_POST["role"]){
   	/*echo $_POST["Username"];
   	echo "<br>".$_POST["Password"]."<br>";*/
   	if(!$_POST["Username"])
   	{
   		echo "Please Enter Username";
   	}
   	else if(!$_POST["Password"])
   	{
   		echo "Please Enter Password";
   	}
      else if(!$_POST["role"]){
         echo "Please Choose Role";
      }
   else{
      $roleid=check_for_login($_POST["Username"],$_POST["Password"],$_POST["role"]);
      if($roleid[0]==-1)
      {
         echo "Incorrect username or password <br>";
         echo $_POST["Username"]." ".$_POST["Password"]." ".$_POST["role"];
         
      }
      else{
          echo "\nLogined successfully\n";

         $_SESSION['login_user'] = $roleid[1];
         $_SESSION['login_id'] = $_POST["Username"];
         $_SESSION['role'] = $_POST["role"];
         $_SESSION['role_id']= $roleid[0];  
        
         header('Location: welcome.php');
   	}
	   endDatabaseConnection();
      exit();
   }
}
?>



<html>
<head>
<meta charset="utf-8">
<title>Login Page</title>
<style type="text/css">
body {
background-color: #f4f4f4;
color: #5a5656;
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
font-size: 16px;
line-height: 1.5em;
}
a { text-decoration: none; }
h1 { font-size: 1em; }
h1, p {
margin-bottom: 10px;
}
strong {
font-weight: bold;
}
.uppercase { text-transform: uppercase; }

/* ---------- LOGIN ---------- */
#login {
margin: 50px auto;
width: 300px;
}
form fieldset input[type="text"], input[type="password"] {
background-color: #e5e5e5;
border: none;
border-radius: 3px;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
color: #5a5656;
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
font-size: 14px;
height: 50px;
outline: none;
padding: 0px 10px;
width: 280px;
-webkit-appearance:none;
}
form fieldset input[type="submit"] {
background-color: #008dde;
border: none;
border-radius: 3px;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
color: #f4f4f4;
cursor: pointer;
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
height: 50px;
text-transform: uppercase;
width: 300px;
-webkit-appearance:none;
}
form fieldset a {
color: #5a5656;
font-size: 10px;
}
form fieldset a:hover { text-decoration: underline; }
.btn-round {
background-color: #5a5656;
border-radius: 50%;
-moz-border-radius: 50%;
-webkit-border-radius: 50%;
color: #f4f4f4;
display: block;
font-size: 12px;
height: 50px;
line-height: 50px;
margin: 30px 125px;
text-align: center;
text-transform: uppercase;
width: 50px;
}
.signup-before {
background-color: #0064ab;
border-radius: 3px 0px 0px 3px;
-moz-border-radius: 3px 0px 0px 3px;
-webkit-border-radius: 3px 0px 0px 3px;
color: #f4f4f4;
display: block;
float: left;
height: 50px;
line-height: 50px;
text-align: center;
width: 50px;
}
.signup {
background-color: #0079ce;
border: none;
border-radius: 0px 3px 3px 0px;
-moz-border-radius: 0px 3px 3px 0px;
-webkit-border-radius: 0px 3px 3px 0px;
color: #f4f4f4;
cursor: pointer;
height: 50px;
text-transform: uppercase;
width: 250px;
}
select {
   background-color: #e5e5e5;
border: none;
border-radius: 3px;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
color: #5a5656;
font-family: 'Open Sans', Arial, Helvetica, sans-serif;
font-size: 14px;
height: 50px;
outline: none;
padding: 0px 10px;
width: 280px;
-webkit-appearance:none;
z-index: 1;
}

</style>

<link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="../CSS3FullscreenSlideshow/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="../CSS3FullscreenSlideshow/css/style2.css" />
    <script type="text/javascript" src="../CSS3FullscreenSlideshow/js/modernizr.custom.86080.js"></script>
     <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

</head>
<body>


<ul class="cb-slideshow">
            <li><span>Image 01</span><div><h3>KGP·course·management</h3></div></li>
            <li><span>Image 02</span><div><h3> Ravi.Bansal</h3></div></li>
            <li><span>Image 03</span><div><h3> ANKUR.GARG</h3></div></li>
            <li><span>Image 04</span><div><h3>kUMAR.ayush</h3></div></li>
            <li><span>Image 05</span><div><h3> VARUN.rawal</h3></div></li>
            <li><span>Image 06</span><div><h3> DBMS.Project</h3></div></li>
        </ul>

<div id="CoursePlex" style="position: fixed;
position:absolute;
    top: 30%;
    left: 30%;
   
    margin-top: -9em; /*set to a negative number 1/2 of your height*/
    margin-left: -15em; /*set to a negative number 1/2 of your width*/" >

    <h1 style="

     font-family: 'BebasNeueRegular', 'Arial Narrow', Arial, sans-serif;
    font-size: 160px;
    padding: 0 30px;
    line-height: 120px;
    color: white;"> 
    Welcome to CoursePlex </h1>
    </div>


<div id="login" style="position: fixed;
position:absolute;
    top: 50%;
    left: 50%;
    width:30em;
    height:18em;
    margin-top: -9em; /*set to a negative number 1/2 of your height*/
    margin-left: -15em; /*set to a negative number 1/2 of your width*/
    ">
    
<h1><strong>Welcome.</strong> Please login.</h1>
<form action="<?php $_PHP_SELF ?>" method="post">
<fieldset>
<p><input type="text" name="Username" required placeholder="Userid" ></p>
<p><input type="password" name="Password" required placeholder="Password"></p>
<select name = "role" required>
    <option value = "Admin">
       Admin
    </option>
 
    <option value = "Faculty">
       Faculty
    </option>

    <option value = "Student">
       Student
    </option>
</select>
<p><a style="label" href="/test/dbmsmn/login/forgotpassword.php">Forgot Password?</a></p>
<p><input type="submit" value="Login"></p>
</fieldset>
</form>
<p><span class="btn-round">or</span></p>
<form action="<?php $_PHP_SELF ?>" method="post">
<p>
<a class="signup-before"></a>
<input type="button" name="signup" value="signup" class="signup" onClick="document.location.href='signup.php'">
</p>
</form>
</div> <!-- end login -->
</body>
</html>