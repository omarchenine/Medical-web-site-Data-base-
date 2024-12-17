<?php
include("database.php");

if (isset($_GET['id'])) {
    $diagnosticId = $_GET['id'];

    // Validate if the diagnosticId is numeric
    if (is_numeric($diagnosticId)) {
        // Perform the deletion
        $sql = "DELETE FROM Diagnostic WHERE NumDiagnostic = ?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $diagnosticId);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php"); // Redirect to index after deletion
            exit; // Stop further script execution
        } else {
            echo "Error deleting diagnostic: " . mysqli_error($connection);
        }

        // Close the delete statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Invalid diagnostic ID.";
    }
} else {
    echo "No diagnostic ID provided.";
}
?>
