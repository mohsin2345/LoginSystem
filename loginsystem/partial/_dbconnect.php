<?php
$servername = "localhost"; // Your server name
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "users"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn){
//     echo "success";
// }
// else{
    die("error". mysqli_connect_error());
}
?>
