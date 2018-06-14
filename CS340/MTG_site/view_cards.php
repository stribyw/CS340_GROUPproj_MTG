<?php session_start(); ?>
<!DOCTYPE html>
<?php
	$currentpage="View Cards";
	include("header.php");
	include("db_connect.php");

	$user = $_SESSION["User_ID"];
	$query = "SELECT * FROM User WHERE User_ID='$user'";
	$result = mysqli_query($conn, $query);
?>

<div class="two-row">
	<div class="two-column">
		<section class="todo">
	<h2>Your Cards:</h2>
	<input type="text" id="myInput" onkeyup="filterCardFunction()" placeholder="Search for names.." title="Type in a name">

<?php
	if (mysqli_num_rows($result) == 0) {
?>
	<!-- echo "<p>Please log in</p>"; -->
	<p>Please log in</p>

<?php
	} else {
	// Update counts if card added or removed
		$modCard = $_GET['addcid'];
		if ($modCard) {
			$query = "UPDATE Collects SET Quantity=Quantity+1 WHERE Card_ID='$modCard' AND User_ID='$user'";
			$conn->query($query);
		}
		$modCard = $_GET['rmcid'];
		if ($modCard) {
			$query = "UPDATE Collects SET Quantity=Quantity-1 WHERE Card_ID='$modCard' AND User_ID='$user'";
			$conn->query($query);
			mysqli_query($conn, "CALL Clear_Zeros");
		}

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
			echo "<td onclick='addCardClicked(this)'><button>add1</button></td>";
			echo "<td onclick='removeCardClicked(this)'><button>remove1</button></td>";
			echo "</tr>\n";
	}
?>

</section>
</div>


	<div class="two-column">
		<section class="todo">
<?php
	$selCard = $_GET['cid'];
	if ($selCard) {
		// Card Info
		$query = "SELECT Name, Rarity, Set_Name FROM Cards WHERE Card_ID='$selCard'";
		$result = mysqli_query($conn, $query);
		if (!$result) { die("Query to show fields from table failed");}
?>


	<!-- Start Display of Card Info for selected card -->
	<h3>Card Info:</h3>
	<p>

<?php
	foreach(mysqli_fetch_row($result) as $cell)
		echo "$cell, ";
?>

	</p>

<?php
	// Card Count
	$query = "SELECT COUNT(*) FROM `Collects` WHERE Card_ID='$selCard'";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
?>

	<p>Card Count (of everyone):

<?php
	foreach(mysqli_fetch_row($result) as $cell)
		echo "$cell ";
?>

	</p>

<?php
	// Number of this user's decks its in
	$query = "SELECT COUNT(*) FROM Contains NATURAL JOIN Decks NATURAL JOIN User WHERE Card_ID='$selCard' AND User_ID = '$user'";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed2");
	}

?>

  <p>Number of your decks its in:

<?php
	foreach(mysqli_fetch_row($result) as $cell)
		echo "$cell ";
?>

	</p>

<?php
	// Discussions its in
	$query = "SELECT COUNT(Card_ID) FROM Discussions WHERE Card_ID='$selCard'";
	$result = mysqli_query($conn, $query);
	if (!$result) { die("Query to show fields from table failed3");}
?>

	<p>Discussions its in:

<?php
	foreach(mysqli_fetch_row($result) as $cell)
		echo "$cell ";
?>

</p>

<?php
	// Trades its in
	$query = "SELECT COUNT(Card_ID) FROM Trade_Have WHERE Card_ID='$selCard'";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed4");
	}
?>

	<p>Trades its offered in:

<?php
	foreach(mysqli_fetch_row($result) as $cell)
		echo "$cell ";
?>

	</p>

</section>
</div>
</div>

<?php
	}
}

mysqli_close($conn);
?>

<?php include("footer.php"); ?>
