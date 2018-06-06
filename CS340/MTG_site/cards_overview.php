<!DOCTYPE html>
<?php
$currentpage="Cards Overview";
include("header.php");
// include("db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$User_ID  = mysqli_real_escape_string($conn, $_POST['User_ID']);
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
			<h2><a href="view_cards.php">Go to View Cards</a></h2>
		</section>
	</div>

	<div class="two-column">
		<section class="todo">
			<h2><a href="edit_cards.php">Go to Edit Cards</a></h2>
		</section>
	</div>
</main>


<?php include("footer.php"); ?>
