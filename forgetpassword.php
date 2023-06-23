<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Runo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
<?php
  include('header.php')
?>
  <section>
        <div class="container">
          <div class="forget-password d-flex justify-content-center align-items-center" style="height: 500px;">
              <form method="POST" action="#" enctype="multipart/form-data">
               <div class="forgetpassword-cols d-grid row-gap-3">
                   <input type="email" placeholder="Username & Email" name="useremail" class="fs-5 fw-light py-2 px-2 text-normal rounded"/>
                   <input type="password" placeholder="New Password" name="newpassword" class="fs-5 fw-light py-2 px-2 text-normal rounded"/>
                   <input type="password" placeholder="Confirm Password" name="newconfirmpassword" class="fs-5 fw-light py-2 px-2 text-normal rounded"/>
                   <input type="submit" name="submit" value="submit" class="fs-5 fw-light py-2 px-2 text-normal rounded-0 border bg-success text-white"/>
               </div>
              </form>
          </div>
        </div>
  </section>

  <?php
  require('connection.php');

       if(isset($_POST['submit'])){
         $username = mysqli_real_escape_string($sqlConnection, $_POST['useremail']);
         $newPassword = mysqli_real_escape_string($sqlConnection, $_POST['newpassword']);
         $confirmPassword = mysqli_real_escape_string($sqlConnection, $_POST['newconfirmpassword']);

         $newpass = password_hash($newPassword, PASSWORD_BCRYPT);

         $userEmailcheck = $sqlConnection->prepare("SELECT * FROM createaccount WHERE Email = ? ");
        $userEmailcheck->bind_param('s', $username);
         $userEmailcheck->execute();
        $rows =  $userEmailcheck->get_result();

         $userCheck = mysqli_num_rows($rows);


         if($userCheck == 1){

             if($newPassword ==  $confirmPassword){
            $updatePassword = $sqlConnection->prepare("UPDATE createaccount SET Password = ?  WHERE Email = ? ");
            $updatePassword->bind_param('ss', $username, $newpass);
            $updatePassword->execute();

            echo "<p> Pasword matching and updating</p>";

            $from = $username;
            $to = "uttampun62@gmail.com, uttampun50@gmail.com";
            $subject = "Password Reset Notification";
            $message = "Your new password has been updated" . ' ' . $newpass;
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: " . $from . "\r\n";
            $mail = mail($to, $subject, $message, $headers, "-smtp smtp.gmail.com -port 587");

             if($mail){
                echo "Password Sent to your website";
             }else{
                echo "Password could not sent.";
             }

           }else{
             echo "Password are not matching";
           }
         }
          $userEmailcheck->close();
          $updatePassword->close();
       }

  ?>
</body>
</html>