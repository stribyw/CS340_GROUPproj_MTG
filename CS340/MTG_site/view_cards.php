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
				echo "<p>Please log in</p>";
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
<!-- 			<h2>Selected Card Info:</h2>
-->				
<?php
$selCard = $_GET['cid'];
if ($selCard) {

	$query = "SELECT Name, Set_Name, Quantity FROM Decks NATURAL JOIN Contains NATURAL JOIN Cards WHERE User_ID='$user'";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}

	$fields_num = mysqli_num_fields($result);
	echo "<table id='t01' border='1'><tr>";


	$query = "SELECT Name, Set_Name, Rarity FROM Cards WHERE Card_ID='$selCard'";
	$result1 = mysqli_query($conn, $query);
	$query = "SELECT COUNT(*) FROM `Collects` WHERE Card_ID='$selCard'";
	$result2 = mysqli_query($conn, $query);
	$query = "SELECT COUNT(*) FROM Contains NATURAL JOIN Decks NATURAL JOIN User WHERE Card_ID='$selCard' AND User_ID = '$user'";
	$result3 = mysqli_query($conn, $query);
	$query = "SELECT COUNT(Card_ID) FROM Discussions WHERE Card_ID='$selCard'";
	$result4 = mysqli_query($conn, $query);
	$query = "SELECT COUNT(Card_ID) FROM Trade_Have WHERE Card_ID='$selCard'";
	$result5 = mysqli_query($conn, $query);


	echo "<td><b>Card Name</b></td>";
	echo "<td><b>Set_Name Name</b></td>";
	echo "<td><b>Rarity</b></td>";
	echo "<td><b>Total Count</b></td>";
	echo "<td><b>Decks its in</b></td>";
	echo "<td><b>Discussions its in</b></td>";
	echo "<td><b>Trades its in</b></td>";
	echo "</tr>\n";
	echo "<tr>";
	while($row = mysqli_fetch_row($result1)) 
		{ foreach($row as $cell) echo "<td>$cell</td>"; }
	while($row = mysqli_fetch_row($result2)) 
		{ foreach($row as $cell) echo "<td>$cell</td>"; }
	while($row = mysqli_fetch_row($result3)) 
		{ foreach($row as $cell) echo "<td>$cell</td>";  }
	while($row = mysqli_fetch_row($result4)) 
		{ foreach($row as $cell) echo "<td>$cell</td>"; }
	while($row = mysqli_fetch_row($result5)) 
		{ foreach($row as $cell) echo "<td>$cell</td>"; }
	echo "</tr>";
}
?>
</section>
</div>
<?php

}

mysqli_close($conn);
?>

<?php include("footer.php"); ?>
