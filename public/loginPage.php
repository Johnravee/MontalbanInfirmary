<?php
include_once("../database/adminDB.php");

session_start();
if (isset($_SESSION['user'])) {
    header('location: ../user-dashboard/userhomePage.php');
}
else if (isset($_SESSION['adminName'])) {
    header('location: ../admin/homepageAdmin.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Icon" href="../Images/logo.png">
    <title>Login account | Montalban Infirmary</title>

    <!-- CSS link  -->
    <link rel="stylesheet" href="../style/Login.css?v=<?php echo time() ?>">

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

    <!-- JS ONLY -->
    <script defer src="../Javascript/login.js?v=<?php echo time() ?>"></script>


    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

</head>

<body>


    <header>

        <a href="../public/homepage.php"><img src="../Images/logo.png" alt="Infirmary Logo" id="logo"></a>

        <h1 id="tittle">MONTALBAN INFIRMARY HOSPITAL</h1>

    </header>


    <div class="modal" id="modalMessage" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Input field is empty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Don't leave a blank input field.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="wrongPass" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Wrong password!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Please check your password</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="wrongEmail" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Email is not found</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Please check your email.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Main Form -->
    <main class="form-container">

        <h2>Log in</h2>
        <div class="form">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">


                <div class="inputSeperator">
                    <p>Email address</p>
                    <input type="email" name="email" required id="email">
                </div>

                <div class="inputSeperator">
                    <p>Password</p>
                    <input type="password" name="password" required id="pass" />
                    <input class="form-check-input" type="checkbox" id="showPass" onclick="showPassword()" />
                    <label class="form-check-label" for="showPass">
                        Show password
                    </label>

                </div>

                <div class="btnForm">
                    <button type="submit" id="login">Log in</button>
                </div>

                <p style=" text-align: center;">Don't have an account? <a href="regPage.php">Register now</a></p>
                <p style=" text-align: center;">
                    <a style="font-size: 1.1em;" href="#">
                        Forgot password?
                    </a>
                </p>
            </form>
        </div>

    </main>

    <div class="ocean">
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
</body>


</html>

<?php
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $hash_pass = password_hash($pass, PASSWORD_DEFAULT);


        $stmt = $conn->prepare("SELECT * FROM accounts WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();


        $hash_pass = $row['Passwords'];
        $account_type = $row['account_type'];
        $passVerify = password_verify($pass, $hash_pass);

        if ($row['Email'] != $email) {
            echo "<script>
          const wrongEmail = new bootstrap.Modal(document.querySelector('#wrongEmail'));
          wrongEmail.show();
        </script>";
            return;
        }

        if (!$passVerify) {
            echo "<script>
           const wrongPass = new bootstrap.Modal(document.querySelector('#wrongPass'));
          wrongPass.show();
        </script>";
            return;
        }


        if ($account_type === "client") {
            if ($passVerify && $row['Email'] == $email) {
                #username
                $_SESSION['user'] = $row['Firstname'] . " " . $row['Surname'];

                
                $_SESSION['id'] = $row['id'];
                $_SESSION['surname'] = $row['Surname'];
                $_SESSION['firstname'] = $row['Firstname'];


                echo "
        <script>window.location.href = '../user-dashboard/userhomePage.php'</script>
        ";
            }
        } else if ($account_type === "admin") {


            if ($passVerify && $row['Email'] == $email) {
                #username
                $_SESSION['adminName'] = $row['Firstname'] . " " . $row['Middlename'] . " " . $row['Surname'];

                #user table in db
                $_SESSION['id'] = $row['id'];
                

                echo "
            <script>window.location.href = '../admin/homepageAdmin.php'</script>
            ";
            }
        } else if ($account_type === "doctor") {
            if ($passVerify && $row['Email'] == $email) {
                    #username
                    $_SESSION['doctorName'] = $row['Firstname'] . " " . $row['Middlename'] . " " . $row['Surname'];
                    $_SESSION['DrSurname'] = $row["Surname"];
                    
                    $_SESSION['id'] = $row['id'];

                    echo "
                <script>window.location.href = '../doctors-dashboard/docHomepage.php'</script>
                ";
        }
        }
    }
} catch (Exception $e) {
    echo "Error";
}











?>