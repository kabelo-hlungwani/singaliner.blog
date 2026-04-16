<!DOCTYPE html>
<html lang="en">
<?php
include 'connect.php';

function render_article_content($html) {
    $allowedTags = '<p><br><strong><b><em><i><u><ul><ol><li><blockquote><h2><h3><h4><h5><h6><a>';
    $sanitized = strip_tags((string)$html, $allowedTags);

    $sanitized = preg_replace('/\s+on[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $sanitized);
    $sanitized = preg_replace('/\s+href\s*=\s*("\s*(javascript|data):[^"]*"|\'\s*(javascript|data):[^\']*\'|\s*(javascript|data):[^\s>]+)/i', '', $sanitized);

    return $sanitized;
}

function safe_mysqli_query($conn, $sql) {
    try {
        return mysqli_query($conn, $sql);
    } catch (Throwable $e) {
        return false;
    }
}

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id = isset($_GET['edt']) ? (int)$_GET['edt'] : 0;
// Increment view counter
if ($id > 0) {
    safe_mysqli_query($conn, "UPDATE article SET views = views + 1 WHERE article_id = $id");
}
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
                    <a class="btn-home" href="blog.php"><i class="fa fa-arrow-left"></i> More stories</a>
                </div>

                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <article class="article-shell">
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM article, admin WHERE admin.admin_id = article.admin_id AND article.article_id = '$id'");
                            if ($result && mysqli_num_rows($result) > 0) {
                                $art = mysqli_fetch_assoc($result);
                                $wc  = str_word_count(strip_tags($art['content']));
                                $rt  = max(1, (int)round($wc / 200));
                                $viewCount = isset($art['views']) ? (int)$art['views'] : 0;
                                $encodedTitle = urlencode($art['heading']);
                                $encodedUrl   = urlencode('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
                            ?>

                            <!-- Meta bar -->
                            <div class="article-meta-bar">
                                <span class="meta-chip cat"><?php echo htmlspecialchars($art['category']); ?></span>
                                <span class="meta-chip"><i class="fas fa-user"></i>&nbsp;<?php echo htmlspecialchars($art['name'] . ' ' . $art['surname']); ?></span>
                                <span class="meta-chip"><i class="fas fa-calendar-alt"></i>&nbsp;<?php echo htmlspecialchars($art['date']); ?></span>
                                <span class="meta-chip"><i class="fas fa-clock"></i>&nbsp;<?php echo $rt; ?> min read</span>
                                <span class="meta-chip"><i class="fas fa-eye"></i>&nbsp;<?php echo number_format($viewCount); ?> views</span>
                            </div>

                            <!-- Cover image -->
                            <img class="article-cover" src="author/articles/<?php echo htmlspecialchars($art['picture']); ?>" alt="<?php echo htmlspecialchars($art['heading']); ?>">

                            <!-- Title -->
                            <h1 class="article-title"><?php echo htmlspecialchars($art['heading']); ?></h1>

                            <!-- Body content -->
                            <div class="article-content mt-3"><?php echo render_article_content($art['content']); ?></div>

                            <!-- Share buttons -->
                            <div class="article-share">
                                <span class="share-label"><i class="fa fa-share-alt"></i> Share:</span>
                                <a class="share-btn share-twitter"
                                   href="https://twitter.com/intent/tweet?text=<?php echo $encodedTitle; ?>&url=<?php echo $encodedUrl; ?>"
                                   target="_blank" rel="noopener">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a class="share-btn share-facebook"
                                   href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $encodedUrl; ?>"
                                   target="_blank" rel="noopener">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a class="share-btn share-whatsapp"
                                   href="https://wa.me/?text=<?php echo $encodedTitle; ?>%20<?php echo $encodedUrl; ?>"
                                   target="_blank" rel="noopener">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                            </div>

                            <!-- Author card -->
                            <div class="author-card mt-4">
                                <div class="author-avatar"><i class="fa fa-user"></i></div>
                                <div>
                                    <div class="author-name"><?php echo htmlspecialchars($art['name'] . ' ' . $art['surname']); ?></div>
                                    <div class="author-bio">Singaliner Inc. editorial team &mdash; delivering stories that inform and inspire.</div>
                                </div>
                            </div>

                            <?php } else { ?>
                            <h1 class="article-title">Story not found</h1>
                            <p class="story-meta">The article you requested may have been removed or does not exist.</p>
                            <?php } ?>
                        </article>

                        <!-- Read More CTA -->
                        <div class="read-next-cta mt-3 reveal">
                            <i class="fas fa-book-open"></i>
                            <span>Enjoyed this story? There&rsquo;s more waiting for you.</span>
                            <a href="blog.php">Browse all posts &rsaquo;</a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <aside class="related-box reveal">
                            <div class="related-box-head">
                                <h2 class="mb-0"><i class="fas fa-book-open"></i> More Stories</h2>
                                <p>Fresh reads from our latest newsroom updates.</p>
                            </div>
                            <?php
                            $re = mysqli_query($conn, "SELECT article.article_id, article.heading, article.picture, article.date FROM article WHERE article_id <> '$id' ORDER BY date DESC LIMIT 0, 8");
                            if ($re && mysqli_num_rows($re) > 0) {
                                while ($rel = mysqli_fetch_assoc($re)) {
                                    ?>
                                    <a class="related-item" href="read.php?edt=<?php echo (int)$rel['article_id']; ?>">
                                        <img class="related-thumb" src="author/articles/<?php echo htmlspecialchars($rel['picture']); ?>" alt="<?php echo htmlspecialchars($rel['heading']); ?>">
                                        <div class="related-item-body">
                                            <span class="related-kicker">Story</span>
                                            <span class="related-title"><?php echo htmlspecialchars($rel['heading']); ?></span>
                                            <small><i class="far fa-calendar-alt"></i> <?php echo htmlspecialchars($rel['date']); ?></small>
                                        </div>
                                        <span class="related-arrow" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
                                    </a>
                                    <?php
                                }
                            } else {
                                echo '<p class="story-meta mb-0">No other stories yet.</p>';
                            }
                            ?>
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
