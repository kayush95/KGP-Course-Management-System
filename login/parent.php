<?php
   include('../login/session.php');
   include('../login/helper_modules.php');
   $alert=0;
   if(isset($_POST["Username"]) && isset($_POST["bday"]))
   {
   		// echo "hello";
   		$mem_id=parent_check($_POST["Username"],$_POST["bday"]);
   		// echo $mem_id;
   		if($mem_id!=-1)
   		{
   			$role_id=get_stud_id($mem_id);
   			if($role_id!=-1)
   			{
				$_SESSION["stud_username"] =$_POST["Username"];
   				$_SESSION["role_id"]=$role_id;
   				$_SESSION["role"]="parent";
   				header("Location:performance.php");
   			}
   		}
   		$alert=1;
   }
?>

<html>
<head>
<meta charset="utf-8">
<title>Performance Page</title>

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
        <link rel="stylesheet" href="bootstrap/css/bootstrap-datepicker.css" />
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../CSS3FullscreenSlideshow/css/style2.css" />
    <script type="text/javascript" src="../CSS3FullscreenSlideshow/js/modernizr.custom.86080.js"></script>
     <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
     

</head>
<body>
<?php if($alert==1) { ?>
            <div class="alert alert-danger" role="alert">
            <a href="#" class="alert-link"><strong>Incorrect userid or birthday!</strong></a>
            </div> 
            <?php } ?>
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
    
<h1><strong>Performance Page</strong></h1>
<form action="<?php $_PHP_SELF ?>" method="post">
<fieldset>
<p><input type="text" name="Username" required placeholder="Userid" ></p>
<p><input type="text" name="bday" data-provide="datepicker" id="datepicker" data-date-format="yyyy-mm-dd" required placeholder="YYYY-MM-DD"></p>

<script src="bootstrap/js/jquery-1.10.2.js"></script>
        <script src="bootstrap/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                
                $('.datepicker').datepicker();  
            
            });
        </script>

<!-- <p><a style="label" href="/test/dbmsmn/login/forgotpassword.php">Forgot Password?</a></p> -->
<p><input type="submit" value="submit"></p>
</fieldset>
</form>
</div> <!-- end login -->
</body>
</html>
