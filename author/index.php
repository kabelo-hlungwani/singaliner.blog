<!DOCTYPE html>
<html lang="en" style="font-family: Allerta, sans-serif;">
<?php
session_start();

 include 'connect.php'; 
if(isset($_POST['email']) && isset($_POST['password'])){
 //Assign

$email=$_POST['email'];
$password=md5($_POST['password']);
//check record
$result=mysqli_query($conn,"select * from admin where email='$email'and password='$password'") or die(mysqli_error($conn));
$row=mysqli_fetch_array($result);


if($row !== null && strtolower($row['email'])==strtolower($email) && $row['password']==$password)
{


   
    $_SESSION['email']=$row['email'];
    $email=$_SESSION['email'];
    $_SESSION['admin_id']=$row['admin_id'];
    $id=$_SESSION['admin_id'];
   
    
echo '<script>alert("login successful.");window.location = "dashboard.php";</script>';  
    

}else
{


echo '<script>alert("User not registered with us.");window.location = "index.php";</script>';  
 exit;

}

}

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin panel-Singaliner Inc</title><link rel="icon" href="assets/img/logo.png">
    <link rel="stylesheet" href="include/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Almarai">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arapey">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Archivo+Narrow">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Balthazar">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Barlow">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/line-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/typicons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css">
    <link rel="stylesheet" href="assets/css/-product-features.css">
    <link rel="stylesheet" href="assets/css/animated-services.css">

    <link rel="stylesheet" href="assets/css/Bootstrap-Callout-Info.css">
    <link rel="stylesheet" href="assets/css/cards.css">
    <link rel="stylesheet" href="assets/css/Customizable-Background--Overlay.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/JLX-Fixed-Nav-on-Scroll.css">
    <link rel="stylesheet" href="assets/css/Latest-Events.css">
    <link rel="stylesheet" href="include/css/Login-Box-En.css">
    <link rel="stylesheet" href="include/css/Modern-Contact-Form.css">

    <link rel="stylesheet" href="assets/css/untitled-1.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>
<script>

    
        function validateForm() 
        {
        var uerror=document.getElementById("uerror");
        var perror=document.getElementById("perror");
        

    

        
        if(document.forms["form"]["email"].value=="" && document.forms["form"]["password"].value=="")
        {
        
        uerror.innerHTML="<span style='color:red;,font-family: Alata, sans-serif;''>"+" email address required *</span>"
        perror.innerHTML="<span style='color:red;,font-family: Alata, sans-serif;''>"+" password required *</span>"
       
        
        return false;
        
        }
        else
        {



        if(document.forms["form"]["email"].value=="")
        {
        
        uerror.innerHTML="<span style='color:red;,font-family: Alata, sans-serif''>"+" email address required *</span>"
        
        return false;
        
        }else
        {
         
            uerror.innerHTML="";

        }
  
        
        if(document.forms["form"]["password"].value=="")
        {
        
        perror.innerHTML="<span style='color:red;,font-family: Alata, sans-serif''>"+" password required *</span>"
        
        return false;
        
        }
        else
        {

            perror.innerHTML="";


        }

//
    
        }
        
        }
        </script>
<body>
    <div class="top"></div>
        <div style="height: 500px;margin-top: -8px;background: url(&quot;assets/img/pexels-ono-kosuki-6000150.jpg&quot;) center / cover no-repeat;filter: grayscale(69%);">
        <div class="d-flex justify-content-center align-items-center" style="height:inherit;min-height:initial;width:100%;position:absolute;left:0;background-color:rgba(30,41,99,0.53);">
            <div class="d-flex align-items-center order-12" style="height: 200px;padding-top: 176px;">
                <div class="container">
                    <h1 class="text-center" data-aos="fade-down-right" data-aos-duration="1000" data-aos-delay="1100" data-aos-once="true" style="color: var(--white);font-size: 40px;font-weight: bold;font-family: Barlow, sans-serif;"><img src="assets/img/logo.png" style="height: 147px;filter: contrast(200%) hue-rotate(360deg);"></h1>
                    <h1 class="text-center" data-aos="fade-down-right" data-aos-duration="1000" data-aos-delay="1100" data-aos-once="true" style="color: rgb(242,245,248);font-size: 35px;font-weight: normal;font-family: Barlow, sans-serif;">Singaliner Inc.</h1>
                    <h3 class="text-center" data-aos="fade-down-right" data-aos-duration="1000" data-aos-delay="1000" data-aos-once="true" style="color: rgb(242,245,248);padding-top: 0.25em;padding-bottom: 0.25em;font-weight: normal;font-family: Barlow, sans-serif;font-size: 20px;">"&nbsp; Admin Login Panel."</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column justify-content-center" data-aos="fade-down-right" data-aos-duration="950" data-aos-delay="950" data-aos-once="true" id="login-box" style="margin-bottom: 70px;">
        <div class="login-box-header">
            <h4 style="color: rgb(0,51,127);margin-bottom: 0px;font-weight: 400;font-size: 27px;font-family: Barlow, sans-serif;">Admin login</h4>
        </div>
        <form name="form" action="" onsubmit="return validateForm();" method="post">

        <div class="email-login" style="background-color:#ffffff;">
        <input type="email" class="email-imput form-control" style="margin-top: 10px;font-family: Barlow, sans-serif;"  placeholder="Email" name="email"><span id="uerror" id="email"></span>
        <input type="password" class="password-input form-control" style="margin-top: 10px;font-family: Barlow, sans-serif;" placeholder="Password" name="password" id="password" ><span id="perror"></span>
      </div>
        <div class="submit-row" style="margin-bottom:8px;padding-top:0px;">
        <button class="btn btn-primary btn-block box-shadow" id="submit-id-submit" type="submit" style="background: rgb(0,51,127);border-radius: 0px;font-family: Barlow, sans-serif;">Login</button>
        </form>
        
            <div class="d-flex justify-content-between"></div>
        </div>
        <div id="login-box-footer" style="padding:10px 20px;padding-bottom:23px;padding-top:18px;"></div>
    </div>
    <section>
        <div class="jumbotron" style="margin:0px;padding:0px;"></div>
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/featured-products-slider.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js"></script>
    <script src="assets/js/JLX-Fixed-Nav-on-Scroll.js"></script>
    <script src="assets/js/NewsHeaher.js"></script>
</body>

</html>