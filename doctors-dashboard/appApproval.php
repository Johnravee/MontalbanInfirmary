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
    <title>APPOINTMENTS APPROVAL| Montalban Infirmary</title>
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../style/header.css?v=<?php echo time() ?>">

    <!-- JS -->
    <script defer src="../Javascript/docApp.js?v=<?php echo time() ?>"></script>

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


    <div class="modal" id="approved" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white">APPOINMENT APPROVED</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>APPROVED SUCCESSFULLY</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <?php
            if(isset($_POST['approve'])){
                $id = $_POST['approve'];
                
                $stat = "Approved";
                $stmt = $conn->prepare('UPDATE appointments SET stat = ? WHERE id = ?');
                $stmt->bind_param('si', $stat, $id);
                if($stmt->execute()){
                        echo "<script defer>
                            const approved = new bootstrap.Modal(document.querySelector('#approved'));
                            approved.show();
                        </script>";

                    
                    header("Refresh:3");
                }else{
                    echo "<script defer>
                           alert('ERROR')
                        </script>";
                }
                
            }else if(isset($_POST["reject"])){
                    $id = $_POST["reject"];
                    $stat = "Rejected";
                    $stmt = $conn->prepare('UPDATE appointments SET stat = ? WHERE id = ?');
                    $stmt->bind_param('si', $stat, $id);
                    $stmt->execute();
                    
                }
        
        ?>

    <main class="h-100 w-100 d-flex justify-content-center align-items-center flex-column">
        <h2 class="p-5 text-white">Pendings</h2>

        <table class="table w-75 text-center table-bordered table-dark">
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
                    <th scope="col">Approval</th>
                    <th scope="col">Reject</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                            //set Philippine timezone
                        date_default_timezone_set('Asia/Manila');
                        $consultant = $_SESSION['DrSurname'];
                        $stats = "Processing";
                        $stmt = $conn->prepare("SELECT * FROM appointments WHERE stat = ? AND consultant = ?");
                        $stmt->bind_param("ss", $stats, $consultant);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while($row = $result->fetch_assoc()){
                        
                            echo "<tr>";
                            echo "<form method='post'>";
                            echo "<td>" . $row["patient"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["contact"] . "</td>";
                            echo "<td>" . $row["concerns"] . "</td>";
                            echo "<td>" . $row["consultant"] . "</td>";
                            echo "<td>" . $row["date_time"] . "</td>";
                            echo "<td>". $row["reference_number"] ."</td>";
                            echo "<td class='payment bg-danger '>". $row["payment_stat"] ."</td>";
                            echo "<td class=' bg-primary '>" . $row["stat"] . "</td>";
                            echo "<td><button type='submit' name='approve' value='" . $row["id"] . "' class='btn btn-success'>Accept</button></td>";
                            echo "<td><button type='submit' name='reject' value='" . $row["id"] . "' class='btn btn-danger'>Reject</button></td>";
                            echo "</form>";
                            echo "</tr>"; 
                             $stmt = $conn->prepare('UPDATE appointments SET stat = "Expired" WHERE date_time < NOW()');
                             $stmt->execute();
                        }
                    
                    ?>
                </tr>
            </tbody>
        </table>
    </main>
</body>

</html>