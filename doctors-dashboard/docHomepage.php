    <?php
    ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
    ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 7);
    include_once('../database/adminDB.php');
    session_start();
    
        if(!isset($_SESSION['doctorName'])){
             header('location: ../public/loginPage.php');
        }
        

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to Montalban Infirmary</title>
        <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">
        <!-- CSS -->
        <link rel="stylesheet" href="../style/docHomepage.css?v=<?php echo time() ?>">

        <!-- Js -->
        <script defer src="../Javascript/userPage.js"></script>

        <!-- CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

    </head>

    <body>
        <header class="d-flex justify-content-between align-items-center w-100 p-5">
            <h1 class="text-white" id="tittle">Montalban Infirmary</h1>
            <?php
                    if (isset($_SESSION['doctorName'])) {
                        $id = $_SESSION['id'];
                        $select = $conn->query("SELECT img FROM accounts WHERE id = $id");
                        $data = $select->fetch_assoc();
                          $image = $data['img'];

                    // Open the image data as a file
                    $imageInfo = finfo_open(FILEINFO_MIME);

                    if ($imageInfo) {  
                        $imageExtensionType = finfo_buffer($imageInfo, $image);
                        $type = strtok($imageExtensionType, ';');
                        switch ($type) {
                        case "image/jpeg":
                            echo '<img class="border border-primary border-3" src="data:image/jpeg;base64,' . base64_encode($image) . '" id="profile"/>';
                            break;

                        case "image/png":
                            echo '<img class="border border-primary border-3" src="data:image/png;base64,' . base64_encode($image) . '" id="profile"/>';
                            break;

                        case "image/jpg":
                            echo '<img class="border border-primary border-3" src="data:image/jpg;base64,' . base64_encode($image) . '" id="profile"/>';
                            break;

                        default:
                            echo '<img class="border border-primary border-3" src="../Images/profile.png" id="profile"/>';
                            break;
                        }
                      
                    } else {
                        echo '<script>alert("Failed to open fileinfo resource.")</script>';
                    }
                    }
                    ?>
        </header>


        <nav class="navigation">
            <div class="box"></div>
            <ul class="proList w-100 p-2 list-group list-group-flush d-flex justify-content-center align-items-center">
                <li class="list-group-item m-2 list-unstyled"><a href="docProfile.php"
                        class="link-dark text-decoration-none">Profile</a>
                </li>
                <li class="list-group-item m-2 list-unstyled">
                    <a href="../public/userLogOut.php">
                        <button class="btn btn-danger" type="button">Log
                            out</button>
                    </a>
                </li>
            </ul>
        </nav>


        <main class="main w-100 d-flex justify-content-center align-items-center flex-column flex-wrap">
            <div class="mainBox container m-2 p-5">
                <h1 class="display-1 text-center text-white">Welcome,
                    <strong>Dr. <?php echo $_SESSION['doctorName'] ?></strong>
                </h1>
                <h2 class="text-center text-white">What would you like to do?</h2>
                <div class="container d-flex justify-content-evenly align-items-center flex-wrap">
                    <div class="boxex w-25 h-50 m-3">
                        <a href="appointmentChart.php"><button class="btn btn-light w-100 h-100 p-5 text-uppercase">
                                Appointments chart
                            </button></a>
                    </div>
                    <div class="boxex w-50 h-50 m-3">
                        <a href="approvedClient.php"><button class="btn btn-light w-100 h-100 p-5 text-uppercase">
                                Approved Clients</button></a>
                    </div>
                    <div class="boxex w-50 h-50 m-3">
                        <a href="appApproval.php"><button
                                class="btn btn-light w-100 h-100 p-5 text-uppercase">appointments
                                approval</button></a>
                    </div>
                    <div class="boxex w-25 h-50 m-3">
                        <a href="#"><button class="btn btn-light w-100 h-100 p-5 text-uppercase">Online
                                checkups</button></a>
                    </div>
                </div>

                <img src="../Images/logo.png" alt="logo" id="mark" class="position-relative">
            </div>
        </main>
    </body>



    </html>