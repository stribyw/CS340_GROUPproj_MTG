<?php session_start(); ?>
<!DOCTYPE html>
<?php
$currentpage="Edit Cards";
include("header.php");
include("db_connect.php");


if ($_SESSION["User_ID"] == '') {
	echo "<p>Please log in</p>";

} else {

	$tmp = $_SESSION["User_ID"];
	$query = "SELECT Name, Quantity, Set_Name FROM Collects NATURAL JOIN Cards WHERE User_ID='$tmp'";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	
	// get number of columns in table
	$fields_num = mysqli_num_fields($result);
	echo "<h2>Your Cards:</h2>";
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
		echo "</tr>\n";
	}

}



mysqli_free_result($result);
mysqli_close($conn);
?>

<main>
	
</main>

<?php include("footer.php"); ?>

