<?php
   include('../login/session.php');
   include('../login/helper_modules.php');

/*
   ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    */
   if($_SESSION['role'] == "Student")
        {}
    else exit();

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> View your courses </title>
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
                        <a class="active-menu" href="courses.php"><i class="fa fa-book"></i> My Courses</a>
                    </li>
                    <li>
                        <a href="enroll.php"><i class="fa fa-plus-square"></i> Enroll </a>
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
        <div id="page-wrapper" >
            <div id="page-inner">

             <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <h1> Enrolled Courses </h1>
                        </div>

                        <div class="panel-body">

                             <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

                             <?php
                             //   echo '<h1> Received Choice : '.$_POST['categ_choice'].' </h1>';
                             $mem_id = $_SESSION['login_id'];

                               $stud_id = $_SESSION['role_id'];
                                     //  echo "stud id : ".$stud_id."<br>";

                            $courses_ARRAY = getAllEnrolledCoursesofStudent($stud_id);
                            //$_SESSION['courses_array'] = $courses_ARRAY;
                          

                              if(isset($_POST['categ_choice']))
                              {
                                    unset($_SESSION['course_choice']);
                                    unset($_SESSION['name_of_chosen_course']);
                                    unset($_SESSION['name_of_chosen_topic']);
                                    unset($_SESSION['topic_choice']);
                                    unset($_SESSION['name_of_chosen_subtopic']);
                                    unset($_SESSION['subtopic_choice']);

                                     $course_category_selected = $_POST['categ_choice'];
                                     $_SESSION['categ_choice'] = $course_category_selected;
                                    // echo "mem id : ".$mem_id."<br>";
        /*
                                       foreach($GLOBALS['courses_ARRAY'] as $c)
                                       {
                                        echo "Course ID : ".$c->c_id." <br> " . "Course Name : ". $c->c_name. " <br> " ;
                                       }
                                */
                           }

                             if(isset($_POST['course_choice']))
                              {
                                    $_SESSION['course_choice'] = $_POST['course_choice'];
                                    $_SESSION['name_of_chosen_course'] = $_POST['name_of_chosen_course'];

                                    unset($_SESSION['name_of_chosen_topic']);
                                    unset($_SESSION['topic_choice']);
                                    unset($_SESSION['name_of_chosen_subtopic']);
                                    unset($_SESSION['subtopic_choice']);

                                     $course_category_selected = $_SESSION['categ_choice'];
                                     $course_selected = $_SESSION['name_of_chosen_course'];
                                     $id_course_selected = $_SESSION['course_choice'];

                                     // echo "Selected Course Category: ".$course_category_selected;
                                     // echo "Selected Course : ".$course_selected." id : ".$id_course_selected;
                                    // echo "mem id : ".$mem_id."<br>";
                                       $stud_id = $_SESSION['role_id'];
                                     //  echo "stud id : ".$stud_id."<br>";

                                      $topics_ARRAY = get_topics_for_course($id_course_selected);
                                      $_SESSION['topics_array'] = $topics_ARRAY;

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

                           if(isset($_POST['name_of_chosen_topic']))
                           {
                                unset($_SESSION['name_of_chosen_subtopic']);
                                unset($_SESSION['subtopic_choice']);

                                $_SESSION['name_of_chosen_topic'] = $_POST['name_of_chosen_topic'];

                                $id_course_selected = $_SESSION['course_choice'];
                                $topics_ARRAY = get_topics_for_course($id_course_selected);
                                    
                                       foreach($GLOBALS['topics_ARRAY'] as $t)
                                       {
                                        if($t['tname'] == $_SESSION['name_of_chosen_topic'])
                                        {
                                            $_SESSION['topic_choice'] = $t['tid'];
                                           // echo "ID of topic sellected : " . $_SESSION['topic_choice']."<br><br>";
                                        }
                                       // echo "Topics ID : ".$t['tid']." <br> " . "Topic Name : ". $t['tname']. " <br> " ;
                                      

                                       }

                                         $subtopics_ARRAY = get_subtopics_for_topic($_SESSION['topic_choice']);

                                                foreach($GLOBALS['subtopics_ARRAY'] as $s)
                                               {
                                               // echo "Subtopics ID : ".$s['sid']." <br> " . "Subtopic Name : ". $s['sname']. " <br> " ;
                                                
                                               }


                                       $_SESSION['subtopics_array'] = $subtopics_ARRAY;

                            }

                        if(isset($_POST['name_of_chosen_subtopic']))
                           {
                                $_SESSION['name_of_chosen_subtopic'] = $_POST['name_of_chosen_subtopic'];

                                $id_course_selected = $_SESSION['course_choice'];
                                $topics_ARRAY = get_topics_for_course($id_course_selected);
                                    
                                       foreach($GLOBALS['topics_ARRAY'] as $t)
                                       {
                                        if($t['tname'] == $_SESSION['name_of_chosen_topic'])
                                        {
                                            $_SESSION['topic_choice'] = $t['tid'];
                                           // echo "ID of topic sellected : " . $_SESSION['topic_choice']."<br><br>";
                                        }
                                       // echo "Topics ID : ".$t['tid']." <br> " . "Topic Name : ". $t['tname']. " <br> " ;
                                      

                                       }

                                         $subtopics_ARRAY = get_subtopics_for_topic($_SESSION['topic_choice']);

                                                foreach($GLOBALS['subtopics_ARRAY'] as $s)
                                               {
                                               // echo "Subtopics ID : ".$s['sid']." <br> " . "Subtopic Name : ". $s['sname']. " <br> " ;
                                                    if($s['sname'] == $_SESSION['name_of_chosen_subtopic'])
                                                    {
                                                        $_SESSION['subtopic_choice'] = $s['sid'];
                                                        //echo "ID of subtopic selected : " . $_SESSION['subtopic_choice']."<br><br>";
                                                    }
                                               }


                                       $_SESSION['subtopics_array'] = $subtopics_ARRAY;

                            }

                            if(isset($_SESSION['categ_choice']))
                            {
                               // echo "YES !";
                            }
                            if(isset($_SESSION['course_choice']))
                            {
                               // echo "YES !";
                                $id_course_selected = $_SESSION['course_choice'];
                                $topics_ARRAY = get_topics_for_course($id_course_selected);

                            }
                            if(isset($_SESSION['course_choice']) && isset($_SESSION['topic_choice']))
                            {
                               // echo "YES !";
                                $id_course_selected = $_SESSION['course_choice'];
                                $topics_ARRAY = get_topics_for_course($id_course_selected);

                                $subtopics_ARRAY = get_subtopics_for_topic($_SESSION['topic_choice']);

                            }
                            if(isset($_SESSION['subtopic_choice']))
                            {
                               // echo "YES !";
                                $id_course_selected = $_SESSION['course_choice'];
                                $topics_ARRAY = get_topics_for_course($id_course_selected);
                                
                                $subtopics_ARRAY = get_subtopics_for_topic($_SESSION['topic_choice']);

                            }
                             ?>


                               <form id="categ_form" action="<?php $_PHP_SELF ?>" method="post">
                                              <input type="hidden" id="categ_select" name='categ_choice'>
                                          </form>

                            <form id="course_form" action="<?php $_PHP_SELF ?>" method="post">
                                              <input type="hidden" id="course_select" name='course_choice'>
                                              <input type="hidden" id="name_of_selected_course" name = 'name_of_chosen_course'>
                                          </form>

                             <form id="topic_form" action="<?php $_PHP_SELF ?>" method="post">
                                              <input type="hidden" id="name_of_selected_topic" name = 'name_of_chosen_topic'>
                                          </form>

                                <form id="subtopic_form" action="<?php $_PHP_SELF ?>" method="post">
                                              <input type="hidden" id="name_of_selected_subtopic" name = 'name_of_chosen_subtopic'>
                                          </form>

                                       <div style="margin-top: 5px;">
                                            <h4> Choose Course Category : </h4>  
                                            <div class="btn-group">
                                           
                                              <button id = "course_category" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">

                                              <?php
                                              if(!isset($_SESSION['categ_choice']))
                                                 echo 'Choose Course Category';
                                             else
                                                echo $_SESSION['categ_choice'];
                                              ?>

                                              <span class="caret"></span></button>

                                              <ul id= "categ_dropdown" class="dropdown-menu">

                                              <?php
                                             /* SET(\'Mathematics\',\'General Sciences\',\'Biology\',\'Physics\',\'Chemistry\',\'Social Sciences\',\'Miscellaneous\',\'Languages\',\'Computer Science\')*/
                                                $age = array("Mathematics","General Sciences","Biology","Physics","Chemistry","Social Sciences","Miscellaneous","Languages","Computer Science");

                                                foreach($age as $x) {
                                                    echo "<li><a href=\"#\">".$x."</a></li> ";
                                                }
                                              ?>

                                              <script type='text/javascript'>

                                             $("#categ_dropdown > li").click(function() {
                                                   $("#course_category").text($(this).text()); 
                                                      $("#categ_select").val($(this).find("a").text());
                                                    document.getElementById('categ_form').submit();
                                                });

                                                </script>
                                                
                                            
                                              </ul>
                                            </div>
                                            <h4> Choose a Course -> Topic -> SubTopic : </h4>  
                                            <div style="margin:5px;" class="btn-group">
                                              <button id="course_options" data-toggle="dropdown" class="btn btn-danger dropdown-toggle"> 

                                                <?php
                                              if(!isset($_SESSION['name_of_chosen_course']) || !isset($_SESSION['categ_choice']))
                                                 echo 'Choose Course';
                                             else
                                                echo $_SESSION['name_of_chosen_course'];
                                              ?>

                                               <span class="caret"></span></button>
                                              <ul id="course_dropdown" class="dropdown-menu">

                                          <?php
                                            if(isset($GLOBALS['courses_ARRAY'])){

                                                        foreach($GLOBALS['courses_ARRAY'] as $x) {
                                                            
                                                            $pos = strpos($x->c_cat,$_SESSION['categ_choice']);
                                                            if($pos !== false)
                                                            echo "<li><a href=\"#\">". $x->c_name. " (ID:". $x->c_id.")"."</a></li> ";
                                                        }
                                            }
                                          ?>

                                          <script type='text/javascript'>

                                             $("#course_dropdown > li").click(function() {
                                               
                                                    var parse_text = $(this).text();
                                                    var parsed_text_1 = parse_text.split(" \(");
                                                    var selected_course_name = parsed_text_1[0];
                                                    var parsed_text_2 = parsed_text_1[1].split(":");
                                                    var parsed_text_3 = parsed_text_2[1].split("\)");
                                                    var selected_course_id = parsed_text_3[0];

                                                // document.write( "name : "+ selected_course_name+" id : "+ selected_course_id );

                                                      $("#course_select").val(selected_course_id);
                                                      $("#course_options").text(selected_course_name);
                                                       $("#name_of_selected_course").val(selected_course_name);
                                                    document.getElementById('course_form').submit();
                                                });

                                                </script>

                                                
                                              </ul>
                                            </div>

                                           <div style="margin:5px;" class="btn-group">
                                              <button id="topic_options" data-toggle="dropdown" class="btn btn-warning dropdown-toggle"> 

                                                    <?php
                                                      if(!isset($_SESSION['name_of_chosen_topic']) || !isset($_SESSION['name_of_chosen_course']) || !isset($_SESSION['categ_choice']))
                                                         echo 'Choose Topic';
                                                     else
                                                        echo $_SESSION['name_of_chosen_topic'];
                                                      ?>

                                               <span class="caret"></span></button>
                                              <ul id="topic_dropdown" class="dropdown-menu">

                                 
                                              <?php
                                              if(isset($GLOBALS['topics_ARRAY'])){

                                                foreach($GLOBALS['topics_ARRAY'] as $t)
                                                   {
                                                   // echo "Topics ID : ".$t['tid']." <br> " . "Topic Name : ". $t['tname']. " <br> " ;
                                                      echo  "<li><a href='#'>". $t['tname']."</a></li>";
                                                   }
                                                
                                                }
                                                ?>
                                                
                                                <script type="text/javascript">
                                                 $("#topic_dropdown > li").click(function() {
                                                   $("#topic_options").text($(this).text()); 
                                                      $("#name_of_selected_topic").val($(this).find("a").text());
                                                    document.getElementById('topic_form').submit();
                                                });
                                                </script>


                                              </ul>
                                            </div>
                                         
                                               
                                             <div style="margin:5px;" class="btn-group">
                                              <button id="subtopic_options" data-toggle="dropdown" class="btn btn-success dropdown-toggle"> 

                                                <?php
                                                      if(!isset($_SESSION['name_of_chosen_subtopic']) || !isset($_SESSION['name_of_chosen_topic']) || !isset($_SESSION['name_of_chosen_course']) || !isset($_SESSION['categ_choice']))
                                                         echo 'Choose Subtopic';
                                                     else
                                                        echo $_SESSION['name_of_chosen_subtopic'];
                                                      ?>

                                               <span class="caret"></span></button>
                                              <ul id = "subtopic_dropdown" class="dropdown-menu">

                                                <?php
                                              if(isset($GLOBALS['subtopics_ARRAY'])){

                                                foreach($GLOBALS['subtopics_ARRAY'] as $s)
                                                   {
                                                   // echo "Topics ID : ".$t['tid']." <br> " . "Topic Name : ". $t['tname']. " <br> " ;
                                                      echo  "<li><a href='#'>". $s['sname']."</a></li>";
                                                   }
                                                
                                                }
                                                ?>

                                                 <script type="text/javascript">
                                                 $("#subtopic_dropdown > li").click(function() {
                                                   $("#subtopic_options").text($(this).text()); 
                                                      $("#name_of_selected_subtopic").val($(this).find("a").text());
                                                    document.getElementById('subtopic_form').submit();
                                                });
                                                </script>
                                               
                                              </ul>
                                            </div>
                                            
                                            
                                          </div>
                                    </div>

                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab"> Course Home </a>
                                </li>
                                <li class=""><a href="#lectures" data-toggle="tab"> Lectures </a>
                                </li>
                                <li class=""><a href="#tutsNassgnmnts" data-toggle="tab"> Tutorials & Assignments </a>
                                </li>
                                <li class=""><a href="#performance" data-toggle="tab">Performance Report</a>
                                </li>
                            </ul>

                            <div style="padding-left: 20px;" class="tab-content">

                                <br>
                                <div class="tab-pane fade active in" id="home">

						<?php  
						       // echo $_SESSION['role_id'];
							if(isset($_SESSION['course_choice']))
							{
								$numberofquizzes = get_number_of_quiz_for_course($_SESSION['role_id'], $_SESSION['course_choice']);
							       	$quizzesTaken = quizzesTaken($_SESSION['role_id'],$_SESSION['course_choice']);
								if($numberofquizzes == 0)
									$completed = 100;
								else
							       		$completed = intval(($quizzesTaken/$numberofquizzes)*100);
							}
							else
						        	$completed=0;
							
						 ?>


                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Your Overall Course Progress :
                                        </div>
                       
                                    <div class="panel-body">
                                       <div class="progress progress-striped active">
						
						
                                               <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $completed; ?>%">
                                                <span class="sr-only">50% Complete (success)</span>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                    <br><br>
                                    <div style="padding-top: 90px;" class="panel-body">

                                        <h3> COURSE : <small style=" color:blue;">
                                        <?php  

                                         foreach ($GLOBALS['courses_ARRAY'] as $crs) 
                                         {
                                           // echo $crs->c_id;
                                            if($crs->c_id == $_SESSION['course_choice'])
                                            {
                                                echo $crs->c_name;
                                            }

                                        }
                                         ?> </small>
                                          </h3>
                                        <br>
                                        <h3> Category : <small style=" color:blue;"> 
                                        <?php 
                                         foreach ($GLOBALS['courses_ARRAY'] as $crs) {
                                            if($crs->c_id == $_SESSION['course_choice'])
                                            {
                                                echo $crs->c_cat;
                                            }

                                        } ?> </small></h3>
                                        <br>

                                         <h3> Course Prerequisites : <small style=" color:blue;"> 
                                        <?php 
                                         foreach ($GLOBALS['courses_ARRAY'] as $crs) {
                                            if($crs->c_id == $_SESSION['course_choice'])
                                            {
                                                echo $crs->c_preq;
                                            }

                                        } ?> </small></h3>
                                        <br>


                                        <h3> Course Air Date : <small style=" color:blue;">
                                        <?php 
                                         foreach ($GLOBALS['courses_ARRAY'] as $crs) {
                                            if($crs->c_id == $_SESSION['course_choice'])
                                            {
                                                echo $crs->c_air_date;
                                            }

                                        } ?> </small></h3>
                                        <br>

                                        <h3> Course Administrator : <small style=" color:blue;">
                                         <?php 
                                         foreach ($GLOBALS['courses_ARRAY'] as $crs) {
                                            if($crs->c_id == $_SESSION['course_choice'])
                                            {
                                                $row = get_member_name($crs->c_admin);
                                                 echo "<a href='email.php?sendemailTo=".$row['email']."' class='tip' title='Click to contact via email'>". $row['fname']." ".$row['lname'] ."</a>";
                                            }

                                        } ?> </small>
                                        </h3>
                                        <br>
                                        <h3> Contributions by following Professors :  <small style=" color:blue;">
                                        <?php

                                             echo "<link href='assets/css/custom-styles.css' rel='stylesheet' />";

                                         if(isset($_SESSION['course_choice']))
                                         {
                                            $id_course = $_SESSION['course_choice'];
                                              $faculty_info = get_All_Faculty_for_Course($id_course);

                                              foreach ($faculty_info as $fac) {
                                                  
                                                  echo "<a href='email.php?sendemailTo=".$fac->fac_email."' class='tip' title='Click to contact via email'>". $fac->fac_name ." , </a>";
                                              }
                                      }
                                        ?>

                                        </small></h3>
                                        <br>
                                        <h3> No. of students enrolled :  <small style=" color:blue;">
                                        <?php
                                        if(isset($_SESSION['course_choice']))
                                           echo get_student_Count_for_Course($_SESSION['course_choice']);
                                        ?>

                                        </small></h3>   
                                        <br>
                                        <h3> Brief Overview about the Course </h3>
                                        <p style=" color:blue;"> <?php
                                         foreach ($GLOBALS['courses_ARRAY'] as $crs) {
                                            if($crs->c_id == $_SESSION['course_choice'])
                                            {
                                                echo $crs->c_brief;
                                            }

                                        } ?> </p> 

                                        <h3> Course Structure </h3> 
                                        
                                        <ul style="color:blue; padding-top: 20px;" class="nav nav-list tree">

                                    <?php
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
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="lectures">
                                    <h3> Browse through Lectures </h3> <br>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                Expand or Collapse any Lecture :
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="panel-group" id="accordion">

                                                          <?php /*
                                                                    <div class="panel panel-default">

                                                                        <div class="panel-heading">
                                                                            <h4 class="panel-title">
                                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed"> Lecture #1</a>
                                                                            </h4>
                                                                        </div>

                                                                        <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
                                                                            <div class="panel-body">
                                                                                Batman v Superman Dawn of Justice Official Final Trailer (2016) - Ben Affleck Superhero Movie HD

                                                                                Fearing the actions of a god-like Super Hero left unchecked, Gotham City's own formidable, forceful vigilante takes on Metropolis' most revered, modern-day savior, while the world wrestles with what sort of hero it really needs. And with Batman and Superman at war with one another, a new threat quickly arises, putting mankind in greater danger than it's ever known before.

                                                                                The Fandango MOVIECLIPS Trailers channel is your destination for the hottest new trailers the second they drop. Whether it's the latest studio release, an indie horror flick, an evocative documentary, or that new RomCom you've been waiting for, the Fandango MOVIECLIPS team is here day and night to make sure all the best new movie trailers are here for you the moment they're released.

                                                                                In addition to being the #1 Movie Trailers Channel on YouTube, we deliver amazing and engaging original videos each week. Watch our exclusive Ultimate Trailers, Showdowns, Instant Trailer Reviews, Monthly MashUps, Movie News, and so much more to keep you in the know.
                                                                            </div>

                                                                            <div class="row">
                                                                                <iframe style="padding-left: 37px;" width="560" height="315" src="https://www.youtube.com/embed/eX_iASz1Si8" frameborder="0" allowfullscreen></iframe>

                                                                                 <iframe style="padding-left: 50px;" src="test.pdf" height="315" 
                                                                                width="700" frameborder="0"></iframe>
                                                                                 
                                                                                </object>
                                                                            </div>

                                                                        </div>
                                                                    </div>


                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            <h4 class="panel-title">
                                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Lecture #2</a>
                                                                            </h4>
                                                                        </div>
                                                                        <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
                                                                            <div class="panel-body">
                                                                                Just when Matt thinks he is bringing order back to the city, new forces are rising in Hell’s Kitchen. Now the Man Without Fear must take on a new adversary in Frank Castle and face an old flame – Elektra Natchios.

                                                                                Bigger problems emerge when Frank Castle, a man looking for vengeance, is reborn as The Punisher, a man who takes justice into his own hands in Matt’s neighborhood. Meanwhile, Matt must balance his duty to his community as a lawyer and his dangerous life as the Devil of Hell’s Kitchen, facing a life-altering choice that forces him to truly understand what it means to be a hero.
                                                                            </div>

                                                                            <div class="row">
                                                                                <iframe style="padding-left: 37px;" width="560" height="315" src="https://www.youtube.com/embed/2Cn3DVV0LHY" frameborder="0" allowfullscreen></iframe>

                                                                                 <iframe style="padding-left: 50px;" src="test.pdf" height="315" 
                                                                                width="700" frameborder="0"></iframe>
                                                                                 
                                                                                </object>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            <h4 class="panel-title">
                                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">Lecture #3</a>
                                                                            </h4>
                                                                        </div>
                                                                        <div id="collapseThree" class="panel-collapse collapse">
                                                                            <div class="panel-body">
                                                                                Based upon Marvel Comics’ most unconventional anti-hero, DEADPOOL tells the origin story of former Special Forces operative turned mercenary Wade Wilson, who after being subjected to a rogue experiment that leaves him with accelerated healing powers, adopts the alter ego Deadpool. Armed with his new abilities and a dark, twisted sense of humor, Deadpool hunts down the man who nearly destroyed his life.

                                                                                Cast: Ryan Reynolds, Morena Baccarin, Ed Skrein, T.J. Miller, Gina Carano, Brianna Hildebrand
                                                                            </div>

                                                                            <div class="row">
                                                                                <iframe style="padding-left: 37px;" width="560" height="315" src="https://www.youtube.com/embed/ZIM1HydF9UA" frameborder="0" allowfullscreen></iframe>

                                                                                 <iframe style="padding-left: 50px;" src="test.pdf" height="315" 
                                                                                width="700" frameborder="0"></iframe>
                                                                                 
                                                                                </object>
                                                                            </div>

                                                                        </div>
                                                                    </div> 
                                                                    */

                                                  
                                                    if(isset($_SESSION['subtopic_choice']))
                                                    {
                                                        $lecture_ARRAY = getAllEnrolledLecturesofSubtopic($_SESSION['subtopic_choice']);

                                                        foreach ($lecture_ARRAY as $la) {

                                                                $fac_name = getFacultyName($la->lec_fac_id);

                                                                echo    "<div class='panel panel-default'>

                                                                        <div class='panel-heading'>
                                                                            <h4 class='panel-title'>
                                                                                <a data-toggle='collapse' data-parent='#accordion' href='#collapse_". $la->lec_id ."' class='collapsed'> <h3> Lecture #".$la->lec_id." : <small style='color:blue;'> ". $la->lec_name . "</small> by Faculty : <small style='color:blue;'> " . $fac_name . "</small> Dated : <small style='color:blue;'> ". $la->lec_rel_date." </small> </h3> </a>
                                                                            </h4>
                                                                        </div>

                                                                        <div id='collapse_".$la->lec_id."' class='panel-collapse collapse' style='height: 0px;'>
                                                                            <div class='panel-body'>
                                                                               <h3> ". $la->lec_notes ." </h3>

                                                                                
                                                                            </div>

                                                                            <div class='row'>
                                                                                <iframe style='padding-left: 37px;' width='560' height='315' src='". $la->vdl."' frameborder='0' allowfullscreen></iframe>

                                                                                 <iframe style='padding-left: 50px;' src='". 
                                                                                   "../lecture/merged.pdf"."' height='315' 
                                                                                width='700' frameborder='0'></iframe>
                                                                                 
                                                                                </object>
                                                                            </div>

                                                                        </div>
                                                                    </div>";

                                                            
                                                        }

                                                            
                                                    }
                                                    ?>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                        <!-- /. ROW  -->

                                    
                                </div>
                                <div class="tab-pane fade" id="tutsNassgnmnts">
                                    <h3> Workout : Tutorials & Assignments </h3>
				    <br><br>
                                  <div class="table-responsive">
				<!-- style  -->
					<style>
					.button {
					  display: inline-block;
					  padding: 15px 20px;
					  font-size: 24px;
					  cursor: pointer;
					  text-align: center;	
					  text-decoration: none;
					  outline: none;
					  color: #fff;
					  background-color: #4CAF50;
					  border: none;
					  border-radius: 10px;
					  box-shadow: 0 9px #999;
					}

					.button:hover {background-color: #3e8e41}

					.button:active {
					  background-color: #3e8e41;
					  box-shadow: 0 5px #666;
					  transform: translateY(4px);
					}
					</style>
				<!-- style  -->
		                        <table class="table table-striped table-bordered table-hover" style="width:98%">
		                            <thead>
		                                <tr>   
						    <th>#</th>                                     
		                                    <th>Quiz</th>
		                                    <th>Score</th>
		                                </tr>
		                            </thead>
		                            <tbody>
  						<?php 
		                             	
						if(isset($_SESSION['subtopic_choice']))
						{
                              
						  $quiz = get_quiz_for_subtopic($_SESSION['subtopic_choice']);

						  								
		                                  $x = 1;
		                                  foreach($quiz as &$q)
		                                  {
		                                      
						   foreach($q as &$qz){
		                                      $qid=$qz;
		                                      $number = get_number_of_questions_in_quiz($qid);                                                        
						      $status = quizTakenStatus($_SESSION['role_id'], $_SESSION['course_choice'], $qid);
		                               	      $score = get_score($_SESSION['role_id'], $_SESSION['course_choice'], $qid);			     			                                      //$status = quizTakenStatus(1, 1, 53);
		                               	      //$score = get_score(1, 1, 53);					   	      
		                                    echo '
		                                      <tr>
							    <td>'.$x.'</td>
				                            <td> 
									   <form action="takequiz.php" method="post">
										<input type="submit" class="button" value="Assignment"></input>
			 							<input type="hidden" name="quizid" value= '.$qid.' ></input>
									    </form><br> 
								
							    </td>
				                            <td>'; 
		                                                if($status == 0)
									echo "Not Taken";
								     else
									 {
										echo $score.'/'.$number;
									 }
									$x++;	
									 									
							       
		                                           echo '</td>                                          
		                                      </tr>';
		                             }}} ?>
		                            </tbody>
		                        </table>
					 
		                    </div> 
				    <h5>#Quizzes can taken as many times but only the first attempt score will considered for performance evaluation.</h5>         
                                </div>
                                <div class="tab-pane fade" id="performance">
                                    <h3> View your Performance </h3> <br> <br> 
                                    
                                    <div class="row">             
                   <!------------------------------------------------->                           
				       <?php 
						if(isset($_SESSION['subtopic_choice']))
						$quizzes = get_quiz_for_subtopic($_SESSION['subtopic_choice']);
						$y = 1;
					foreach($quizzes as &$quiz)
						foreach($quiz as &$q_id)
						{
						      $score = get_score($_SESSION['role_id'], $_SESSION['course_choice'], $q_id);
						      $number = get_number_of_questions_in_quiz($q_id);
						      $x = intval(($score/$number)*100);

			echo '			                                                
                            <div class="col-md-5">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" >
                                            <b>Percentage Score in Assignment '.$y.' : '.$x.'%</b>
                                        </div>
                       
                                    <div class="panel-body">
                                       <div class="progress progress-striped active">


                                              <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:'.$x.'%">
                                                <span class="sr-only">50% Complete (success)</span>
                                              </div>
					
                                        </div>
                                    </div>
                                </div>
                            </div>';
				     $y++; } ?>
                      <!----------------------------------------------->              
                                                   
			                </div>                                                                                        
                               </div><!-- performance --->
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
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
   
</body>
</html>
