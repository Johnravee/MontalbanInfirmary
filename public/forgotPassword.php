<?php
include_once("../database/adminDB.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORGOT PASSWORDS | Montalban Infirmary</title>
    <link rel="shortcut icon" href="../Images/logo.png" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../style/header.css?v=<?php echo time() ?>">
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

<body>

    <main class="vh-100 w-100 d-flex justify-content-center align-items-center flex-column">
        <div class="text  pb-5">
            <h2 class="fs-1 text-success">Reset Passwords</h2>
            <h3 class="fs-6 text-muted" id="subTittle">Enter your email to reset your passwords</h3>
        </div>

        <!-- FORM1 -->
        <form class="form1 form-control w-25 p-5 d-flex justify-content-evenly  flex-column" style="box-shadow: 0px 0px 15px 1px rgba(92,184,92,0.75);
-webkit-box-shadow: 0px 0px 15px 1px rgba(92,184,92,0.75);
-moz-box-shadow: 0px 0px 15px 1px rgba(92,184,92,0.75);" method="post">

            <img class="align-self-center" src="../Images/logo.png" style="height:100px;
             width:100px; border-radius:50%;" alt="logo">
            <div class="form-group mt-5">
                <label class="form-label" for="email">Email address</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="Enter your email" />
            </div>
            <button class="btn btn-primary mt-4" type="submit" name="emailValidation">Reset password</button>
        </form>

        <!-- FORM 2 -->
        <form class="form2 d-none form-control w-25 p-5 d-flex justify-content-evenly  flex-column" style="box-shadow: 0px 0px 15px 1px rgba(92,184,92,0.75);
-webkit-box-shadow: 0px 0px 15px 1px rgba(92,184,92,0.75);
-moz-box-shadow: 0px 0px 15px 1px rgba(92,184,92,0.75);" method="post">
            <img class="align-self-center" src="../Images/logo.png" style="height:100px;
             width:100px; border-radius:50%;" alt="logo">
            <div class="form-group">
                <label for="oldPass" class="form-label mt-4">Password</label>
                <input class="form-control" type="password" name="oldPass" id="oldPass" />
            </div>

            <div class="form-group">
                <label for="cpass" class="form-label mt-4">Confirm password</label>
                <input class="form-control" type="password" name="cpass" id="cpass" />
            </div>

            <div class="form-group">
                <label for="newPass" class="form-label mt-4">New password</label>
                <input class="form-control" type="password" name="newPass" id="newPass" />
            </div>

            <button class="btn btn-primary w-100 mt-4" type="submit" name="resetPass">Reset password</button>
        </form>


        <?php 

            #isEmailExisted?
            try{
                if(isset($_POST["emailValidation"])){
                $email = $_POST['email'];

                $stmt = $conn->prepare('SELECT email FROM accounts WHERE email = ?');
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
            echo '<script>
                document.querySelector(".form1").classList.add("d-none");
                document.querySelector(".form2").classList.remove("d-none");
                document.querySelector(".form2").classList.add("d-block");
                document.querySelector("#subTittle").classList.add("d-none");
                
            </script>';
        } else {
            echo '<script>
                alert("Email address not found.");
            </script>';
        }
                }
            }catch(Exception $e){
                echo "".$e->getMessage()."";
            }

            #Reset Passwords
            try{
                    if(isset($_POST["resetPass"])){
                        $oldpass = $_POST["oldPass"];
                        $cpass = $_POST["cpass"];
                        $newPass = $_POST["newPass"];

                        if($oldpass != $cpass){
                            echo '<script>
                                alert("Password not matched.");
                            </script>';
                            return;
                        }
                        $hash_pass = password_hash($newPass, PASSWORD_DEFAULT);
                        $stmt = $conn->prepare('UPDATE accounts SET Passwords = ?');
                        $stmt->bind_param('s', $hash_pass);
                        
                        if($stmt->execute()){
                            header("location: loginPage.php");
                            $conn->close();
                        }
                        
                    }
            }catch(Exception $e){
                echo "".$e->getMessage()."";
            }
        ?>
    </main>
</body>

</html>