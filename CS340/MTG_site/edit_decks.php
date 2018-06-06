<!DOCTYPE html>
<?php
$currentpage="Home page";
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

	include 'connectvars.php';
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	if (!$conn) {
		die('Could not connect: ' . mysql_error());
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);

				// See if username is in the table
		$queryIn = "SELECT * FROM Users where username='$username'";
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

		<section class="todo">
			<h2>About the Site:</h2>
			<div class="todo-body">
				<ul class="todo-list">
					<li>put</li>
					<li>stuff here</li>
					<li>about the</li>
					<li>site</li>
				</ul>
			</div>
		</section>

		<section class="todo">
			<h2>Login</h2>
			<div class="todo-body">
				<form action="/action_page.php">
					Username: <input type="text" name="Username"><br>
					Password: <input type="text" name="password"><br>
					<input type="submit" value="Login">
				</form>
			</div>
		</section>

		<section class="todo">
			<h2 class="navbar-item"><a href="/about">Create Account</a></h2>
		</section>

	</main>

	<footer>
		<div class="copyright">
			Copyright &copy; 2016
		</div>
	</footer>

</body>
</html>
