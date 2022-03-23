<!DOCTYPE html>
<html lang="en" style="font-family: Allerta, sans-serif;">
<?php
    include 'connect.php';
 
    // Check connection
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
     
      $menu=$_GET['edt'];
    ?> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blog-Singaliner Inc</title><link rel="icon" href="assets/img/singa1 (2).png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
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
    <link rel="stylesheet" href="assets/css/Animation-Cards-1.css">
    <link rel="stylesheet" href="assets/css/Animation-Cards.css">
    <link rel="stylesheet" href="assets/css/Article-Clean.css">
    <link rel="stylesheet" href="assets/css/Basic-fancyBox-Gallery-v2.css">
    <link rel="stylesheet" href="assets/css/Bootstrap-Callout-Info.css">
    <link rel="stylesheet" href="assets/css/cards.css">
    <link rel="stylesheet" href="assets/css/Customizable-Background--Overlay.css">
    <link rel="stylesheet" href="assets/css/ebs-contact-form-1.css">
    <link rel="stylesheet" href="assets/css/ebs-contact-form.css">
    <link rel="stylesheet" href="assets/css/featured-products-slider-1.css">
    <link rel="stylesheet" href="assets/css/featured-products-slider.css">
    <link rel="stylesheet" href="assets/css/Features-Boxed.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Footer-Clean-1.css">
    <link rel="stylesheet" href="assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/JLX-Fixed-Nav-on-Scroll.css">
    <link rel="stylesheet" href="assets/css/Latest-Events.css">
    <link rel="stylesheet" href="assets/css/Login-Box-En.css">
    <link rel="stylesheet" href="assets/css/Modern-Contact-Form.css">
    <link rel="stylesheet" href="assets/css/NewsHeaher-1.css">
    <link rel="stylesheet" href="assets/css/NewsHeaher.css">
    <link rel="stylesheet" href="assets/css/Newsletter-Subscription-Form.css">
    <link rel="stylesheet" href="assets/css/OcOrato---Contact-Information-bar-line-with-e-mail-link-1.css">
    <link rel="stylesheet" href="assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="assets/css/Projects-Horizontal.css">
    <link rel="stylesheet" href="assets/css/Sidebar-1-1.css">
    <link rel="stylesheet" href="assets/css/Sidebar-1.css">
    <link rel="stylesheet" href="assets/css/Social-Icons.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
    <link rel="stylesheet" href="assets/css/Team-Clean.css">
    <link rel="stylesheet" href="assets/css/untitled-1.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body>
    <div class="top">
        <nav class="navbar navbar-light navbar-expand-md fixed-top" id="navbar-main" style="opacity: 0.95;background: #000000;text-align: center;">
            <div class="container-fluid">
                <div><a class="navbar-brand" href="index.php" style="color: rgba(255,255,255,0.9);font-family: Barlow, sans-serif;">Singaliner <span style="color: rgb(0,51,127);border-color: #003cd0;">Inc.</span></a></div><button class="navbar-toggler" data-toggle="collapse"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"><i class="icon ion-android-menu" style="color: #003cd0;"></i></span></button>
            </div>
        </nav>
    </div>
    <div style="height: 500px;margin-top: -8px;background: url(&quot;assets/img/pexels-ono-kosuki-6000150.jpg&quot;) center / cover no-repeat;filter: grayscale(69%);">
        <div class="d-flex justify-content-center align-items-center" style="height:inherit;min-height:initial;width:100%;position:absolute;left:0;background-color:rgba(30,41,99,0.53);">
            <div class="d-flex align-items-center order-12" style="height: 200px;padding-top: 176px;">
                <div class="container">
                    <h1 class="text-center" data-aos="fade-down-right" data-aos-duration="1000" data-aos-delay="1100" data-aos-once="true" style="color: var(--white);font-size: 40px;font-weight: bold;font-family: Barlow, sans-serif;"><img src="assets/img/singa1%20(2).png" style="height: 147px;filter: contrast(200%) hue-rotate(360deg);"></h1>
                    <h1 class="text-center" data-aos="fade-down-right" data-aos-duration="1000" data-aos-delay="1100" data-aos-once="true" style="color: rgb(242,245,248);font-size: 35px;font-weight: normal;font-family: Barlow, sans-serif;">Singaliner Inc.</h1>
                    <h3 class="text-center" data-aos="fade-down-right" data-aos-duration="1000" data-aos-delay="1000" data-aos-once="true" style="color: rgb(242,245,248);padding-top: 0.25em;padding-bottom: 0.25em;font-weight: normal;font-family: Barlow, sans-serif;font-size: 20px;">"BLOG "</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="padding-top: 40px;">
        <h1 style="font-family: Barlow, sans-serif;font-size: 22px;text-align: center;font-weight: normal;"><?php echo $menu?> Stories</h1>
        <div>
            <div class="container">
                <div class="col"><a class="btn btn-sm" role="button" style="color: rgb(255,255,255);background: #000000;border-radius: 0px;font-family: Barlow, sans-serif;font-size: 14px;" href="index.php"><i class="icon-home"></i>&nbsp;Home</a></div>
                <div class="col">
                    <ul class="list-inline" style="text-align: center;font-size: 15px;font-family: Barlow, sans-serif;">
                     <li class="list-inline-item" style="background: var(--blue);border-radius: 2px;color: rgb(255,255,255);">&nbsp;<a href="blog.php" style="color: rgb(255,255,255);">All</a>&nbsp;</li>
                    <?PHP          
         
         $result=mysqli_query($conn,"SELECT * from blog_category");
         $rows=mysqli_num_rows($result);        
         
         if ($rows>0) {
           
         
        while ($rows=mysqli_fetch_array($result)) {
            
            ?>
                  
 <li class="list-inline-item" style="background: #000000;border-radius: 2px;color: rgb(255,255,255);">&nbsp;<a href="category.php?edt=<?php echo $rows['category']?>" style="color: rgb(255,255,255);"><?php echo $rows['category']?></a>&nbsp;</li>
                        <?php }
         }
                        ?>
                        
                       
                        
                    </ul>
                </div>
                <div class="cust_bloglistintro">
                    <p style="margin-left:34px;color:rgba(255,255,255,0.5);font-size:14px;"></p>
                </div>

              
                <div class="row">

                <?PHP          
         
         $res=mysqli_query($conn,"SELECT * from article,admin where admin.admin_id=article.admin_id AND article.category='$menu' ORDER BY article.date DESC");
         $row=mysqli_num_rows($res);        
         
         if ($row>0) {
           
         
        while ($row=mysqli_fetch_array($res)) {
            
            ?>
                    <div class="col-md-4 cust_blogteaser" style="padding-bottom:20px;margin-bottom:32px;">
                      
         
                    <div class="card">
                            <div class="card-body" style="height: 340px;"><img class="img-fluid" style="height:auto;" src="author/articles/<?php echo $row['picture']?>">
                                <h4 class="card-title" style="font-family: Lora, serif;font-weight: normal;color: #000000;font-size: 16px;margin-top: 3px;"><span style="text-decoration: underline;"><a href="read.php?edt=<?php echo $row['article_id']?>" style="font-family: Lora, serif;font-weight: normal;color: #000000;font-size: 16px;margin-top: 3px;"><?php echo $row['heading']?></a></span></h4>
                                <h6 class="text-muted card-subtitle mb-2" style="margin-top: 0px;font-family: Barlow, sans-serif;"><span style="font-size: 12px;color: rgb(4,4,4);">Author :&nbsp;<i class="fa fa-user"></i>&nbsp;<?php echo $row['name'].' '.$row['surname']?>&nbsp;</span></h6>
                                <h6 class="text-muted card-subtitle mb-2" style="margin-top: 0px;font-family: Barlow, sans-serif;"><span style="font-size: 12px;color: rgb(4,4,4);">&nbsp;<i class="fa fa-clock-o"></i>&nbsp;<?php echo $row['date']?>&nbsp;</span></h6>
                                
                            </div>
                    
                        </div>
        
                        
                    </div>
                            <?php }
         }
                        ?>
                   
                </div>
            </div>
        </div>
    </div>
    <footer class="footer-basic" style="background: rgb(0,0,0);">
        <div class="social"><a href="#" style="background: #ffffff;opacity: 1;"><i class="icon ion-social-instagram" style="color: rgb(0,0,0);font-size: 20px;"></i></a><a href="#" style="background: #ffffff;opacity: 1;font-size: 20px;"><i class="icon ion-social-twitter" style="color: rgb(0,0,0);"></i></a><a href="#" style="font-size: 20px;background: #ffffff;opacity: 1;"><i class="icon ion-social-facebook" style="color: rgb(0,0,0);"></i></a></div>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="index.php" style="color: rgb(255,255,255);font-size: 14px;font-weight: normal;font-family: Barlow, sans-serif;opacity: 1;">Home</a></li>
            <li class="list-inline-item"><a href="portfolio.php" style="color: rgb(255,255,255);font-size: 14px;font-weight: normal;font-family: Barlow, sans-serif;opacity: 1;">Gallery</a></li>
            <li class="list-inline-item"><a href="#" style="color: rgb(255,255,255);font-size: 14px;font-weight: normal;font-family: Barlow, sans-serif;opacity: 1;">Blog</a></li>
            <li class="list-inline-item"><a href="#" style="color: rgb(255,255,255);font-size: 14px;font-weight: normal;font-family: Barlow, sans-serif;opacity: 1;">African Connecting Businesses EXPO</a></li>
        </ul>
        <p class="copyright" style="font-family: Barlow, sans-serif;font-weight: normal;color: rgb(255,255,255);">Singaliner Inc© 2010-<?php echo date('Y')?></p>
    </footer>
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