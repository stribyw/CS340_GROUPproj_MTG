<?php session_start(); ?>
<!DOCTYPE html>

<html>
<body>

	<?php
	$currentpage="View Discussions";
	include("header.php");
	include("db_connect.php");

	$user = $_SESSION["User_ID"];
	if ($_SESSION["User_ID"] == '') {
		echo "<p>Please log in</p>";

	} else {

		$query = "SELECT Discussion_ID, Post_Type, Card_ID, Deck_ID, User_ID FROM Discussions WHERE Parent_ID IS NULL";

	// Get results from query
		$result = mysqli_query($conn, $query);
		if (!$result) {
			die("Query to show fields from table failed");
		}

	// get number of columns in table
		$fields_num = mysqli_num_fields($result);
		echo "<h2>Discussions:</h2>";
		echo "<table id='t01' border='1'><tr>";

		// printing table headers
		for($i=0; $i<$fields_num; $i++) {
			$field = mysqli_fetch_field($result);
			echo "<td><b>$field->name</b></td>";
		}
		echo "</tr>\n";
		while($row = mysqli_fetch_row($result)) {
			echo "<tr onclick='discussionClicked(this)'>";
			foreach($row as $cell)
				echo "<td>$cell</td>";
			echo "</tr>\n";
		}
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$type = mysqli_real_escape_string($conn, $_POST['type']);
			$did = mysqli_real_escape_string($conn, $_POST['did']);
			$act = mysqli_real_escape_string($conn, $_POST['action']);
		//echo $type;
			$id = mysqli_real_escape_string($conn, $_POST['id']);
			$contents = mysqli_real_escape_string($conn, $_POST['contents']);
		//echo $contents;
			
			if ($act == "new"){
				$queryIn = "SELECT MAX(Discussion_ID) AS max FROM Discussions";
				$newDID = mysqli_query($conn, $queryIn);
		//echo "results for did max";
		//echo mysqli_num_rows($newDID);
				$newDID = $newDID->fetch_assoc();
		//echo "newDID";
		//echo $newDID['max'];
				$int = $newDID['max'] + 1;
				
				if($type == "Deck") {
					echo "Get ready to insert";
					$query = "INSERT INTO Discussions (Discussion_ID, Parent_ID, Post_Type, Card_ID, Deck_ID, User_ID, Contents) VALUES ('$int', NULL, '$type', NULL, '$id', '$user', '$contents')";
					if (mysqli_query($conn, $query)){
						$msg = "Post Added Successfully";
					} else{
						echo 'ERROR: Could not able to execute $query. ' . mysqli_error($conn);
					}
				} else{
					$query = "INSERT INTO Discussions (Discussion_ID, Parent_ID, Post_Type, Card_ID, Deck_ID, User_ID, Contents) VALUES ('$int', NULL, '$type', '$id', NULL, '$user', '$contents')";
					if (mysqli_query($conn, $query)){
						$msg = "Post Added Successfully";
					} else{
						echo 'ERROR: Could not able to execute $query. ' . mysqli_error($conn);
					}
				}
			} else{
				$queryIn = "SELECT MAX(Discussion_ID) AS max FROM Discussions";
				$newDID = mysqli_query($conn, $queryIn);
			//echo "results for did max";
			//echo mysqli_num_rows($newDID);
				$newDID = $newDID->fetch_assoc();
			//echo "newDID";
			//echo $newDID['max'];
				$int = $newDID['max'] + 1;
				if($type == "Deck"){
					$query = "INSERT INTO Discussions (Discussion_ID, Parent_ID, Post_Type, Card_ID, Deck_ID, User_ID, Contents) VALUES ('$int', $did, '$type', NULL, '$id', '$user', '$contents')";
				} else{
					$query = "INSERT INTO Discussions (Discussion_ID, Parent_ID, Post_Type, Card_ID, Deck_ID, User_ID, Contents) VALUES ('$int', $did, '$type', '$id', NULL, '$user', '$contents')";
				}
				if (mysqli_query($conn, $query)){
					$msg = "Post Added Successfully";
				} else{
					echo 'ERROR: Could not able to execute $query. ' . mysqli_error($conn);
				}
			}
		}
		
		echo "<form method='post' id='newDiscussionForm'>";
		echo "<fieldset>";
		echo "	<legend>New Post:</legend>";
		echo "    <p>";
		echo "        <label for='Type'>Discussion Type:</label>";
		echo "        <input type='radio' name = 'type' id = 'type' value = 'Deck' checked='checked'> Deck";
		echo "		<input type='radio' name = 'type' id = 'type'value = 'Card'> Card<br>";
		echo "		<input type='hidden' name='action' value='new'>";
		echo "		<input type='hidden' name='did' value='1'>";
		echo "    </p>";
		echo "    <p>";
		echo "        <label for='ID'>Card or Deck ID:</label>";
		echo "        <input type='number' class='required' name = 'id' id = 'id' title = 'Should be within the database'>";
		echo "    </p>";
		echo "    <p>";
		echo "        <label for='Name'>Contents:</label>";
		echo "        <input type='text' class='required' name='contents' id = 'contents' id='contents'>";
		echo "</fieldset>";

		echo "      <p>";
		echo "        <input type = 'submit'  value = 'Submit' />";
		echo "        <input type = 'reset'  value = 'Clear Form' />";
		echo "      </p>";
		echo "</form>";

		$selDiss = $_GET['did'];
		if ($selDiss) {
			$query = "SELECT Discussion_ID, User_ID, Contents FROM Discussions WHERE Discussion_ID = '$selDiss'";
			$queryComments = "SELECT User_ID, Contents FROM Discussions WHERE Parent_ID = '$selDiss'";
			$result = mysqli_query($conn, $query);
			$resultComments = mysqli_query($conn, $queryComments);
			if (!$result) { die("Query to show fields from table failed");}
		// if (!$resultComments) { die("Query to show fields from table failed");}
		//echo "<p>Original Post: ";
			$fields_num = mysqli_num_fields($result);
			echo "<table id='t01' border='1'><tr>";
			echo "<td><b>Original</b></td>";
			echo "</tr>\n";
			while($row = mysqli_fetch_row($result)) {
			// echo "<tr onclick='cardClicked(this)'>";
				echo "<tr>";
				foreach($row as $cell)
					echo "<td>$cell</td>";
			//echo "<td onclick='addCardClicked(this)'><button>add1</button></td>";
			//echo "<td onclick='removeCardClicked(this)'><button>remove1</button></td>";
				echo "</tr>\n";
			}
		//foreach(mysqli_fetch_row($result) as $cell)
			//echo "$cell, ";
		//echo "</p>";
		//echo "<p>Comments: ";
			$fields_num = mysqli_num_fields($resultComments);
			echo "<table id='t01' border='1'><tr>";
			echo "<td><b>Comments</b></td>";
			echo "</tr>\n";
			while($row = mysqli_fetch_row($resultComments)) {
			// echo "<tr onclick='cardClicked(this)'>";
				echo "<tr>";
				foreach($row as $cell)
					echo "<td>$cell</td>";
			//echo "<td onclick='addCardClicked(this)'><button>add1</button></td>";
			//echo "<td onclick='removeCardClicked(this)'><button>remove1</button></td>";
				echo "</tr>\n";
			}
		//echo "Got to Make Comment Section";
			$queryIn = "SELECT * FROM Discussions WHERE Discussion_ID = '$selDiss'";
		//echo "Made query";
			$res = mysqli_query($conn, $queryIn);
		//echo "Finished Query";
			$row = mysqli_fetch_row($res);
		//echo "Fetched results";
			$newtype = $row[2];
			$newcid = $row[3];
			$newdid = $row[4];
			$sub = $newcid;
			if($newtype == "Deck"){
				$sub = $newdid;
			}
			echo "Form";
			echo "<form method='post' id='newDiscussionForm'>";
			echo "<fieldset>";
			echo "	<legend>New Post:</legend>";
			echo "    <p>";
			echo "        <input type='hidden' name = 'type' value = '$type'>";
			echo "		<input type='hidden' name='action' value='comment'>";
			echo "		<input type='hidden' name='did' value='$selDiss'>";
			echo "    </p>";
			echo "    <p>";
			echo "        <input type='hidden' name = 'id' value = '$sub'>";
			echo "    </p>";
			echo "    <p>";
			echo "        <label for='Name'>Contents:</label>";
			echo "        <input type='text' class='required' name='contents' id = 'contents' id='contents'>";
			echo "</fieldset>";

			echo "      <p>";
			echo "        <input type = 'submit'  value = 'Submit' />";
			echo "        <input type = 'reset'  value = 'Clear Form' />";
			echo "      </p>";
			echo "</form>";
		}

	}

	mysqli_free_result($result);
	mysqli_close($conn);
	?>

	<main>
	</main>

	<?php include("footer.php"); ?>
	<section>
		<h2> <?php echo $msg; ?> </h2>


	</body>
	</html>