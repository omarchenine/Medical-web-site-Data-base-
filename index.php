<?php
include("database.php");

// Queries for different tables
$sqlPatients = "SELECT * FROM patient";
$resultPatients = mysqli_query($connection, $sqlPatients);

$sqlPhysicians = "SELECT * FROM physician";
$resultPhysicians = mysqli_query($connection, $sqlPhysicians);

$sqlDiagnostics = "SELECT * FROM diagnostic";
$resultDiagnostics = mysqli_query($connection, $sqlDiagnostics);

$sqlTreatments = "SELECT * FROM treatment";
$resultTreatments = mysqli_query($connection, $sqlTreatments);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container my-5">
        <h2>Hospital Management System</h2>

        <!-- Patients Section -->
        <div class="section-container">
            <h3>Patient Records</h3>
            <a href="./create.php" class="btn btn-primary mb-3" role="button">
                <i class="fas fa-plus"></i> Add New Patient
            </a>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Social Security</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($resultPatients) > 0) {
                            while ($row = mysqli_fetch_assoc($resultPatients)) {
                                echo "<tr>
                                    <td>{$row['NumPatient']}</td>
                                    <td>{$row['NumSocial']}</td>
                                    <td>{$row['FirstName']} {$row['LastName']}</td>
                                    <td><span class='status-stable'>Active</span></td>
                                    <td>
                                        <a href='./edit.php?id={$row['NumPatient']}' class='btn btn-primary btn-sm'>Edit</a> 
                                        <a href='./delete.php?id={$row['NumPatient']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this patient record?\");'>Delete</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No patient records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Physicians Section -->
        <div class="section-container">
            <h3>Medical Staff</h3>
            <a href="./create_physician.php" class="btn btn-primary mb-3" role="button">
                <i class="fas fa-user-md"></i> Add New Physician
            </a>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Staff ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($resultPhysicians) > 0) {
                            while ($row = mysqli_fetch_assoc($resultPhysicians)) {
                                echo "<tr>
                                    <td>{$row['NumMedecin']}</td>
                                    <td>{$row['FirstName']} {$row['LastName']}</td>
                                    <td>General</td>
                                    <td>
                                        <a href='./edit_physician.php?id={$row['NumMedecin']}' class='btn btn-primary btn-sm'>Edit</a> 
                                        <a href='./delete_physician.php?id={$row['NumMedecin']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to remove this physician?\");'>Delete</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No physicians found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Diagnostics Section -->
        <h3>Diagnostics</h3>
        <a href="./create_diagnostic.php" class="btn btn-primary mb-3" role="button">New Diagnostic</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Diagnostic ID</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($resultDiagnostics) > 0) {
                    while ($row = mysqli_fetch_assoc($resultDiagnostics)) {
                        echo "<tr>
                            <td>{$row['NumDiagnostic']}</td>
                            <td>{$row['Describ']}</td>
                            <td>
                                <a href='./edit_diagnostic.php?id={$row['NumDiagnostic']}' class='btn btn-primary btn-sm'>Edit</a> 
                                <a href='./delete_diagnostic.php?id={$row['NumDiagnostic']}' class='btn btn-danger btn-sm'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No diagnostics found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Treatment Section -->
        <h3>Treatments</h3>
        <a href="./create_treatment.php" class="btn btn-primary mb-3" role="button">New Treatment</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Treatment ID</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($resultTreatments) > 0) {
                    while ($row = mysqli_fetch_assoc($resultTreatments)) {
                        echo "<tr>
                            <td>{$row['NumTreatment']}</td>
                            <td>{$row['Describ']}</td>
                            <td>
                                <a href='./edit_treatment.php?id={$row['NumTreatment']}' class='btn btn-primary btn-sm'>Edit</a> 
                                <a href='./delete_treatment.php?id={$row['NumTreatment']}' class='btn btn-danger btn-sm'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No treatments found</td></tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

    <!-- Add Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
