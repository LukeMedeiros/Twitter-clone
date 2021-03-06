<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	
	<link rel="stylesheet" href="http://lukestesthostingpackage-coom.stackstaging.com/11-twitter//styles.css">
	
  </head>
  <body>
  
  <nav class="navbar navbar-toggleable-sm navbar-light bg-faded">
	  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <a class="navbar-brand" href="index.php">Twitter</a>
	  <div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
		  <li class="nav-item">
			<a class="nav-link" href="?page=timeline">Your timeline</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="?page=yourtweets">Your tweets</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="?page=publicprofiles">Public Profiles</a>
		  </li>
		</ul>
		<div class="pull-right">
		
			<?php if($_SESSION['id']){ ?>
				<a class="btn btn-outline-success" href="?function=logout">Logout</a>
			<?php } else{ ?>
				<button class="btn btn-outline-success" data-toggle="modal" data-target="#myModal">Login/Sign-up</button>
			<?php } ?>
			
		</div>
	  </div>
	</nav>