<!DOCTYPE html>
<?php
$currentpage="Home page";
include("header.php");
include("db_connect.php");


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

<?php include("footer.php"); ?>