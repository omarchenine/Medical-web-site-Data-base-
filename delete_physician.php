<?php
include("database.php");

if (isset($_GET['id'])) {
    $physicianId = $_GET['id'];

    // Validate if the physicianId is numeric
    if (is_numeric($physicianId)) {
        // Step 1: Delete dependent rows in enteredfile table
        $deleteDependentSql = "DELETE FROM enteredfile WHERE NumMedecin = ?";
        $stmtDeleteDependent = mysqli_prepare($connection, $deleteDependentSql);
        mysqli_stmt_bind_param($stmtDeleteDependent, "i", $physicianId);

        if (mysqli_stmt_execute($stmtDeleteDependent)) {
            // Step 2: Now delete the physician
            $deleteSql = "DELETE FROM Physician WHERE NumMedecin = ?";
            $stmt = mysqli_prepare($connection, $deleteSql);
            mysqli_stmt_bind_param($stmt, "i", $physicianId);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: index.php"); // Redirect to index after deletion
                exit; // Stop further script execution
            } else {
                echo "Error: " . mysqli_error($connection);
            }

            // Close the delete statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Error deleting dependent rows: " . mysqli_error($connection);
        }

        // Close the dependent delete statement
        mysqli_stmt_close($stmtDeleteDependent);
    } else {
        echo "Invalid physician ID.";
    }
}
?>
