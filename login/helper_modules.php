<?php
    
///get_course_for_faculty updated to return more info about course

function connectToDatabase()
{
   include('info.php');
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   if(! $conn ) {
     die('Could not connect: ' . mysql_error());
   }
   
   mysql_select_db('dbms');
      //echo 'Connected successfully <br>';
   return $conn;
}

function endDatabaseConnection($conn)
{
    mysql_close($conn);
}


function createMembersTable()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE members('.
      'id INTEGER AUTO_INCREMENT NOT NULL,'.
      'fname varchar(20) NOT NULL,'.
      'mname varchar(20),'.
      'lname varchar(20) NOT NULL,'.
      'userid varchar(20) NOT NULL,'.
      'pwd varchar(30) NOT NULL,'.
      'age INTEGER NOT NULL CHECK (age>0 AND age<120),'.
      'sex BOOLEAN NOT NULL,'. // true denotes male, false -> female
      'bday DATE NOT NULL,'.
      'email varchar(50) NOT NULL,'.
      'PRIMARY KEY(id) )';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 100000: ' . mysql_error());
   }
   else{
      echo "Created Members Table successfully <br>";
   }
   endDatabaseConnection($conn);
} 

function createLecturesTable()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE lectures('.
      'lec_id INTEGER AUTO_INCREMENT NOT NULL,'.
      'lec_name varchar(50) NOT NULL,'.
      'vdl varchar(500),'.
      'lec_notes varchar(5000) NOT NULL,'.
      'rel_date Date NOT NULL,'.
      'fac_id INT NOT NULL,'.
      'topics varchar(500),'.
      'PRIMARY KEY(lec_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 2: ' . mysql_error());
   }
   else{
      echo "Created Lectures Table successfully <br>";
   }

   endDatabaseConnection($conn);
}


function createSubTopicsTable()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE subtopics('.
      'sub_id INTEGER AUTO_INCREMENT NOT NULL,'.
      'sub_name varchar(50),'.
      'PRIMARY KEY(sub_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 4: ' . mysql_error());
   }
   else{
      echo "Created SubTopics Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function createTopicsTable()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE topics('.
      'top_id INTEGER AUTO_INCREMENT NOT NULL,'.
      'top_name varchar(50),'.
      'PRIMARY KEY(top_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 5: ' . mysql_error());
   }
   else{
      echo "Created Topics Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

//////////////////////////////////////////////////////////////////////////////
function createQuizTable()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE quiz('.
      'q_id INTEGER AUTO_INCREMENT NOT NULL,'.
      'path varchar(500) NOT NULL,'.
      'PRIMARY KEY(q_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 8: ' . mysql_error());
   }
   else{
      echo "Created Topics Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function createQuestionsTable()
{
    $conn=connectToDatabase();
	$sql='CREATE TABLE IF NOT EXISTS `questions` (
	  `questionid` int NOT NULL AUTO_INCREMENT,
	  `name` char(150) NOT NULL,
	  `choice1` varchar(150) NOT NULL,
	  `choice2` varchar(150) NOT NULL,
	  `choice3` varchar(150) NOT NULL,
	  `answer` varchar(150) NOT NULL,
	   status int DEFAULT 0,
	  PRIMARY KEY (`questionid`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14';

   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data Questions: ' . mysql_error());
   }
   else{
      echo "Created Questions Table successfully<br/>";
   }

   endDatabaseConnection($conn);
}

function relationQuiz_questions()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE quizQuestions(
      	 q_id INTEGER NOT NULL,
      	 questionid INTEGER NOT NULL,
      	 FOREIGN KEY(q_id) REFERENCES quiz(q_id),
      	 FOREIGN KEY(questionid) REFERENCES questions(questionid))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 15: ' . mysql_error());
   }
   else{
      echo "Created Quiz_Questions Table successfully<br/>";
   }

   endDatabaseConnection($conn);
}

function get_quiz_for_course($c_id)
{
   $conn=connectToDatabase();
   $sql="SELECT q_id FROM coursetop, topsubtop, subtopquiz where coursetop.c_id=$c_id and coursetop.top_id=topsubtop.top_id and topsubtop.sub_id=subtopquiz.sub_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }

   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[] = $row;
   }
   endDatabaseConnection($conn);
   return $result;
   //return $retval;
}

function get_number_of_quiz_for_course($stud_id, $c_id)
{
   $conn=connectToDatabase();
   $sql="SELECT score FROM scores where stud_id=$stud_id and c_id=$c_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get number of quizzws: ' . mysql_error());
   }

   $result=array();
   $x = 0;
   while($row=mysql_fetch_assoc($retval))
   {
      $result[$x] = $row;
      $x++;
   }
   endDatabaseConnection($conn);
   return $x;
   //return $retval;
}

function quizzesTaken($stud_id, $c_id)
{
   $conn=connectToDatabase();
   $sql="SELECT score FROM scores where stud_id=$stud_id and c_id=$c_id and testTaken=1";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get quizzesTaken: ' . mysql_error());
   }

   $result=array();
   $x = 0;
   while($row=mysql_fetch_assoc($retval))
   {
      $result[$x] = $row;
      $x++;
   }
   endDatabaseConnection($conn);
   return $x;
   //return $retval;
}

function get_quiz_for_subtopic($sub_id)
{
   $conn=connectToDatabase();
   $sql="SELECT q_id FROM subtopquiz where sub_id=$sub_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get quiz data: ' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[] = $row;
   }
   endDatabaseConnection($conn);
   return $result;
   //return $retval;
}

function get_questions_for_quiz($q_id)
{
   $conn=connectToDatabase();
   $sql="SELECT quizQuestions.questionid FROM questions INNER JOIN quizQuestions ON quizQuestions.questionid=questions.questionid WHERE quizQuestions.q_id=$q_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[] = $row;
   }
   endDatabaseConnection($conn);
   return $result;
/******************************/
   //return $retval;
/******************************/
}

function get_questions_false()
{
   $conn=connectToDatabase();
   $sql="SELECT questionid FROM questions WHERE status = 0";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get false status questions: ' . mysql_error());
   }
   $result=array();
   $x=0;
   while($row=mysql_fetch_assoc($retval))
   {
      $result[$x] = $row;
      $x++;
   }
   endDatabaseConnection($conn);
   return $result;
/******************************/
   //return $retval;
/******************************/
}

function update_question_false($questionid)
{
   $conn=connectToDatabase();
   $sql="UPDATE questions SET status = 1 WHERE questionid = $questionid";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not update data: ' . mysql_error());
   }

}

function create_quiz($sub_id)
{
   $conn=connectToDatabase();
   $sql = "INSERT INTO quiz set q_id=NULL";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get 1234: ' . mysql_error());
   }
   $qid=mysql_insert_id();
   $sql = "INSERT INTO subtopquiz SET sub_id=$sub_id,q_id=$qid";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get 5678: ' . mysql_error());
   }
   endDatabaseConnection($conn);
   return $qid;
}

function add_question($questionid, $q_id)
{
   $conn=connectToDatabase();
   
   $sql = "INSERT INTO quizQuestions SET q_id=$q_id,questionid=$questionid";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get 789: ' . mysql_error());
   }
   endDatabaseConnection($conn);
}

function create_Scores_Table()
{
    $conn=connectToDatabase();
	$sql='CREATE TABLE scores(
	      stud_id INTEGER NOT NULL,
	      c_id INTEGER NOT NULL,
	      q_id int NOT NULL,
	      score int,
	      testTaken int DEFAULT 0)';	
	      /*FOREIGN KEY(stud_id) REFERENCES students(stud_id),
	      FOREIGN KEY(c_id) REFERENCES courses(c_id),
	      FOREIGN KEY(q_id) REFERENCES quiz(q_id))';*/

   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data Scores: ' . mysql_error());
   }
   else{
      echo "Created Scores Table successfully<br/>";
   }

   endDatabaseConnection($conn);
}

function quizTakenStatus($stud_id, $c_id, $qid)
{
    $conn=connectToDatabase();
    $sql="select testTaken from scores where q_id = $qid and stud_id=$stud_id and c_id=$c_id";

   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get quiz Taken Status: ' . mysql_error());
   }
   $result=array();
   $x=0;
   while($row=mysql_fetch_assoc($retval))
   {
      $result[$x] = $row;
      $x++;
   }

   foreach($result as &$value)
	foreach($value as &$y)
		$status = $y;

   endDatabaseConnection($conn);

   return $status;
}

function add_score($stud_id, $c_id, $q_id,$score)
{
   $conn=connectToDatabase();
   
   $sql = "INSERT INTO scores SET q_id=$q_id, stud_id=$stud_id, c_id = $c_id, score = $score";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not add score: ' . mysql_error());
   }
   endDatabaseConnection($conn);
}

function add_score_taken($stud_id, $c_id, $q_id,$score,$testTaken)
{
   $conn=connectToDatabase();
   
   $sql = "UPDATE scores SET testTaken=$testTaken,score=$score WHERE q_id=$q_id and stud_id=$stud_id and c_id=$c_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not update scores: ' . mysql_error());
   }
   endDatabaseConnection($conn);
}


function get_score($stud_id, $c_id, $q_id)
{
   $conn=connectToDatabase();
   
   $sql = "select score from scores where q_id=$q_id and stud_id=$stud_id and c_id = $c_id";
   $retval=mysql_query($sql,$conn);

   if(!$retval )
   {
     die('Could not get score: ' . mysql_error());
   }
   $result=array();
   $x=0;
   while($row = mysql_fetch_assoc($retval))
   {
      $result[$x] = $row;
      $x++;
   }

   foreach($result as &$value)
	foreach($value as &$y)
		$score = $y;

   endDatabaseConnection($conn);

   return $score;
}


function get_name($stud_username)
{
   $conn=connectToDatabase();
   
   $sql = "select fname from members where userid='$stud_username'";
   $retval=mysql_query($sql,$conn);

   if(!$retval )
   {
     die('Could not get score: ' . mysql_error());
   }
   $result=array();
   while($row = mysql_fetch_assoc($retval))
   {
      $fname=$row['fname'];
	break;
   }

   endDatabaseConnection($conn);

   return $fname;
   
}


function get_quizscores_for_course($stud_id, $c_id)
{
   $conn=connectToDatabase();
   
   $sql = "select q_id,score from scores where c_id=$c_id and stud_id=$stud_id";
   $retval=mysql_query($sql,$conn);

   if(!$retval )
   {
     die('Could not get quizscores: ' . mysql_error());
   }
   $result=array();
   $x=0;
   while($row = mysql_fetch_assoc($retval))
   {
      $result[$x]=$row;
      $x++;
   }

   endDatabaseConnection($conn);

   return $result;
   
}

function get_course_name($c_id)
{
   $conn=connectToDatabase();
   
   $sql = "select course_name from courses where c_id=$c_id";
   $retval=mysql_query($sql,$conn);

   if(!$retval )
   {
     die('Could not get course name: ' . mysql_error());
   }
 
   $cname='';
   while($row = mysql_fetch_assoc($retval))
   {
      $cname=$row['course_name'];
      break;
   }

   endDatabaseConnection($conn);

   return $cname;
   
}

function get_number_of_questions_in_quiz($q_id)
{
   $conn=connectToDatabase();
   
   $sql = "select questionid from quizQuestions where q_id=$q_id";
   $retval=mysql_query($sql,$conn);

   if(!$retval )
   {
     die('Could not get number of questions: ' . mysql_error());
   }
   $result=array();
   $x=0;
   while($row = mysql_fetch_assoc($retval))
   {
      $result[$x]=$row;
      $x++;
   }

   endDatabaseConnection($conn);

   return $x;
   
}

//////////////////////////////////////////////////////////////////////////////

function createAssignTable()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE assign('.
      'ass_id INTEGER AUTO_INCREMENT NOT NULL,'.
      'path varchar(500) NOT NULL,'.
      'PRIMARY KEY(ass_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 7: ' . mysql_error());
   }
   else{
      echo "Created Assignments Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function relationTopic_SubTopic()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE topsubtop('.
      'top_id INTEGER NOT NULL,'.
      'sub_id INTEGER NOT NULL,'.
      'FOREIGN KEY(top_id) REFERENCES topics(top_id),'.
      'FOREIGN KEY(sub_id) REFERENCES subtopics(sub_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 11: ' . mysql_error());
   }
   else{
      echo "Created Topic_SubTopic Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function relationSubTopic_Lecture()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE subtoplec('.
      'sub_id INTEGER NOT NULL,'.
      'lec_id INTEGER NOT NULL,'.
      'FOREIGN KEY(sub_id) REFERENCES subtopics(sub_id),'.
      'FOREIGN KEY(lec_id) REFERENCES lectures(lec_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 12: ' . mysql_error());
   }
   else{
      echo "Created SubTopic_Lecture Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function relationCourse_Topic()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE coursetop('.
      'c_id INTEGER NOT NULL,'.
      'top_id INTEGER NOT NULL,'.
      'FOREIGN KEY(top_id) REFERENCES topics(top_id),'.
      'FOREIGN KEY(c_id) REFERENCES courses(c_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 13: ' . mysql_error());
   }
   else{
      echo "Created relationCourse_Topic Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function relationSubTopic_Quiz()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE subtopquiz('.
      'sub_id INTEGER NOT NULL,'.
      'q_id INTEGER NOT NULL,'.
      'FOREIGN KEY(sub_id) REFERENCES subtopics(sub_id),'.
      'FOREIGN KEY(q_id) REFERENCES quiz(q_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 15: ' . mysql_error());
   }
   else{
      echo "Created SubTopic_Lecture Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function relationSubTopic_Assign()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE subtopass('.
      'sub_id INTEGER NOT NULL,'.
      'ass_id INTEGER NOT NULL,'.
      'FOREIGN KEY(sub_id) REFERENCES subtopics(sub_id),'.
      'FOREIGN KEY(ass_id) REFERENCES assign(ass_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 16: ' . mysql_error());
   }
   else{
      echo "Created SubTopic_Assign Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function dropTable($tablename)
{
   $conn=connectToDatabase();

   $sql='DROP TABLE '.$tablename;
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not execute query: ' . mysql_error());
   }
   else{
      echo "Droppped Table ". $tablename." successfully <br>";
   }
    endDatabaseConnection($conn);
}


function createCoursesTable()
{
   $conn=connectToDatabase();
   
   $sql='CREATE TABLE courses('.
      'c_id INTEGER AUTO_INCREMENT NOT NULL,'.
      'course_name varchar(50) NOT NULL,'.
      'course_category SET(\'Mathematics\',\'General Sciences\',\'Biology\',\'Physics\',\'Chemistry\',\'Social Sciences\',\'Miscellaneous\',\'Languages\',\'Computer Science\') NOT NULL,'.
      'course_preq varchar(100),'.
      'course_admin INTEGER NOT NULL,'. 
      'air_date Date NOT NULL,'.
      'brief_overview varchar(1000) NOT NULL,'.
      'published BOOLEAN NOT NULL,'.
      'payment INTEGER NOT NULL,'.
      'PRIMARY KEY(c_id),'.
      'FOREIGN KEY(course_admin) REFERENCES members(id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 3: ' . mysql_error());
   }
   else{
      echo "Created Courses Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function createFacultyTable() //tested
{
   $conn=connectToDatabase();
   $sql='CREATE TABLE faculty('.
      'fac_id INTEGER AUTO_INCREMENT NOT NULL,'.
      'mem_id INTEGER NOT NULL,'.
      'FOREIGN KEY(mem_id) REFERENCES members(id),'.
      'PRIMARY KEY(fac_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 10: ' . mysql_error());
   }
   else{
      echo "Created Faculty Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function relationCourse_Faculty()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE coursefac('.
      'c_id INTEGER NOT NULL,'.
      'fac_id INTEGER NOT NULL,'.
      'FOREIGN KEY(fac_id) REFERENCES faculty(fac_id),'.
      'FOREIGN KEY(c_id) REFERENCES courses(c_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 17: ' . mysql_error());
   }
   else{
      echo "Created relationCourse_Faculty Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function createStudentsTable()
{
   $conn=connectToDatabase();
   $sql='CREATE TABLE students('.
      'stud_id INTEGER AUTO_INCREMENT NOT NULL,'.
      'mem_id INTEGER NOT NULL,'.
      'FOREIGN KEY(mem_id) REFERENCES members(id),'.
      'PRIMARY KEY(stud_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 6: ' . mysql_error());
   }
   else{
      echo "Created Students Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function createAdminsTable()
{
   $conn=connectToDatabase();
   $sql='CREATE TABLE admins('.
      'admin_id INTEGER AUTO_INCREMENT NOT NULL,'.
      'mem_id INTEGER NOT NULL,'.
      'FOREIGN KEY(mem_id) REFERENCES members(id),'.
      'PRIMARY KEY(admin_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 9: ' . mysql_error());
   }
   else{
      echo "Created Admins Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function populate_lectures($subtop_id,$lec_name,$vdl,$lec_notes,$fac_id,$topics)
{
   $conn=connectToDatabase();
   /*
   $sql = "SELECT top_id FROM topics where top_name = \'$topic\'";
   $retval=mysql_query($sql,$conn);

   if(! $retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $i=0;
   while($row = mysql_fetch_assoc($retval))
   {
      $i=1;
      break;
   }
   if($i==0)
   {
      //Inserted Topic
      $sql = "INSERT INTO topics SET top_name=\'$topic\'";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }

      //Get the id of just insterted topic
      $sql = "SELECT top_id FROM topics where top_name = \'$topic\'";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }
      $row = mysql_fetch_assoc($retval);
      $topid=$row['top_id'];

      //to insert the top_id course_id
      $sql = "INSERT INTO coursetop SET c_id=$course_id, top_id=$topid";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }
   }

   $sql = "SELECT sub_id FROM subtopics where sub_name = \'$subtopic\'";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $i=0;

   while($row = mysql_fetch_assoc($retval))
   {
      $i=1;
      $sql = "INSERT INTO lectures SET top_name=\'$topic\'";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }
      break;
   }

   if($i==0)
   {
      $sql = "INSERT INTO subtopics SET sub_name=\'$subtopic\'";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }

      //Get the id of just insterted topic
      $sql = "SELECT sub_id FROM subtopics where sub_name = \'$subtopic\'";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }
      $row = mysql_fetch_assoc($retval);
      $subid=$row['sub_id'];

      $sql = "INSERT INTO topsubtop SET top_id=$top_id, sub_id=$subid";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }
   }
   $sql = "SELECT lec_id FROM lectures where lec_name = \'$lec_name\'";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $i=0;
   while($row = mysql_fetch_assoc($retval))
   {
      $i=1;
      $lecid=$row['lec_id'];
      $sql = "SELECT sub_id FROM subtoplec where lec_id = $lecid";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }
      while($row = mysql_fetch_assoc($retval))
      {
         $i=2;
      }
      break;
   }
   if($i==2)
   {
      return -1;
   }
   else
   {
      if($i==0)
      {
         $sql = "INSERT INTO lectures SET lec_name=\'$lec_name\',vdl=";
         $retval=mysql_query($sql,$conn);
         if(! $retval )
         {
           die('Could not get data: ' . mysql_error());
         }
      }
   }*/
   $dt = date("Y-m-d");
   $sql = "INSERT INTO lectures SET lec_name='$lec_name',vdl='$vdl',lec_notes='$lec_notes',rel_date='$dt',fac_id=$fac_id,topics='$topics'";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data 7676: ' . mysql_error());
   }
   $lecid=mysql_insert_id();
   $sql = "INSERT INTO subtoplec SET sub_id=$subtop_id,lec_id=$lecid";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data 239: ' . mysql_error());
   }
   endDatabaseConnection($conn);
   return $lecid;
}

function populate_subtopics($top_id,$sub_name)
{
   $conn=connectToDatabase();
   $sql = "INSERT INTO subtopics SET sub_name='$sub_name'";
   //echo "Querying".$sql;
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data 4000: ' . mysql_error());
   }
   $subid=mysql_insert_id();
   $sql = "INSERT INTO topsubtop SET top_id=$top_id,sub_id=$subid";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data 40001: ' . mysql_error());
   }
   endDatabaseConnection($conn);
   return $subid;
}

function populate_topics($course_id,$top_name)
{
   $conn=connectToDatabase();
   $sql = "INSERT INTO topics SET top_name='$top_name'";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data 3000: ' . mysql_error());
   }
   $topid=mysql_insert_id();
   $sql = "INSERT INTO coursetop SET c_id=$course_id,top_id=$topid";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data 30001: ' . mysql_error());
   }
   endDatabaseConnection($conn);
   return $topid;
}

/*function get_course_for_faculty($fac_id)
{
   $conn=connectToDatabase();
   $sql="SELECT coursefac.c_id , courses.course_name FROM courses INNER JOIN coursefac ON courses.c_id=coursefac.c_id WHERE coursefac.fac_id=$fac_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[] = $row;
   }
   endDatabaseConnection($conn);
   return $result;
}*/

function get_topics_for_course($course_id)
{
   $conn=connectToDatabase();
   $sql="SELECT coursetop.top_id as tid, topics.top_name as tname FROM topics INNER JOIN coursetop ON topics.top_id=coursetop.top_id WHERE coursetop.c_id=$course_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[] = $row;
   }
   endDatabaseConnection($conn);
   return $result;
}

function get_subtopics_for_topic($top_id)
{
   $conn=connectToDatabase();
   $sql="SELECT topsubtop.sub_id as sid, subtopics.sub_name as sname FROM subtopics INNER JOIN topsubtop ON subtopics.sub_id=topsubtop.sub_id WHERE topsubtop.top_id=$top_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[] = $row;
   }
   endDatabaseConnection($conn);
   return $result;
}

function get_lectures_for_subtopic($sub_id)
{
   $conn=connectToDatabase();
   $sql="SELECT subtoplec.lec_id, lectures.lec_name,lectures.vdl,lectures.lec_notes,lectures.rel_date,lectures.fac_id,lectures.topics FROM lectures INNER JOIN subtoplec ON subtoplec.lec_id=lectures.lec_id WHERE subtoplec.sub_id=$sub_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[] = $row;
   }
   endDatabaseConnection($conn);
   return $result;
}

function get_assignments_for_subtopic($sub_id)
{
   $conn=connectToDatabase();
   $sql="SELECT subtopass.ass_id, assign.path FROM assign INNER JOIN subtopass ON subtopass.ass_id=assign.ass_id WHERE subtopass.sub_id=$sub_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[] = $row;
   }
   endDatabaseConnection($conn);
   return $result;
}


function get_fac_id($mem_id)
{
   $conn=connectToDatabase();
   $sql="SELECT faculty.fac_id FROM faculty WHERE faculty.mem_id = $mem_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $facid=-1;
   while($row=mysql_fetch_assoc($retval))
   {
      $facid=$row['fac_id'];
      break;
   }
   return $facid;
}

function get_admin_id($mem_id)
{
   $conn=connectToDatabase();
   $sql="SELECT admins.admin_id FROM admins WHERE admins.mem_id = $mem_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $adminid=-1;
   while($row=mysql_fetch_assoc($retval))
   {
      $adminid=$row['admin_id'];
      break;
   }
   return $adminid;
}

function get_stud_id($mem_id)
{
   $conn=connectToDatabase();
   $sql="SELECT students.stud_id FROM students WHERE students.mem_id = $mem_id";
   //echo $sql;
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 323: ' . mysql_error());
   }
   $studid=-1;
   while($row=mysql_fetch_assoc($retval))
   {
      $studid=$row['stud_id'];
      break;
   }
   endDatabaseConnection($conn);
   return $studid;
}
function populate_faculty($mem_id) //tested
{
   $conn=connectToDatabase();
   $sql = "INSERT INTO faculty SET mem_id=$mem_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $facid=mysql_insert_id();
   endDatabaseConnection($conn);
   return $facid;
}

function populate_course($course_name,$course_category,$course_admin,$air_date,$brief_overview,$preq,$payment) 
{
   $conn=connectToDatabase();
   $sql = "INSERT INTO courses SET course_name='$course_name',course_category='$course_category',course_admin=$course_admin,air_date='$air_date',brief_overview='$brief_overview',published=0,course_preq='$preq',payment=$payment";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: populate course' . mysql_error());
   }
   $courseid=mysql_insert_id();
   endDatabaseConnection($conn);
   return $courseid;
}

function populate_students($mem_id) //tested
{
   $conn=connectToDatabase();
   $sql = "INSERT INTO students SET mem_id=$mem_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $studid=mysql_insert_id();
   endDatabaseConnection($conn);
   return $studid;
}

function relationStudent_Course()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE studcourse('.
      'stud_id INTEGER NOT NULL,'.
      'c_id INTEGER NOT NULL,'.
      'FOREIGN KEY(stud_id) REFERENCES students(stud_id),'.
      'FOREIGN KEY(c_id) REFERENCES courses(c_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 14: ' . mysql_error());
   }
   else{
      echo "Created Student_Course Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function enroll_students($stud_id,$course_id)
{
   $conn=connectToDatabase();
   $sql = "INSERT INTO studcourse SET stud_id=$stud_id,c_id=$course_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   endDatabaseConnection($conn);

   $quiz_set = get_quiz_for_course($_SESSION['enroll_course_choice']);
			
   foreach($quiz_set as &$quiz)
	foreach($quiz as &$q)
	   add_score($stud_id, $course_id, $q, 0);

}

function populate_quiz($sub_id,$path)
{
   $conn=connectToDatabase();
   $sql = "INSERT INTO quiz SET path='$path'";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $qid=mysql_insert_id();
   $sql = "INSERT INTO subtopquiz SET sub_id=$sub_id,q_id=$qid";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   endDatabaseConnection($conn);
}

function populate_assign($sub_id,$path)
{
   $conn=connectToDatabase();
   $sql = "INSERT INTO assign SET path='$path'";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $assid=mysql_insert_id();
   $sql = "INSERT INTO subtopass SET sub_id=$sub_id,ass_id=$assid";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   endDatabaseConnection($conn);
}

class Course
{
   function Course($c_id, $c_name, $c_cat, $c_admin, $c_air_date, $c_brief, $c_payment, $c_preq)
   {
      $this->c_id = $c_id;
      $this->c_name = $c_name;
      $this->c_cat = $c_cat;
      $this->c_admin = $c_admin;
      $this->c_air_date = $c_air_date;
      $this->c_brief = $c_brief;
      $this->c_payment = $c_payment;
      $this->c_preq = $c_preq;
   }
}

/*

$sql='CREATE TABLE courses('.
      'c_id INTEGER AUTO_INCREMENT NOT NULL,'.
      'course_name varchar(50) NOT NULL,'.
      'course_category SET(\'Mathematics\',\'General Sciences\',\'Biology\',\'Physics\',\'Chemistry\',\'Social Sciences\',\'Miscellaneous\',\'Languages\',\'Computer Science\') NOT NULL,'.
      'course_preq varchar(100),'.
      'course_admin INTEGER NOT NULL,'. 
      'air_date Date NOT NULL,'.
      'brief_overview varchar(1000) NOT NULL,'.
      'published BOOLEAN NOT NULL,'.
      'payment INTEGER NOT NULL,'.
      'PRIMARY KEY(c_id),'.
      'FOREIGN KEY(course_admin) REFERENCES members(id))';

      */

function getAllEnrolledCoursesofStudent($stud_id)
{
   $conn=connectToDatabase();

   $sql="SELECT c_id,course_name,course_category,course_admin,air_date,brief_overview,payment,course_preq FROM studcourse NATURAL JOIN courses WHERE stud_id = $stud_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: 301' . mysql_error());
   }

   $course_ARRAY = array();
   $i = 0;

   while($row=mysql_fetch_assoc($retval))
   {
      $course_ARRAY[$i] = new Course($row['c_id'],$row['course_name'], $row['course_category'] , $row['course_admin'] , $row['air_date']  , $row['brief_overview'] , $row['payment'] , $row['course_preq'] ) ;
      $i = $i + 1;
   }

   endDatabaseConnection($conn);

   return $course_ARRAY;

}

function getAllUnenrolledCoursesofStudent($stud_id)
{
   $conn=connectToDatabase();

   $sql="SELECT c_id,course_name,course_category,course_admin,air_date,brief_overview,payment,course_preq FROM courses WHERE c_id NOT IN (SELECT c_id FROM studcourse NATURAL JOIN courses WHERE stud_id = $stud_id) and published=1;";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: 301' . mysql_error());
   }

   $course_ARRAY = array();
   $i = 0;

   while($row=mysql_fetch_assoc($retval))
   {
      $course_ARRAY[$i] = new Course($row['c_id'],$row['course_name'], $row['course_category'] , $row['course_admin'] , $row['air_date']  , $row['brief_overview'] , $row['payment'] , $row['course_preq'] ) ;
      $i = $i + 1;
   }

   endDatabaseConnection($conn);

   return $course_ARRAY;

}

function getIDofmember($userid)
{
   $conn = connectToDatabase();

   $sql="SELECT id FROM members WHERE members.userid = '$userid'";

   echo "Querying : ".$sql. "<br> ";

   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 302: ' . mysql_error());
   }
   $id=0;
   while($row=mysql_fetch_assoc($retval))
   {
      $id = $row['id'];
      break;
   }

   endDatabaseConnection($conn);
   return $id;
}

function populate_admins($mem_id) //tested
{
   $conn=connectToDatabase();
   $sql = "INSERT INTO admins SET mem_id=$mem_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data 303: ' . mysql_error());
   }
   $admin_id=mysql_insert_id();
   endDatabaseConnection($conn);
   return $admin_id;
}

function populate_parents($mem_id) //tested
{
   $conn=connectToDatabase();
   $sql = "INSERT INTO parents SET mem_id=$mem_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data 304: ' . mysql_error());
   }
   $par_id=mysql_insert_id();
   endDatabaseConnection($conn);
   return $par_id;
}

function createParentsTable()
{
   $conn=connectToDatabase();
   $sql='CREATE TABLE parents('.
      'par_id INTEGER AUTO_INCREMENT NOT NULL,'.
      'mem_id INTEGER NOT NULL,'.
      'FOREIGN KEY(mem_id) REFERENCES members(id),'.
      'PRIMARY KEY(par_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data 305: ' . mysql_error());
   }
   else{
      echo "Created Parents Table successfully <br> <br>";
   }

   endDatabaseConnection($conn);
}


function destroy_database()
{
   $conn=connectToDatabase();
   $sql = "drop database dbms";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data : drop database ' . mysql_error());
   }
   $sql = "create database dbms";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data 306 : create database ' . mysql_error());
   }
   endDatabaseConnection($conn);
}



function populate_members($fname,$lname,$userid,$pwd,$sex,$bday,$email,$role)
{
   $memid=get_mem_id($userid);
   if($sex=='M')
      $sex=1;
   else 
      $sex=0;
   $conn=connectToDatabase();

   $from = new DateTime($bday);
   $to   = new DateTime('today');
   $age = $from->diff($to)->y;
   if($memid==-1)
   {
      $sql = "INSERT INTO members SET fname='$fname',lname='$lname',userid='$userid',pwd='$pwd',age= $age,sex=$sex,bday='$bday',email='$email'";

      $retval=mysql_query($sql,$conn);
      if(!$retval)
      {
        echo $sql."<br>";
        die('Could not get data: populate_members if($memid==-1) ' . mysql_error());
      }
      $memid=mysql_insert_id();
   }
   if($role=="Admin"){
      $sql = "INSERT INTO admins SET mem_id=$memid";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: populate_members ADMIN' . mysql_error());
      }
   }
   else if($role=="Faculty"){
      $sql = "INSERT INTO faculty SET mem_id=$memid";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data:populate_membersFACULTY ' . mysql_error());
      }
   }
   else{
      $sql = "INSERT INTO students SET mem_id=$memid";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data:populate_membersSTUDENTS ' . mysql_error());
      }
   }
   endDatabaseConnection($conn);
}


function populate_members_mname($fname,$mname,$lname,$userid,$pwd,$sex,$bday,$email,$role)
{
   $memid=get_mem_id($userid);
   if($sex=='M')
      $sex=1;
   else 
      $sex=0;
   $conn=connectToDatabase();

   $from = new DateTime($bday);
   $to   = new DateTime('today');
   $age = $from->diff($to)->y;
   if($memid==-1)
   {
      $sql = "INSERT INTO members SET fname='$fname',mname='$mname',lname='$lname',userid='$userid',pwd='$pwd',age= $age,sex='$sex',bday='$bday',email='$email'";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }
      $memid=mysql_insert_id();
   }
   if($role=="Admin"){
      $sql = "INSERT INTO admins SET mem_id=$memid";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }
   }
   else if($role=="Faculty"){
      $sql = "INSERT INTO faculty SET mem_id=$memid";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }
   }
   else{
      $sql = "INSERT INTO students SET mem_id=$memid";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }
   }
   endDatabaseConnection($conn);
}

function check_for_convenience($userid,$pwd)
{
   $conn=connectToDatabase();
   $sql="SELECT id FROM members where userid='$userid'";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $i=-1;
   while($row=mysql_fetch_assoc($retval))
   {
      $i=0;
      break;
   }
   if($i==0)
   {
      $sql="SELECT id FROM members where userid='$userid' and pwd='$pwd'";
      $i=-1;
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }
      while($row=mysql_fetch_assoc($retval))
      {
         $i=0;
         break;
      }
      if($i==-1)
      {
         endDatabaseConnection($conn);
         return -1;
      }
   }
   endDatabaseConnection($conn);
   return 0;
}


function check_for_userid($userid,$role,$pwd)
{
   if(check_for_convenience($userid,$pwd)==-1)
   {
      //echo "Here";
      return -1;
   }
   $conn=connectToDatabase();
   if($role=="Faculty")
   {
      $sql = "SELECT faculty.fac_id FROM faculty INNER JOIN members ON members.id=faculty.mem_id WHERE members.userid='$userid'";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }
      $fac_id=-1;
      while($row=mysql_fetch_assoc($retval))
      {
         $fac_id=$row['fac_id'];
         break;
      }
      if($fac_id!=-1)
      {
         return -1;
      }
   }
   else if($role=="Admin")
   {
      $sql = "SELECT admins.admin_id FROM admins INNER JOIN members ON members.id=admins.mem_id WHERE members.userid='$userid'";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }
      $admin_id=-1;
      while($row=mysql_fetch_assoc($retval))
      {
         $admin_id=$row['admin_id'];
         break;
      }
      if($admin_id!=-1)
      {
         return -1;
      }
   }
   else{
      $sql = "SELECT students.stud_id FROM students INNER JOIN members ON members.id=students.mem_id WHERE members.userid='$userid'";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data: ' . mysql_error());
      }
      $stud_id=-1;
      while($row=mysql_fetch_assoc($retval))
      {
         $stud_id=$row['stud_id'];
         break;
      }
      if($stud_id!=-1)
      {
         return -1;
      }
   }
   return 0;
}

function check_for_login($userid,$pwd,$role)
{
   $conn=connectToDatabase();
   if($role=="Faculty")
   {
      $sql = "SELECT faculty.fac_id,members.fname FROM faculty INNER JOIN members ON members.id=faculty.mem_id WHERE members.userid='$userid' and members.pwd='$pwd'";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data 318:  ' . mysql_error());
      }
      $fac_id=-1;
      while($row=mysql_fetch_assoc($retval))
      {
         $fac_id=$row['fac_id'];
         $fname=$row['fname'];
         break;
      }
      $rtn=array($fac_id,$fname);
      return $rtn;
   }
   else if($role=="Admin")
   {
      $sql = "SELECT admins.admin_id,members.fname FROM admins INNER JOIN members ON members.id=admins.mem_id WHERE members.userid='$userid' and members.pwd='$pwd'";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data 319: ' . mysql_error());
      }
      $admin_id=-1;
      while($row=mysql_fetch_assoc($retval))
      {
         $admin_id=$row['admin_id'];
         $fname=$row['fname'];
         break;
      }
      $rtn=array($admin_id,$fname);
      return $rtn;
   }
   else{
      $sql = "SELECT students.stud_id,members.fname FROM students INNER JOIN members ON members.id=students.mem_id WHERE members.userid='$userid' and members.pwd='$pwd'";
      $retval=mysql_query($sql,$conn);
      if(! $retval )
      {
        die('Could not get data 320: ' . mysql_error());
      }
      $stud_id=-1;
      $fname=" ";
      while($row=mysql_fetch_assoc($retval))
      {
         $stud_id=$row['stud_id'];
         $fname=$row['fname'];
         break;
      }
      $rtn=array($stud_id,$fname);
      return $rtn;
   }
}



function relationUnassignCourse_Fac()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE uncoursefac('.
      'c_id INTEGER NOT NULL,'.
      'fac_id INTEGER NOT NULL,'.
      'FOREIGN KEY(c_id) REFERENCES courses(c_id),'.
      'FOREIGN KEY(fac_id) REFERENCES faculty(fac_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data unassigncoursefac: ' . mysql_error());
   }
   else{
      echo "Created UnassignCourse_Fac Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function accept_course($fac_id,$course_id)
{
   $conn=connectToDatabase();
   $sql = "DELETE FROM uncoursefac WHERE c_id=$course_id and fac_id=$fac_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: to delete' . mysql_error());
   }
   $sql = "INSERT INTO coursefac SET c_id=$course_id,fac_id=$fac_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: accept_course ' . mysql_error());
   }
   endDatabaseConnection($conn);
}

function get_member_name($mem_id)
{
   $conn=connectToDatabase();
   $sql = "SELECT userid,fname,lname,email FROM members WHERE id=$mem_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: get_member_name' . mysql_error());
   }
   $row=mysql_fetch_assoc($retval);
   endDatabaseConnection($conn);  
   return $row;
}
/////////////////////////////////////////////////////////////////////////////////////////////
function get_student_name($stud_username)
{
   $conn=connectToDatabase();
   $sql = "SELECT fname,lname,email FROM members WHERE userid='$stud_username'";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: get_member_name' . mysql_error());
   }
   $row=mysql_fetch_assoc($retval);
   endDatabaseConnection($conn);  
   return $row;
}

//////////////////////////////////////////////////////////////////////////////////////////////
class Faculty_info
{
   function Faculty_info($fac_id, $fac_name, $fac_email , $fac_userid)
   {
      $this->fac_id = $fac_id;
      $this->fac_name = $fac_name;
      $this->fac_email = $fac_email;
      $this->fac_userid = $fac_userid;
   }
}


function get_All_Faculty_for_Course($course_id)
{
    $conn=connectToDatabase();

   $sql = "SELECT fname,lname,faculty.fac_id,members.email, members.userid FROM members,faculty,coursefac WHERE members.id=faculty.mem_id and coursefac.c_id = $course_id and faculty.fac_id = coursefac.fac_id";
   //echo "Q : ".$sql;
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: 823' . mysql_error());
   }

   $faculty_name;
   $fac_i = array();

   $i=0;
   while($row=mysql_fetch_assoc($retval))
   {
      $faculty_name = $row['fname']." ".$row['lname'];

      $fac_i[$i] = new Faculty_info($row['fac_id'],$faculty_name,$row['email'] , $row['userid']);
     
      $i = $i + 1;
   }

   endDatabaseConnection($conn);  
   return $fac_i;
}

function get_student_Count_for_Course($course_id)
{
    $conn=connectToDatabase();

   $sql = "SELECT count(stud_id) as cnt FROM studcourse WHERE c_id = $course_id";
   //echo "Q : ".$sql;
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: 833' . mysql_error());
   }

   $row=mysql_fetch_assoc($retval);

   $stud_count = $row['cnt'];

   endDatabaseConnection($conn);  
   return $stud_count;
}

/*
   $sql='CREATE TABLE lectures('.
      'lec_id INTEGER AUTO_INCREMENT NOT NULL,'.
      'lec_name varchar(50) NOT NULL,'.
      'vdl varchar(500),'.
      'lec_notes varchar(5000) NOT NULL,'.
      'rel_date Date NOT NULL,'.
      'fac_id INT NOT NULL,'.
      'topics varchar(50),'.
      'PRIMARY KEY(lec_id))';


      $sql='CREATE TABLE subtoplec('.
      'sub_id INTEGER NOT NULL,'.
      'lec_id INTEGER NOT NULL,'.
      'FOREIGN KEY(sub_id) REFERENCES subtopics(sub_id),'.
      'FOREIGN KEY(lec_id) REFERENCES lectures(lec_id))';
      */

class Lecture
{
   function Lecture($lec_id, $lec_name, $vdl, $lec_notes, $lec_rel_date, $lec_fac_id , $lec_topics)
   {
      $this->lec_id = $lec_id;
      $this->lec_name = $lec_name;
      $this->vdl = $vdl;
      $this->lec_notes = $lec_notes;
      $this->lec_rel_date = $lec_rel_date;
      $this->lec_fac_id = $lec_fac_id;
      $this->lec_topics = $lec_topics;
   }
}

function getAllEnrolledLecturesofSubtopic($sub_id)
{
   $conn=connectToDatabase();

   $sql="SELECT lec_id,lec_name,vdl,lec_notes,rel_date,lectures.fac_id as fac_id_1,topics FROM subtoplec NATURAL JOIN lectures WHERE sub_id = $sub_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: 3021' . mysql_error());
   }

   $lecture_ARRAY = array();
   $i = 0;

   while($row=mysql_fetch_assoc($retval))
   {
      $lecture_ARRAY[$i] = new Lecture($row['lec_id'],$row['lec_name'], $row['vdl'] , $row['lec_notes'] , $row['rel_date']  , $row['fac_id_1'] , $row['topics'] ) ;
      $i = $i + 1;
   }

   endDatabaseConnection($conn);

   return $lecture_ARRAY;

}


function getFacultyName($fac_id)
{
        
   $conn=connectToDatabase();

  $sql = "SELECT fname,lname FROM faculty INNER JOIN members ON members.id=faculty.mem_id WHERE faculty.fac_id='$fac_id'";
 // echo "Q : ".$sql;

   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: 30221' . mysql_error());
   }

   $row=mysql_fetch_assoc($retval);

   $fac_name = $row['fname']." ".$row['lname'];
   endDatabaseConnection($conn);

   return $fac_name;
}

function populate_coursequery($course_id,$mem_id,$comment,$pertype)
{
   $conn=connectToDatabase();
   $sql = "INSERT INTO coursequery SET c_id=$course_id,mem_id='$mem_id',comment='$comment',pertype=$pertype";
   echo $sql;
   $retval= mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $facid = mysql_insert_id();
   endDatabaseConnection($conn);
   return $facid;
}

function createCourseQuery()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE coursequery('.
      'query_id INTEGER AUTO_INCREMENT NOT NULL,'.
      'mem_id VARCHAR(50) NOT NULL,'.
      'pertype INTEGER,'.
      'comment VARCHAR(500),'.
      'c_id INTEGER NOT NULL,'.
      'FOREIGN KEY(c_id) REFERENCES courses(c_id),'.
      'PRIMARY KEY(query_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   else{
      echo "Created CourseQuery Table successfully <br>";
   }

   endDatabaseConnection($conn);
}

function createCalenderTable()
{
   $conn=connectToDatabase();
   $sql= 'SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO"';
   $retval=mysql_query($sql,$conn);
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   else{
      echo "SET SQL_MODE successfully <br>";
   }

   $sql='CREATE TABLE `jqcalendar` ('.
     '`Id` int(11) NOT NULL auto_increment,'.
     '`Subject` varchar(1000) character set utf8 default NULL,'.
     '`Location` varchar(200) character set utf8 default NULL,'.
     '`Description` varchar(255) character set utf8 default NULL,'.
     '`StartTime` datetime default NULL,'.
     '`EndTime` datetime default NULL,'.
     '`IsAllDayEvent` smallint(6) NOT NULL,'.
     '`Color` varchar(200) character set utf8 default NULL,'.
     '`RecurringRule` varchar(500) character set utf8 default NULL,'.
     'PRIMARY KEY  (`Id`)'.
   ') ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4' ;
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   else{
      echo "Created Calendar Table successfully <br>";
   }

   endDatabaseConnection($conn);
}


function get_course_for_student($stu_id)
{
   $conn=connectToDatabase();

   $sql="SELECT studcourse.c_id , courses.course_name FROM courses INNER JOIN studcourse ON courses.c_id=studcourse.c_id WHERE studcourse.stud_id=$stu_id";
      
  // echo $sql;
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[] = $row;
   }
   endDatabaseConnection($conn);
   return $result;
}

function get_mem_id($userid)
{
   $conn=connectToDatabase();
   $sql = "SELECT id FROM members WHERE userid='$userid'";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: get_member_id' . mysql_error());
   }
   $mem_id=-1;
   while($row=mysql_fetch_assoc($retval))
   {
      $mem_id=$row['id'];
   }
   endDatabaseConnection($conn);  
   return $mem_id;
}

function display_course_for_fac($fac_id)
{
   $conn=connectToDatabase();
   $sql = "SELECT courses.c_id,courses.course_name,courses.course_admin FROM courses INNER JOIN uncoursefac ON uncoursefac.c_id=courses.c_id WHERE uncoursefac.fac_id=$fac_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: display_course_for_fac' . mysql_error());
   }
   $result=array();
   $i=0;
   while($row=mysql_fetch_assoc($retval))
   {
      $row1=get_member_name($row['course_admin']);
      $result[$i]['c_id']=$row['c_id'];
      $result[$i]['course_name']=$row['course_name'];
      $result[$i]['course_admin']=$row['course_admin'];
      $result[$i]['fname']=$row1['fname'];
      $result[$i]['lname']=$row1['lname'];
      $i=$i+1;
   }
   endDatabaseConnection($conn); 
   return $result;
}

function invite_faculty($course_id,$fac_id)
{
   $conn=connectToDatabase();
   $sql = "INSERT INTO uncoursefac SET c_id=$course_id,fac_id=$fac_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: invite_faculty' . mysql_error());
   }
   endDatabaseConnection($conn);
}

function uninvite_faculty($course_id,$fac_id)
{
   $conn=connectToDatabase();
   $sql = "DELETE FROM uncoursefac WHERE c_id=$course_id and fac_id=$fac_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: invite_faculty' . mysql_error());
   }
   endDatabaseConnection($conn);  
}

function get_danger_course($user_id)
{
   $mem_id=get_mem_id($user_id);
   $conn=connectToDatabase();
   $curr_dt=date("Y-m-d");
   $sql="SELECT * FROM courses WHERE courses.course_admin=$mem_id and DATEDIFF(courses.air_date,'$curr_dt')<0 and courses.published=false";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: get_danger_course' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[]=$row;
   }
   endDatabaseConnection($conn);
   return $result;
}  
function get_warning_course($user_id)
{
   $mem_id=get_mem_id($user_id);
   $conn=connectToDatabase();
   $curr_dt=date("Y-m-d");
   $sql="SELECT * FROM courses WHERE courses.course_admin=$mem_id and DATEDIFF(courses.air_date,'$curr_dt')<=3 and DATEDIFF(courses.air_date,'$curr_dt')>=0 and courses.published=false";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: get_warning_course' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[]=$row;
   }
   endDatabaseConnection($conn);
   return $result;
}

function get_normal_course($user_id)
{
   $mem_id=get_mem_id($user_id);
   $conn=connectToDatabase();
   $curr_dt=date("Y-m-d");
    //echo $user_id.$mem_id."dasdasdsada<br>";
    //echo $curr_dt;
   $sql="SELECT * FROM courses WHERE courses.course_admin=$mem_id and DATEDIFF(courses.air_date,'$curr_dt')>3 and courses.published=false";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: get_normal_course' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[]=$row;
   }
   endDatabaseConnection($conn);
   return $result;
}

function get_success_course($user_id)
{
   $mem_id=get_mem_id($user_id);
   $conn=connectToDatabase();
   $curr_dt=date("Y-m-d");
   $sql="SELECT * FROM courses WHERE courses.course_admin=$mem_id and courses.published=true";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: get_success_course' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[]=$row;
   }
   endDatabaseConnection($conn);
   return $result;
}

function get_course_for_publishing($user_id)
{
   $mem_id=get_mem_id($user_id);
   $conn=connectToDatabase();
   $sql="SELECT * FROM courses WHERE courses.course_admin=$mem_id and courses.published=false";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: get_success_course' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[]=$row;
   }
   endDatabaseConnection($conn);
   return $result;
}

function get_faculty_pending($course_id)
{
   $conn=connectToDatabase();
   $sql="SELECT faculty.mem_id FROM uncoursefac INNER JOIN faculty ON uncoursefac.fac_id=faculty.fac_id WHERE uncoursefac.c_id=$course_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: get_faculty_pending' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[]=$row;
   }
   endDatabaseConnection($conn);
   $rtn=array();
   foreach ($result as $value) {
      $rtn[]=get_member_name($value['mem_id']);
   }
   return $rtn;
}

function get_faculty_accepted($course_id)
{
   $conn=connectToDatabase();
   $sql="SELECT faculty.mem_id FROM coursefac INNER JOIN faculty ON coursefac.fac_id=faculty.fac_id WHERE coursefac.c_id=$course_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: get_faculty_accepted' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[]=$row;
   }
   endDatabaseConnection($conn);
   $rtn=array();
   foreach ($result as $value) {
      $rtn[]=get_member_name($value['mem_id']);
   }
   return $rtn;
}


function get_course_for_admin($user_id)
{
   $mem_id=get_mem_id($user_id);
   $conn=connectToDatabase();
    //echo $user_id.$mem_id."dasdasdsada<br>";
    //echo $curr_dt;
   $sql="SELECT * FROM courses WHERE courses.course_admin=$mem_id and courses.published=false";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: get_normal_course' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[]=$row;
   }
   endDatabaseConnection($conn);
   return $result;
}

function delete_course($course_id)
{
   $conn=connectToDatabase();
   $sql="DELETE FROM coursetop WHERE c_id=$course_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: delete_course1' . mysql_error());
   }
   $sql="DELETE FROM coursefac WHERE c_id=$course_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: delete_course2' . mysql_error());
   }
   $sql="DELETE FROM studcourse WHERE c_id=$course_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: delete_course3' . mysql_error());
   }
   $sql="DELETE FROM uncoursefac WHERE c_id=$course_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: delete_course4' . mysql_error());
   }
   $sql="DELETE FROM coursequery WHERE c_id=$course_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: delete_course3' . mysql_error());
   }
   $sql="DELETE FROM courses WHERE c_id=$course_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: delete_course3' . mysql_error());
   }
   endDatabaseConnection($conn);
}

function publish_course($course_id)
{
   $conn=connectToDatabase();
   $sql="UPDATE courses SET published=1 where c_id=$course_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: delete_course3' . mysql_error());
   }
   endDatabaseConnection($conn);
}

function populate_adminquery($course_id,$mem_id,$comment,$pertype)
{
   $conn=connectToDatabase();
   $sql = "INSERT INTO adminquery SET c_id=$course_id,mem_id='$mem_id',comment='$comment',pertype=$pertype";
   //echo $sql;
   $retval= mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $facid = mysql_insert_id();
   endDatabaseConnection($conn);
   return $facid;
}

function createAdminQuery()
{
   $conn=connectToDatabase();

   $sql='CREATE TABLE adminquery('.
      'query_id INTEGER AUTO_INCREMENT NOT NULL,'.
      'mem_id VARCHAR(50) NOT NULL,'.
      'pertype INTEGER,'.
      'comment VARCHAR(500),'.
      'c_id INTEGER NOT NULL,'.
      'FOREIGN KEY(c_id) REFERENCES courses(c_id),'.
      'PRIMARY KEY(query_id))';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   else{
      echo "Created Admins Table successfully <br>";
   }

   endDatabaseConnection($conn);
}


// -----------------------------------------------------------------------------------------------------------------------
// created the following : 5 new functions and one new class, all for Emails and mailbox facility, plz update accordingly

function createEmailsTable()
{
     $conn=connectToDatabase();

   $sql='CREATE TABLE emails('.
      'email_id INTEGER AUTO_INCREMENT NOT NULL,'.
      'email_to varchar(50) NOT NULL,'.
      'email_from varchar(50) NOT NULL,'.
      'email_body varchar(1000) NOT NULL,'.
      'email_subject varchar(100) NOT NULL,'.
      'time_stamp DATETIME NOT NULL,'.
      'PRIMARY KEY(email_id) )';
      
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data createEmailsTable: ' . mysql_error());
   }
   else{
      echo "Created Emails Table successfully <br>";
   }
   endDatabaseConnection($conn);
}


function insertIntoEmails($email_to , $email_from, $email_subject , $email_body )
{
    $conn=connectToDatabase();

   $sql = "INSERT INTO emails(email_to,email_from,email_body,email_subject,time_stamp) VALUES ('$email_to','$email_from','$email_body','$email_subject', now() ) ";
   //echo "Querying".$sql;
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data insertIntoEmails: ' . mysql_error());
   }
   $inserted_email_id = mysql_insert_id();

   endDatabaseConnection($conn);
   return $inserted_email_id;
}



class Email
{
   function Email($email_to, $email_from, $subject, $body , $time_stamp)
   {
      $this->email_to = $email_to;
      $this->email_from = $email_from;
      $this->subject = $subject;
      $this->body = $body;
      $this->time_stamp = $time_stamp;
   }
}



function getAllInboxMessages($user_id)
{

   $mem_id=get_mem_id($user_id);
   $conn=connectToDatabase();
    //echo $user_id.$mem_id."dasdasdsada<br>";
    //echo $curr_dt;
   $sql="SELECT emails.email_to , emails.email_from , email_subject , email_body, time_stamp FROM emails INNER JOIN members ON emails.email_to = members.email WHERE members.id = $mem_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: getAllInboxMessages' . mysql_error());
   }

   $emails_ARRAY = array();

   $i=0;
   while($row=mysql_fetch_assoc($retval))
   {
      $emails_ARRAY[$i] = new Email($row['email_to'], $row['email_from'],$row['email_subject'],$row['email_body'] , $row['time_stamp'] );
      $i = $i + 1;
   }

   endDatabaseConnection($conn);
   return array_reverse($emails_ARRAY);

}


function getAllOutboxMessages($user_id)
{

   $mem_id=get_mem_id($user_id);
   $conn=connectToDatabase();
    //echo $user_id.$mem_id."dasdasdsada<br>";
    //echo $curr_dt;
   $sql="SELECT emails.email_to , emails.email_from , email_subject , email_body, time_stamp FROM emails INNER JOIN members ON emails.email_from = members.email WHERE members.id = $mem_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: getAllOutboxMessages' . mysql_error());
   }

   $emails_ARRAY = array();

   $i=0;
   while($row=mysql_fetch_assoc($retval))
   {
      $emails_ARRAY[$i] = new Email($row['email_to'], $row['email_from'],$row['email_subject'],$row['email_body'] , $row['time_stamp'] );
      $i = $i + 1;
   }
   
   endDatabaseConnection($conn);
   return array_reverse($emails_ARRAY);

}

function isValidEmail($email)
{

   $conn=connectToDatabase();
    //echo $user_id.$mem_id."dasdasdsada<br>";
    //echo $curr_dt;
   $sql="SELECT id FROM members WHERE email = '$email' LIMIT 1";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: isValidEmail' . mysql_error());
   }

   endDatabaseConnection($conn);

   if(mysql_num_rows($retval) > 0)
      return 1;
   else
      return -1;

}


function update_member($userid,$fname,$lname,$pwd,$sex,$bday)
{
   $memid=get_mem_id($userid);
   if($sex=='M')
      $sex=1;
   else 
      $sex=0;
   $conn=connectToDatabase();
   $from = new DateTime($bday);
   $to   = new DateTime('today');
   $age = $from->diff($to)->y;
   if($memid!=-1)
   {
      $sql = "UPDATE members SET fname='$fname',lname='$lname',pwd='$pwd',age= $age,sex=$sex,bday='$bday' WHERE userid='$userid'";
      $retval=mysql_query($sql,$conn);
      if(!$retval)
      {
        echo $sql."<br>";
        die('Could not get data: populate_members if($memid==-1) ' . mysql_error());
      }
   }
}

function update_member_mname($userid,$fname,$mname,$lname,$pwd,$sex,$bday)
{
   $memid=get_mem_id($userid);
   if($sex=='M')
      $sex=1;
   else 
      $sex=0;
   $conn=connectToDatabase();
   $from = new DateTime($bday);
   $to   = new DateTime('today');
   $age = $from->diff($to)->y;
   if($memid!=-1)
   {
      $sql = "UPDATE members SET fname='$fname',mname='$mname',lname='$lname',pwd='$pwd',age= $age,sex=$sex,bday='$bday' WHERE userid='$userid'";
      $retval=mysql_query($sql,$conn);
      if(!$retval)
      {
        echo $sql."<br>";
        die('Could not get data: populate_members if($memid==-1) ' . mysql_error());
      }
   }
}
function get_students_for_fac($facid)
{
   $conn=connectToDatabase();
   $sql = "SELECT studcourse.stud_id FROM coursefac INNER JOIN studcourse ON coursefac.c_id=studcourse.c_id WHERE coursefac.fac_id=$facid";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: get_member_name' . mysql_error());
   }
   $mem_id=-1;
   $num = 0;
   while($row=mysql_fetch_assoc($retval))
   {
      $mem_id=$row['stud_id'];
     // echo "kola" . $mem_id; 
      $num++;
   }
   endDatabaseConnection($conn); 
   //$num = count($retval); 
   return $num;
}

function get_queries_for_fac($facid)
{
   $conn=connectToDatabase();
   $sql = "SELECT coursequery.query_id FROM coursefac INNER JOIN coursequery ON coursefac.c_id=coursequery.c_id WHERE coursefac.fac_id=$facid and coursequery.pertype=0";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: get_member_name' . mysql_error());
   }
   $mem_id=-1;
   $num = 0;
   while($row=mysql_fetch_assoc($retval))
   {
      $mem_id=$row['stud_id'];
     // echo "kola" . $mem_id; 
      $num++;
   }
   endDatabaseConnection($conn); 
   //$num = count($retval); 
   return $num;
}
function course_invite_for_fac($fac_id)
{
   $conn=connectToDatabase();
   $sql = "SELECT c_id FROM  uncoursefac WHERE fac_id=$fac_id";
   $retval=mysql_query($sql,$conn);
   if(! $retval )
   {
     die('Could not get data: display_course_for_fac' . mysql_error());
   }
   $result=array();
   $i=0;
   while($row=mysql_fetch_assoc($retval))
   {
      /*$row1=get_member_name($row['course_admin']);
      $result[$i]['c_id']=$row['c_id'];
      $result[$i]['course_name']=$row['course_name'];
      $result[$i]['course_admin']=$row['course_admin'];
      $result[$i]['fname']=$row1['fname'];
      $result[$i]['lname']=$row1['lname'];*/
      $i=$i+1;
   }
   endDatabaseConnection($conn); 
   return $i;
}

function get_course_for_faculty($fac_id)
{
   $conn=connectToDatabase();
   $sql="SELECT coursefac.c_id , courses.course_name , courses.course_category , courses.course_admin FROM courses INNER JOIN coursefac ON courses.c_id=coursefac.c_id WHERE coursefac.fac_id=$fac_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[] = $row;
   }
   endDatabaseConnection($conn);
   return $result;
}

function get_admin_for_course($admin_id)
{
   $conn=connectToDatabase();
   $sql="SELECT fname , lname FROM members WHERE id=$admin_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $result=array();
   while($row=mysql_fetch_assoc($retval))
   {
      $result[] = $row;
   }
   endDatabaseConnection($conn);
   return $result;
}

/*function get_students_for_course($c_id)
{
   $conn=connectToDatabase();
   $sql="SELECT stud_id FROM studcourse WHERE c_id=$c_id";
   $retval=mysql_query($sql,$conn);
   
   if(!$retval )
   {
     die('Could not get data: ' . mysql_error());
   }
   $result=array();
   $num=0;
   while($row=mysql_fetch_assoc($retval))
   {
      $result[] = $row;
      $num++;
   }
   endDatabaseConnection($conn);
   return $num;
}*/

function parent_check($userid,$bday)
{
   $conn=connectToDatabase();
   $sql = "SELECT id FROM members WHERE userid='$userid' and bday='$bday'";
   $retval=mysql_query($sql,$conn);
   if(!$retval)
   {
     //echo $sql."<br>";
     die('Could not get data: populate_members if($memid==-1) ' . mysql_error());
   }
   $mem_id=-1;
   while($row=mysql_fetch_assoc($retval))
   {
      $mem_id=$row["id"];
      break;
   }
   return $mem_id;
}

?>
