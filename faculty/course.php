<?php
    include('../login/session.php');
    include('../login/info.php');
    include('../login/helper_modules.php');

    /*
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    */

     if($_SESSION['role'] == "Faculty")
        {}
    else exit();


    $result = array();
     $resultInvited = array();
    if(isset($_SESSION['role_id'])){
        $fac_id = $_SESSION['role_id'];
        $result = get_course_for_faculty($fac_id);
        $resultInvited = display_course_for_fac($fac_id);
    }
    if(isset($_POST['submitb'])) {      
        $fac_id = $_SESSION['role_id'];     
        /*if(!isset($_POST['select_course']))       
            echo "FOUND";*/     
        $c_id = $_POST['select_course'];        
        if($c_id === "none"){       
            ?>      
            <script type="text/javascript">     
                alert("Sorry no course selected");      
            </script>       
            <?php       
        }       
        else{       
            accept_course($fac_id,$c_id);       
            echo ' <div class="alert alert-success alert-dismissible" role="alert"> ';      
            echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"> &times; </span></button> ';        
            echo ' <strong>Well done!</strong> Course Accepted ';       
            echo ' </div>';     
            $fac_id = $_SESSION['role_id'];     
            $result = get_course_for_faculty($fac_id);      
            $resultInvited = display_course_for_fac($fac_id);       
        }       
        //echo "You are now the assigned faculty by Mr. bansal";        
    }
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Courseplex</title>
	<!-- Bootstrap Styles-->
    <link href="../dashboard/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="../dashboard/assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="../dashboard/assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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

                            if($counter_limit < 5) // quick read email limit = 8
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
                        <a href="chart.php"><i class="fa fa-bar-chart-o"></i>Course Forum</a>
                    </li>
                    <li>
                        <a href="../wdCalendar/sample.php"><i class="fa fa-qrcode"></i> Event Calender</a>
                    </li>
                    
                    <li>
                        <a href="form.php"><i class="fa fa-edit"> </i> Upload Content </a>
                    </li>
                    <li>
                        <a class="active-menu" href="course.php"><i class="fa fa-fw fa-file"></i> Courses Teaching</a>
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
                            Courses Teaching 
                        </h1>
                        <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course Name</th>
                                            <th>Course Category</th>
                                            <th>Course ID</th>
                                            <th>Student's Enrolled</th>
                                            <th>Course admin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          //$connection = mysql_connect($dbhost, $dbuser, $dbpass); //The Blank string is the password
                                          //mysql_select_db('dbms');

                                          //$table=mysql_query('SELECT * FROM courset WHERE facID=1 ');
                                          
                                          $num = 1;
                                          foreach($result as $row)
                                          {
                                              $number=$num;
                                              $smark=$row['course_name'];
                                              $smark2=$row['c_id'];
                                              $smark1=$row['course_category'];
                                              $smark3=get_student_Count_for_Course($smark2);
                                              $tt1 = $row['course_admin'];
                                              $smark4 = get_admin_for_course($tt1);
                                              $num++;
                                          ?>
                                          <tr>
                                            <td><?php echo $number ?></td>
                                            <td><?php echo $smark ?></td>
                                            <td><?php echo $smark1 ?></td>
                                            <td><?php echo $smark2 ?></td>
                                            <td><?php echo $smark3 ?></td>
                                            <td><?php echo $smark4[0]['fname'] . " " . $smark4[0]['lname'] ?></td>
                                          </tr>
                                        <?php } 
                                        //mysql_close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <form role="form" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data" >
                                <div class="form-group">
                                    <label>Teach Course</label>
                                    <select class="form-control" name="select_course" id="select_course" style=" border-radius:4px;-webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
                                               -moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
                                               background: #f8f8f8;
                                                color:#888;
                                                border:none;
                                                outline:none;
                                                display: inline-block;
                                                -webkit-appearance:none;
                                                -moz-appearance:none;
                                                appearance:none;
                                                cursor:pointer;">
                                         
                                        <?php   
                                             
                                                                                      
                                          /*$connection = mysql_connect($dbhost, $dbuser, $dbpass); //The Blank string is the password
                                          mysql_select_db('dbms');
                                          $table=mysql_query('SELECT * FROM courset WHERE facID=1 ');
                                          while($row=mysql_fetch_array($table))
                                          {
                                              $number=$row['id'];
                                              $smark=$row['facID'];
                                              $smark1=$row['courseID'];
                                              echo "<option>". $cname_id . "</option>";
                                          }*/
                                          $flag = 0;
                                          foreach($resultInvited as $option) {
                                            $flag=1;
                                            $cname_id = $option['course_name'] . "-[" . $option['c_id'] . "]";
                                            echo '<option value="' . $option['c_id'] . '">'. $cname_id . '</option>';
                                            }
                                        if($flag === 0){
                                            echo '<option value="none"> No invite </option>'; 
                                        }
                                        //mysql_close();
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" name="submitb" class="btn btn-default">Submit</button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div> 
                 <!-- /. ROW  -->
                 
                </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="../dashboard/assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="../dashboard/assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="../dashboard/assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="../dashboard/assets/js/custom-scripts.js"></script>
    
   
</body>
</html>
