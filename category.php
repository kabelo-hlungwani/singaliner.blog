<!DOCTYPE html>
<html lang="en">
<?php
include 'connect.php';

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$menu = isset($_GET['edt']) ? trim($_GET['edt']) : '';
$menuEscaped = mysqli_real_escape_string($conn, $menu);
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Category - Singaliner Inc</title>
    <link rel="icon" href="assets/img/singa1 (2).png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
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
                <span class="hero-kicker">CATEGORY</span>
                <div>
                    <img class="hero-logo" src="assets/img/singa1%20(2).png" alt="Singaliner logo">
                </div>
                <h1><?php echo htmlspecialchars($menu); ?> Stories</h1>
                <p>Focused stories from this category.</p>
            </div>
        </header>

        <main class="blog-main">
            <div class="container">
                <section class="blog-panel">
                    <h2 class="blog-heading"><?php echo htmlspecialchars($menu); ?> Stories</h2>

                    <div class="toolbar">
                        <a class="btn-home" href="index.php"><i class="icon-home"></i> Home</a>
                        <ul class="category-list">
                            <li><a class="category-pill" href="blog.php">All</a></li>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM blog_category");
                            $rows = mysqli_num_rows($result);

                            if ($rows > 0) {
                                while ($rows = mysqli_fetch_array($result)) {
                                    $isActive = ($menu === $rows['category']);
                                    ?>
                                    <li>
                                        <a class="category-pill<?php echo $isActive ? ' active' : ''; ?>" href="category.php?edt=<?php echo urlencode($rows['category']); ?>"><?php echo htmlspecialchars($rows['category']); ?></a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="row">
                        <?php
                        $res = mysqli_query($conn, "SELECT * FROM article,admin WHERE admin.admin_id=article.admin_id AND article.category='$menuEscaped' ORDER BY article.date DESC");
                        $row = mysqli_num_rows($res);

                        if ($row > 0) {
                            while ($row = mysqli_fetch_array($res)) {
                                ?>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <article class="card story-card">
                                        <div class="story-image-wrap">
                                            <img src="author/articles/<?php echo htmlspecialchars($row['picture']); ?>" alt="<?php echo htmlspecialchars($row['heading']); ?>">
                                        </div>
                                        <div class="card-body">
                                            <h3 class="story-title">
                                                <a href="read.php?edt=<?php echo (int)$row['article_id']; ?>"><?php echo htmlspecialchars($row['heading']); ?></a>
                                            </h3>
                                            <p class="story-meta">By <i class="fa fa-user"></i> <?php echo htmlspecialchars($row['name'] . ' ' . $row['surname']); ?></p>
                                            <p class="story-meta"><i class="fa fa-clock-o"></i> <?php echo htmlspecialchars($row['date']); ?></p>
                                        </div>
                                    </article>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-12">
                                <p class="story-meta mb-0">No stories found in this category yet.</p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </section>
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
                        <h4>Categories</h4>
                        <ul class="footer-services">
                            <li>Focused Topics</li>
                            <li>Latest Coverage</li>
                            <li>Editorial Picks</li>
                            <li>Archive Stories</li>
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
