    <?php       
    include('../login/session.php');        
    include('../login/info.php');       
    include('../login/helper_modules.php');     
    /*ini_set('display_errors', 1);     
    ini_set('display_startup_errors', 1);       
    error_reporting(E_ALL);*/       
    if($_SESSION['role'] === "Faculty"){        
        $nouse = 0;     
    }       
    else        
        exit();     
    $flag="";       
    $page;      
    $page_name = "";        
    $mem_id = "";       
    $ptype= "";     
    $pval=0;        
    if(isset($_SESSION['login_id'])){       
        $mem_id = $_SESSION['login_id'];        
        $ptype = $_SESSION['role'];     
        if($ptype === "Admin")      
            $pval = 1;      
        $fac_id = $_SESSION['role_id'];     
        if($pval == 0)      
            $table = get_course_for_faculty($fac_id);       
        else        
            $table = get_course_for_admin($fac_id);     
        if( count($table) > 0 )     
        {       
             $table_row = $table[0];        
             $page = $table_row['c_id'];        
             $page_name = $table_row['course_name'];        
        }       
        /*$connection = mysql_connect($dbhost, $dbuser, $dbpass);       
        mysql_select_db('dbms');        
        $table = $_SESSION['login_id'];     
        mysql_close();*/        
    }       
    if(isset($_POST['course_id']))      
    {       
        //echo $_POST['course_id'];     
        $flag1 = 1;     
        if($_POST['course_id'] === "none"){     
            $flag1 = 0;     
            ?>      
            <script type="text/javascript">     
                alert("Sorry error processing");        
            </script>       
            <?php       
        }       
        else{       
            $page = $_POST['course_id'];        
            $page_name = $_POST['course_name'];     
            $comment1 = $_POST['area3'];        
            //echo $page .  " " . $mem_id ." " . $comment1 . " " . $pval;       
            populate_adminquery($page,$mem_id,$comment1,$pval);     
            foreach ($table as $option) {       
                if($option['c_id'] === $page){      
                    $page_name = $option['course_name'];        
                }       
            }       
            echo ' <div class="alert alert-success alert-dismissible" role="alert"> ';      
            echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"> &times; </span></button> ';        
            echo ' <strong>Well done!</strong> Query Posted ';      
            echo ' </div>';     
        }       
    }       
    if(isset($_POST['select_course'])){     
        $page = $_POST['select_course'];        
        foreach ($table as $option) {       
            if($option['c_id'] === $page){      
                $page_name = $option['course_name'];        
            }       
        }       
    }       
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Courseplex</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>       
    <script type="text/javascript">     
        function handleChange() {       
            //alert("HELLLLO OOO");     
            //document.getElementById('select_course')      
            //$("#course_id").val($("#select_course").val());       
            //alert($("#select_course").val());     
            document.getElementById('myform1').submit();        
        }       
        function setValues() {      
            //alert("HELLLLO OOO");     
            //document.getElementById('select_course')      
            $("#course_id").val($("#select_course").val());     
            //alert($("#select_course").val());     
            document.getElementById('myform22').submit();       
        }       
   </script>
</head>
<body>


 <?php
  
                    $url_query = $_SERVER['QUERY_STRING'];
                    parse_str($url_query, $output);
                    $email_to = $output['sendemailTo'];
                    if(filter_var($email_to, FILTER_VALIDATE_EMAIL)) {
                        $_SESSION['email_tab_selected'] = "#send_mail";
                        $GLOBALS['sender_email_id'] = $email_to;
                     }


                    if(isset($_POST['tab_selector_name']))
                    {
                        $_SESSION['email_tab_selected'] = $_POST['tab_selector_name'];
                        $url = "email.php";
                        unset($_POST['tab_selector_name']);
                        echo '<script>window.location = "'.$url.'";</script>';
                            
                    }
                ?>

                 <form id="page_redirect_form" action="<?php $_PHP_SELF ?>" method="post">
                        <input type="hidden" id="tab_selector" name = 'tab_selector_name'>
                 </form>

                  
                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

                <script type="text/javascript">

                function goToOutbox()
                    {
                        $("#tab_selector").val("#outbox_mail");
                        $("#page_redirect_form").submit();
                    }

                    function goToNewMail()
                    {
                        $("#tab_selector").val("#send_mail");
                        $("#page_redirect_form").submit();
                    }


                    function goToInbox()
                    {
                        $("#tab_selector").val("#inbox_mail");
                        $("#page_redirect_form").submit();
                    }

                    function goToProfileEditor()
                    {
                        $("#tab_selector").val("#profile_editor");
                        $("#page_redirect_form").submit();
                    }

                </script>


    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><i class="fa fa-comments"></i> <strong>Courseplex </strong></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                           <?php
                    /*
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Doe</strong>
                                    <span class="pull-right text-muted">
                                        <em>Today</em>
                                    </span>
                                </div>
                                <div>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem Ipsum has been the industry's standard dummy text ever since an kwilnw...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem Ipsum has been the industry's standard dummy text ever since the...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#" onclick="goToInbox()">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>

                        */
                          $inboxMails = getAllInboxMessages($_SESSION['login_id']);

                          $counter_limit = 0;

                         foreach ($inboxMails as $mssg) {

                            if($counter_limit < 8) // quick read email limit = 8
                            {

                                echo  " <li>
                                        <a href='#' onclick='goToInbox()'>

                                            <div style='min-width: 500px;'>
                                                <strong>". $mssg->email_from ."</strong>
                                                <span class='pull-right text-muted'>
                                                    <em> Date / Time : ". $mssg->time_stamp ."</em>
                                                </span>
                                            </div>
                                            <div> Subject : ". $mssg->subject ."</div>

                                        </a>

                                    </li> ";

                                    $counter_limit = $counter_limit + 1;
                                }



                                }

                        ?>

                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#" onclick="goToInbox()">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>

                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">28% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100" style="width: 28%">
                                            <span class="sr-only">28% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">85% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%">
                                            <span class="sr-only">85% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 min</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#" onclick="goToProfileEditor()"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../login/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="ui-elements.php"><i class="fa fa-desktop"></i> Chat Forum</a>
                    </li>
					<li>
                        <a href="chart.php" class="active-menu"><i class="fa fa-bar-chart-o"></i>Course Forum</a>
                    </li>
                    <li>
                        <a href="../wdCalendar/sample.php"><i class="fa fa-qrcode"></i> Event Calender</a>
                    </li>
                    
                    <li>
                        <a href="form.php"><i class="fa fa-edit"></i> Upload Content </a>
                    </li>
                    <li>
                        <a href="course.php"><i class="fa fa-fw fa-file"></i> Courses Teaching</a>
                    </li>

                    <li>
                        <a href="email.php"><i class="fa fa-envelope"></i> Contact via Email </a>
                    </li>
                    <li>
                        <a href="kola_3.php"><i class="fa fa-envelope"></i> Create Quiz </a>
                    </li>
                    
                    
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Admin Faculty Query Forum
                        </h1>
                        <form name="myform1" id="myform1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <label>Selects Course</label>
                            <select name="select_course" id="select_course" onchange="handleChange()">
                                
                                <?php
                                      if(count($table) > 0){
                                        $cname_id = $page_name . "-[" . $page . "]";
                                        echo '<option value="' . $page . '">'. $cname_id . '</option>';
                                      foreach($table as $option)
                                      {
                                        if($option['c_id'] === $page){
                                            $nouse = 0;
                                        }
                                        else{
                                          $cname_id = $option['course_name'] . "-[" . $option['c_id'] . "]";
                                          echo '<option value="' . $option['c_id'] . '">'. $cname_id . '</option>';
                                        }
                                      } 
                                      } 
                                      else
                                            echo '<option value=none> none </option>'; 
                                ?>
                            </select>
                        </form>
                    </div>
                </div> 
                 <!-- /. ROW  -->
             
                 <!-- /. ROW  -->
                <div class="row">

              <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                 Queries And Suggestions
                </div> 
                    <?php 
                      $connection = mysql_connect($dbhost, $dbuser, $dbpass); //The Blank string is the password
                      mysql_select_db('dbms');


                      $txer=mysql_query('SELECT * FROM adminquery where c_id =' . $page);

                      while($row=mysql_fetch_array($txer))
                      {

                          $number=$row['c_id'];
                          $smark=$row['mem_id'];
                          $smark1=$row['comment'];
                          $smark2=$row['pertype'];
                          echo "<div class='panel-body'>";
                          if($smark2 == 1)
                            echo "<div class='alert alert-success'>";
                          else
                            echo "<div class='alert alert-danger'>";
                          echo "<strong>" . $smark . ": </strong>" . $smark1;    
                          echo "</div>";
                          echo "</div>";
                      }
                    mysql_close();
                    ?>  
                </div>
            </div>                      
                </div>                              
                                    
                  <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            Ask or Answer Query
                        </div>

                       <form name="myform22" id="myform22" role="form" action="" method="post" enctype="multipart/form-data">
                        <div class="panel-body">
                            <input type="hidden" id="course_id" name="course_id" />
                            <input type="hidden" id="course_name" name="course_name" />
                            <textarea id="area3" name="area3" placeholder="Comment" cols="50" rows="5"></textarea>
                            <input type='button' value='Submit form' onClick='setValues()' />
                            <!-- <button type="submit" class="btn btn-default" name="submit">Submit</button> -->
                        </div>
                        </form>


                    </div>
                        
                     <!-- End Modals-->
                </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- Morris Chart Js -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
   
</body>
</html>
