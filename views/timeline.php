<div class="myContainer container" >
	
	<div class="row">
		<div class="col-8">
			<h2>Tweets for you</h2>
		  
			<?php displayTweets('isFollowing');?>
			
		</div>
		<div class="col-4">
			
			<?php displaySearch(); ?>
			
			<br>
			
			<?php displayTweetBox(); ?>
		
		</div>
	</div>
	
</div>