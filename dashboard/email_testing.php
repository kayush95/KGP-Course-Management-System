<?php
	include '../login/helper_modules.php';

   ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    createEmailsTable();
    

 	insertIntoEmails("ravib@courseplex.com" , "vrawal@courseplex.com", "Hello ravi from Varun" , "Hi Ravi " );
 	insertIntoEmails("ravib@courseplex.com" , "kayush@courseplex.com", "Hello ravi from kayush" , "Hi Ravi again " );
 	insertIntoEmails("kayush@courseplex.com" , "vrawal@courseplex.com", "Hello kayush from Varun" , "Hi Ravi " );

	$arr = getAllInboxMessages('ravib');

	foreach($arr as $obj)
	{
		echo "To : ".$obj->email_to."<br>";
		echo "From : ".$obj->email_from."<br>";
		echo "Subject : ".$obj->subject."<br>";
		echo "Content : ".$obj->body."<br>";
		echo "<br> <br>";	
	}

	getAllInboxMessages('kayush');

	foreach($arr as $obj)
	{
		echo "To : ".$obj->email_to."<br>";
		echo "From : ".$obj->email_from."<br>";
		echo "Subject : ".$obj->subject."<br>";
		echo "Content : ".$obj->body."<br>";
		echo "<br> <br>";
	}

	getAllOutboxMessages('vrawal');

	foreach($arr as $obj)
	{
		echo "To : ".$obj->email_to."<br>";
		echo "From : ".$obj->email_from."<br>";
		echo "Subject : ".$obj->subject."<br>";
		echo "Content : ".$obj->body."<br>";
		echo "<br> <br>";
	}


	getAllOutboxMessages('kayush');

	foreach($arr as $obj)
	{
		echo "To : ".$obj->email_to."<br>";
		echo "From : ".$obj->email_from."<br>";
		echo "Subject : ".$obj->subject."<br>";
		echo "Content : ".$obj->body."<br>";
		echo "<br> <br>";
	}


?>