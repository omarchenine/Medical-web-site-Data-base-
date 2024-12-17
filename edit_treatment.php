<?php
include("database.php");

$errorMessage = "";
$successMessage = "";

if (isset($_GET['id'])) {
    $treatmentId = $_GET['id'];

    // Fetch current treatment details
    $sql = "SELECT * FROM Treatment WHERE NumTreatment = '$treatmentId'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $describ = mysqli_real_escape_string($connection, $_POST['Describ']);

        // Update treatment record
        $updateSql = "UPDATE Treatment SET Describ = '$describ' WHERE NumTreatment = '$treatmentId'";

        if (mysqli_query($connection, $updateSql)) {
            $successMessage = "Treatment updated successfully!";
        } else {
            $errorMessage = "Error: " . mysqli_error($connection);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Treatment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Edit Treatment</h2>

        <?php if (!empty($successMessage)) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?php echo $successMessage; ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } ?>

        <?php if (!empty($errorMessage)) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><?php echo $errorMessage; ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } ?>

        <form method="POST">
            <div class="mb-3">
                <label for="Describ" class="form-label">Treatment Description</label>
                <textarea class="form-control" id="Describ" name="Describ" rows="4" required><?php echo $row['Describ']; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
