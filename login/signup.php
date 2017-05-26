<?php
include 'helper_modules.php';

 	if($_POST["password"]){

 	if(!$_POST["fname"]||!$_POST["lname"]||!$_POST["userid"]||!$_POST["password"]||!$_POST["sex"]||!$_POST["bday"]||!$_POST["email"]||!$_POST["role"])
 	{
 		echo "Please fill all the details!!";
 	}
 	else{
  if(check_for_userid($_POST["userid"],$_POST["role"],$_POST["password"])==-1)
  {
    echo "userid has already been taken!!";
  }
  else
  {
     	if(!$_POST["mname"])
      {

     	  populate_members($_POST["fname"],$_POST["lname"],$_POST["userid"],$_POST["password"],$_POST["sex"],$_POST["bday"],$_POST["email"],$_POST["role"]);
      }
     else{
        populate_members_mname($_POST["fname"],$_POST["mname"],$_POST["lname"],$_POST["userid"],$_POST["password"],$_POST["sex"],$_POST["bday"],$_POST["email"],$_POST["role"]);
     }
     
       //echo "\nAccount created successfully\n";
     	echo "\nAccount created successfully \n";
      header('Location: login.php');

       //print "<br>".$sql."<br>";
       //echo "hello";
       exit();
	}
}
}
?>

<html>
<head>
<script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-datepicker.css" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<meta charset="utf-8">
<title>Signup Page</title>
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
form fieldset input[type="text"] ,input[type="number"] ,input[type="date"],input[type="password"],input[type="email"]{
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
form fieldset a:hover { text-decoration: underline; }
</style>

  <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="../CSS3FullscreenSlideshow/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="../CSS3FullscreenSlideshow/css/style3.css" />
    <script type="text/javascript" src="../CSS3FullscreenSlideshow/js/modernizr.custom.86080.js"></script>
     <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

</head>
<body>



<ul class="cb-slideshow">
            <li><span>Image 01</span><div><h3> exciting &nbsp; &nbsp; &nbsp; &nbsp; courses </h3></div></li>
            <li><span>Image 02</span><div><h3> skilled &nbsp; &nbsp; &nbsp; &nbsp; faculty</h3></div></li>
            <li><span>Image 03</span><div><h3> nextgen &nbsp; &nbsp; &nbsp; &nbsp; learning</h3></div></li>
            <li><span>Image 04</span><div><h3> forget all &nbsp; &nbsp; &nbsp; &nbsp; your pain </h3></div></li>
            <li><span>Image 05</span><div><h3> learning @ &nbsp; &nbsp; &nbsp; &nbsp; your own pace</h3></div></li>
            <li><span>Image 06</span><div><h3> introducing &nbsp; &nbsp; &nbsp; &nbsp; CoursePlex </h3></div></li>
        </ul>



<div id="signup" style="position: fixed;
position:absolute;
    top: 20%;
    left: 50%;
    max-width: 350px;
    margin-top: -9em; /*set to a negative number 1/2 of your height*/
    margin-left: -15em; /*set to a negative number 1/2 of your width*/
    ">


<h1><strong>Welcome</strong> Please signup.</h1>
<form action="<?php $_PHP_SELF ?>" method="post">
<fieldset>
<p><input type="text" name="fname" required placeholder="First Name" ></p>
<p><input type="text" name="mname" placeholder="Middle Name"></p>
<p><input type="text" name="lname" required placeholder="Last Name"></p>
<p><input id="user_ID" type="text" name="userid" value ="" required placeholder="User ID"></p>
<!-- <p><input type="password" name="password" required placeholder="password"></p> -->
<section>
      <!-- <label for="password">Enter password</label> -->
      <input type="password" name="password" id="password" required placeholder="password">
      <meter max="4" id="password-strength-meter"></meter>
      <p id="password-strength-text"></p>
</section>

<p><input readonly="" id="email_address" type="email" name="email" required placeholder="username@courseplex.com"></p>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                                           
                                                           <script type="text/javascript">

                                                                    $("#user_ID").keyup(function () {
                                                                      var username = $(this).val();
                                                                       username = username.replace(/ /g,'_');
                                                                       $("#email_address").val( username + "@courseplex.com");
                                                                    });

                                                                     
                                                           </script>


<p>sex: </p>
<select name = "sex">
    <option value = "M">
       Male
    </option>
 
    <option value = "F">
       Female
    </option>
 </select>
<p>Birth Date: </p>
<p><input type="text" name="bday" data-provide="datepicker" id="datepicker" data-date-format="yyyy-mm-dd" required placeholder="YYYY-MM-DD"></p>
<script src="bootstrap/js/jquery-1.10.2.js"></script>
        <script src="bootstrap/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function () {
                
                $('.datepicker').datepicker();  
            
            });
          
          // }
        </script>
<p>Role: </p>
<select name = "role">
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
<p><input type="submit" value="Create Account"></p>
</fieldset>
</form>

<script src='https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js'></script>
<script src="js/index.js"></script>


</div> <!-- end login -->
</body>
</html>