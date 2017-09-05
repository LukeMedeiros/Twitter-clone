<?php

	session_start();

	$link = mysqli_connect("shareddb1c.hosting.stackcp.net", "twitter-323068fa", "NPBCt3rHwkZ5", "twitter-323068fa");

	if(mysqli_connect_errno()){
		
		print_r(mysqli_connect_error());
		
	}
?>