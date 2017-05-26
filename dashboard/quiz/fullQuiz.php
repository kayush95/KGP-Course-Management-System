<!--- quiz.php --->
<?php

/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/

$q_id = $_SESSION['quizid'];
//echo $q_id;

//include('../login/helper_modules.php');

require_once('includes/db_conn.php');
$query = "select * from questions INNER JOIN quizQuestions on quizQuestions.questionid=questions.questionid where quizQuestions.q_id=$q_id";
$query_result = $dbc->query($query);
$num_questions_returned = $query_result->num_rows;

if ($num_questions_returned < 1){
    echo "There is no question in the database";
    exit();}
$questionsArray = array();

while ($row = $query_result->fetch_assoc()){
    $questionsArray[] = $row;
}

$correctAnswerArray = array();
foreach($questionsArray as  $question){
    $correctAnswerArray[$question['questionid']] = $question['answer'];
}

$questions = array();
foreach($questionsArray as $question) {
    $questions[$question['questionid']] = $question['name'];
 }

$choices = array();
foreach ($questionsArray as $row) {
    $choices[$row['questionid']] = array($row['choice1'], $row['choice2'], $row['choice3'], $row['answer']);
  }

//--- quiz.php --

//--- MCQ.php --

$rightAnswer = 0;
$wrongAnswer = 0;

require_once('includes/functions_list.php');



if (isset($_POST['submit'])){
  foreach($_POST['response'] as $key => $value){
      if($correctAnswerArray[$key] == $value){
          $rightAnswer++;
      } else {
          $wrongAnswer++;
      }
  }
}
?>
<!-- //Display result-->
    <?php

	if ($rightAnswer == 0 && $wrongAnswer == 0)
	{

	}
	else if ($rightAnswer == 0)
	{
		
		add_score_taken($_SESSION['role_id'], $_SESSION['course_choice'], $_SESSION['quizid'], 0,1);
		
	}
       if ($rightAnswer > 0)
		{ 
			if( quizTakenStatus($_SESSION['role_id'], $_SESSION['course_choice'], $_SESSION['quizid'])==0 )
			{
				add_score_taken($_SESSION['role_id'], $_SESSION['course_choice'], $_SESSION['quizid'], $rightAnswer,1);
			}
    ?>
           <h2><span class="label label-success">You have <?php echo $rightAnswer; ?> correct answers</span></h2>
           <?php }
        if ($wrongAnswer > 0) { ?>
           <h2><span class="label label-danger">You have <?php echo $wrongAnswer; ?> wrong answers</span></h2>
           <?php
        }
     ?>

<!--Display form-->
<form action="takequiz.php" method="post">

    <?php
    foreach($questions as $id => $question) {
        echo "<div class=\"form-group\">";
        echo "<h4> $question</h4>"."<ol>";//display the question

        //Display multiple choices
        $randomChoices = $choices[$id];
        $randomChoices = shuffle_assoc($randomChoices);
        foreach ($randomChoices as $key => $values){
            echo '<li><input type="radio" name="response['.$id.'] id="'.$id.'" value="' .$values.'"/>';
        ?>
            <label for="question-<?php echo($id); ?>"><?php echo($values);?></label></li>
    <?php

        }
            echo("</ul>");
            echo("</div>");
        }
       ?>

    <input type="submit" name="submit" class="btn btn-primary" value="Submit Quiz" />
</form>

    <?php   //include('includes/footer.html'); ?>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-48989039-2', 'valokafor.com');
    ga('send', 'pageview');

</script>


<!--- MCQ.php --->
