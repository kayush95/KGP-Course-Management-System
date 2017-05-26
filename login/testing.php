<?php
// $ver = date("Y-m-d");
// $ver = 2;
// echo 'I love '."hello $ver";

function connectToDatabase()
{
   include('info.php');
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   if(! $conn ) {
     die('Could not connect: ' . mysql_error());
   }
   
   mysql_select_db('dbms');
      //echo 'Connected successfully';
   return $conn;
}

// function get_topics_for_course($course_id)
// {
//    $conn=connectToDatabase();
//      $sql="SELECT coursetop.top_id, topics.top_name FROM topics INNER JOIN coursetop ON topics.top_id=coursetop.top_id WHERE coursetop.c_id=$course_id";
//    $retval=mysql_query($sql,$conn);
   
//    if(!$retval )
//    {
//      die('Could not get data: ' . mysql_error());
//    }
//    $result=array();
//    while($row=mysql_fetch_assoc($retval))
//    {
//       $result[] = $row;
//    }
//    endDatabaseConnection($conn);
//    return $result;
// }

function endDatabaseConnection($conn)
{
    mysql_close($conn);
}


function populate_students($mem_id)
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


function createStudentTable()
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
     die('Could not get data: ' . mysql_error());
   }
   else{
      echo "Created Topics Table successfully";
   }

   endDatabaseConnection($conn);
}

createStudentTable();
$id=populate_students(1);
echo $id."<br>";
?>