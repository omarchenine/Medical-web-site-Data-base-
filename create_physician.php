<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];

    // Updated SQL query without PhysicianID
    $sql = "INSERT INTO physician (FirstName, LastName) 
            VALUES ('$firstName', '$lastName')";

    if (mysqli_query($connection, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Physician</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Create New Physician</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="FirstName" class="form-label">First Name</label>
                <input type="text" class="form-control" id="FirstName" name="FirstName" required>
            </div>
            <div class="mb-3">
                <label for="LastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="LastName" name="LastName" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
