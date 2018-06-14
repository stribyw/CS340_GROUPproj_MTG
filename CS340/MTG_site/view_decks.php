<?php session_start(); ?>
<!DOCTYPE html>
<?php
$currentpage="View Decks";
include("header.php");
include("db_connect.php");

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
		echo "<tr onclick='deckClicked(this)'>";
		foreach($row as $cell) 
			echo "<td>$cell</td>";
		echo "</tr>\n";
	}



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
	}

}


mysqli_free_result($result);
mysqli_close($conn);
?>


<main>

</main>



<?php include("footer.php"); ?>
