<?php
//connecting into the database 
 include('../dbconnection/connection.php'); 

// Checking if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];

    // Calculating age based on the date of birth
    $birthDate = new DateTime($dob);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthDate)->y;

    // Performing  server-side validation 
    if (empty($name) || empty($dob) || empty($gender)) {
        die("Please fill in all fields.");
    }

    $sql = "INSERT INTO usersdetails (Name, DateOfBirth, Gender, Age) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sssi", $name, $dob, $gender, $age);

    if ($stmt->execute()) {
        echo "User added successfully.";
        header("Location:../index.php");

    } else {
        echo "Error: " . $db->error;
    }

    $stmt->close();
    $db->close();
} 
?>