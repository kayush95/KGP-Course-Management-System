<?php
   include('../login/session.php');
   include('../login/helper_modules.php');

 if($_SESSION['role'] == "Student")
        {}
    else exit();

    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Enroll into a new Course </title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>

 <?php
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
                <a class="navbar-brand" href="index.php"><i class="fa fa-chrome"></i> <strong> CoursePlex </strong></a>
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
                        <a href="courses.php"><i class="fa fa-book"></i> My Courses</a>
                    </li>
                    <li>
                        <a class="active-menu" href="enroll.php"><i class="fa fa-plus-square"></i> Enroll </a>
                    </li>
                    <li>
                        <a href="forum.php"><i class="fa fa-comments"></i> Query Forum </a>
                    </li>
                     <li>
                        <a href="../wdCalendar/sample.php"><i class="fa fa-calendar"></i> Events Calendar </a>
                    </li>
                      <li>
                        <a href="email.php"><i class="fa fa-envelope"></i> Contact via Email </a>
                    </li>

                     <?php /*
                    <li>
                        <a href="ui-elements.php"><i class="fa fa-desktop"></i> UI Elements</a>
                    </li>
                    <li>
                        <a href="chart.php"><i class="fa fa-bar-chart-o"></i> Charts</a>
                    </li>
                    <li>
                        <a href="tab-panel.php"><i class="fa fa-qrcode"></i> Tabs & Panels</a>
                    </li>
                    
                    <li>
                        <a href="table.php"><i class="fa fa-table"></i> Responsive Tables</a>
                    </li>
                    <li>
                        <a href="form.php"><i class="fa fa-edit"></i> Forms </a>
                    </li>



                    <li>
                        <a href="#"><i class="fa fa-sitemap"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="empty.php"><i class="fa fa-fw fa-file"></i> Empty Page</a>
                    </li>
                    */ ?>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

                             <?php
                             //   echo '<h1> Received Choice : '.$_POST['enroll_categ_choice'].' </h1>';
                             $mem_id = $_SESSION['login_id'];

                            $stud_id = $_SESSION['role_id'];
                                     //  echo "stud id : ".$stud_id."<br>";

                            $enroll_courses_ARRAY = getAllUnenrolledCoursesofStudent($stud_id);
                            //$_SESSION['enroll_courses_ARRAY'] = $enroll_courses_ARRAY;
                          
                           

                              if(isset($_POST['enroll_categ_choice']))
                              {
                                    unset($_SESSION['enroll_course_choice']);
                                    unset($_SESSION['name_of_chosen_course_enroll']);
                                 
                                     $course_category_selected = $_POST['enroll_categ_choice'];
                                     $_SESSION['enroll_categ_choice'] = $course_category_selected;
                                    // echo "mem id : ".$mem_id."<br>";
        /*
                                       foreach($GLOBALS['enroll_courses_ARRAY'] as $c)
                                       {
                                        echo "Course ID : ".$c->c_id." <br> " . "Course Name : ". $c->c_name. " <br> " ;
                                       }
                                */
                           }

                             if(isset($_POST['enroll_course_choice']))
                              {
                                    $_SESSION['enroll_course_choice'] = $_POST['enroll_course_choice'];
                                    $_SESSION['name_of_chosen_course_enroll'] = $_POST['name_of_chosen_course_enroll'];

                                     $course_category_selected = $_SESSION['enroll_categ_choice'];
                                     $enroll_course_selected = $_SESSION['name_of_chosen_course_enroll'];
                                     $enroll_id_course_selected = $_SESSION['enroll_course_choice'];

                                     // echo "Selected Course Category: ".$course_category_selected;
                                     // echo "Selected Course : ".$enroll_course_selected." id : ".$enroll_id_course_selected;
                                    // echo "mem id : ".$mem_id."<br>";
                                       $stud_id = $_SESSION['role_id'];
                                     //  echo "stud id : ".$stud_id."<br>";

                                      $topics_ARRAY = get_topics_for_course($enroll_id_course_selected);
                        

                                     // $subtopics_ARRAY = array();
                                    
                                        $j =0;
                                       foreach($GLOBALS['topics_ARRAY'] as $t)
                                       {
                                       // echo "Topics ID : ".$t['tid']." <br> " . "Topic Name : ". $t['tname']. " <br> " ;
                                      //  $subtopics_ARRAY[$j] = get_subtopics_for_topic($t['tid']);

                                             /*   foreach($subtopics_ARRAY[$j] as $s)
                                               {
                                               // echo "Subtopics ID : ".$s['sid']." <br> " . "Subtopic Name : ". $s['sname']. " <br> " ;
                                                
                                               }*/

                                        $j = $j + 1;
                                       }
                                      // $_SESSION['subtopics_array'] = $subtopics_ARRAY;
                                       
                           }

                             if(isset($_SESSION['enroll_categ_choice']))
                            {
                               // echo "YES !";
                            }
                            if(isset($_SESSION['enroll_course_choice']) && isset($_SESSION['enroll_categ_choice']))
                            {
                               // echo "YES !";
                                $enroll_id_course_selected = $_SESSION['enroll_course_choice'];
                                $topics_ARRAY = get_topics_for_course($enroll_id_course_selected);

                            }

                             ?>


        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-20">
                                    <div class="panel panel-default">


                                            <div class="panel-heading">
                                                     <h1> Enroll yourself in exciting new Courses  :  </h1>
                                            </div>

                                            <form id="enroll_categ_form" action="<?php $_PHP_SELF ?>" method="post">
                                              <input type="hidden" id="enroll_categ_select" name='enroll_categ_choice'>
                                          </form>

                            <form id="enroll_course_form" action="<?php $_PHP_SELF ?>" method="post">
                                              <input type="hidden" id="enroll_course_select" name='enroll_course_choice'>
                                              <input type="hidden" id="enroll_name_of_selected_course" name = 'name_of_chosen_course_enroll'>
                                          </form>



                                         <div style="margin-top: 5px;">
                                            <h4 style="margin-left: 10px;"> Choose Course Category : </h4>  
                                            <div class="btn-group">
                                           
                                              <button style="margin-left: 10px;" id = "enroll_course_category" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">

                                              <?php
                                              if(!isset($_SESSION['enroll_categ_choice']))
                                                 echo 'Choose Course Category';
                                             else
                                                echo $_SESSION['enroll_categ_choice'];
                                              ?>

                                              <span class="caret"></span></button>

                                              <ul id= "enroll_categ_dropdown" class="dropdown-menu">

                                              <?php
                                             /* SET(\'Mathematics\',\'General Sciences\',\'Biology\',\'Physics\',\'Chemistry\',\'Social Sciences\',\'Miscellaneous\',\'Languages\',\'Computer Science\')*/
                                                $age = array("Mathematics","General Sciences","Biology","Physics","Chemistry","Social Sciences","Miscellaneous","Languages","Computer Science");

                                                foreach($age as $x) {
                                                    echo "<li><a href=\"#\">".$x."</a></li> ";
                                                }
                                              ?>

                                              <script type='text/javascript'>

                                             $("#enroll_categ_dropdown > li").click(function() {
                                                   $("#enroll_course_category").text($(this).text()); 
                                                      $("#enroll_categ_select").val($(this).find("a").text());
                                                    document.getElementById('enroll_categ_form').submit();
                                                });

                                                </script>
                                                
                                            
                                              </ul>
                                            </div>
                                            <h4 style="margin-left: 10px;"> Choose a Course : </h4>  
                                            <div style="margin:5px;" class="btn-group">
                                              <button style="margin-left: 10px;" id="enroll_course_options" data-toggle="dropdown" class="btn btn-danger dropdown-toggle"> 

                                                <?php
                                              if(!isset($_SESSION['name_of_chosen_course_enroll']) || !isset($_SESSION['enroll_categ_choice']))
                                                 echo 'Choose Course';
                                             else
                                                echo $_SESSION['name_of_chosen_course_enroll'];
                                              ?>

                                               <span class="caret"></span></button>
                                              <ul id="enroll_course_dropdown" class="dropdown-menu">

                                          <?php
                                            if(isset($GLOBALS['enroll_courses_ARRAY'])){

                                                        foreach($GLOBALS['enroll_courses_ARRAY'] as $x) {
                                                            
                                                            $pos = strpos($x->c_cat,$_SESSION['enroll_categ_choice']);
                                                            if($pos !== false)
                                                            echo "<li><a href=\"#\">". $x->c_name. " (ID:". $x->c_id.")"."</a></li> ";
                                                        }
                                            }
                                          ?>

                                          <script type='text/javascript'>

                                             $("#enroll_course_dropdown > li").click(function() {
                                               
                                                    var parse_text = $(this).text();
                                                    var parsed_text_1 = parse_text.split(" \(");
                                                    var selected_course_name = parsed_text_1[0];
                                                    var parsed_text_2 = parsed_text_1[1].split(":");
                                                    var parsed_text_3 = parsed_text_2[1].split("\)");
                                                    var selected_course_id = parsed_text_3[0];

                                                // document.write( "name : "+ selected_course_name+" id : "+ selected_course_id );

                                                      $("#enroll_course_select").val(selected_course_id);
                                                      $("#enroll_course_options").text(selected_course_name);
                                                       $("#enroll_name_of_selected_course").val(selected_course_name);
                                                    document.getElementById('enroll_course_form').submit();
                                                });

                                                </script>

                                                
                                              </ul>
                                            </div>








                                            <div style="padding-top: 50px;" class="panel-body">
                                                            <h3> COURSE : <small style=" color:blue;">
                                                            <?php  

                                                             foreach ($GLOBALS['enroll_courses_ARRAY'] as $crs) 
                                                             {
                                                               // echo $crs->c_id;
                                                                if($crs->c_id == $_SESSION['enroll_course_choice'])
                                                                {
                                                                    echo $crs->c_name;
                                                                }

                                                            }
                                                             ?> </small>
                                                              </h3>
                                                            <br>
                                                            <h3> Category : <small style=" color:blue;"> 
                                                            <?php 
                                                             foreach ($GLOBALS['enroll_courses_ARRAY'] as $crs) {
                                                                if($crs->c_id == $_SESSION['enroll_course_choice'])
                                                                {
                                                                    echo $crs->c_cat;
                                                                }

                                                            } ?> </small></h3>
                                                            <br>

                                                            <h3> Course Prerequisites : <small style=" color:blue;"> 
                                                            <?php 
                                                             foreach ($GLOBALS['enroll_courses_ARRAY'] as $crs) {
                                                                if($crs->c_id == $_SESSION['enroll_course_choice'])
                                                                {
                                                                    echo $crs->c_preq;
                                                                }

                                                            } ?> </small></h3>
                                                            <br>


                                                            <h3> Course Air Date : <small style=" color:blue;">
                                                            <?php 
                                                             foreach ($GLOBALS['enroll_courses_ARRAY'] as $crs) {
                                                                if($crs->c_id == $_SESSION['enroll_course_choice'])
                                                                {
                                                                    echo $crs->c_air_date;
                                                                }

                                                            } ?> </small></h3>
                                                            <br>
                                                            <h3> Course Administrator : <small style=" color:blue;">
                                                             <?php 
                                                             foreach ($GLOBALS['enroll_courses_ARRAY'] as $crs) {
                                                                if($crs->c_id == $_SESSION['enroll_course_choice'])
                                                                {
                                                                    $row = get_member_name($crs->c_admin);
                                                                    echo $row['fname']." ".$row['lname'];
                                                                }

                                                            } ?> </small>
                                                            </h3>
                                                            <br>
                                                            <h3> Contributions by following Professors :  <small style=" color:blue;">
                                                            <?php
                                                             if(isset($_SESSION['enroll_course_choice']))
                                                             {
                                                                $id_course = $_SESSION['enroll_course_choice'];
                                                                 $faculty_info = get_All_Faculty_for_Course($id_course);

                                                                  foreach ($faculty_info as $fac) {
                                                                      echo $fac->fac_name." , ";
                                                                  }

                                                                  
                                                          }
                                                            ?>

                                                            </small></h3>
                                                            <br>
                                                            <h3> No. of students enrolled :  <small style=" color:blue;">
                                                            <?php
                                                            if(isset($_SESSION['enroll_course_choice']))
                                                               echo get_student_Count_for_Course($_SESSION['enroll_course_choice']);
                                                            ?>

                                                            </small></h3>
                                                            <br>
                                                            <h3> Brief Overview about the Course </h3>
                                                            <p style=" color:blue;"> <?php
                                                             foreach ($GLOBALS['enroll_courses_ARRAY'] as $crs) {
                                                                if($crs->c_id == $_SESSION['enroll_course_choice'])
                                                                {
                                                                    echo $crs->c_brief;
                                                                }

                                                            } ?> </p> 

                                                            <h3> Course Structure </h3> 
                                                            
                                                            <ul style="color:blue; padding-top: 20px;" class="nav nav-list tree">

                                                        <?php
                                                        if(isset($_SESSION['enroll_categ_choice']) && isset($_SESSION['enroll_course_choice']) )
                                                        {
                                                                  $j =0;
                                                           foreach($GLOBALS['topics_ARRAY'] as $t)
                                                           {
                                                           // echo "Topics ID : ".$t['tid']." <br> " . "Topic Name : ". $t['tname']. " <br> " ;
                                                            
                                                            echo "<li>".$t['tname']."<ul class='nav-second-level'> ";
                                                                $subtopics_ARRAY[$j] = get_subtopics_for_topic($t['tid']);
                                                                    foreach($subtopics_ARRAY[$j] as $s)
                                                                   {
                                                                   // echo "Subtopics ID : ".$s['sid']." <br> " . "Subtopic Name : ". $s['sname']. " <br> " ;
                                                                        echo "<li>". $s['sname'] ."</li>";
                                                                   }
                                                            echo "</ul> </li>";

                                                            $j = $j + 1;
                                                           }
                                                       }
                                                        

                                                        /*
                                                                <li> Topic1 
                                                                    <ul class="nav-second-level"> 
                                                                        <li>  SubTopic1  </li>
                                                                        <li>  SubTopic2  </li>
                                                                        <li>  SubTopic3  </li>
                                                                        <li>  SubTopic4  </li>
                                                                    </ul>
                                                                </li>

                                                                <li> Topic2 
                                                                    <ul class="nav-second-level"> 
                                                                        <li>  SubTopic1  </li>
                                                                        <li>  SubTopic2  </li>
                                                                        <li>  SubTopic3  </li>
                                                                        <li>  SubTopic4  </li>
                                                                    </ul>
                                                                </li>

                                                                <li> Topic3 
                                                                    <ul class="nav-second-level"> 
                                                                        <li>  SubTopic1  </li>
                                                                        <li>  SubTopic2  </li>
                                                                        <li>  SubTopic3  </li>
                                                                        <li>  SubTopic4  </li>
                                                                    </ul>
                                                                </li>

                                                                <li> Topic4 
                                                                    <ul class="nav-second-level"> 
                                                                        <li>  SubTopic1  </li>
                                                                        <li>  SubTopic2  </li>
                                                                        <li>  SubTopic3  </li>
                                                                        <li>  SubTopic4  </li>
                                                                    </ul>
                                                                </li>

                                                                */
                                                                ?>


                                                            </ul>


                                                                 <h3> Enrollment Fees : <small style=" color:blue;"> 
                                                                    <?php 
                                                                     foreach ($GLOBALS['enroll_courses_ARRAY'] as $crs) {
                                                                        if($crs->c_id == $_SESSION['enroll_course_choice'])
                                                                        {
                                                                            echo "$".$crs->c_payment;
                                                                        }

                                                                    } ?> </small></h3>
                                                                   <br>

                                           </div>

                                           <?php

                                            if($_POST['enroll'])
                                            {
                                                $_SESSION['categ_choice'] = $_SESSION['enroll_categ_choice'];
                                                $_SESSION['course_choice'] = $_SESSION['enroll_course_choice'];
                                                $_SESSION['name_of_chosen_course'] = $_SESSION['name_of_chosen_course_enroll'];
                                                $stud_id = $_SESSION['role_id'];

////////////////////////////////////////////////////////////////////////////////////////////////////

						/*$quiz_set = get_quiz_for_course($_SESSION['enroll_course_choice']);
			
						foreach($quiz_set as &$quiz)
							foreach($quiz as &$q)
								add_score($stud_id, $_SESSION['enroll_course_choice'], $q, 0);*/

////////////////////////////////////////////////////////////////////////////////////////////////////


                                                enroll_students($stud_id , $_SESSION['enroll_course_choice']);
                                                unset($_SESSION['enroll_categ_choice']);
                                                unset($_SESSION['enroll_course_choice']);
                                                echo "<script type='text/javascript'> window.alert('You have been successfully enrolled for ". $_SESSION['name_of_chosen_course_enroll'] ."'); </script>";
                                                $url = "courses.php";
                                                echo '<script>window.location = "'.$url.'";</script>';
                                                
                                            }

                                           ?>

                                        <form style="padding-top: 10px; padding-left: 600px;" id="enroll_form" action="<?php $_PHP_SELF ?>" method="post">
                                            <input 
                                            <?php if(isset($_SESSION['enroll_course_choice']) && isset($_SESSION['enroll_categ_choice']))
                                            echo " type='submit' ";
                                            else
                                              echo " type='hidden' ";
                                          ?> class="btn btn-success btn-lg" id="enroll_course" value="Enroll" name='enroll'> 
                                          </form>

                                         
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
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
   
</body>
</html>
