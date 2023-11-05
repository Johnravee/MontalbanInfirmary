<?php
include_once("../database/adminDB.php");
include_once("../Service/updateProfile.php");
session_start();



        
try{
                $id = $_SESSION['id'];
                $stmt = "SELECT * FROM accounts WHERE id = $id";
                $stmt = $conn->query($stmt);
                $row = $stmt->fetch_assoc();



                if(isset($_FILES['profile'])){

                if ($_FILES["profile"]["error"] === 0) {
                    $image = addslashes(file_get_contents($_FILES["profile"]["tmp_name"]));
                    $query = $conn->query("UPDATE accounts SET img = '$image' WHERE id = $id");   
                  } else {header("Refresh:0");}
                  }  

                  
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $surname = $_POST["surname"];
                $firstname = $_POST["firstname"];
                $middlename = $_POST["middlename"];
                $email = $_POST["email"];
                $contact = $_POST["contact"];
                $citizenship = $_POST["citizenship"];
                $location = $_POST["location"];
                $muniBa = $_POST["muniBa"];

                updateDocProfile($conn,$id,$surname,$firstname,$middlename,$email,$contact,$citizenship,$location, $muniBa);
            }
      }catch(Exception $e){
        echo $e->getMessage();
         } 
    
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Montalban Infirmary</title>
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../style/userProfile.css?v=<?php echo time() ?>">
    <!-- JS -->
    <script defer src="../Javascript/userProfile.js?v=<?php echo time() ?>"></script>

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

<body class="overflow-hidden">
    <header class="d-flex justify-content-between align-items-center w-100 p-5">
        <h1 class="text-white" id="tittle">Profile</h1>
        <a href="docHomepage.php"><img src="../Images/back.png" alt="profile" id="profile"></a>
    </header>
    <main class="h-100 w-100 bg-dark d-flex justify-content-around p-3">
        <!-- FORM -->

        <form class="bg-dark  d-flex justify-content-evenly align-items-start flex-row h-100 w-100 "
            action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">


            <div class="bg-white p-5 m-1 d-flex justify-content-center align-items-start flex-column h-100 w-25"
                id="profileDiv">

                <div class="mt-4 mb-4 d-flex justify-content-center w-100 h-50">
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
                            echo '<img class="border border-primary border-3" src="data:image/jpeg;base64,' . base64_encode($image) . '" id="profileDisplay"/>';
                            break;

                        case "image/png":
                            echo '<img class="border border-primary border-3" src="data:image/png;base64,' . base64_encode($image) . '" id="profileDisplay"/>';
                            break;

                        case "image/jpg":
                            echo '<img class="border border-primary border-3" src="data:image/jpg;base64,' . base64_encode($image) . '" id="profileDisplay"/>';
                            break;

                        default:
                             echo '<img class="border border-primary border-3" src="../Images/profile.png" id="profileDisplay"/>';
                            break;
                        }
                        finfo_close($imageInfo);  // Close the fileinfo resource
                    } else {
                        echo '<script>alert("Failed to open fileinfo resource.")</script>';
                    }
                    }
                    ?>
                </div>

                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Edit profile picture</label>
                    <input class="form-control" type="file" name="profile" id="profilePic" accept=".jpg, .jpeg, .png">
                </div>
            </div>


            <div class="bg-white m-1 p-1 h-100 w-50" id="profileDetails" method="post">
                <div class="p-2">

                    <label for="surname">Surname</label>
                    <input type="text" class="inputDetail text-uppercase form-control" name="surname" id="surname"
                        value="<?php echo  $row['Surname'] ?>" readonly />

                    <label for="firstname">Firstname</label>
                    <input type="text" class="inputDetail text-uppercase form-control" name="firstname" id="firstname"
                        value="<?php echo $row['Firstname'] ?>" readonly />
                </div>


                <div class="p-2">
                    <label class="control-label" for="middlename">Middlename</label>
                    <input type="text" class="inputDetail text-uppercase form-control" name="middlename" id="middlename"
                        value="<?php echo $row['Middlename'] ?>" readonly />

                    <label for="email">Email</label>
                    <input type="text" class="inputDetail form-control" name="email" id="email"
                        value="<?php echo $row['Email'] ?>" readonly />
                </div>


                <div class="p-2">
                    <label class="control-label" for="contact">Contact #</label>
                    <input type="text" class="inputDetail text-uppercase form-control" name="contact" id="contact"
                        value="<?php echo $row['Contact'] ?>" readonly />

                    <label for="citizenship p-5">Citizenship</label>
                    <input type="text" class="inputDetail text-uppercase form-control" name="citizenship"
                        id="citizenship" value="<?php echo $row['Citizenship'] ?>" readonly />
                </div>


                <div class="p-2">
                    <label class="control-label" for="location">Location</label>
                    <input type="text" class="inputDetail text-uppercase form-control" name="location" id="location"
                        value="<?php echo $row['place'] ?>" readonly />

                    <label for="muniBa">Municipal/Baranggay</label>
                    <input type="text" class="inputDetail text-uppercase form-control" name="muniBa" id="muniBa"
                        value="<?php echo $row['Munipal_bara'] ?>" readonly />
                </div>

                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-info" onclick="updateInfo()">EDIT</button>
                    <button type="submit" class="btn btn-success" onclick="saveInfo()">SAVE</button>
                </div>


            </div>

        </form>


        <!-- FORM -->

    </main>
</body>

</html>