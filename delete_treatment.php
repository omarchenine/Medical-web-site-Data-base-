<?php
include("database.php");

if (isset($_GET['id'])) {
    $treatmentId = $_GET['id'];

    // Validate if the treatmentId is numeric
    if (is_numeric($treatmentId)) {
        // Prepare the delete statement to avoid SQL injection
        $sql = "DELETE FROM Treatment WHERE NumTreatment = ?";
        $stmt = mysqli_prepare($connection, $sql);

        // Bind the parameter to the prepared statement
        mysqli_stmt_bind_param($stmt, "i", $treatmentId);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.php"); // Redirect to index after deletion
            exit; // Stop further script execution
        } else {
            echo "Error: " . mysqli_error($connection);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Invalid treatment ID.";
    }
}
?>
