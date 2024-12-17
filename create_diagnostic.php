<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['Description'];
    

    $sql = "INSERT INTO diagnostic (Describ) 
            VALUES ('$description')";

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
    <title>Create Diagnostic</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Create New Diagnostic</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="Description" class="form-label">Description</label>
                <input type="text" class="form-control" id="Description" name="Description" required>
            </div>
            
           
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
