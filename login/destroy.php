<?php
include 'helper_modules.php';
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
//if you want to initiall delete all databse just use 
//drop database dbms and then create database dbms
   destroy_database();
   //Relation
   // dropTable('subtoplec'); //1
   // dropTable('topsubtop'); //2
   // dropTable('coursetop'); //3
   // dropTable('subtopquiz');//4
   // dropTable('subtopass');//5
   // dropTable('coursefac');//6
   // dropTable('studcourse');//7

   // //Tables
   // dropTable('lectures');//9
   // dropTable('courses');//10
   // dropTable('subtopics');//11
   // dropTable('topics');//12
   // dropTable('students');//13
   // dropTable('assign');//14
   // dropTable('quiz');//15
   // dropTable('admins');//16
   // dropTable('faculty');//17
   
   //dropTable('emails');
   // dropTable('members'); //8

   exit();
?>