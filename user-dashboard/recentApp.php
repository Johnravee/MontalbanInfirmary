<?php

                include_once("../database/adminDB.php");
                session_start();
                if(!isset($_SESSION['user'])){
                 header('location: ../public/loginPage.php');
                 return;
                  }


                   if(isset($_POST['cancel'])){
                        $id = $_POST['cancel'];
                        $stmt = "UPDATE appointments SET stat = 'Cancelled' WHERE id = $id";
                        $result = $conn->query($stmt);

                        if($result){
                            header("location:".$_SERVER['PHP_SELF']);
                        }
                        return;
                    }

                    else if(isset($_POST['delete'])){
                        $id = $_POST['delete'];
                        $stmt = "DELETE FROM appointments WHERE id = $id";
                        $result = $conn->query($stmt);
                        if($result){
                            header("location:".$_SERVER['PHP_SELF']);
                        }
                        return;
                    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent appointments | Montalban Infirmary</title>

    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">
    <!-- CSS -->
    <link rel="stylesheet" href="../style/recentApp.css?v=<?php echo time()?>">

    <!-- JS -->
    <script defer src="../Javascript/recentAppU.js?v=<?php echo time()?>"></script>

    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
        <a href="userhomePage.php"><img src="../Images/back.png" alt="back" id="backImg"></a>
    </header>



    <main class=" w-100 bg-light d-flex justify-content-center align-items-center flex-column">
        <h3 class="text-center m-2 w-100 text-muted">Recent appointments</h3>

        <div class="container bg-dark h-100 w-auto  m-5 overflow-auto d-flex flex-row flex-wrap">

            <?php 
                //Select appoinments 
                  $patientName = $_SESSION['firstname']." ".$_SESSION['surname'];

                  $stmt = "SELECT * FROM appointments WHERE patient = '$patientName' ORDER BY id DESC";
                  $result = $conn->query($stmt);

                 
               
                  while($data = $result->fetch_assoc()){
                    echo '<form class="h-100 w-auto overflow-auto d-flex flex-row flex-wrap" method="post">';
                    echo '<div class="card m-5 align-self-start" style="width: 20rem; height: auto;">';
                    echo '  <div class="card-body">';
                    echo '    <h5 class="card-title">Appointment Details</h5>';
                    echo ' <p>
                                <button class="btn btn-dark" type="button" data-bs-toggle="collapse" data-bs-target="#concern',$data['id'].'" aria-expanded="false">
                                Concerns
                                 </button>
                            </p>
                            <div class="collapse" id="concern'.$data['id'] .'">
                            <div class="card card-body">
                                ' . $data["concerns"] . '
                            </div>
                            </div> ';
                    echo '    <ul class="list-group list-group-flush">';
                    echo '      <li class="list-group-item fw-bold">Consultant : DR. '.$data["consultant"] . '</li>';
                    echo '      <li class="list-group-item fw-bold dt">Date and Time : '.$data["date_time"] . '</li>';
                    echo '      <li class="list-group-item fw-bold">Patient : '.$data["patient"] . '</li>';
                    echo '      <li class="list-group-item fw-bold">Ref No. : '.$data["reference_number"] . '</li>';
                     if($data["payment_stat"] === "Paid"){
                         echo '      <li class="list-group-item fw-bold">Payment Status : <span class ="badge bg-success">'.$data["payment_stat"].'</span></li>';
                     }else{
                         echo '      <li class="list-group-item fw-bold">Payment Status : <span class ="badge bg-danger">'.$data["payment_stat"].'</span></li>';
                     }
                    echo '    </ul>';
                    echo '    <div class="card-body">';
                    echo '      <span class="card-text">Status : <span class ="badge" id="status">'.$data["stat"].'</span></span>';
                    echo '    </div>';
                   // Check if the status is 'Approved' to decide whether to display the delete button
                    if ($data["stat"] === "Expired" || $data["stat"] === "Rejected" || $data["stat"] === "Cancelled") {
                        // Only display the delete button if the status is not 'Approved'
                        echo '<button type="submit" name="delete" value="' . $data["id"] . '" class="deleteBtn btn btn-danger">Delete</button>';
                    }else if($data['stat'] === "Processing"){
                        echo '<button type="submit" name="cancel" value="' . $data["id"] . '" class="cancelBtn btn btn-danger">Cancel appointment</button>';
                    }
                    else if($data['stat'] === "Approved") {
                        echo '<button type="submit" name="cancel" value="' . $data["id"] . '" class="cancelBtn btn btn-danger" disabled>Cancel appointment</button>';
                    }
                    echo '  </div>';
                    echo '</div>';
                    echo '</form';
                    $stmt = $conn->query('UPDATE appointments SET stat = "Expired" WHERE date_time < NOW()');
                        
                    
                  }
            
            ?>
        </div>
    </main>
    <img src="../Images/logo.png" alt="mark" id="mark">
</body>







</html>