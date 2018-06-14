<?php session_start(); ?>
<html>
<head>
	<meta charset="utf-8">
	<title>M:TG Exchange</title>
	<!-- This is a 3rd-party stylesheet for Font Awesome: http://fontawesome.io/ -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" media="screen">
	<script type="text/javascript" src="verifyInput.js" > </script>
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	
	<header>
		<h1><a>Magic: The Gathering Exchange</a></h1>
		<nav>
			<ul class="navbar-list">
				<li class="navbar-item"><a href="home.php">Home</a></li>

				<?php

				if ($_SESSION['User_ID'] != '') {

					// echo "<li class='navbar-item'><a href='cards_overview.php'>Cards</a></li>";
					// echo "<li class='navbar-item'><a href='decks_overview.php'>Decks</a></li>";
					echo "<li class='navbar-item'><a href='view_cards.php'>View Collection</a></li>";
					echo "<li class='navbar-item'><a href='edit_cards.php'>Edit Collection</a></li>";
					echo "<li class='navbar-item'><a href='view_decks.php'>View Decks</a></li>";
					echo "<li class='navbar-item'><a href='edit_decks.php'>Edit Decks</a></li>";

					echo "<li class='navbar-item'><a href='view_discussions.php'>Forums</a></li>";
					echo "<li class='navbar-item'><a href='my_trades.php'>Trades</a></li>";
					echo "<li class='navbar-item'><a href='account.php'>Welcome " . $_SESSION['User_ID'] . "<a/></li>";
					echo "<li class='navbar-item navbar-right'><a href='logout.php'>Log out</a></li>";
				} else {
					echo "<li class='navbar-item navbar-right'><a href='#'>Log in</a></li>";
				}
				?>
			</ul>
		</nav>
	</header>




