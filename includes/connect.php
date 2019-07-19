<?php
	$db_host = "localhost";
	$db_user = "alamin";
	$db_pass = "alamin";
	$db_name = "jupmsm_v3";
	$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
	}
	$db->set_charset("utf8");
?>