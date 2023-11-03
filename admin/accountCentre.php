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
    <title>Clients Account | Montalban Infirmary</title>
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../style/clientsAccounts.css?v=<?php echo time() ?>">

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

<body class="h-100 bg-dark">
    <header class="w-100 d-flex justify-content-between p-5">
        <h1 class="text-white" id="tittle">Montalban Infirmary</h1>
        <a href="homepageAdmin.php"><img src="../Images/back.png" alt="back" id="backImg"></a>
    </header>

    <main class="h-100 w-100 d-flex justify-content-center align-items-center flex-column  p-5">

        <h1 class="p-4 text-white">ACCOUNT CENTRE</h1>
        <table class="table  w-100 table-striped text-center table-dark table-bordered border-light table-hover">
            <thead class="text-uppercase">
                <tr>
                    <th scope="col">Profile</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Citizenship</th>
                    <th scope="col">Address</th>
                    <th scope="col">Municipal</th>
                    <th scope="col">Sex</th>
                    <th scope="col">Account Type</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
                try{

                    $stmt = "SELECT * FROM accounts";
                    $query = $conn->query($stmt);

                    
                    
                    while($row = $query->fetch_assoc()){
                        $profile = $row["img"];
                        $imageInfo = finfo_open(FILEINFO_MIME);
                        $imgType = strtok(finfo_buffer($imageInfo, $profile),';');

                       

                        echo " <tr>";
                         if ($imageInfo) {  
                        switch ($imgType) {
                        case "image/jpeg":
                            echo '<td><img class="border border-primary border-3" src="data:image/jpeg;base64,' . base64_encode($profile) . '" id="profileDisplay"/></td>';
                            break;

                        case "image/png":
                            echo '<td><img class="border border-primary border-3" src="data:image/png;base64,' . base64_encode($profile) . '" id="profileDisplay"/></td>';
                            break;

                        case "image/jpg":
                            echo '<td><img class="border border-primary border-3" src="data:image/jpg;base64,' . base64_encode($profile) . '" id="profileDisplay"/></td>';
                            break;

                        default:
                             echo '<td><img class="border border-primary border-3" src="../Images/profile.png" id="profileDisplay"/></td>';
                            break;
                        }
                        finfo_close($imageInfo);  // Close the fileinfo resource
                    } else {
                        echo '<script>alert("Failed to open fileinfo resource.")</script>';
                    }
                        echo '<td>'.$row["Surname"].'</td>';
                        echo '<td>'.$row["Firstname"].'</td>';
                        echo '<td>'.$row["Middlename"].'</td>';
                        echo '<td>'.$row["Email"].'</td>';
                        echo '<td>'.$row['Contact'].'</td>';
                        echo '<td>'.$row['Citizenship'].'</td>';
                        echo '<td>'.$row["place"].'</td>';
                        echo '<td>'.$row['Munipal_bara'].'</td>';
                        echo '<td>'.$row['Sex'].'</td>';
                        echo '<td>'.$row['account_type'].'</td>';
                        echo " </tr>";
                    }

                    


                }catch(Exception $e){
                    echo "".$e->getMessage()."";
                }
                
                ?>

            </tbody>
        </table>

    </main>

</body>

</html>