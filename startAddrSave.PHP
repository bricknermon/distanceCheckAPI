<!-- Author: Brian F.
Purpose: Hobby API project, develop convenient distance checker from "static" starting address. 
I am limited in my programming capabilities, but with the help of ChatGPT, I can create cool stuff : )

Code Purpose: Save user submission to database. This submssion will act as the starting point
for a distance search.-->

<?php
session_start();

//connect to database
$conn = mysqli_connect('host', 'username', 'password', 'database_name');

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['address'])) {
    $address = $_POST['address'];
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO addresses (address, user_id) VALUES ('$address', '$user_id')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Address saved successfully.";
    } else {
        echo "Error saving address.";
    }
}
?>