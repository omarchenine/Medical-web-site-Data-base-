<?php
    include("database.php");
    $socialNum = "";
    $firstName = "";
    $lastName = "";
    $errorMessage = "";
    $successMessage = "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $socialNum = $_POST["socialNum"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];

        do {
            if (empty($socialNum) || empty($firstName) || empty($lastName)) { 
                $errorMessage = "All the fields are required";
            break;
            }
            $sql = "INSERT INTO patient (NumSocial, FirstName, LastName)
                    VALUES ('$socialNum', '$firstName', '$lastName')";
            $result = mysqli_query($connection, $sql);
            if(!$result){
                $errorMessage = "invalid query";
                break;
            }

            $socialNum = "";
            $firstName = "";
            $lastName = "";

            $successMessage = "Patient Added successfuly";

            header("location: ./index.php"); //redirection
            exit;
        }while(false);
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js
"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Patient</h2>
        
<?php
if (!empty($errorMessage) ) {
echo "
<div class='alert alert-warning alert-dismissible fade show' role='alert'>
<strong>$errorMessage</strong>
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
} ?>
        <form method="post">
        <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Social number</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="socialNum" value="<?php echo $socialNum;  ?>">
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-3 col-form-label">FirstName</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="firstName" value="<?php echo $firstName;  ?>">
    </div>
</div>


<div class="row mb-3">
    <label class="col-sm-3 col-form-label">LastName</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="lastName" value="<?php echo $lastName;  ?>">
    </div>
</div>

<?php
if ( !empty($successMessage) ) {
    echo "
    <div class='row mb-3'>
        <div class='offset-sm-3 col-sm-6'>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        </div>
    </div>
    ";
}
?>

<div class="row mb-3">
    <div class="offset-sm-3 col-sm-3 d-grid">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <div class="col-sm-3 d-grid">
        <a class="btn btn-outline-primary" href="./index.php" role="button">Cancel</a>
    </div>
</div>
        </form>
    </div>
</body>
</html>