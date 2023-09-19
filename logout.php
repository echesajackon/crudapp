<?php
// Start the session 
session_start();

// Unset or destroy the session variables
session_unset();
session_destroy(); 

// Redirect to the login page 
header('Location: login.php'); 
exit();
?>