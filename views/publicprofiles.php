
<div class="myContainer container" >
	
	<div class="row">
		<div class="col-8">
		
			<?php if ($_GET['userid']) { ?>
				
				<?php displayTweets($_GET['userid']);?>
				
			<?php } else { ?>
				
				<h2>Active Users</h2>
			  
				<?php displayUsers();?>
				
			<?php } ?>
			
		</div>
		<div class="col-4">
			
			<?php displaySearch(); ?>
			
			<br>
			
			<?php displayTweetBox(); ?>
		
		</div>
	</div>
	
</div> 