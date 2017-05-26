<?php
   include('../login/session.php');
    include('../login/info.php');
    include('../login/helper_modules.php');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tab</title>
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
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><i class="fa fa-comments"></i> <strong>KGP Course Management </strong></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
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
                            <a class="text-center" href="#">
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
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
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
                           <h1> Upload Content For Course </h1>
                        </div>

                        <div class="panel-body">

                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab"> Course Home </a>
                                </li>
                                <li class=""><a href="#lectures" data-toggle="tab"> Lectures </a>
                                </li>
                                <li class=""><a href="#tutsNassgnmnts" data-toggle="tab"> Tutorials & Assignments </a>
                                </li>
                                <li class=""><a href="#performance" data-toggle="tab"> my Performance </a>
                                </li>
                            </ul>

                            <div style="padding-left: 20px;" class="tab-content">

                                   <br>
                                <div class="tab-pane fade active in" id="home">

                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Your Overall Course Progress : 
                                        </div>
                       
                                    <div class="panel-body">
                                       <div class="progress progress-striped active">
                                              <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                <span class="sr-only">50% Complete (success)</span>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                    <br><br>
                                    <div style="padding-top: 90px;" class="panel-body">
                                        <h3> COURSE :  </h3>
                                        <br>
                                        <h3> Category :  </h3>
                                        <br>
                                        <h3> Course Air Date :  </h3>
                                        <br>
                                        <h3> Course Administrator :  </h3>
                                        <br>
                                        <h3> Contributions by following Professors :  </h3>
                                        <br>
                                        <h3> No. of students enrolled :  </h3>
                                        <br>
                                        <h3> Brief Overview about the Course </h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                                        <h3> Course Topics </h3>
                                        
                                        <ul style="padding-top: 20px;" class="nav nav-list tree">

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
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                        <!-- /. ROW  -->

                                    
                                </div>
                                <div class="tab-pane fade" id="tutsNassgnmnts">
                                    <h3> Workout : Tutorials & Assignments </h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                                <div class="tab-pane fade" id="performance">
                                    <h3> View your Performance </h3>
                                    
                                                        <div class="col-md-12">
                                                            <h4 class="page-header">
                                                                Charts <small>Show up your stats</small>
                                                            </h4>
                                                        </div>
                                                 
                                                
                                                       
                                                          
                                                    <div class="col-md-6 col-sm-12 col-xs-12">                     
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                Bar Chart
                                                            </div>
                                                            <div style="height: 100px; display:inline-block;">
                                                                <div id="morris-bar-chart"></div>
                                                            </div>
                                                        </div>            
                                                    </div>
                                                    
                                                    <div class="col-md-6 col-sm-12 col-xs-12">                     
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                Area Chart
                                                            </div>
                                                            <div class="panel-body">
                                                                <div id="morris-area-chart"></div>
                                                            </div>
                                                        </div>            
                                                    </div> 
                                                    
                                             
                                               
                                                                       
                                                          
                                                    <div class="col-md-6 col-sm-12 col-xs-12">                     
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                Line Chart
                                                            </div>
                                                            <div class="panel-body">
                                                                <div id="morris-line-chart"></div>
                                                            </div>
                                                        </div>            
                                                    </div>
                                                          <div class="col-md-6 col-sm-12 col-xs-12">                     
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                Donut Chart
                                                            </div>
                                                            <div class="panel-body">                            
                                                                <div id="morris-donut-chart"></div>
                                                            </div>
                                                        </div>            
                                                    </div> 
                                                    
                                              

                                </div>
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
