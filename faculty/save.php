<?php
   include('../login/session.php');
   include('../login/info.php');
   include('../login/helper_modules.php');
		echo $_SESSION['current_subtopic_id'];
		$qid = create_quiz($_SESSION['current_subtopic_id']);
		echo $qid;
		$false_status_questions = get_questions_false();
		echo $false_status_questions;

		$arrlength = count($false_status_questions);
		echo $arrlength;

		foreach($false_status_questions as &$value)
		{
			foreach($value as &$x)
			{
				    add_question($x, $qid);
				    update_question_false($x);
			}
		}
	header("Location: kola_3.php");
?>
