<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Handyman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

<?php include('header.php')?>

    <main>
         <section>
               <div class="container">
                   <div class="login-form d-flex justify-content-center align-items-center w-100 my-5">
                      <div class="form bg-primary p-5 d-grid justify-content-center align-items-center rounded-sm" style="width: 35%;">
                        <h1 class="text-white fw-semibold">Login</h1>
                        <br>
                         <form method="post" action="" enctype="multipart/form-data">
                              <div class="login-grid d-grid row-gap-3 w-100 position-relative">
                                 <input type="email" placeholder="Email" required class="p-1" name="email"/>
                                 <input type="password" placeholder="password" required class="p-1" name="password" id="password"/><i class="fa fa-key" aria-hidden="true" style="position: absolute; left: 85%; top: 34%;" id="viewPassword"></i>
                                 <input type="submit" value="Login" name="login" class="p-1"/>

                                 <div class="create-account d-flex align-items-center justify-content-between">
                                    <a href="forgetpassword.php" class="text-white text-decoration-none fs-6 fw-semibold">Forget Password</a>
                                    <a href="index.php" class="text-danger text-decoration-none fs-6 fw-semibold">Create Account</a>
                                 </div>
                              </div>
                         </form>
                      </div>
                   </div>
               </div>
         </section>
    </main>

    <?php
 require('connection.php');

   session_start();

        if(isset($_POST['login'])){

            $username =  $_POST['email'];
            $password =  $_POST['password'];


            $stmt = $sqlConnection->prepare("SELECT * FROM createaccount WHERE Email = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $rows = $stmt->get_result();

           if(mysqli_num_rows($rows)){

              $checkPassword = mysqli_fetch_assoc($rows);

              $db_password = $checkPassword['Password'];
              $pass_decode = password_verify($password, $db_password);

               $_SESSION['username'] = $checkPassword['Fullname'];

              if($pass_decode){
                ?>
                   <script>
                     location.replace('index.php');
                   </script>

                <?php
              }else{
                echo "password not matching";
              }
           }else{
              echo "Invalid email";
           }

        }
    ?>

    <script type="text/javascript">
      let showPassword = document.getElementById('viewPassword');
      let password = document.getElementById('password');

      showPassword.addEventListener('click', function(){
         if(password.type == "password"){
            password.type = "text";
         }else{
            password.type = "password";
         }
      })

    </script>
</body>
</html>