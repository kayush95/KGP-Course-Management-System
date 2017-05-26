<?php
include('helper_modules.php');
// display_errors = on;
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	//run the function call according to their priority wise i.e. low integer value = higher priority
   	createMembersTable(); //1
   	createLecturesTable(); //2
   	createCoursesTable(); // 3 
	createSubTopicsTable(); //4
	createTopicsTable(); //5
	createStudentsTable();//6
	createAssignTable();//7
	createQuizTable();//8
	createAdminsTable();//9
	createFacultyTable();//10
	createParentsTable();
	createCalenderTable();
	createAdminQuery();
	createCourseQuery();
	createEmailsTable();

	
	createQuestionsTable();
	relationQuiz_questions();
	create_Scores_Table();

	relationTopic_SubTopic();//11
	relationSubTopic_Lecture();//12
	relationCourse_Topic();//13
	relationStudent_Course();//14
	relationSubTopic_Quiz();//15
	relationSubTopic_Assign();//16
	relationCourse_Faculty();//17
	relationUnassignCourse_Fac();
	
	exit();
?>
