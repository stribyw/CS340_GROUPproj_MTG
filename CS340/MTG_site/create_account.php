<!DOCTYPE html>
<?php
$currentpage="Create Account";
include("header.php");
include("db_connect.php");


$msg = "Add the following information to sign up";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// Escape user inputs
	$userid = mysqli_real_escape_string($conn, $_POST['userid']);
	$name   = mysqli_real_escape_string($conn, $_POST['name']);
	$email  = mysqli_real_escape_string($conn, $_POST['email']);
	$pass1  = mysqli_real_escape_string($conn, $_POST['pass1']);
	$pass2  = mysqli_real_escape_string($conn, $_POST['pass2']);

	// $hash = mysqli_real_escape_string($conn, $_POST['password']);
	// $hash = hash("md5", $pass1, FALSE);
	$hash = MD5($pass1);


				// See if username is already in the table
	$queryIn = "SELECT * FROM User where User_ID='$userid' ";
	$resultIn = mysqli_query($conn, $queryIn);
	if (mysqli_num_rows($resultIn) > 0) {
		$msg ="<h2>Can't use that username, '$userid' is already in use!</h2>";
	} else if ($pass1 != $pass2) {
		$msg ="<h2>Passwords don't match</h2>";
	} else {
		// attempt insert query 
		$query = "INSERT INTO User (User_ID, Name, Email, Password_Hash) VALUES ('$userid', '$name', '$email', '$hash')";
		if (mysqli_query($conn, $query)){
			$msg = "Account Created Successfully";
		} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
		}
	}
}
			// close connection
mysqli_close($conn);
?>


<main>
	<section>
		<h2 name="msg" id="msg"> <?php echo $msg; ?> </h2>

 <!--      <section class="todo">
		<h2>Add the following information to sign up!</h2>
		<div class="todo-body">
			<ul class="todo-list">
				<li>Username: <input type="text" class="required" name="User_ID" id="User_ID" title="username can be characters and numeric"></li>
				<li>Name: <input type="text" class="required" name="Name" id="Name"></li>
				<li>Email: <input type="text" class="required" name="Email" id="Email"></li>
				<li>Password: <input type="text" class="required" name="password" id="password"></li>
				<li>Repeat Password: <input type="text" class="required" name="password" id="password"></li>
				<li><input type="submit" value="Login"></li>
				<li><input type="reset" value="Clear Form"></li>
			</ul>
		</div>
	</section> -->
	<form method="post" id="createAccountForm" name="createAccountForm">
		<fieldset>
			<legend>Create Account Info:</legend>
			<p>
				<label for="userid">Username:</label>
				<input type="text" class="required" name="userid" id="userid" title="username should be alphanumeric">
			</p>
			<p>
				<label for="name">Name:</label>
				<input type="text" class="required" name="name" id="name">
			</p>
			<p>
				<label for="email">Email:</label>
				<input type="text" class="required" name="email" id="email">
			</p>
			<p>
				<label for="password">Password:</label>
				<input type="text" class="required" name="pass1" id="pass1">
			</p>
			<p>
				<label for="password">Confirm Password:</label>
				<input type="text" class="required" name="pass2" id="pass2">
			</p>
		</fieldset>

		<p>
			<input type = "submit"  value = "Submit" />
			<input type = "reset"  value = "Clear Form" />
		</p>
	</form>
</main>

<?php include("footer.php"); ?>