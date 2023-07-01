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
   <header>
       <nav>
           <div class="header">
                <div class="headerInformation d-flex justify-content-around align-items-baseline py-3" style="background-color: #F18F01;">
                     <div class="info d-flex justify-content-center align-items-center gap-3">
                           <div class="phone">
                              <p>+62 899 7789</p>
                           </div>

                           <div class="time">
                              <p>07:00 - 16:00</p>
                           </div>

                           <div class="address">
                              <p>Manchester, Kentucky 39495</p>
                           </div>
                     </div>
                     <div>

                     </div>
                     <div class="search">
                      <input type="text" placeholder="search" class="text-center py-2 rounded fw-light fs-5" style="border: none;"/>
                     </div>
                </div>
           </div>
           <div class="logoSection" style="background-color: #051951;">
               <div class="logo-row d-flex justify-content-evenly align-items-center py-4">
                    <div class="logo d-flex gap-3">
                        <div class="logo-pic" style="width: 10%;">
                            <img src="./assets/oceanengine.png" style="width: 100%; object-fit:cover;"/>
                        </div>
                         <div class="logo-row-title">
                             <h1 class="text-white fs-3 text-uppercase">Handyman</h1>
                             <p class="text-white fs-6">Expert Interior Design
                         </div>
                    </div>

                    <div class="logo-menu d-flex gap-3 align-items-baseline">

                       <a href="index.php" class="text-decoration-none text-white lh-lg fs-5 fw-normal">Home</a>
                       <a href="#" class="text-decoration-none text-white lh-lg fs-5 fw-normal">About</a>
                       <a href="#" class="text-decoration-none text-white lh-lg fs-5 fw-normal">Contact</a>

                       <?php
                        session_start();
                        if(isset($_SESSION['username'])){

                           $userName = $_SESSION['username'];
                        }

                         if($userName){
                          echo '<p class="text-white fs-5 fw-normal">' . $userName . '</p>';
                          echo '<a href= "logout.php" class="text-white text-decoration-none fs-5 fw-normal">Log out</a>';
                         }
                       ?>

                    </div>
               </div>
           </div>
       </nav>
   </header>
   <script type="text/javascript">
     let sessionValue = '<?php echo $userName?>';
     console.log(sessionValue);
   </script>
</body>
</html>