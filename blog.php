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
    <title>Blog - Singaliner Inc</title>
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
                <a class="navbar-brand" href="index.php"><img src="assets/img/singa1%20(2).png" alt="Singaliner" class="brand-logo">Singaliner <span class="brand-em">Inc.</span></a>
                <button data-toggle="collapse" class="navbar-toggler" data-target="#blogNav" aria-controls="blogNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="blogNav">
                    <ul class="navbar-nav ml-auto align-items-md-center">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="portfolio.php">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link active" href="blog.php">Blog</a></li>
                        <li class="nav-item"><a class="nav-link nav-cta" href="contact.php">Let&rsquo;s Talk</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <header class="blog-hero">
            <div class="container">
                <span class="hero-kicker">NEWSROOM</span>
                <div>
                    <img class="hero-logo" src="assets/img/singa1%20(2).png" alt="Singaliner logo">
                </div>
                <h1>Stories, Updates, and Insights</h1>
                <p>Fresh content from the Singaliner team.</p>
            </div>
        </header>

        <main class="blog-main">
            <div class="container">
                <section class="blog-panel">
                    <?php
                    $perPage    = 6;
                    $page       = isset($_GET['pg']) ? max(1, (int)$_GET['pg']) : 1;
                    $cntRes     = mysqli_query($conn, "SELECT COUNT(*) AS total FROM article");
                    $cntRow     = mysqli_fetch_assoc($cntRes);
                    $totalPosts = (int)$cntRow['total'];
                    // page 1 = featured(1) + up to $perPage grid; page 2+ = $perPage grid
                    $totalPages = ($totalPosts <= 1) ? 1 : (int)ceil(($totalPosts - 1) / $perPage);
                    $page       = min($page, $totalPages);
                    $gridOffset = 1 + ($page - 1) * $perPage;
                    ?>
                    <div class="section-head">
                        <h2 class="blog-heading">All Stories</h2>
                        <span class="post-count"><?php echo $totalPosts; ?> post<?php echo $totalPosts !== 1 ? 's' : ''; ?></span>
                    </div>

                    <div class="toolbar">
                       
                        <ul class="category-list">
                            <li><a class="category-pill active" href="blog.php">All</a></li>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM blog_category");
                            $rows = mysqli_num_rows($result);

                            if ($rows > 0) {
                                while ($rows = mysqli_fetch_array($result)) {
                                    ?>
                                    <li>
                                        <a class="category-pill" href="category.php?edt=<?php echo urlencode($rows['category']); ?>"><?php echo htmlspecialchars($rows['category']); ?></a>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>

                    <?php
                    // ── Fetch featured (most recent post — always post #1) ──────
                    $fpRes = mysqli_query($conn, "SELECT article.*, admin.name, admin.surname FROM article JOIN admin ON admin.admin_id = article.admin_id ORDER BY article.date DESC LIMIT 1");
                    $fp    = ($fpRes && mysqli_num_rows($fpRes) > 0) ? mysqli_fetch_assoc($fpRes) : null;

                    // ── Fetch paginated grid posts ───────────────────────────────
                    $gridRes   = mysqli_query($conn, "SELECT article.*, admin.name, admin.surname FROM article JOIN admin ON admin.admin_id = article.admin_id ORDER BY article.date DESC LIMIT $perPage OFFSET $gridOffset");
                    $gridPosts = [];
                    if ($gridRes) {
                        while ($gp = mysqli_fetch_assoc($gridRes)) { $gridPosts[] = $gp; }
                    }
                    ?>

                    <?php if ($fp): ?>

                        <?php if ($page === 1):
                            $fpWords   = str_word_count(strip_tags($fp['content']));
                            $fpTime    = max(1, (int)round($fpWords / 200));
                            $fpText    = strip_tags($fp['content']);
                            $fpExcerpt = mb_strlen($fpText) > 200 ? mb_substr($fpText, 0, 200) . '…' : $fpText;
                        ?>
                    <article class="featured-card mb-5 reveal">
                        <div class="featured-img-wrap">
                            <img src="author/articles/<?php echo htmlspecialchars($fp['picture']); ?>" alt="<?php echo htmlspecialchars($fp['heading']); ?>">
                            <span class="story-badge"><?php echo htmlspecialchars($fp['category']); ?></span>
                        </div>
                        <div class="featured-body">
                            <span class="featured-label">&#9733; Featured Story</span>
                            <h2 class="featured-title">
                                <a href="read.php?edt=<?php echo (int)$fp['article_id']; ?>"><?php echo htmlspecialchars($fp['heading']); ?></a>
                            </h2>
                            <p class="story-excerpt"><?php echo htmlspecialchars($fpExcerpt); ?></p>
                            <div class="story-meta mb-3">
                                <i class="fas fa-user"></i> <?php echo htmlspecialchars($fp['name'] . ' ' . $fp['surname']); ?>
                                &nbsp;&middot;&nbsp;
                                <i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($fp['date']); ?>
                                &nbsp;&middot;&nbsp;
                                <i class="fas fa-clock"></i> <?php echo $fpTime; ?> min read
                                &nbsp;&middot;&nbsp;
                                <i class="fas fa-eye"></i> <?php echo number_format((int)$fp['views']); ?> views
                            </div>
                            <a class="story-read-more" href="read.php?edt=<?php echo (int)$fp['article_id']; ?>">Read Story &nbsp;<i class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>
                        <?php endif; ?>

                        <?php if (!empty($gridPosts)): ?>
                    <div class="row">
                        <?php foreach ($gridPosts as $post):
                            $wc      = str_word_count(strip_tags($post['content']));
                            $rt      = max(1, (int)round($wc / 200));
                            $txt     = strip_tags($post['content']);
                            $excerpt = mb_strlen($txt) > 110 ? mb_substr($txt, 0, 110) . '…' : $txt;
                        ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <article class="card story-card reveal">
                                <div class="story-image-wrap">
                                    <img src="author/articles/<?php echo htmlspecialchars($post['picture']); ?>" alt="<?php echo htmlspecialchars($post['heading']); ?>">
                                    <span class="story-badge"><?php echo htmlspecialchars($post['category']); ?></span>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h3 class="story-title">
                                        <a href="read.php?edt=<?php echo (int)$post['article_id']; ?>"><?php echo htmlspecialchars($post['heading']); ?></a>
                                    </h3>
                                    <p class="story-excerpt"><?php echo htmlspecialchars($excerpt); ?></p>
                                    <div class="story-footer">
                                        <p class="story-meta mb-0">
                                            <i class="fas fa-user"></i> <?php echo htmlspecialchars($post['name'] . ' ' . $post['surname']); ?><br>
                                            <i class="fas fa-calendar-alt"></i> <?php echo htmlspecialchars($post['date']); ?> &middot; <i class="fas fa-clock"></i> <?php echo $rt; ?> min &middot; <i class="fas fa-eye"></i> <?php echo number_format((int)$post['views']); ?>
                                        </p>
                                        <a class="story-read-more" href="read.php?edt=<?php echo (int)$post['article_id']; ?>">Read More <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <?php endforeach; ?>
                    </div>
                        <?php endif; ?>

                    <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-newspaper"></i>
                        <p>No stories published yet. Check back soon!</p>
                    </div>
                    <?php endif; ?>

                    <?php if ($totalPages > 1): ?>
                    <nav class="blog-pagination" aria-label="Page navigation">
                        <a class="pg-btn<?php echo $page <= 1 ? ' disabled' : ''; ?>"
                           href="?pg=<?php echo $page - 1; ?>" aria-label="Previous">&lsaquo;</a>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a class="pg-btn<?php echo $i === $page ? ' active' : ''; ?>"
                           href="?pg=<?php echo $i; ?>"><?php echo $i; ?></a>
                        <?php endfor; ?>
                        <a class="pg-btn<?php echo $page >= $totalPages ? ' disabled' : ''; ?>"
                           href="?pg=<?php echo $page + 1; ?>" aria-label="Next">&rsaquo;</a>
                    </nav>
                    <?php endif; ?>
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
                        <h4>Newsroom</h4>
                        <ul class="footer-services">
                            <li>Company Stories</li>
                            <li>Industry Insights</li>
                            <li>Project Updates</li>
                            <li>Announcements</li>
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
