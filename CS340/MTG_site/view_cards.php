<!DOCTYPE html>
<?php
$currentpage="Home page";
include("header.php");
include("db_connect.php");

	// query to select all information from supplier table
$query = "SELECT * FROM Cards ";


	// Get results from query
$result = mysqli_query($conn, $query);
if (!$result) {
	die("Query to show fields from table failed");
}
	// get number of columns in table	
$fields_num = mysqli_num_fields($result);
echo "<h1>Parts:</h1>";
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

mysqli_free_result($result);
mysqli_close($conn);
?>


<main>

</main>



<?php include("footer.php"); ?>
