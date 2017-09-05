<?php

	include("functions.php"); 
	
	if($_GET['action'] == "loginSignup"){
		
		$error = "";
		
		if(!$_POST['email']){
			
			$error = "email required";
			
		}else if(!$_POST['password']){
			
			$error = "password required"; 
			
		}else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$error = "Invalid email format"; 
		}
		
		if($error != ""){

			echo $error; 
			exit(); 
			
		}
		
		if($_POST['loginActive'] == "0"){
			
			$query = "SELECT * FROM `users` WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1"; 
			$result = mysqli_query($link, $query); 
			if(mysqli_num_rows($result) > 0){
				$error = "email address taken";
			}else{
				
				$query = "INSERT INTO `users` (`email`, `password`) VALUES ('". mysqli_real_escape_string($link, $_POST['email'])."', '". mysqli_real_escape_string($link, $_POST['password'])."')";
				if(mysqli_query($link, $query)){
					
					$_SESSION['id'] = mysqli_insert_id($link); 
					
					$query = "UPDATE `users` SET `password` = '".md5(md5($_SESSION['id']).$_POST['password'])."' WHERE `id` = ".$_SESSION['id']." LIMIT 1";
					
					$result = mysqli_query($link, $query); 
					
					echo 1; 
					
				}else{
					
					echo "Couldnt create"; 
					
				}
				
			}
			
		}else{
			
			$query = "SELECT * FROM `users` WHERE email = '". mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1"; 
			
			$result = mysqli_query($link, $query); 
			
			$row = mysqli_fetch_assoc($result);
				
			if($row['password'] == md5(md5($row[id]).$_POST['password'])){
				
				echo 1;
				
				$_SESSION['id'] = $row['id']; 
				
			}else{
				
				$error = "incorrect login"; 
				
			}
				
		}
		
		if($error != "" ){
			
			echo $error; 
			
		}
		
		
		
	}
	
?>