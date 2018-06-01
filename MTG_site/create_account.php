<!DOCTYPE html>
<?php
        $currentpage="Create Account";
        //include "pages.php";
?>
<html>
  <head>

    <meta charset="utf-8">
    <title>M:TG Exchange</title>
    <!-- This is a 3rd-party stylesheet for Font Awesome: http://fontawesome.io/ -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" media="screen">
    <script type="text/javascript" src="verifyInput.js" > </script>
    <link rel="stylesheet" href="style.css" media="screen">

  </head>
  <body>

    	<?php
        	//include "header.php";
			$msg = "Add the following information to sign up";
        	include 'connectvars.php';

			$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			if (!$conn) {
				die('Could not connect: ' . mysql_error());
			}
			if ($_SERVER["REQUEST_METHOD"] == "POST") {

				$User_ID = mysqli_real_escape_string($conn, $_POST['User_ID']);
				$Name = mysqli_real_escape_string($conn, $_POST['Name']);
				$Email = mysqli_real_escape_string($conn, $_POST['Email']);
				$password = mysqli_real_escape_string($conn, $_POST['password']);

				function generateRandomSalt(){
					return base64_encode(mcrypt_create_iv(12, MCRYPT_DEV_URANDOM));
				}
				$salt = generateRandomSalt();
				$hashPassword = MD5($password.$salt);

				// See if username is already in the table
				$queryIn = "SELECT * FROM User where User_ID='$User_ID' ";
				$resultIn = mysqli_query($conn, $queryIn);
				if (mysqli_num_rows($resultIn)> 0) {
					$msg ="<p><h2>Can't use that username,</h2> $username is already in use!</p>";
				} else {
					// attempt insert query 
					$query = "INSERT INTO User (User_ID, Name, Email, Password_Hash) VALUES ('$User_ID', '$Name', '$Email', '$Password_Hash')";
					if(mysqli_query($conn, $query)){
						$msg = "User added successfully.";
					} else{
						echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
					}
				}
			}
			// close connection
			mysqli_close($conn);
    	?>

    <header>
      <h1><a>Magic: The Gathering Exchange</a></h1>
      <nav>
        <ul class="navbar-list">
          <li class="navbar-item"><a href="home.php">Home</a></li>
          <li class="navbar-item"><a href="account.php">Account</a></li>
          <li class="navbar-item"><a href="/about">Cards</a></li>
          <li class="navbar-item"><a href="/about">Decks</a></li>
          <li class="navbar-item"><a href="/about">Forums</a></li>
          <li class="navbar-item"><a href="/about">Trades</a></li>
          <li class="navbar-item navbar-right"><a href="#">Log out</a></li>
        </ul>
      </nav>

    </header>

    <main>

      <section class="todo">
        <h2>Add the following information to sign up!</h2>
        <div class="todo-body">
            <ul class="todo-list">
            	<li>Username: <input type="text" class="required" name="User_ID" id="User_ID" title="username can be characters and numeric"></li>
            	<li>Name: <input type="text" class="required" name="Name" id="Name"></li>
            	<li>Email: <input type="text" class="required" name="Email" id="Email"></li>
            	<li>Password: <input type="text" class="required" name="password" id="password"></li>
            	<li>Repeat Password: <input type="text" class="required" name="password" id="password"></li>
            	<li><input type="submit" value="Login"></li>
            	<li><input type="reset" value="Clear Form"></li>
        	</ul>
        </div>
      </section>

    </main>

    <footer>
      <div class="copyright">
        Copyright &copy; 2018
      </div>
    </footer>

  </body>
</html>
