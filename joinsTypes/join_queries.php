<?php
// Database connection details
$servername = "localhost";
$username = "root"; // default username
$password = ""; // default password (leave blank if not set)
$dbname = "Ainee";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully<br>";
}

// Function to execute and display query results
function executeQuery($conn, $sql, $joinType) {
    echo "<h2>$joinType</h2>";
    $result = $conn->query($sql);
    
    if ($result) {
        if ($result->num_rows > 0) {
            echo "<table border='1'><tr>";
            // Fetch table headers
            while ($field = $result->fetch_field()) {
                echo "<th>{$field->name}</th>";
            }
            echo "</tr>";
            
            // Fetch table rows
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
    } else {
        echo "Error: " . $conn->error;
    }
    echo "<br>";
}

// Queries for different join types
$innerJoinSQL = "SELECT * FROM `students data` INNER JOIN `student fee` ON `students data`.`ID` = `student fee`.`student_id`";
$leftJoinSQL = "SELECT * FROM `students data` LEFT JOIN `student fee` ON `students data`.`ID` = `student fee`.`student_id`";
$rightJoinSQL = "SELECT * FROM `students data` RIGHT JOIN `student fee` ON `students data`.`ID` = `student fee`.`student_id`";
$fullOuterJoinSQL = "SELECT * FROM `students data` LEFT JOIN `student fee` ON `students data`.`ID` = `student fee`.`student_id` UNION SELECT * FROM `students data` RIGHT JOIN `student fee` ON `students data`.`ID` = `student fee`.`student_id`";

// Execute and display results for each join type
executeQuery($conn, $innerJoinSQL, "INNER JOIN");
executeQuery($conn, $leftJoinSQL, "LEFT JOIN");
executeQuery($conn, $rightJoinSQL, "RIGHT JOIN");
executeQuery($conn, $fullOuterJoinSQL, "FULL OUTER JOIN");

// Close connection
$conn->close();
?>
