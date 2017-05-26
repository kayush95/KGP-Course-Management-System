<?php
	include('../login/helper_modules.php');
	include('../login/session.php');	
echo $_SESSION['role_id'];
echo $_SESSION['course_choice'];


						$numberofquizzes = get_number_of_quiz_for_course($_SESSION['role_id'], $_SESSION['course_choice']);
						       	$quizzesTaken = quizzesTaken($_SESSION['role_id'],$_SESSION['course_choice']);
						       	//$completed = intval(($quizzesTaken/$numberofquizzes)*100);
echo $numberofquizzes;
echo $quizzesTaken;
//echo $completed;
?>
