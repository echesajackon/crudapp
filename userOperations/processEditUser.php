<?php
//connecting into the database 
 include('../dbconnection/connection.php'); 
// Checking if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $user_id = filter_var($_POST["id"], FILTER_VALIDATE_INT);
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];

    // Calculating the age based on the date of birth
    $birthDate = new DateTime($dob);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthDate)->y;

    // Performing server-side validation
    if (empty($user_id) || empty($name) || empty($dob) || empty($gender)) {
        die("Please fill in all fields.");
    }

 

    $sql = "UPDATE usersdetails SET Name = ?, DateofBirth = ?, Gender = ?, Age = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssssi", $name, $dob, $gender, $age, $user_id);

    if ($stmt->execute()) {

        header("Location:../index.php");

    } else {
        echo "Error: " . $db->error;
    }

    $stmt->close();
    $db->close();
}