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
    <link rel="stylesheet" href="../style/appointmentAdmin.css?v=<?php echo time() ?>">

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

    <main class="h-auto bg-dark w-100 bg-light d-flex justify-content-center align-items-center flex-column">

        <div class="Pendings h-100 w-100 d-flex justify-content-start flex-column p-5 ">
            <div class="accordion-item show">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        List of pending appointments
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour"
                    data-bs-parent="#accordion">
                    <div class="accordion-body bg-dark">
                        <table
                            class="table text-white table-responsive table-dark table-sm w-100 text-center table-sm table align-middle table-bordered">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Concerns</th>
                                    <th scope="col">Consultant</th>
                                    <th scope="col">Date and Time</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
            $stmt = "SELECT * FROM appointments WHERE stat = 'Processing'";
            $result = $conn->query($stmt);

            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>". $row["patient"] ."</td>";
              echo "<td>". $row["email"] ."</td>";
              echo "<td>". $row["contact"] ."</td>";
              echo "<td>". $row["concerns"] ."</td>";
              echo "<td>". $row["consultant"] ."</td>";
              echo "<td>". $row["date_time"] ."</td>";
              echo "<td class='badge bg-primary m-1'>". $row["stat"] ."</td>";
              echo "</tr>";
            }
            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <!-- Approved -->
        <div class="Approved overflow-auto w-100 d-flex justify-content-start flex-column p-5">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        List of approved appointments
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordion">
                    <div class="accordion-body bg-dark">
                        <table
                            class="table table-responsive table-sm w-100 table-dark text-center table-sm table align-middle table-bordered">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Concerns</th>
                                    <th scope="col">Consultant</th>
                                    <th scope="col">Date and Time</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
            $stmt = "SELECT * FROM appointments WHERE stat = 'Approved'";
            $result = $conn->query($stmt);

            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>". $row["patient"] ."</td>";
              echo "<td>". $row["email"] ."</td>";
              echo "<td>". $row["contact"] ."</td>";
              echo "<td>". $row["concerns"] ."</td>";
              echo "<td>". $row["consultant"] ."</td>";
              echo "<td>". $row["date_time"] ."</td>";
              echo "<td class='badge bg-success m-1'>". $row["stat"] ."</td>";
              echo "</tr>";
            }
            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cancelled -->
        <div class="accordion overflow-auto w-100 d-flex justify-content-start flex-column p-5">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        List of cancelled appointments
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordion">
                    <div class="accordion-body bg-dark">
                        <table
                            class="table table-responsive table-sm w-100 table-dark text-center table-sm table align-middle table-bordered">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Concerns</th>
                                    <th scope="col">Consultant</th>
                                    <th scope="col">Date and Time</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
            $stmt = "SELECT * FROM appointments WHERE stat = 'Cancelled'";
            $result = $conn->query($stmt);
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>". $row["patient"] ."</td>";
              echo "<td>". $row["email"] ."</td>";
              echo "<td>". $row["contact"] ."</td>";
              echo "<td>". $row["concerns"] ."</td>";
              echo "<td>". $row["consultant"] ."</td>";
              echo "<td>". $row["date_time"] ."</td>";
              echo "<td class='badge bg-danger m-1'>". $row["stat"] ."</td>";
              echo "</tr>";
            }
            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- Expired -->
        <div class="accordion w-100 h-100 p-5">
            <div class="accordion-item">
                <h2 class="accordion-header " id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        List of expired appointments
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#accordion">
                    <div class="accordion-body bg-dark">
                        <table
                            class="table table-responsive table-dark table-sm w-100 text-center table-sm table align-middle table-bordered">
                            <thead class="text-uppercase">
                                <tr>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Concerns</th>
                                    <th scope="col">Consultant</th>
                                    <th scope="col">Date and Time</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
            $expired = "SELECT * FROM appointments WHERE stat = 'Expired'";
            $result = $conn->query($expired);
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>". $row["patient"] ."</td>";
              echo "<td>". $row["email"] ."</td>";
              echo "<td>". $row["contact"] ."</td>";
              echo "<td>". $row["concerns"] ."</td>";
              echo "<td>". $row["consultant"] ."</td>";
              echo "<td>". $row["date_time"] ."</td>";
              echo "<td class='badge bg-secondary m-1'>". $row["stat"] ."</td>";
              echo "</tr>";
            }
            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </main>
</body>

</html>