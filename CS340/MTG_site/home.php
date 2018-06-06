<?php session_start(); ?>

<!DOCTYPE html>
<?php
$currentpage="Home Page";
include("header.php");
include("db_connect.php");
// session_start();

$lis = false;

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
			if ($obj->Password_Hash == MD5($password)) {
                //echo "Log in successful.";
				$_SESSION["User_ID"] = $username;
                $lis = true;
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
							<p>Do you play Magic: The Gathering!?!</p>
							<p>Want to trade, play, and interact with other players!?!</p>
							<p>Create an account and then build your card and deck inventory, and then you can create trades of cards that you are willing to trade and what you are wanting for them. </p>
							<p>And most importantly there are discussion boards for everything so that you can talk with other M:TG players just like you!</p>
						</ul>
					</div>
				</section>
			</div>

			<div class="two-column">
				<section class="todo">
					<form method="post" id="addForm">
						<fieldset>
						<legend>Login:</legend>
							<div class="todo-body">
								<ul class="todo-list">
									<li>
										<label for="username">Username:</label>
										<input type="text" class="required" name="username" id="username" title="username should be alphanumeric">
									</li>
									<li>
										<label for="password">Password:</label>
										<input type="text" class="required" name="password" id="password">
									</li>
									<li><input type = "submit"  value = "Log In" /></li>
									<li><input type = "reset"  value = "Clear Form" /></li>
								</ul>
							</div>
						</fieldset>
					</form>
				</section>

				<section class="todo">
					<h2><a href="create_account.php">Create Account</a></h2>
				</section>
			</div>

	</div>
</main>

<?php 
    include("footer.php"); 
    if ($lis) {
        header("Location:home.php");
        exit();
    }
?>
