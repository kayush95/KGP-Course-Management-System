<?php
   include('../login/session.php');
   include('../login/helper_modules.php');
   /*ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);*/
   //$_SESSION['email_tab_selected'] = "#profile_editor";
   if($_SESSION['email_tab_selected'] === "#inbox_mail" || $_SESSION['email_tab_selected'] === "#outbox_mail")
   {
        $GLOBALS['toRefresh'] = 1;
        $GLOBALS['timeout'] = 10;
   }
   else
   {
    unset($GLOBALS['toRefresh']);
   }

   $al_success=0;
   if(isset($_POST["password"]))
   {
        $al_success=1;
        if(!isset($_POST["mname"]))
        {
            update_member($_SESSION['login_id'],$_POST["fname"],$_POST["lname"],$_POST["password"],$_POST["gender"],$_POST["bday"]);
        }
        else{
            update_member_mname($_SESSION['login_id'],$_POST["fname"],$_POST["mname"],$_POST["lname"],$_POST["password"],$_POST["gender"],$_POST["bday"]);
        }
    }
    if(isset($_FILES["propic"]) ) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/kgpcm/propic/";
        $uploadOk = 1;
        $target_file = $target_dir . basename($_FILES["propic"]["name"]); 
        if(file_exists($target_file)){
            //echo "Sorry, file already exists.";
            $uploadOk = 0;
            $al_success=0;
        }
        $errors = array();
        //echo "Error";
        chmod($target_file, 0777);
        if (move_uploaded_file($_FILES["propic"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["propic"]["name"]). " has been uploaded.";
        } else {
            $flag = 0;
            $al_success=0;
            //echo "Sorry, there was an error uploading your file.";
        }
    }

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />

<?php  if(isset($GLOBALS['toRefresh'])) echo "  <meta http-equiv='refresh' content=\"".$GLOBALS['timeout'].";URL='".$_SERVER['PHP_SELF']."'\" /> ";  ?>   
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>  CoursePlex Mailbox </title>
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
                <a class="navbar-brand" href="index.php"><i class="fa fa-chrome"></i> <strong> COURSEPLEX </strong></a>
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

                <?php
                if($_SESSION['role'] === "Student")
                echo"  
                    <li>
                        <a href='index.php'><i class='fa fa-dashboard'></i> Dashboard</a>
                    </li>
                    <li>
                        <a href='courses.php'><i class='fa fa-book'></i> My Courses</a>
                    </li>
                    <li>
                        <a href='enroll.php'><i class='fa fa-plus-square'></i> Enroll </a>
                    </li>
                    <li>
                        <a href='forum.php'><i class='fa fa-comments'></i> Query Forum </a>
                    </li>
                     <li>
                        <a href='../wdCalendar/sample.php'><i class='fa fa-calendar'></i> Events Calendar </a>
                    </li>
                     <li>
                        <a class='active-menu' href='email.php'><i class='fa fa-envelope'></i> Contact via Email </a>
                    </li>
                    ";
                else
                    echo "
                             <li>
                                <a href='admin.php'><i class='fa fa-fw fa-file'></i> Administrator Control</a>
                            </li>
                            <li>
                                <a class='active-menu' href='email.php'><i class='fa fa-envelope'></i> Contact via Email </a>
                            </li>
                            <li>
                                <a href='../wdCalendar/sample.php'><i class='fa fa-calendar'></i> Event Calender</a>
                            </li>
                        ";
                    ?>

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
			                    <!-- /. ROW  -->
                    <div class="row">
                        
                        <div class="col-md-12 col-sm-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3> Manage your Mailbox......Edit your Profile </h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="nav nav-pills">
                                        <li class=  <?php  

                                        if(isset($_SESSION['email_tab_selected']))
                                        {
                                            if($_SESSION['email_tab_selected'] === "#send_mail")
                                                echo "'active'";
                                            else
                                                echo "''";
                                        }
                                        else
                                            echo "''";

                                       ?> ><a href="#send_mail" data-toggle="tab" onclick="goToNewMail()"> Send Mail </a>
                                        </li>
                                        <li class=  <?php    

                                             if(isset($_SESSION['email_tab_selected']))
                                            {
                                                if($_SESSION['email_tab_selected'] === "#inbox_mail")
                                                    echo "'active'";
                                                else
                                                    echo "''";
                                            }
                                            else
                                                echo "''";

                                       ?> ><a href="#inbox_mail" data-toggle="tab" onclick="goToInbox()"> Inbox </a>
                                        </li>
                                        <li class=  <?php  

                                             if(isset($_SESSION['email_tab_selected']))
                                            {
                                                if($_SESSION['email_tab_selected'] === "#outbox_mail")
                                                    echo "'active'";
                                                else
                                                    echo "''";
                                            }
                                            else
                                                echo "''";

                                       ?>   
                                        ><a href="#outbox_mail" data-toggle="tab" onclick="goToOutbox()"> Outbox </a>
                                        </li>
                                        <li class=  <?php  

                                             if(isset($_SESSION['email_tab_selected']))
                                            {
                                                if($_SESSION['email_tab_selected'] === "#profile_editor")
                                                    echo "'active'";
                                                else
                                                    echo "''";
                                            }
                                            else
                                                echo "'active'";

                                        ?> ><a href="#profile_editor" data-toggle="tab" onclick="goToProfileEditor()"> Profile Editor </a>
                                        </li>
                                    </ul>



                                    <div class="tab-content">
                                        <div class=

                                        <?php  

                                        if(isset($_SESSION['email_tab_selected']))
                                        {
                                            if($_SESSION['email_tab_selected'] === "#send_mail")
                                                echo " 'tab-pane fade active in' ";
                                            else
                                                echo " 'tab-pane fade' ";
                                        }
                                        else
                                            echo " 'tab-pane fade' ";

                                       ?>

                                        id="send_mail">
                                            <h4> Write New Mail </h4>

                                            <?php
                                          //  echo "--->".$_POST['receiver_email'];

                                            if(isset($_POST['receiver_email']))
                                            {
                                                $email_Valid = isValidEmail($_POST['receiver_email']);

                                                if($email_Valid == 1)
                                                {
                                             /*   echo "<br>--->".$_POST['receiver_email'];
                                                 echo "<br>--->".$_SESSION['my_email'];
                                                  echo "<br>--->".$_POST['subject_email'];
                                                   echo "<br>--->".$_POST['content_email'];
                                              */
                                                insertIntoEmails($_POST['receiver_email'] , $_SESSION['my_email'] , $_POST['subject_email'] , $_POST['content_email'] );

                                               $_SESSION['email_tab_selected'] = "#send_mail";
                                               echo "<script type='text/javascript'> window.alert('Your mail has been successfully sent to ". $_POST['receiver_email'] ."'); </script>";
                                           }
                                           else
                                            echo "<script type='text/javascript'> window.alert('No such email address exists on the Courseplex server'); </script>";

                                            }

                                            ?>
                                           
                                                        <form id="mail_sender_form" role="send_mail_form" method="post" action="<?php $_PHP_SELF ?>">
                                                            <div class="form-group input-group">
                                                                <span class="input-group-addon">To:</span>
                                                                
                                                                    <input type="text" class="form-control" placeholder="#receiver_id@courseplex.com"

                                                                    <?php 
                                                                        if(isset( $GLOBALS['sender_email_id'] ))
                                                                            echo " value='". $GLOBALS['sender_email_id']."' ";
                                                                    ?>

                                                                    name="receiver_email" >

                                                                    <span class="input-group-addon">@courseplex.com</span>
                                                            </div>

                                                            <div class="form-group input-group">
                                                                <span class="input-group-addon">From:</span>
                                                                <input type="text" class="form-control" value= <?php echo "'".$_SESSION['my_email']."'"; ?> name="sender_email" disabled="">
                                                            </div>

                                                            <div class="form-group input-group">
                                                                <span class="input-group-addon">Subject:</span>
                                                                <input id="email_subject"  type="text" class="form-control" placeholder="The Topic of your message" name="subject_email">
                                                            </div>
                                                             
                                                           <div class="form-group">
                                                                <label> Write Email Body : </label>
                                                                <textarea id="email_content" class="form-control" rows="10" placeholder="Start Typing..." name="content_email"></textarea>
                                                            </div>

                                                            <div style="padding-left: 30px;">
                                                                 <input style="display: none;" id="send_mail_btn" class="btn btn-success btn-lg" type="submit" value="Send Mail">

                                                                 <input class="btn btn-danger btn-lg" type="reset" value="Reset">
                                                            </div>

                                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                                           
                                                           <script type="text/javascript">
                                                                    $("#email_content").keyup(function () {
                                                                       if ($(this).val() && $("#email_subject").val() ) {
                                                                          $("#send_mail_btn").show();
                                                                       }
                                                                       else {
                                                                          $("#send_mail_btn").hide();
                                                                       }
                                                                    });

                                                                     $("#email_subject").keyup(function () {
                                                                       if ($(this).val() && $("#email_content").val()) {
                                                                          $("#send_mail_btn").show();
                                                                       }
                                                                       else {
                                                                          $("#send_mail_btn").hide();
                                                                       }
                                                                    });


                                                                    $("#send_mail_btn").click(function () {
                                                                     //  $("#send_mail_btn").val('');
                                                                       $(this).hide();
                                                                       $("#mail_sender_form").refresh();
                                                                    });
                                                           </script>
                                                      

                                                           
                                                        </form>

                                        </div>
                                        <div class=
                                                 <?php  

                                                if(isset($_SESSION['email_tab_selected']))
                                                {
                                                    if($_SESSION['email_tab_selected'] === "#inbox_mail")
                                                        echo " 'tab-pane fade active in' ";
                                                    else
                                                        echo " 'tab-pane fade' ";
                                                }
                                                else
                                                    echo " 'tab-pane fade' ";

                                               ?>
                                        id="inbox_mail">
                                            <h4> Received Mails </h4>
                                            

                                                <?php

                                                    $inboxMails = getAllInboxMessages($_SESSION['login_id']);

                                                    foreach ($inboxMails as $mssg) {
                                                              echo "
                                                                 <div class='col-md-12 col-sm-4'>
                                                                    <div class='panel panel-success'>
                                                                        <div class='panel-heading'>
                                                                            <div> <h4> From : <small script='color : blue;'>". $mssg->email_from  ." </small> </h4> </div>
                                                                             <div> <h4> Subject : <small script='color : blue;'>". $mssg->subject ."</small> </h4> </div>
                                                                        </div>
                                                                        <div class='panel-body'>
                                                                            <p>". $mssg->body ."</p>
                                                                        </div>
                                                                        <div class='panel-footer'>
                                                                            <div> <h4> TIMESTAMP : <small script='color : blue;'>". $mssg->time_stamp ."</small> 
                                                                            <input readonly class='btn btn-danger btn-lg' style = 'float: right;
                                                                            right: 0px;
                                                                            width: 100px;' value='Delete'>
                                                                            </h4>
                                                                             
                                                                              </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <br> <br>   
                                                        ";
                                                    }
                                                  
                                                ?>

                                        </div>
                                        <div class=

                                         <?php  

                                                if(isset($_SESSION['email_tab_selected']))
                                                {
                                                    if($_SESSION['email_tab_selected'] === "#outbox_mail")
                                                        echo " 'tab-pane fade active in' ";
                                                    else
                                                        echo " 'tab-pane fade' ";
                                                }
                                                else
                                                    echo " 'tab-pane fade' ";

                                               ?>

                                        id="outbox_mail">
                                            <h4> Previously Sent Mails </h4>
                                                    
                                                 <?php

                                                    $outboxMails = getAllOutboxMessages($_SESSION['login_id']);

                                                    foreach ($outboxMails as $mssg) {
                                                              echo "
                                                                 <div class='col-md-12 col-sm-4'>
                                                                    <div class='panel panel-danger'>
                                                                        <div class='panel-heading'>
                                                                            <div> <h4> To : <small script='color : blue;'>". $mssg->email_to  ." </small> </h4> </div>
                                                                             <div> <h4> Subject : <small script='color : blue;'>". $mssg->subject ."</small> </h4> </div>
                                                                        </div>
                                                                        <div class='panel-body'>
                                                                            <p>". $mssg->body ."</p>
                                                                        </div>
                                                                        <div class='panel-footer'>
                                                                            <div> <h4> TIMESTAMP : <small script='color : blue;'>". $mssg->time_stamp ."</small> 
                                                                            <input readonly class='btn btn-danger btn-lg' style = 'float: right;
                                                                            right: 0px;
                                                                            width: 100px;' value='Delete'>
                                                                            </h4> </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <br> <br>   
                                                        ";
                                                    }
                                                  
                                                ?>

                                        </div>
                                        <div class=

                                        <?php  

                                                if(isset($_SESSION['email_tab_selected']))
                                                {
                                                    if($_SESSION['email_tab_selected'] === "#profile_editor")
                                                        echo " 'tab-pane fade active in' ";
                                                    else
                                                        echo " 'tab-pane fade' ";
                                                }
                                                else
                                                    echo " 'tab-pane fade active in' ";

                                               ?>

                                         id="profile_editor">

                                            <h4>Edit your Profile </h4>

                                                            <?php if($al_success==1) { ?>
                                                            <div class="alert alert-success alert-dismissible" role="alert">
                                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                              <strong>Updated !</strong> Your profile has been updated successfully.
                                                            </div>
                                                            <?php } ?>  
                                                            <script src="http://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>
                                                                <link rel="stylesheet" href="../login/css/normalize.css">
                                                                <link rel="stylesheet" href="../login/css/style.css">
                                                                <meta charset="utf-8">

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

                                                        <div id="signup" style="
                                                               padding-left: 40px;
                                                               max-width: 350px;
                                                                ">

                                                    
                                                         <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
                                                            <fieldset>


                                                                <div class="form-group">
                                                                    <label> Upload your Profile Picture </label>
                                                                    <input type="file" name="propic" id="propic"> <button> <img src="avatar.png" alt="Smiley face" height="140" width="120"> </button>  
                                                                </div>

                                                        

                                                            <p><input type="text" value= <?php echo "'".$_SESSION['my_fname']."'"; ?> name="fname" required placeholder="First Name" ></p>
                                                            <p><input type="text" value= <?php echo "'".$_SESSION['my_mname']."'"; ?> name="mname" placeholder="Middle Name"></p>
                                                            <p><input type="text" value= <?php echo "'".$_SESSION['my_lname']."'"; ?>  name="lname" required placeholder="Last Name" ></p>
                                                            <p>
                                                            <label for="userid"> Userid </label>
                                                            <input type="text" name="userid" value =" <?php echo $_SESSION['login_id']; ?> " required placeholder="User ID" disabled=""></p>
                                                            <!-- <p><input type="password" name="password" required placeholder="password"></p> -->
                                                            <section>
                                                                  <!-- <label for="password">Enter password</label> -->
                                                                  <label for="password"> Change password </label>
                                                                  <input type="password" name="password" id="password" required placeholder="password">
                                                                  <meter max="4" id="password-strength-meter"></meter>
                                                                  <p id="password-strength-text"></p>
                                                            </section>
                                                            
                                                            <p>
                                                            <label for="email"> Email address </label>
                                                            <input readonly="" type="email" name="email" required placeholder="username@courseplex.com" 
                                                            value= <?php echo "'".$_SESSION['my_email']."'"; ?>  
                                                            ></p>
                                                            
                                                            <label for="gender"> Gender </label>
                                                            
                                                            <select name = "gender">
                                                                <option value = "M">
                                                                   Male
                                                                </option>
                                                             
                                                                <option value = "F">
                                                                   Female
                                                                </option>
                                                             </select>
                                                            <p>
                                                            <label for="bday"> Birth Date: </label>
                                                            <input type="date" name="bday" required placeholder="YYYY-MM-DD"></p>
                                                            
                                                            <p><input type="submit" value="Update Account" name="submitb"></p>
                                                            </fieldset>
                                                            </form>

                                                            <script src='https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js'></script>
                                                             <script src="../login/js/index.js"></script>

                                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                            <!-- /. ROW  -->
                 
			
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