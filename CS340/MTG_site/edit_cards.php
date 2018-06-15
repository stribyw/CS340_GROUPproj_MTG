<?php session_start(); ?>
<!DOCTYPE html>
<?php
$currentpage="Edit Cards";
include("header.php");
include("db_connect.php");

$user = $_SESSION["User_ID"];
$query = "SELECT * FROM User WHERE User_ID='$user'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 0) {
	echo "<p>Please log in</p>";

} else {

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
	$modCard = $_GET['newcid'];
	if ($modCard) {
		$query = "INSERT INTO Collects VALUES ('$user', $modCard, 1)";
		$conn->query($query);
	}

	// Display user's cards
	$query = "SELECT Card_ID, Name, Quantity, Set_Name FROM Collects NATURAL JOIN Cards WHERE User_ID='$user'";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	
	// get number of columns in table
	$fields_num = mysqli_num_fields($result);
	echo "<h2>Your Collection:</h2>";
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
			echo "<td>$cell</td>";
		echo "<td onclick='addCardClickedEdit(this)'><button>add1</button></td>";
		echo "<td onclick='removeCardClickedEdit(this)'><button>remove1</button></td>";
		echo "</tr>\n";
	}
	echo "</table>";


	// Display all cards
	// $query = "(SELECT Card_ID, Name, Set_Name FROM Cards) - (SELECT Card_ID, Name, Quantity, Set_Name FROM Collects NATURAL JOIN Cards WHERE User_ID='$user')";
	// $query = "SELECT Card_ID, Name, Set_Name FROM Cards CROSS JOIN User WHERE User='$user'";
	$query = "SELECT Card_ID, Name, Set_Name FROM Cards WHERE Card_ID NOT IN (SELECT Card_ID FROM Collects NATURAL JOIN Cards WHERE User_ID='$user')";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	
	// get number of columns in table
	$fields_num = mysqli_num_fields($result);
	echo "<h2>Possible Cards:</h2>";
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
			echo "<td>$cell</td>";
		echo "<td onclick='newCardClickedEdit(this)'><button>add1</button></td>";
		// echo "<td onclick='removeCardClickedEdit(this)'><button>remove1</button></td>";
		echo "</tr>\n";
	}
	echo "</table>";


}



mysqli_free_result($result);
mysqli_close($conn);
?>

<main>
	
</main>

<?php include("footer.php"); ?>

