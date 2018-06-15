<?php session_start(); ?>
<!DOCTYPE html>

<html>
<body>

<?php
$currentpage="Account Page";
include ("header.php");
include("db_connect.php");
 
?>


<main>
	<div class="two-row">

		<div class="two-column">
			<section class="todo">
				<h2><a href="view_cards.php">My Card Collection<a/></h2>
			</section>  

			<section class="todo">
				<h2><a href="view_decks.php">My Decks<a/></h2>
			</section>

			<section class="todo">
				<h2><a href="my_trades.php">All Trades<a/></h2>
			</section>

			<section class="todo">
				<h2><a href="view_discussions.php">Forum<a/></h2>
			</section>
		</div>

		<div class="two-column">
			<section class="todo">
				<h2>Account Details</h2>
			</section>

			<section class="todo">
				<h2>User Info</a></h2>
				<div class="todo-body">
					<ul class="todo-list">
						<?php
						
							$user = $_SESSION["User_ID"];
							if ($_SESSION["User_ID"] == '') {
							echo "<p>Please log in</p>";

							} else {
								$query = "SELECT SUM(Quantity) FROM Collects WHERE User_ID = '$user'";
								$result = mysqli_query($conn, $query);
								$row = mysqli_fetch_row($result);
								$cards = $row[0];
								$query = "SELECT COUNT(*) FROM Decks WHERE User_ID = '$user'";
								$result = mysqli_query($conn, $query);
								$row = mysqli_fetch_row($result);
								$decks = $row[0];
								$query = "SELECT COUNT(*) FROM Discussions WHERE User_ID = '$user'";
								$result = mysqli_query($conn, $query);
								$row = mysqli_fetch_row($result);
								$posts = $row[0];
								echo "<p>Cards Owned: ";
								echo $cards;
								echo "</p>";
								
								echo "<p>Decks Owned: ";
								echo $decks;
								echo "</p>";
								
								echo "<p>Discussions: ";
								echo $posts;
								echo "</p>";
								
								mysqli_close($conn);
							}
							
						?>
					</ul>
				</div>
			</section>
		</div>

	</div>
</main>

</html>
</body>

<?php include("footer.php"); ?>
