<!DOCTYPE html>
<?php
$currentpage="Decks Page";
//include "pages.php";
?>
<html>

<head>
	<meta charset="utf-8">
	<title>M:TG Exchange</title>
	<!-- This is a 3rd-party stylesheet for Font Awesome: http://fontawesome.io/ -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" media="screen">
	<script type="text/javascript" src="verifyInput.js" > </script>
	<link rel="stylesheet" href="style.css" media="screen">
</head>

<body>
	<?php
	include "header.php";
	
	//$msg = "Please log in.";
	include 'connectvars.php';
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$User_ID = mysqli_real_escape_string($conn, $_POST['User_ID']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);

		// See if username is in the table
		$queryIn = "SELECT * FROM User where User_ID='$User_ID'";
		$resultIn = mysqli_query($conn, $queryIn);
		if ($row = mysqli_fetch_assoc($resultIn)) {
			$salt = $row['salt'];
			$saltedPassword = MD5($password.$salt);
			if ($saltedPassword == $row['password']){
				echo "Log in successful!";
			} else {
				$rowpassword = $row['password'];
				echo "ERROR, wrong username or password.";
			}
		} else {
			echo "ERROR, wrong username or password.";
		}
	}
	// close connection
	mysqli_close($conn);
	?>


	<main>


		<div class="two-column">
			<section class="todo">
				<h2><a href="view_decks.php">Go to View Decks</a></h2>
			</section>
		</div>

		<div class="two-column">
			<section class="todo">
				<!-- <h2>Go to Edit Cards</h2> -->
				<h2><a href="edit_decks.php">Go to Edit Decks</a></h2>
			</section>
		</div>

	</main>

	<footer>
		<div class="copyright">
			Copyright &copy; 2018
		</div>
	</footer>

</body>
</html>
