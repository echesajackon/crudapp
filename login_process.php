<?php 
 include('./dbconnection/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

// Check if the user exists in the database based on the provided username
$check_sql = "SELECT * FROM users WHERE username = ?";
$check_stmt = $db->prepare($check_sql);
$check_stmt->bind_param("s", $username);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows == 0) {
    //creating a new user if the user doesn't exists 
    $insert_sql = "INSERT INTO users (username, password) VALUES (?,?)";
    $insert_stmt = $db->prepare($insert_sql);
    
    // hashing your password 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $insert_stmt->bind_param("ss", $username, $hashed_password);
    $insert_stmt->execute();
    $insert_stmt->close();
}

//login authentication
$check_sql = "SELECT * FROM users WHERE username = ?";
$check_stmt = $db->prepare($check_sql);
$check_stmt->bind_param("s", $username);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows == 0) {
    echo "User not found. Please register first.";
} else {
    // if user exixts fetch the stored password hash
    $user_row = $check_result->fetch_assoc();
    $stored_password_hash = $user_row['password'];

    // Verify the provided password against the stored hash
    if (password_verify($password, $stored_password_hash)) {
        // if Password is correct; perform the login
        $_SESSION['username'] = $username;
        header('Location: index.php');
    } else {
        // if passwordis incorrect Password is incorrect
        echo "Login failed. Please check your username and password.";
    }
}


// Close prepared statements and the database connection
$check_stmt->close();
$auth_stmt->close();
$db->close();
}
?>