<?php

$sql = "SELECT * FROM usersdetails";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    $user_details = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $user_details = [];
}
?>
<div class="container">
    <h2>User Details</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Age(Years)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user_details as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['Name']; ?></td>
                    <td><?php echo $user['Gender']; ?></td>
                    <td><?php echo $user['DateofBirth']; ?></td>
                    <td><?php echo $user['Age']; ?></td>
                    <td>
                        <a href="./userOperations/editUser.php?id=<?php echo $user['id']; ?>"
                            class="btn btn-primary">Edit</a>
                        <a href="./userOperations/delete.php?id=<?php echo $user['id']; ?>"
                            class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="./userOperations/addingaUser.php" class="btn btn-primary rounded-circle position-fixed"
            style="bottom: 4rem; right: 4rem;">
            <i class="fa fa-plus"></i>
        </a>
    </div>
</div>