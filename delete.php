<?php
include("database.php"); // Include database connection

if (isset($_GET['id'])) {
    $patientNum = $_GET['id']; // Get the ID from the request

    // Prepare the DELETE query
    $sql = "DELETE FROM patient WHERE NumPatient = $patientNum";
    $reslut = mysqli_query($connection, $sql);

    
}
header("location: ./index.php");
exit;
?>