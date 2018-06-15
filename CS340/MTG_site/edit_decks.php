<?php session_start(); ?>
<!DOCTYPE html>
<?php
$currentpage="Edit Decks";
include("header.php");
include("db_connect.php");
?>

	<div class="two-column">
		<section class="todo">
			<h2>Your Decks:</h2>

<?php
$user = $_SESSION["User_ID"];
$query = "SELECT * FROM User WHERE User_ID='$user'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
	echo "<p>Please log in</p>";
} else {

	// Deck table
	$query = "SELECT Deck_ID, Deck_Name FROM Decks WHERE User_ID='$user'";
	$result = mysqli_query($conn, $query);
	$fields_num = mysqli_num_fields($result);
	echo "<h2>Your Cards:</h2>";
	echo "<table id='t01' border='1'><tr>";
	for($i=0; $i<$fields_num; $i++) {
		$field = mysqli_fetch_field($result);
		echo "<td><b>$field->name</b></td>";
	}
	echo "</tr>\n";
	while($row = mysqli_fetch_row($result)) {
		echo "<tr onclick='deckClickedEdit(this)'>";
		foreach($row as $cell) 
			echo "<td>$cell</td>";
		echo "</tr>\n";
	}
	echo "</table>";


	// If deck selected
	$selDeck = $_GET['did'];
	if ($selDeck) {

		$query = "SELECT Name, Set_Name, Quantity FROM Decks NATURAL JOIN Contains NATURAL JOIN Cards WHERE Deck_ID='$selDeck' AND User_ID='$user'";
		$result = mysqli_query($conn, $query);
		if (!$result) {
			die("Query to show fields from table failed");
		}

		$fields_num = mysqli_num_fields($result);
		echo "<h2>Cards in this Deck:</h2>";
		echo "<table id='t01' border='1'><tr>";

		for($i=0; $i<$fields_num; $i++) {
			$field = mysqli_fetch_field($result);
			echo "<td><b>$field->name</b></td>";
		}
		echo "</tr>\n";
		while($row = mysqli_fetch_row($result)) {
			echo "<tr>";
			foreach($row as $cell)
				echo "<td>$cell</td>";
			echo "</tr>\n";
		}
		echo "</table>";

		echo "</section>";
		echo "</div>";


		echo "<div class='two-column'>";
		echo "<section class='todo'>";

		// User's collection
		$query = "SELECT Card_ID, Name, Set_Name, Rarity, Quantity FROM Collects NATURAL JOIN Cards WHERE User_ID='$user'";
		$result = mysqli_query($conn, $query);
		if (!$result) {
			die("Query to show fields from table failed");
		}

		// get number of columns in table
		$fields_num = mysqli_num_fields($result);
		echo "<table id='t01' border='1'><tr>";
		// printing table headers
		for($i=0; $i<$fields_num; $i++) {
			$field = mysqli_fetch_field($result);
			echo "<td><b>$field->name</b></td>";
		}
		echo "</tr>\n";
		while($row = mysqli_fetch_row($result)) {
			echo "<tr>";
			foreach($row as $cell)
				echo "<td onclick='cardClicked(this)'>$cell</td>";
			echo "<td onclick='addCardClickedEditDecks(this)'><button>add1</button></td>";
			echo "<td onclick='removeCardClickedEditDecks(this)'><button>remove1</button></td>";
			echo "</tr>\n";
		}
		echo "</table>";

		echo "</section>";
		echo "</div>";
	}

}


mysqli_free_result($result);
mysqli_close($conn);
?>


<main>

</main>



<?php include("footer.php"); ?>
