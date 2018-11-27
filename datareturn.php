<?php

$servername = "127.0.0.1";
$username = "root";
$password = "ITC134a6";
$dbname = "a6";
 
// create connect
$sql = "SELECT DISTINCT * FROM guestbook";
$conn = new mysqli($servername, $username, $password, $dbname);

$result = $conn->query($sql);

// Check connection
if ($conn->connect_error) {
    die("connect fail: " . $conn->connect_error);
} 

if($result->num_rows > 0)
{//show records

    while($row = $result->fetch_assoc())
    {
        echo "<p>";
	   echo "Name: <b>" . $row['name'] . "</b><br />";
       echo "Telephone Number: <b>" . $row['tel'] . "</b><br />";
	   echo "Email: <b>" . $row['email'] . "</b><br />";
        echo '</p>';
        
    }    
 
 
}else{//inform there are no records
    echo '<p>There are currently no contacts</p>';
}

//release web server resources
$result->free_result();

//close connection to mysql
$conn->close();

?>