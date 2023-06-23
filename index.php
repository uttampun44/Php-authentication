<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Runo</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

<?php include('header.php'); ?>

        <section class="hero-section">
            <div class="container heroContainer">
                 <div class="hero-container d-flex justify-content-between align-items-center">
                     <div class="hero-title col-sm">
                       <h2 class="text-white fw-bold fs-1 lh-sm">We are the <br>solutions provider<br> <span class="fs-1 fw-bold" style="color: #F18F01;">for all home<span></h2>
                     </div>

                     <div class="signup-form w-50">
                         <h2 class="text-white fw-semibold fs-2">Create account</h2>
                        <form method="post" action="#" enctype="multipart/form-data">
                            <div class="form-container d-grid row-gap-3">
                               <input type="text" placeholder="Full Name" class="w-100 py-2 rounded px-2 fw-light fs-4" style="border: none;" name="fullname" required/>
                               <input type="email" placeholder="Email" class="w-100 py-2 rounded px-2 fw-light fs-4" style="border: none;" name="email" required/>
                                <div class="d-flex align-items-center position-relative form-password">
                                <input type="password" id="password" placeholder="Password" class="w-100 py-2 rounded px-2 fw-light fs-4" style="border: none;" name="password" required>
                                </div>
                                <div class="confirm-password d-flex align-items-center position-relative">
                                <input type="password" id="confirmPassword" placeholder="Confirm Password" class="w-100 py-2 rounded px-2 fw-light fs-4" style="border: none;" name="confirmpassword" required/><i class="fa fa-key" aria-hidden="true" style="position: absolute; left: 95%" onclick="view()" id="view"></i>
                            </div>
                              <div class="comparison">
                                 <p class="fs-5 fw-light lh-sm text-danger" id="comparison"></p>
                              </div>
                               <input type="text" placeholder="Phone Number" class="w-100 py-2 rounded px-2 fw-light fs-4" style="border: none;" name="phone" required/>
                               <input type="submit" value="Create Account" class="py-2 fw-light fs-4 bg-primary text-white rounded" style="border: none;"  name="submit" id="submit"/>
                               <a href="login.php" class="py-2 fw-light fs-4 bg-success text-white rounded text-center text-decoration-none" style="border: none;">Login Account</a>
                            </div>
                        </form>
                     </div>

                 </div>
            </div>
         </section>
<?php

require('connection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['submit'])) {
        $fullname = mysqli_real_escape_string($sqlConnection,  $_POST['fullname']);
        $email =  mysqli_real_escape_string($sqlConnection, $_POST['email']);
        $password = mysqli_real_escape_string($sqlConnection, $_POST['password']);
        $confirmPassword = mysqli_real_escape_string($sqlConnection, $_POST['confirmpassword']);
        $phone = mysqli_real_escape_string($sqlConnection, $_POST['phone']);


        $pass = password_hash($password, PASSWORD_BCRYPT);
        $confirmpass = password_hash($confirmPassword, PASSWORD_BCRYPT);

        $checkEmail =  "SELECT *  FROM createaccount WHERE Email = '$email'";
        $checkQuery = mysqli_query($sqlConnection, $checkEmail);

        if(mysqli_num_rows($checkQuery) > 0){
            echo "email alreay exists";
        }else{

            if($password !== $confirmPassword){
            }else{

            $dataInsert = "INSERT INTO createaccount (Fullname, Email, Password, Confirmpassword, phonenumber)
            VALUES ('$fullname', '$email', '$pass', '$confirmpass', '$phone')";

            $insertQuery = mysqli_query($sqlConnection, $dataInsert);

            if($insertQuery){
                echo "data inserted";
            }else{
                echo "error" .  mysqli_connect_error();
            }
          }
        }
    }
}
?>


         <!-- javascript -->
         <script type="text/javascript">

                function view(){

                    let confirmPassword = document.getElementById('confirmPassword');
                    let views = document.getElementById('view');

                    if(confirmPassword.type === "password"){
                        confirmPassword.type = "text";
                        views.style.color = "red";
                    }else{
                        confirmPassword.type = "password";
                        views.style.color = "black";
                    }
                }

                let comparison = document.getElementById('comparison');
                let showText =  document.querySelector('.comparison');
                let password = document.getElementById('password');

                let submit = document.getElementById('submit');

                submit.addEventListener('click', (event) =>{

                    // event.preventDefault();
                    if(password.value !== confirmPassword.value){
                       comparison.style.color= "red";
                       showText.style.display = "block";
                       comparison.innerHTML = "password not matching"

                    }else{
                        return true;
                    }
                })


         </script>
</body>
</html>