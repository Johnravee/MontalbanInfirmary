<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIND A DOCTOR | Montalban Infirmary</title>
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../style/findDoctor.css?v=<?php echo time() ?>">

    <!-- CDN -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
        <a href="homepage.php"><img src="../Images/back.png" alt="back" id="backImg"></a>
    </header>

    <main class=" w-100">
        <section class="imgBackground  w-100 d-flex align-items-center justify-content-center">
            <h1 class="text-dark fs-1">Find your best <span class="display-3">Doctor</span></h1>
        </section>

        <section class="vh-100 w-100  p-5">
            <h2 class='p-5 text-primary'>All Doctors</h2>
            <div class="container-fluid d-flex justify-content-evenly flex-row flex-wrap">

                <?php
                    include_once("../database/adminDB.php");

                    $stmt = $conn->query("SELECT * FROM accounts INNER JOIN doctors_specialization ON accounts.id = doctors_specialization.doctors_id");
                    $row = $stmt->fetch_assoc();
                    
                    echo '<div class="card mb-3 p-2 border-0" style="max-width: 500px;">';
                    echo '<div class="row g-0">';
                    echo '<div class="col-md-4">';
               
                    $image = $row['img'];
                    // Open the image data as a file
                    $imageInfo = finfo_open(FILEINFO_MIME);

                    if ($imageInfo) {  
                        $imageExtensionType = finfo_buffer($imageInfo, $image);
                        $type = strtok($imageExtensionType, ';');
                        switch ($type) {
                        case "image/jpeg":
                            echo '<img class="img-fluid rounded-start" src="data:image/jpeg;base64,' . base64_encode($image) . '" id="profile"/>';
                            break;

                        case "image/png":
                            echo '<img class="img-fluid rounded-start" src="data:image/png;base64,' . base64_encode($image) . '" id="profile"/>';
                            break;

                        case "image/jpg":
                            echo '<img class="img-fluid rounded-start" src="data:image/jpg;base64,' . base64_encode($image) . '" id="profile"/>';
                            break;

                        default:
                            echo '<img class="img-fluid rounded-start" src="../Images/profile.png" id="profile"/>';
                            break;
                        }
                      
                    } else {
                        echo '<script>alert("Failed to open fileinfo resource.")</script>';
                    }
                    
                    echo '</div>';
                    echo '<div class="col-md-8">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['Firstname'] . ' ' . $row['Surname'] . '</h5>';
                    echo '<p class="card-text"><small class="text-muted">' . $row['specialization'] . '</small></p>';
                    echo '<p class="card-text">📞 ' . $row['Contact'] . '</p>';
                    echo '<p class="card-text">' . $row['Sex'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                
                ?>




            </div>
        </section>
    </main>
</body>

</html>