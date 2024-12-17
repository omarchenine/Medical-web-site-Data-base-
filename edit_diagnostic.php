<?php
include("database.php");

// Fetch diagnostic details based on ID
if (isset($_GET['id'])) {
    $diagnosticId = $_GET['id'];

    if (is_numeric($diagnosticId)) {
        $sql = "SELECT * FROM Diagnostic WHERE NumDiagnostic = ?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $diagnosticId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $diagnostic = mysqli_fetch_assoc($result);

        if (!$diagnostic) {
            echo "Diagnostic not found.";
            exit;
        }
    } else {
        echo "Invalid diagnostic ID.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];

    $sql = "UPDATE Diagnostic SET Describ = ? WHERE NumDiagnostic = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "si", $description, $diagnosticId);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php"); // Redirect to index page after successful update
        exit;
    } else {
        echo "Error updating diagnostic: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Diagnostic</title>
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
        <h2>Edit Diagnostic</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea 
                    class="form-control" 
                    id="description" 
                    name="description" 
                    rows="3"
                    required><?php echo htmlspecialchars($diagnostic['Describ']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
