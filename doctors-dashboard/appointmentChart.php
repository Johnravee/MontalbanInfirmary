<?php
include_once("../database/adminDB.php");
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
    <title>APPOINTMENT CHART | Montalban Infirmary</title>
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../style/header.css?v=<?php echo time() ?>">

    <!-- JS -->
    <script defer src="../Javascript/appointmentChart.js?v=<?php echo time() ?>"></script>

    <!-- CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>
    <header class="w-100 d-flex justify-content-between p-5">
        <h1 class="text-white" id="tittle">Montalban Infirmary</h1>
        <a href="docHomepage.php"><img src="../Images/back.png" alt="back" id="backImg"></a>
    </header>

    <main class="w-100 h-100 d-flex justify-content-center align-items-center flex-column">
        <h2 class="text-dark p-5">Appointment Chart</h2>
        <table class="table w-75 text-center table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Patient Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Concerns</th>
                    <th scope="col">Consultant</th>
                    <th scope="col">Date and Time</th>
                    <th scope="col">Ref No.</th>
                    <th scope="col">Payment status</th>
                    <th scope="col">Appointment status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                        $consultant = $_SESSION['DrSurname'];
                        $stmt = "SELECT * FROM appointments WHERE consultant = ?";
                        $stmt = $conn->prepare($stmt);
                        $stmt->bind_param("s", $consultant);
                        
                        if($stmt->execute()){
                            $result = $stmt->get_result();
                            while($row = $result->fetch_assoc()){
                                 echo '<td>'.$row['patient'].'</td>';
                                 echo '<td>'.$row['email'].'</td>';
                                 echo '<td>'.$row['contact'].'</td>';
                                 echo '<td>'.$row['concerns'].'</td>';
                                 echo '<td>'.$row['consultant'].'</td>';
                                 echo '<td>'.$row['date_time'].'</td>';
                                 echo '<td>'.$row['reference_number'].'</td>';
                                 echo '<td class ="badge bg-danger m-2">'.$row['payment_stat'].'</td>';
                                 echo '<td class ="stat bg-danger text-white m-2">'.$row['stat'].'</td>';
                            }

                           
                            
                        }
                    ?>
                </tr>
            </tbody>
        </table>
    </main>
</body>

</html>