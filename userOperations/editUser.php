<?php
 include('../dbconnection/connection.php'); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit User</h2>
        <?php
        // Check if user ID is provided in the URL
        if (isset($_GET["id"])) {
            $user_id = $_GET["id"];
            
            // Fetch user details from the database 
           
            $sql = "SELECT * FROM usersDetails WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
        ?>
        <form action="processEditUser.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $user["id"]; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user["Name"]; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $user["DateofBirth"]; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male" <?php if ($user["Gender"] == "Male") echo "selected"; ?>>Male</option>
                    <option value="Female" <?php if ($user["Gender"] == "Female") echo "selected"; ?>>Female</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
        <?php
            } else {
                echo "User not found.";
            }

            $stmt->close();
            $db->close();
        } else {
            echo "User ID not provided.";
        }
        ?>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>