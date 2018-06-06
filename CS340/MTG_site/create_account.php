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
	<section class="todo">
		<h2 name="msg" id="msg"> <?php echo $msg; ?> </h2>
		<form method="post" id="createAccountForm" name="createAccountForm">
			<div class="todo-body">
				<fieldset>
				<legend>Create Account Info:</legend>
					<ul class="todo-list">
						<li>
							<label for="userid">Username:</label>
							<input type="text" class="required" name="userid" id="userid" title="username should be alphanumeric">
						</li>
						<li>
							<label for="name">Name:</label>
							<input type="text" class="required" name="name" id="name">
						</li>
						<li>
							<label for="email">Email:</label>
							<input type="text" class="required" name="email" id="email">
						</li>
						<li>
							<label for="password">Password:</label>
							<input type="text" class="required" name="pass1" id="pass1">
						</li>
						<li>
							<label for="password">Confirm Password:</label>
							<input type="text" class="required" name="pass2" id="pass2">
						</li>
						<li><input type = "submit"  value = "Submit" /></li>
						<li><input type = "reset"  value = "Clear Form" /></li>
					</ul>
				</fieldset>
			</div>
		</form>
	</section>
</main>

<?php include("footer.php"); ?>
