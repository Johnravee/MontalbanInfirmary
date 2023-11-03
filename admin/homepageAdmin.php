<?php 

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
    <title>ADMINISTRATION | Montalban Infirmary</title>
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../style/adminHomepage.css?v=?<?php echo time() ?>">
    <!-- JS -->
    <script defer src="../Javascript/adminHome.js?v=<?php echo time() ?>"></script>

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
    <header class="d-flex justify-content-between align-items-center w-100 p-5">
        <h1 class="text-white" id="tittle">Montalban Infirmary</h1>

    </header>




    <div class="cont d-flex flex-row w-100">
        <aside class="sideBard w-25 p-5">
            <div class="wrapper d-flex justify-content-evenly align-items-center w-100 h-100 flex-column">
                <h2 class="text-white fs-1">Menu</h2>

                <div class="btns w-100 p-3">
                    <a href="appointmentAdmin.php">
                        <div class="btn btn-primary text-uppercase p-3 w-100">Appointments</div>
                    </a>
                </div>

                <div class="btns w-100 p-3">
                    <a href="approvalAdmin.php">
                        <div class="btn btn-primary text-uppercase p-3 w-100">approvals</div>
                    </a>
                </div>

                <div class="btns w-100 p-3">
                    <a href="accountCentre.php">
                        <div class="btn btn-primary text-uppercase p-3 w-100">account center</div>
                    </a>
                </div>

                <div class="btns w-100 p-3">
                    <a href="adminReg.php">
                        <div class="btn btn-primary text-uppercase p-3 w-100">Add new admin</div>
                    </a>
                </div>

                <div class="btns w-100 p-3">
                    <a href="docReg.php">
                        <div class="btn btn-primary text-uppercase p-3 w-100">Add new Doctor</div>
                    </a>
                </div>

                <div class="btns w-100 p-3">
                    <a href="#">
                        <div class="btn btn-primary text-uppercase p-3 w-100">??????????</div>
                    </a>
                </div>



            </div>
        </aside>

        <main class="d-flex align-items-center flex-column justify-content-center">
            <img src="../Images/logo.png" alt="logo">
            <h1 class="mb-5">ADMINISTRATION</h1>

            <div class="adminName border-bottom border-2 border-dark w-50 text-center mb-2">
                <h4><?php echo $_SESSION['adminName']; ?></h4>
            </div>

            <small class="p-1">ADMIN</small>

            <div class="bt w-50 mt-5">
                <a href="adminProfile.php"><button class="btn btn-primary w-100 fs-4 mb-1">Profile</button></a>
                <a href="../public/userLogOut.php">
                    <button class="btn btn-danger fs-4 w-100" type="button">Log
                        out</button>
                </a>
            </div>
        </main>
    </div>



</body>

</html>