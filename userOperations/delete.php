<?php
 include('../dbconnection/connection.php'); 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = $_GET['id'];

    // Perform the deletion operation in your database
    $sql = "DELETE FROM usersdetails WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Redirect back to the user list page with a success message
        header('Location: ../index.php');
        exit();
    } 
} 
?>