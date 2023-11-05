<?php 
include_once("../database/adminDB.php");
session_start();

if(!isset($_SESSION["adminName"])){
    header("location: ../public/loginPage.php");
    return;
}
               

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APPOINTMENT APPROVAl | Montalban Infirmary</title>
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../style/approvalAdmin.css?v=<?php echo time() ?>">
    <!-- JS -->
    <script defer src="../Javascript/adminApproval.js?v=<?php echo time() ?>"></script>

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

<body class="bg-dark">
    <header class="w-100 d-flex justify-content-between p-5">
        <h1 class="text-white" id="tittle">Montalban Infirmary</h1>
        <a href="homepageAdmin.php"><img src="../Images/back.png" alt="back" id="backImg"></a>
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
    <!-- To show modal -->
    <?php
    
                 //Update status
                if (isset($_POST['submit'])) {
                    $id = $_POST['submit'];

                    $stmt = "UPDATE appointments SET payment_stat = 'Paid' WHERE id = '$id'";
                    $stmt = $conn->query($stmt);
                    if($stmt){
                        echo "<script defer>
                            const approved = new bootstrap.Modal(document.querySelector('#approved'));
                            approved.show();
                        </script>";

                    
                    header("Refresh:3");
                    }
        }
    ?>

    <main class="h-auto w-100 h-100 d-flex justify-content-center align-items-center flex-column">
        <h1 class="p-4 text-uppercase">appointments</h1>
        <table class="m-3 table  w-75 text-white text-center table-bordered ">
            <h2 class="text-white">List of pending appointments</h2>
            <thead class="text-uppercase">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Concerns</th>
                    <th scope="col">Consultant</th>
                    <th scope="col">Date and Time</th>
                    <th scope="col">Ref No.</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Status</th>
                    <th scope="col">Paid</th>
            </thead>
            <tbody>
                <?php
             //set Philippine timezone
             date_default_timezone_set('Asia/Manila');
             
            $stmt = "SELECT * FROM appointments WHERE stat = 'Approve' AND payment_stat = 'Not Paid'";
            $result = $conn->query($stmt);

            //Iterate through every rows 
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<form method='post'>";
                echo "<td>" . $row["patient"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["contact"] . "</td>";
                echo "<td>" . $row["concerns"] . "</td>";
                echo "<td>" . $row["consultant"] . "</td>";
                echo "<td>" . $row["date_time"] . "</td>";
                echo "<td>". $row["reference_number"] ."</td>";
                echo "<td class=' bg-danger '>". $row["payment_stat"] ."</td>";
                echo "<td class=' bg-primary '>" . $row["stat"] . "</td>";
                echo "<td><button type='submit' name='submit' value='" . $row["id"] . "' class='btn btn-success'>Paid</button></td>";
                echo "</form>";
                echo "</tr>";       
            }
            //Check if the appointment time/date is expired
            $stmt = $conn->prepare('UPDATE appointments SET stat = "Expired" WHERE date_time < NOW()');
            $stmt->execute();          
?>

            </tbody>
        </table>
    </main>
</body>

</html>