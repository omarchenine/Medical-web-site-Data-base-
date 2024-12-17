<?php
include("database.php");

// Fetch physician details based on ID
if (isset($_GET['id'])) {
    $physicianId = $_GET['id'];

    if (is_numeric($physicianId)) {
        $sql = "SELECT * FROM Physician WHERE NumMedecin = ?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $physicianId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $physician = mysqli_fetch_assoc($result);

        if (!$physician) {
            echo "Physician not found.";
            exit;
        }
    } else {
        echo "Invalid physician ID.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];

    $sql = "UPDATE Physician SET FirstName = ?, LastName = ? WHERE NumMedecin = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $firstName, $lastName, $physicianId);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php"); // Redirect to index page after successful update
        exit;
    } else {
        echo "Error updating physician: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Physician</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
            color: #007bff;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Physician</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="first_name" 
                    name="first_name" 
                    value="<?php echo htmlspecialchars($physician['FirstName']); ?>" 
                    required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="last_name" 
                    name="last_name" 
                    value="<?php echo htmlspecialchars($physician['LastName']); ?>" 
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
