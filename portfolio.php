<!DOCTYPE html>
<html lang="en">
<?php
include 'connect.php';

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Gallery - Singaliner Inc</title>
    <link rel="icon" href="assets/img/singa1 (2).png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css">
    <link rel="stylesheet" href="assets/css/site-modern.css">
</head>

<body>
    <div class="site-shell">
        <nav class="navbar navbar-dark navbar-expand-md fixed-top modern-nav">
            <div class="container">
                <a class="navbar-brand" href="index.php"><img src="assets/img/singa1%20(2).png" alt="Singaliner" class="brand-logo">Singaliner <span class="brand-em">Inc.</span></a>
                <button data-toggle="collapse" class="navbar-toggler" data-target="#galleryNav" aria-controls="galleryNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="galleryNav">
                    <ul class="navbar-nav ml-auto align-items-md-center">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                        <li class="nav-item"><a class="nav-link active" href="portfolio.php">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                        <li class="nav-item"><a class="nav-link nav-cta" href="contact.php">Let&rsquo;s Talk</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <header class="site-hero">
            <div class="container">
                <span class="hero-kicker">VISUAL PORTFOLIO</span>
                <div>
                    <img class="hero-logo" src="assets/img/singa1%20(2).png" alt="Singaliner logo">
                </div>
                <h1>Gallery</h1>
                <p>Selected visuals from our projects and moments.</p>
            </div>
        </header>

        <main class="section-wrap">
            <div class="container">
                <section class="panel mb-4">
                    <div class="gallery-section-title">
                        <h2 class="gallery-title">Explore Our Work</h2>
                        <a class="home-btn" href="index.php"><i class="la la-home"></i> Home</a>
                    </div>
                    <p class="panel-sub mb-0">Browse each category and click any image to view it in full size.</p>
                </section>

                <?php
                $result = mysqli_query($conn, "SELECT * FROM gallery_category");
                $rows = mysqli_num_rows($result);

                if ($rows > 0) {
                    while ($rows = mysqli_fetch_array($result)) {
                        $div = $rows['category'];
                        ?>
                        <section class="panel">
                            <div class="gallery-section-title">
                                <h3 class="gallery-title"><?php echo htmlspecialchars($rows['category']); ?></h3>
                            </div>
                            <div class="row gallery-grid">
                                <?php
                                $result1 = mysqli_query($conn, "SELECT * FROM gallery_category,gallery WHERE gallery.section=gallery_category.category AND gallery.section='$div'");
                                $rows1 = mysqli_num_rows($result1);

                                if ($rows1 > 0) {
                                    while ($rows1 = mysqli_fetch_array($result1)) {
                                        ?>
                                        <div class="col-sm-6 col-lg-4 gallery-item">
                                            <a data-fancybox="gallery-<?php echo md5($rows['category']); ?>" href="author/gallery/<?php echo htmlspecialchars($rows1['picture']); ?>">
                                                <img src="author/gallery/<?php echo htmlspecialchars($rows1['picture']); ?>" alt="<?php echo htmlspecialchars($rows['category']); ?>">
                                            </a>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="col-12">
                                        <p class="panel-sub mb-0">No images available in this section yet.</p>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </section>
                        <?php
                    }
                }
                ?>
            </div>
        </main>

        <footer class="modern-footer">
            <div class="footer-top container">
                <div class="row">
                    <div class="col-lg-4 mb-4 mb-lg-0">
                        <div class="footer-brand">
                            <h3>Singaliner Inc.</h3>
                            <p>Creative media, marketing, and business services built to help brands communicate with impact.</p>
                        </div>
                        <div class="social">
                            <a href="#" aria-label="Instagram"><i class="icon ion-social-instagram"></i></a>
                            <a href="#" aria-label="Twitter"><i class="icon ion-social-twitter"></i></a>
                            <a href="#" aria-label="Facebook"><i class="icon ion-social-facebook"></i></a>
                        </div>
                    </div>
                    <div class="col-6 col-lg-2 mb-4 mb-lg-0">
                        <h4>Explore</h4>
                        <ul class="footer-links">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="portfolio.php">Gallery</a></li>
                            <li><a href="blog.php">Blog</a></li>
                            <li><a href="index.php#contact">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-lg-3 mb-4 mb-lg-0">
                        <h4>Gallery</h4>
                        <ul class="footer-services">
                            <li>Category Albums</li>
                            <li>Project Highlights</li>
                            <li>Event Moments</li>
                            <li>Visual Storytelling</li>
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <h4>Contact</h4>
                        <ul class="footer-contact">
                            <li><i class="icon ion-ios-email"></i> Singaliner@executivemail.co.za</li>
                            <li><i class="icon ion-ios-telephone"></i> +27 78 762 2161</li>
                            <li><i class="icon ion-ios-location"></i> Johannesburg, South Africa</li>
                        </ul>
                        <div class="footer-cta">
                            <p class="mb-1">Share your brief and we can craft visuals for your brand.</p>
                            <a class="footer-btn" href="index.php#contact">Book a Creative Session</a>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p class="copyright">Singaliner Inc &copy; 2010-<?php echo date('Y'); ?>. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <button id="scrollTopBtn" class="scroll-top-btn" type="button" aria-label="Scroll to top">
            <i class="fa fa-chevron-up"></i>
        </button>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js"></script>
    <script src="assets/js/site-modern.js"></script>
</body>

</html>
