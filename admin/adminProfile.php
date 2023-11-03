<?php
include_once("../database/adminDB.php");
include_once("../Service/updateProfile.php");
session_start();

if(!isset($_SESSION["adminName"])){
    header("location: ../public/loginPage.php");
}

try{
     $id = $_SESSION['id'];
    $query = "SELECT * FROM accounts WHERE id = $id";
    $stmt = $conn->query($query);
    $row = $stmt->fetch_assoc();
    

}catch(Exception $e){
    echo "".$e->getMessage()."";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Doctor Registration Form | Montalban Infirmary</title>
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../style/docReg.css?v=<?php echo time() ?>">

    <!-- JS -->
    <script defer src="../Javascript/adminProfile.js?v=<?php echo time() ?>"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <header class="w-100 d-flex justify-content-between p-5">
        <h1 class="text-white" id="tittle">Montalban Infirmary</h1>
        <a href="homepageAdmin.php"><img src="../Images/back.png" alt="back" id="backImg"></a>
    </header>



    <main class="container mt-4 p-5">
        <h1>Profile</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
            <div class="row mb-3">
                <div class="col">
                    <label for="surname" class="form-label">Surname</label>
                    <input value="<?php echo $row["Surname"] ?>" type="text" class="form-control" id="surname"
                        name="surname" readonly>
                </div>
                <div class="col">
                    <label for="firstname" class="form-label">First Name</label>
                    <input value="<?php echo $row["Firstname"] ?>" type="text" class="form-control" id="firstname"
                        name="firstname" readonly>
                </div>
                <div class="col">
                    <label for="middlename" class="form-label">Middle Name</label>
                    <input value="<?php echo $row["Middlename"] ?>" type="text" class="form-control" id="middlename"
                        name="middlename" readonly>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input value="<?php echo $row["Email"] ?>" type="email" class="form-control" id="email" name="email"
                    readonly>
            </div>

            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input value="<?php echo $row["Contact"] ?>" type="tel" class="form-control" id="contact" name="contact"
                    readonly>
            </div>

            <div class="mb-3">
                <label for="citizenship" class="form-label">Citizenship</label>
                <input value="<?php echo $row["Citizenship"] ?>" type="text" class="form-control" id="citizenship"
                    name="citizenship" readonly>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="place" class="form-label">Address</label>
                    <input value="<?php echo $row["place"] ?>" type="text" class="form-control" id="place" name="place"
                        readonly>
                </div>
                <div class="col">
                    <label for="munipal_bara" class="form-label">Municipality/Barangay</label>
                    <input value="<?php echo $row["Munipal_bara"] ?>" type="text" class="form-control" id="munipal_bara"
                        name="munipal_bara" readonly>
                </div>
            </div>

            <div class="mb-3">
                <label for="sex" class="form-label">Sex</label>
                <input value="<?php echo $row["Sex"] ?>" type="text" class="form-control" id="sex" name="sex" readonly>
            </div>
            <div class="btn btn-group w-100">
                <button type="button" class="btn btn-primary w-50 fs-4 me-2" onclick="editProfile()">Edit</button>
                <button type="button" class="btn btn-danger w-50 fs-4 me-2" onclick="cancelEdit()">Cancel</button>
                <button type="submit" class="btn btn-success w-50 fs-4" onclick="updateProfile()">Update</button>
            </div>
        </form>
    </main>
</body>

<?php

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        try{
            $surname = strtoupper($_POST["surname"]);
            $firstname = strtoupper($_POST["firstname"]);
            $middlename = strtoupper($_POST["middlename"]);
            $email = $_POST["email"];
            $contact = $_POST["contact"];
            $citizenship = strtoupper($_POST["citizenship"]);
            $address = strtoupper($_POST["place"]);
            $munipal_bara = strtoupper($_POST["munipal_bara"]);
            $id = $_SESSION['id'];

             updateProfileAdmin($conn, $id, $surname, $firstname, $middlename, $email, $contact, $citizenship, $address, $munipal_bara,);

            
        }catch(Exception $e){
            echo $e->getMessage();
        }


    }

?>

</html>