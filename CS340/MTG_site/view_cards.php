<?php session_start(); ?>
<!DOCTYPE html>
<?php
	$currentpage="View Cards";
	include("header.php");
	include("db_connect.php");

	// echo "User is "  . $_SESSION["User_ID"] . ".";
	// $query = "SELECT * FROM User WHERE I
	$tmp = $_SESSION["User_ID"];
	echo "<p>Tmp: $tmp</p>";
	//$query = "SELECT COUNT(*) FROM User WHERE User_ID='$tmp' ";
	// $query = "SELECT * FROM User WHERE User_ID='$tmp' ";
	$query = "SELECT * FROM User WHERE User_ID='$tmp'";
	//$query = "SELECT * FROM Cards";
	echo "<p>Query: $query</p>";
	$result = mysqli_query($conn, $query);
	// echo "<p>Result: $result</p>";
	// echo "<p>Test: $result</p>";
	if (mysqli_num_rows($result) == 0) {
		echo "<p>Please log in</p>";
	} else {
		// query to select all information from supplier table
		$query = "SELECT * FROM Cards";
		//$query = "SELECT * FROM Collects WHERE User_ID='$tmp'";

		// Get results from query
		$result = mysqli_query($conn, $query);
		if (!$result) {
			die("Query to show fields from table failed");
		}
		// get number of columns in table
		$fields_num = mysqli_num_fields($result);
		echo "<h2>Your Cards:</h2>";
		//echo "<input type="text" id="myInput" onkeyup="filterFunction()" placeholder="Search for names.." title="Type in a name">";
		echo "<table id='t01' border='1'><tr>";

		// printing table headers
		for($i=0; $i<$fields_num; $i++) {
			$field = mysqli_fetch_field($result);
			echo "<td><b>$field->name</b></td>";
		}
		echo "</tr>\n";
		while($row = mysqli_fetch_row($result)) {
			echo "<tr>";
			// $row is array... foreach( .. ) puts every element
			// of $row to $cell variable
			foreach($row as $cell)
				echo "<td>$cell</td>";
			echo "</tr>\n";
		}
	}
	// mysqli_free_result($result);
	mysqli_close($conn);
?>


<main>
	<input type="text" id="myInput" onkeyup="filterCardFunction()" placeholder="Search for names.." title="Type in a name">

</main>

<?php include("footer.php"); ?>
