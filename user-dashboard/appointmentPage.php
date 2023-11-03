<?php

include_once("../database/adminDB.php");
session_start();


 if(!isset($_SESSION['user'])){
    header('location: ../public/loginPage.php');
 }

 if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $concerns = $_POST['concerns'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $consultant = $_POST['consultant'];
    $date_time = $_POST['date_time'];
    $refNumber = $_POST['refNumbers'];
    $paymentStat = $_POST['paymentStat'];

    $patient = $_SESSION['firstname']. " " . $_SESSION['surname'];
    $stats = "Processing";
    $newDateTime = new DateTime($date_time);
    $dateTimeFormat = date_format($newDateTime,"Y/m/d H:i:s");


        $stmt = $conn->prepare("INSERT INTO appointments (contact, patient
        ,email, concerns, consultant, date_time, reference_number, payment_stat,stat) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $contact, $patient ,$email, $concerns, $consultant, $dateTimeFormat,
        $refNumber, $paymentStat ,$stats);

        if($stmt->execute()){
        header('location: recentApp.php');
    } else {
        echo "<script>alert('Error: ".$stmt->error."')</script>";
    }
}
   
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an appointment | Montalban Infirmary</title>
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">

    <!-- JS -->
    <script defer src="../Javascript/userAppointment.js?v=<?php echo time() ?>"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="../style/userAppoint.css?v=<?php echo time() ?>">

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
        <a href="userhomePage.php"><img src="../Images/back.png" alt="back" id="backImg"></a>
    </header>


    <!-- Modal -->
    <div class="modal" tabindex="-1" id="schedProb">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">Schedule problem</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>We're not available at weekends or from 5 PM to 9 AM, Sorry.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <main class="bg-light w-100 d-flex justify-content-center align-items-center flex-column">
        <strong class="h3 text-uppercase text-muted m-1">Appointment Form</strong>
        <form class="form-control  w-50 justify-content-evenly align-items-center flex-row p-5 m-1">

            <div class="input-group mb-3">
                <input type="number" id="contactInput" maxlength="11" class="form-control" placeholder="Contact number"
                    aria-label="contact" aria-describedby="contact" required>
                <span class="input-group-text" id="contact">09-000-000-000</span>
            </div>

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Email" aria-label="Email" id="emailInput"
                    aria-describedby="email" required>
                <span class="input-group-text" id="email">example@gmail.com</span>
            </div>

            <div class="concern w-100 mb-3">
                <h3>Concern</h3>
                <textarea class="form-control w-100" id="concerns" placeholder="Leave your concerns here" cols="30"
                    rows="5" required></textarea>
            </div>



            <div class="details w-100 mb-3">
                <div class=" doctors mb-3">
                    <h3>Available Doctors</h3>
                    <select class="form-select w-100" id="consultant" required>
                        <?php
                $stmt = "SELECT * FROM accounts WHERE account_type = 'doctor'";
                $query = $conn->query($stmt);
                
                while($doctor = $query->fetch_assoc()){
                    echo '<option value="'.$doctor["Surname"].'">DR. '.$doctor["Firstname"]." ".$doctor["Surname"].'</option>'; 
                }

            ?>

                    </select>
                </div>

                <div class="date_time mb-3">
                    <h3>Date and Time</h3>
                    <input type="datetime-local" class=" form-control w-100" id="date_time" required>
                </div>

                <div class="button w-100 d-flex justify-content-end">
                    <button type="button" onclick="getForm()" id="submitBtn"
                        class="btn btn-success w-25 m-2 text-uppercase p-3">Submit</button>
                </div>
            </div>
        </form>
    </main>


    <!-- Modal inputs -->
    <div class="modal fade" id="formShow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Submitted successfully, Please take a
                            screenshot to have a proof of appointment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-dark" id="exampleModalLabel">Appointment Details</p>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="contactName">Contact Number</label>
                                    <input type="text" class="form-control" name="contact" id="contactName" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="contactEmail">Contact Email</label>
                                    <input type="email" class="form-control" name="email" id="contactEmail" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="appointmentConcerns">Appointment Concerns</label>
                                    <textarea class="form-control" name="concerns" id="appointmentConcerns" rows="5"
                                        readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="appointmentConsultant">Appointment Consultant</label>
                                    <input type="text" name="consultant" class="form-control" id="appointmentConsultant"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="appointmentDateTime">Appointment Date and Time</label>
                                    <input type="datetime-local" name="date_time" class="form-control"
                                        id="appointmentDateTime" readonly>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="refNumber">Reference No.</label>
                                    <input type="text" name="refNumbers" class="form-control" id="refNumber" readonly>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="paymentStat">Payment status</label>
                                    <input type="text" name="paymentStat" class="form-control" id="paymentStat"
                                        readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Book</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <img src="../Images/logo.png" alt="thubm" id="mark">
</body>

</html>