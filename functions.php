<?php

	session_start();

	$link = mysqli_connect("shareddb1c.hosting.stackcp.net", "twitter-323068fa", "NPBCt3rHwkZ5", "twitter-323068fa");

	if(mysqli_connect_errno()){
		
		print_r(mysqli_connect_error());
		
	}
	
	if($_GET['function']=="logout"){
		
		session_unset();
		
	}
	
	function displaySearch(){
		
		echo '<div class="form-inline">
			  <div class="form-group" >
				<input type="text" style="margin-bottom:20px;" class="form-control" id="formGroupExampleInput" placeholder="Search">
			  </div>
			  <button class="btn btn-primary" >Search Tweets</button>
			</div>'; 
		
	}
	
	function displayTweetBox(){
		
		if($_SESSION['id']>0){
			
			echo '<div>
			  <div class="form-group" >
				<textarea class="form-control" id="tweetContent" rows="3" style="margin-bottom:20px;"></textarea>
				<button class="btn btn-primary" >Post Tweets</button>
			  </div>
			</div>'; 
			
		}
		
	}
	
	function displayTweets($type){
		
		global $link; 
		
		if($type == 'public'){
			
			$whereClause = "";

			$query = "SELECT * FROM `tweets` ".$whereClause." ORDER BY `datetime` DESC LIMIT 10";			
			
		} else if($type == 'isFollowing'){
			
			$query = "SELECT * FROM `isFollowing` WHERE follower = ". mysqli_real_escape_string($link, $_SESSION['id']);
			
			$result = mysqli_query($link, $query);
			
			$whereClause = ""; 
			
			while($row = mysqli_fetch_assoc($result)){
				
				if($whereClause == "") $whereClause = "WHERE "; 
				else $whereClause.= " OR ";
				$whereClause .= " userid =".$row['isFollowing'];
				
				
			}
			
			if ($whereClause == "") $query = "";
			else $query = "SELECT * FROM `tweets` ".$whereClause." ORDER BY `datetime` DESC LIMIT 10";
		}
		
		$result = mysqli_query($link, $query); 
		
		if(mysqli_num_rows($result)==0){
			
			echo "no tweets to display"; 
			
		}else{
			
			while($row = mysqli_fetch_assoc($result)){
				
				$userQuery = "SELECT * FROM `users` WHERE `id` =".mysqli_escape_string($link, $row['userid'])." LIMIT 1";
				$userResult = mysqli_query($link, $userQuery); 
				$user = mysqli_fetch_assoc($userResult);
				
				echo "<div class='tweet'> <p>".$user['email']." <span class='time'>".time_since(time()-strtotime($row['datetime']))." ago</span>:</p>"; 
				echo "<p>".$row['tweet']."</p>"; 
				echo "<a href='' class='toggleFollow' data-userId=".$row['userid']." >";

				$isFollowingQuery = "SELECT * FROM `isFollowing` WHERE follower = '". mysqli_real_escape_string($link, $_SESSION['id'])."' AND isFollowing = '". mysqli_real_escape_string($link, $row['userid'])."' LIMIT 1 "; 
	
				$isFollowingResult = mysqli_query($link, $isFollowingQuery);
				
				if(mysqli_num_rows($isFollowingResult) > 0) echo "Unfollow"; 
				else echo "Follow"; 
			
				echo "</a> </div>";
				
			}
			
		}
		
	}
	
	function time_since($since) {
		$chunks = array(
			array(60 * 60 * 24 * 365 , 'year'),
			array(60 * 60 * 24 * 30 , 'month'),
			array(60 * 60 * 24 * 7, 'week'),
			array(60 * 60 * 24 , 'day'),
			array(60 * 60 , 'hour'),
			array(60 , 'min'),
			array(1 , 's')
		);

		for ($i = 0, $j = count($chunks); $i < $j; $i++) {
			$seconds = $chunks[$i][0];
			$name = $chunks[$i][1];
			if (($count = floor($since / $seconds)) != 0) {
				break;
			}
		}

		$print = ($count == 1) ? '1 '.$name : "$count {$name}s";
		return $print;
	}
	
?>