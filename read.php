<!DOCTYPE html>
<html lang="en">
<?php
include 'connect.php';

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id = isset($_GET['edt']) ? (int)$_GET['edt'] : 0;
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Article - Singaliner Inc</title>
    <link rel="icon" href="assets/img/singa1 (2).png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/fonts/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/blog-modern.css">
</head>

<body>
    <div class="blog-shell">
        <nav class="navbar navbar-dark navbar-expand-md fixed-top modern-nav">
            <div class="container">
                <a class="navbar-brand" href="index.php">Singaliner <span class="brand-em">Inc.</span></a>
                <button data-toggle="collapse" class="navbar-toggler" data-target="#blogNav" aria-controls="blogNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="blogNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="portfolio.php">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link active" href="blog.php">Blog</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <header class="blog-hero">
            <div class="container">
                <span class="hero-kicker">ARTICLE</span>
                <div>
                    <img class="hero-logo" src="assets/img/singa1%20(2).png" alt="Singaliner logo">
                </div>
                <h1>Read the Full Story</h1>
                <p>Thoughtful updates from our editorial team.</p>
            </div>
        </header>

        <main class="blog-main">
            <div class="container">
                <div class="mb-3">
                    <a class="btn-home" href="blog.php"><i class="la la-arrow-left"></i> More stories</a>
                </div>

                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <article class="article-shell">
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM article,admin WHERE admin.admin_id=article.admin_id AND article.article_id='$id'");
                            $rows = mysqli_num_rows($result);

                            if ($rows > 0) {
                                while ($rows = mysqli_fetch_array($result)) {
                                    ?>
                                    <p class="article-meta mb-2">By <i class="icon-user"></i> <?php echo htmlspecialchars($rows['name'] . ' ' . $rows['surname']); ?> | <?php echo htmlspecialchars($rows['date']); ?></p>
                                    <img class="article-cover" src="author/articles/<?php echo htmlspecialchars($rows['picture']); ?>" alt="<?php echo htmlspecialchars($rows['heading']); ?>">
                                    <h1 class="article-title"><?php echo htmlspecialchars($rows['heading']); ?></h1>
                                    <div class="article-content"><?php echo nl2br(htmlspecialchars($rows['content'])); ?></div>
                                    <?php
                                }
                            } else {
                                ?>
                                <h1 class="article-title">Story not found</h1>
                                <p class="article-content">The article you requested may have been removed.</p>
                                <?php
                            }
                            ?>
                        </article>
                    </div>

                    <div class="col-lg-4">
                        <aside class="related-box">
                            <h2><i class="icon ion-ios-book"></i> More Related Stories</h2>
                            <ol class="related-list">
                                <?php
                                $re = mysqli_query($conn, "SELECT * FROM article WHERE article_id <> '$id' ORDER BY date DESC LIMIT 0,10");
                                $row = mysqli_num_rows($re);

                                if ($row > 0) {
                                    while ($row = mysqli_fetch_array($re)) {
                                        ?>
                                        <li><a href="read.php?edt=<?php echo (int)$row['article_id']; ?>"><?php echo htmlspecialchars($row['heading']); ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ol>
                        </aside>
                    </div>
                </div>
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
                        <h4>Newsroom</h4>
                        <ul class="footer-services">
                            <li>Featured Articles</li>
                            <li>Related Stories</li>
                            <li>Editorial Insights</li>
                            <li>Media Trends</li>
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <h4>Stay Updated</h4>
                        <ul class="footer-contact">
                            <li><i class="icon ion-ios-email"></i> Singaliner@executivemail.co.za</li>
                            <li><i class="icon ion-ios-telephone"></i> +27 78 762 2161</li>
                            <li><i class="icon ion-ios-location"></i> Johannesburg, South Africa</li>
                        </ul>
                        <div class="footer-cta">
                            <p class="mb-1">Want the latest stories and campaign tips?</p>
                            <a class="footer-btn" href="blog.php">Read Latest Posts</a>
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
    <script src="assets/js/site-modern.js"></script>
</body>

</html>
