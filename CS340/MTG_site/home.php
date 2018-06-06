<?php session_start(); ?>

<!DOCTYPE html>
<?php
$currentpage="Home Page";
include("header.php");
include("db_connect.php");
// session_start();


// if ($_SERVER["REQUEST_METHOD"] == "POST") {

// 	$User_ID = mysqli_real_escape_string($conn, $_POST['User_ID']);
// 	$password = mysqli_real_escape_string($conn, $_POST['password']);

// 				// See if username is in the table
// 	$queryIn = "SELECT * FROM User where User_ID='$User_ID'";
// 	$resultIn = mysqli_query($conn, $queryIn);
// 	if ($row = mysqli_fetch_assoc($resultIn)) {
// 		$salt = $row['salt'];
// 		$saltedPassword = MD5($password.$salt);
// 		if ($saltedPassword == $row['password']){
// 			echo "Log in successful!";
// 		} else {
// 			$rowpassword = $row['password'];
// 			echo "ERROR, wrong username or password.";
// 		}
// 	} else {
// 		echo "ERROR, wrong username or password.";
// 	}
// }
if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// Escape user inputs for security
	$username  = mysqli_real_escape_string($conn, $_POST['username']);
	$password  = mysqli_real_escape_string($conn, $_POST['password']);
	
	$queryIn = "SELECT * FROM User WHERE User_ID='$username'";

	$resultIn = mysqli_query($conn, $queryIn);
		if (!mysqli_num_rows($resultIn)) { // See if username is already in the table
			// $msg ="<h2>Incorrect Username</h2><p>";
			echo "<p>Incorrect Username</p>";
		} 
		else {
			$obj = $resultIn->fetch_object();
			// $tmp = MD5($password);
			$tmp = hash("md5", $password, FALSE);
			echo "<p>stored hash: '$obj->Password_Hash'</p>";
			echo "<p>pass hash: '$tmp'</p>";
			if ($obj->Password_Hash == MD5($password)) {
			// if ($obj->Password_Hash == hash("md5", $password, FALSE)) { // Make sure password was correct
				echo "<p>Login Successful</p>";

				

				

				$_SESSION["User_ID"] = $username;
				// $_SESSION["User_ID"] = "testing";
				echo "<p>User is "  . $_SESSION["User_ID"] . "</p>";

				echo "<p>Session variables are set</p>";

			} else {
				echo "<p>Password Incorrect</p>";
			}
		}
	}
			// close connection
	mysqli_close($conn);
	?>


	<main>
		<div class="two-row">

			<div class="two-column">
				<section class="todo">
					<h2>About the Site:</h2>
					<div class="todo-body">
						<div class="todo-list">
							<p>put stuff here</p>
							<p>about the site</p>
							<p>and what</p>
							<p>users can do</p>
						</ul>
					</div>
				</section>
			</div>

			<div class="two-column">
			<!-- <section class="todo">
				<h2>Login</h2>
				<div class="todo-body">
					<ul class="todo-list">
						<li>Username: <input type="text" name="userid" id="userid" title="username can be characters and numeric"></li>
						<li>Password: <input type="text" name="password" id="password"></li>
						<li><input type="submit" value="Login"></li>
						<li><input type="reset" value="Clear Form"></li>
					</ul>
				</div>
			</section> -->
			<form method="post" id="addForm">
				<fieldset>
					<legend>User Info:</legend>
					<p>
						<label for="username">Username:</label>
						<input type="text" class="required" name="username" id="username" title="username should be alphanumeric">
					</p>

					<p>
						<label for="password">Password:</label>
						<input type="text" class="required" name="password" id="password">
					</p>
				</fieldset>

				<p>
					<input type = "submit"  value = "Submit" />
					<input type = "reset"  value = "Clear Form" />
				</p>
			</form>


			<section class="todo">
				<h2><a href="create_account.php">Create Account</a></h2>
			</section>
		</div>

	</div>
</main>

<?php include("footer.php"); ?>

