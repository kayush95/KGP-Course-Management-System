<?php
//include('includes/header.html');

/***********************************************************/
//include('../student/helper_modules.php');
/***********************************************************/

error_reporting(-1);
ini_set('display_errors', 'On');

//Check for empty fields
if(empty($_POST['question'])||
    empty($_POST['correct_answer'])	||
    empty($_POST['wrong_answer1'])		||
    empty($_POST['wrong_answer2'])		||
    empty($_POST['wrong_answer3']))
{
    echo '<h2>Please complete all fields<h2>';
    exit();
}

//Create short variables
$question = $_POST['question'];
$correct_answer = ($_POST['correct_answer']);
$wrong_answer1 = ($_POST['wrong_answer1']);
$wrong_answer2 = ($_POST['wrong_answer2']);
$wrong_answer3 = ($_POST['wrong_answer3']);

//connect to the database
require_once('includes/db_conn.php');

//Create the insert query
$query = "INSERT INTO questions
			-- (questionid, name, choice1, choice2, choice3, answer, status)
			 VALUES (NULL, '".$question."','".$wrong_answer1."','".$wrong_answer2."','".$wrong_answer3."','".$correct_answer."',0)";

$result = $dbc->query($query);

/***************************************************************/
//Add question to Corresponding Quiz
//add_question($result, $qid);
/***************************************************************/

if($result){
    echo '<h2>Your question has been saved</h2>';
} else {
    echo '<h1>System Error</h1>';
}
$dbc->close();



//include('includes/footer.html');
?>

