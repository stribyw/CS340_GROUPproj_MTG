<?php session_start(); ?>

<!DOCTYPE html>

<?php
    $currentpage="My Trades";
    include("header.php");
    include("db_connect.php");

    if (!isset($_SESSION["User_ID"])) {
        echo "<p>Please log in</p>";
    } else {
        echo "<div class='two-row'>";
            echo "<div class='two-column'>";
                echo "<section class='todo'>";
                    echo "<h2>All trades</h2>";
                    $query = "SELECT * FROM Trades";
                    $result = mysqli_query($conn, $query);
                    if (!$result) {
                        die("Query to show fields from table failed");
                    }

                    // get number of columns in table
                    $fields_num = mysqli_num_fields($result);
                    echo "<table id='t01' border='1'>";
                        echo "<tr>";
                            // printing table headers
                            for($i=0; $i<$fields_num; $i++) {
                                $field = mysqli_fetch_field($result);
                                echo "<td><b>$field->name</b></td>";
                            }
                        echo "</tr>\n";
                        while($row = mysqli_fetch_row($result)) {
                            echo "<tr>";
                                foreach($row as $cell)
                                    echo "<td onclick='tradeClicked(this)'>$cell</td>";
                            echo "</tr>\n";
                        }
                    echo "</table>";
                echo "</section>";
            echo "</div>";
            
            $selectedTrade = $_GET['tid'];
            if ($selectedTrade) {
                echo "<div class='two-column'>";
                    echo "<section class='todo'>";
                        echo "<h2>Haves</h2>";
                        $query = "SELECT * FROM Trade_Have WHERE Trade_ID = '$selectedTrade'";
                        $result = mysqli_query($conn, $query);
                        if (!$result) {
                            die("Query to show fields from table failed");
                        }

                        // get number of columns in table
                        $fields_num = mysqli_num_fields($result);
                        echo "<table id='t01' border='1'>";
                            echo "<tr>";
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
                        echo "</table>";
                        
                        echo "<h2>Wants</h2>";
                        $query = "SELECT * FROM Trade_Want WHERE Trade_ID = '$selectedTrade'";
                        $result = mysqli_query($conn, $query);
                        if (!$result) {
                            die("Query to show fields from table failed");
                        }

                        // get number of columns in table
                        $fields_num = mysqli_num_fields($result);
                        echo "<table id='t01' border='1'>";
                            echo "<tr>";
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
                        echo "</table>";
                    echo "</section>";
                echo "</div>";
            }
        echo "</div>";
    }
?>

<?php include("footer.php"); ?>