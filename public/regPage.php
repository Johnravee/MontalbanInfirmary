<?php

session_start();


if(isset($_SESSION['user'])){
    header('location: ../user-dashboard/userhomePage.php');
 }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Css Link -->
    <link rel="stylesheet" href="../style/registration.css?v=<?php echo time(); ?>">
    <script defer src="../Javascript/reg.js?v=<?php echo time() ?>"></script>
    <link rel="Icon" href="../Images/logo.png">
    <title>Registration | Montalban Infirmary</title>


    <!-- CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>



</head>

<body>


    <header>

        <a href="../public/homepage.php"><img src="../Images/logo.png" alt="Infirmary Logo" id="logo"></a>

        <h1 id="tittle">MONTALBAN INFIRMARY HOSPITAL</h1>

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





    <main class="wrapper">
        <h2>Registration</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <img src="../Images/logo.jpg" alt="stamp" id="stamp">

            <div class="fullName">

                <div class="seperator">
                    <p>Surname</p>
                    <input type="text" name="surname" id="surName" required />
                </div>

                <div class="seperator">
                    <p>Firstname</p>
                    <input type="text" name="firstname" id="firstName" required />
                </div>

                <div class="seperator">
                    <p>Middlename</p>
                    <input type="text" name="middlename" id="middleName" required />
                </div>
            </div>

            <div class="details1">
                <div class="seperator">
                    <p>Email</p>
                    <input type="email" name="email" id="email" required />
                </div>

                <div class="seperator">
                    <p>Contact #</p>
                    <input type="number" maxlength="11" name="contact" id="contact" required />
                </div>

                <div class="seperator">
                    <p>Citizenship</p>
                    <input type="text" name="citizen" id="citizen" required />
                </div>
            </div>


            <div class="details2">

                <div class="seperator w-50">
                    <p>Address</p>
                    <input type="text" name="address" id="address" required />
                </div>

                <div class="seperator">
                    <p>Baranggay/Municipality</p>
                    <input type="text" name="municipal" id="municipal" required />
                </div>

                <div class="w-0 d-flex flex-column align-items-start h-100 justify-content-start" id="sex">
                    <p>Sex</p>
                    <select name="sex" class="form-select shadow-none text-uppercase h-50 w-100">
                        <option selected value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>


            </div>


            <div class="registerSection">
                <div class="seperator">
                    <p>Password</p>
                    <input type="password" name="pass" id="pass" required />
                </div>

                <div class=" seperator">
                    <p>Confirm password</p>
                    <input type="password" name="cpass" id="cpass" oninput="checkPasswordMatch()" required />
                    <small></small>
                </div>

                <div class=" submitBtn">
                    <button type="submit" id="submit">Register</button>
                </div>
            </div>
        </form>
    </main>
    <div class="ocean">
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
</body>

</html>

<?php
include_once("../database/adminDB.php");


try{

   if($_SERVER["REQUEST_METHOD"] == "POST"){
    $surName = htmlspecialchars(strtoupper($_POST['surname']));
    $fName = htmlspecialchars(strtoupper($_POST['firstname']));
    $mName = htmlspecialchars(strtoupper($_POST['middlename']));
    $email = htmlspecialchars($_POST['email']);
    $contact = htmlspecialchars($_POST['contact']);
    $citizen = htmlspecialchars(strtoupper($_POST['citizen']));
    $address = htmlspecialchars(strtoupper($_POST['address']));
    $municipal = htmlspecialchars(strtoupper($_POST['municipal']));
    $sex = htmlspecialchars(strtoupper($_POST['sex']));
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
      $account_type = "client";
      
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
   echo "
   <script defer>
         const emailError = new bootstrap.Modal(document.querySelector('#emailError'));
        emailError.show();
      </script>
      ";
}

?>