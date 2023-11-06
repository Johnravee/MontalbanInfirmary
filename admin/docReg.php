<?php
include_once("../database/adminDB.php");
session_start();

if(!isset($_SESSION["adminName"])){
    header("location: ../public/loginPage.php");
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS and Popper.js (for Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <header class="w-100 d-flex justify-content-between p-5">
        <h1 class="text-white" id="tittle">Montalban Infirmary</h1>
        <a href="homepageAdmin.php"><img src="../Images/back.png" alt="back" id="backImg"></a>
    </header>



    <div class="modal" id="accountCreated" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">Account created!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Please proceed to log in page.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary bg-success" onclick="logIn()">Log in</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="createError" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Account creation error!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Sorry we cannot process your account registration.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="emailError" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Email error!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Your email address is already existed, Please provide another email address.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="passwordErr" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Check your passwords</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Your password not matched!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <main class="container mt-4 p-5">
        <h1>Doctor Registration Form</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
            <div class="row mb-3">
                <div class="col">
                    <label for="surname" class="form-label">Surname</label>
                    <input type="text" class="form-control" id="surname" name="surname" required>
                </div>
                <div class="col">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
                <div class="col">
                    <label for="middlename" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middlename" name="middlename">
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="tel" class="form-control" id="contact" name="contact" required>
            </div>

            <div class="mb-3">
                <label for="citizenship" class="form-label">Citizenship</label>
                <input type="text" class="form-control" id="citizenship" name="citizenship" required>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="place" class="form-label">Place</label>
                    <input type="text" class="form-control" id="place" name="place" required>
                </div>
                <div class="col">
                    <label for="munipal_bara" class="form-label">Municipality/Barangay</label>
                    <input type="text" class="form-control" id="munipal_bara" name="munipal_bara" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="sex" class="form-label">Sex</label>
                <select class="form-select" id="sex" name="sex" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="specialization" class="form-label">Specialization</label>
                <input type="text" class="form-control" id="specialization" name="specialization" required>
            </div>


            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" name="department" required>
            </div>


            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Confirm password</label>
                <input type="password" class="form-control" id="password" name="cpassword" required>
            </div>

            <button type="submit" class="btn btn-success">Register</button>
        </form>
    </main>
</body>
<?php
    try{
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $surName = htmlspecialchars(strtoupper($_POST['surname']));
        $fName = htmlspecialchars(strtoupper($_POST['firstname']));
        $mName = htmlspecialchars(strtoupper($_POST['middlename']));
        $email = htmlspecialchars($_POST['email']);
        $contact = htmlspecialchars($_POST['contact']);
        $citizen = htmlspecialchars(strtoupper($_POST['citizenship']));
        $address = htmlspecialchars(strtoupper($_POST['place']));
        $municipal = htmlspecialchars(strtoupper($_POST['munipal_bara']));
        $sex = htmlspecialchars(strtoupper($_POST['sex']));
        $pass = htmlspecialchars($_POST['password']);
        $cpassword = htmlspecialchars($_POST['cpassword']);


        if($pass !== $cpassword) {
            echo "
                        <script>
                            const passwordErr = new bootstrap.Modal(document.querySelector('#passwordErr'));
                    passwordErr.show();
                    cpass.style.borderColor = 'd9534f';

                    setTimeout(()=>{
                        cpass.style.borderColor = null;
                    }, 5000);

                        </script>
                    ";
                      return;
        }

            $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
            $account_type = "doctor";
      
                 $stmt = $conn->prepare("INSERT INTO accounts (Surname, Firstname, Middlename, Email, Contact, Citizenship, place, Munipal_bara, Sex, Passwords, account_type) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssssssss", $surName, $fName, $mName, $email, $contact, $citizen, $address, $municipal, $sex, $hash_pass, $account_type);

            if($stmt->execute()){
                echo "<script defer>
                    const accountCreated = new bootstrap.Modal(document.querySelector('#accountCreated'));
                accountCreated.show();
                </script>";

                unset($surName, $fName, $mName, $email, $contact, $citizen, $address, $municipal, $sex, $pass, $cpass);


                try{
                    $doctorsAccount = "SELECT * FROM accounts WHERE account_type = 'doctor' ORDER BY id DESC LIMIT 1";
                    $query = $conn->query($doctorsAccount);
                    $result = $query->fetch_assoc();
                    
                    if($result){
                        $specialization = htmlspecialchars($_POST['specialization']);
                        $department = htmlspecialchars($_POST['department']);
                        $id = $result["id"];
                        $stmt = $conn->prepare("INSERT INTO doctors_specialization (doctors_id, specialization, department) VALUES (?, ?, ?)");
                        $stmt->bind_param("iss", $id, $specialization, $department);
                        $stmt->execute();
                    }
                }catch(Exception $e){
                    echo $e->getMessage();
                }


        }else{
            echo "<script defer>
                const createError = new bootstrap.Modal(document.querySelector('#createError'));
                createError.show();
            </script>";
        }

    }

    }catch(Exception $e){
        echo $e->getMessage();
    }

     




?>

</html>