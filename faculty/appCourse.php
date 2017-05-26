<?php
	include('../login/session.php');
    include('../login/info.php');
    include('../login/helper_modules.php');

    if(isset($_SESSION['role_id'])){
        $fac_id = $_SESSION['role_id'];
        $c_id = $_POST['select_course'];
	    accept_course($fac_id,$c_id);
	    echo "You are now the assigned faculty by Mr. bansal";
	}
	else{
		echo "session defunct Sorry try again";
	}
?>