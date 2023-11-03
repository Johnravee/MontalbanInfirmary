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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN REGISTRATION | Montalban Infirmary</title>
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../style/adminReg.css?v=<?php echo time() ?>">

    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
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


    <main class="h-auto w-100">
        <h1 class="pt-5 text-center">REGISTRATION</h1>
        <div class="wrapper d-flex justify-content-center w-100 p-5">

            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" class="form-control p-5 w-50" method="post">
                <div class="input-group  input-group-lg mb-3">
                    <input type="text" class="form-control" name="Surname" placeholder="Surname" required>
                </div>

                <div class="input-group  input-group-lg mb-3">
                    <input type="text" class="form-control" name="Firstname" placeholder="Firstname" required>
                </div>

                <div class="input-group  input-group-lg mb-3">
                    <input type="text" class="form-control" name="Middlename" placeholder="Middlename" required>
                </div>

                <div class="input-group  input-group-lg mb-3">
                    <input type="email" class="form-control" name="Email" placeholder="Email address" required>
                </div>

                <div class="input-group  input-group-lg mb-3">
                    <input type="number" class="form-control" name="Contact" placeholder="Contact" required>
                </div>


                <div class="input-group  input-group-lg mb-3">
                    <input type="text" class="form-control" name="Citizenship" placeholder="Citizenship" required>
                </div>

                <div class="input-group  input-group-lg mb-3">
                    <input type="text" class="form-control" name="Address" placeholder="Address" required>
                </div>

                <div class="input-group  input-group-lg mb-3">
                    <input type="text" class="form-control" name="Municipality" placeholder="Municipality" required>
                </div>

                <select name="Sex" class="form-select form-select-lg mb-3">
                    <option selected value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>

                <div class="input-group  input-group-lg mb-3">
                    <input type="password" class="form-control" name="pass" placeholder="Password" required>
                </div>

                <div class="input-group  input-group-lg mb-3">
                    <input type="password" class="form-control" name="cpass" placeholder="Confirm password" required>
                </div>

                <button type="submit" class="btn btn-success w-100 fs-4">Register</button>
            </form>
        </div>
    </main>
</body>

<?php

        try{
            
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $surName = htmlspecialchars(strtoupper($_POST['Surname']));
                $fName = htmlspecialchars(strtoupper($_POST['Firstname']));
                $mName = htmlspecialchars(strtoupper($_POST['Middlename']));
                $email = htmlspecialchars($_POST['Email']);
                $contact = htmlspecialchars($_POST['Contact']);
                $citizen = htmlspecialchars(strtoupper($_POST['Citizenship']));
                $address = htmlspecialchars(strtoupper($_POST['Address']));
                $municipal = htmlspecialchars(strtoupper($_POST['Municipality']));
                $sex = htmlspecialchars(strtoupper($_POST['Sex']));
                $pass = htmlspecialchars($_POST['pass']);
                $cpass = htmlspecialchars($_POST['cpass']);

                if($pass !== $cpass){
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
                 $account_type = "admin";
      
                 $stmt = $conn->prepare("INSERT INTO accounts (Surname, Firstname, Middlename, Email, Contact, Citizenship, place, Munipal_bara, Sex, Passwords, account_type) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssssssss", $surName, $fName, $mName, $email, $contact, $citizen, $address, $municipal, $sex, $hash_pass, $account_type);

            if($stmt->execute()){
                echo "<script defer>
                    const accountCreated = new bootstrap.Modal(document.querySelector('#accountCreated'));
                accountCreated.show();
                </script>";

                unset($surName, $fName, $mName, $email, $contact, $citizen, $address, $municipal, $sex, $pass, $cpass);
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