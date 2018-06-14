<?php session_start(); ?>
<!DOCTYPE html>
<?php
$currentpage="View Cards";
include("header.php");
include("db_connect.php");


$user = $_SESSION["User_ID"];
$query = "SELECT * FROM User WHERE User_ID='$user'";
$result = mysqli_query($conn, $query);
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
	}



	$query = "SELECT Card_ID, Name, Set_Name, Rarity, Quantity FROM Collects NATURAL JOIN Cards WHERE User_ID='$user'";
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
		// echo "<tr onclick='cardClicked(this)'>";
		echo "<tr>";
		foreach($row as $cell)
			echo "<td onclick='cardClicked(this)'>$cell</td>";
		echo "<td onclick='addCardClicked(this)'><button>add1</button></td>";
		echo "<td onclick='removeCardClicked(this)'><button>remove1</button></td>";
		echo "</tr>\n";
	}



	$selCard = $_GET['cid'];
	if ($selCard) {
		// Card Info
		$query = "SELECT Name, Rarity, Set_Name FROM Cards WHERE Card_ID='$selCard'";
		$result = mysqli_query($conn, $query);
		if (!$result) { die("Query to show fields from table failed");}
		echo "<p>Card Info: ";
		foreach(mysqli_fetch_row($result) as $cell)
			echo "$cell, ";
		echo "</p>";

		// Card Count
		$query = "SELECT COUNT(*) FROM `Collects` WHERE Card_ID='$selCard'";
		$result = mysqli_query($conn, $query);
		if (!$result) { die("Query to show fields from table failed");}
		echo "<p>Card Count (of everyone): ";
		foreach(mysqli_fetch_row($result) as $cell)
			echo "$cell ";
		echo "</p>";

		// Number of this user's decks its in
		$query = "SELECT COUNT(*) FROM Contains NATURAL JOIN Decks NATURAL JOIN User WHERE Card_ID='$selCard' AND User_ID = '$user'";		
		$result = mysqli_query($conn, $query);
		// echo $result;
		if (!$result) { die("Query to show fields from table failed2");}
		echo "<p>Number of your decks its in: ";
		foreach(mysqli_fetch_row($result) as $cell)
			echo "$cell ";
		echo "</p>";

		// Discussions its in
		$query = "SELECT COUNT(Card_ID) FROM Discussions WHERE Card_ID='$selCard'";
		$result = mysqli_query($conn, $query);
		if (!$result) { die("Query to show fields from table failed3");}
		echo "<p>Discussions its in: ";
		foreach(mysqli_fetch_row($result) as $cell)
			echo "$cell ";
		echo "</p>";

		// Trades its in
		$query = "SELECT COUNT(Card_ID) FROM Trade_Have WHERE Card_ID='$selCard'";

		$result = mysqli_query($conn, $query);
		if (!$result) { die("Query to show fields from table failed4");}
		echo "<p>Trades its offered in: ";
		foreach(mysqli_fetch_row($result) as $cell)
			echo "$cell ";
		echo "</p>";

		
	}



	echo "<div class='two-column'>";
		echo "<h2 id=selCard>Current Card Name:</h2>";
		echo "<div class='todo-body'>";
			echo "<div class='todo-list'>";
				echo "<p>Test</p>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
	// echo "<div>";
	// echo "<div class='two-column'>";
	// 	echo "<section class='todo'>";
	// 		echo "<h2>Some header:</h2>";
	// 		echo "<div class='todo-body'>";
	// 			echo "<div class='todo-list'>";
	// 				echo "<p>Test</p>";
	// 			echo "</ul>";
	// 		echo "</div>";
	// 	echo "</section>";
	// echo "</div>";

	// echo "<div class='two-column'>";
	// 	echo "<section class='todo'>";
			
	// 	echo "</section>";

	// 	echo "<section class='todo'>";
			
	// 	echo "</section>";
	// echo "</div>";
	// echo "</div>";
}
	// mysqli_free_result($result);
mysqli_close($conn);
?>


<main>
	<input type="text" id="myInput" onkeyup="filterCardFunction()" placeholder="Search for names.." title="Type in a name">



<!-- 
	<div class="two-column">
		<h2 id=selCard>Some header:</h2>
		<div class="todo-body">
			<div class="todo-list">
				<p>Test</p>
			</ul>
		</div>
	</div> -->
<!-- 
	<div class="two-column">
		<section class="todo">
			
		</section>

		<section class="todo">
			
		</section>
	</div> -->

</main>

<?php include("footer.php"); ?>
