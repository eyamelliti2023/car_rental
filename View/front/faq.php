<?php
include("header.php");
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>User Profile</title>

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
        <link href="css/tooplate-little-fashion.css" rel="stylesheet">
    </head>
    
    <body>
        

        <header class="site-header section-padding d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row">
                    <center>
                    <div class="col-lg-10 col-12 text-center">
                        <h1>Your Profile</h1>
                    </div>
                    </center>
                </div>
            </div>
        </header>

        <section class="profile section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="profile-card text-center">
                            <h2><?php echo htmlspecialchars($username); ?></h2>
                            <p class="text-muted"><?php echo htmlspecialchars($_SESSION['user']['email']); ?></p>
                        </div>
                    </div>
                    
                    <div class="col-lg-8 col-md-6">
                        <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                            <h3>Update Information</h3>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['user']['name']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="surname" class="form-label">Surname</label>
                                <input type="text" class="form-control" id="surname" name="surname" value="<?php echo htmlspecialchars($_SESSION['user']['surname']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="newEmail" class="form-label">Email Address</label>
                                <input type="email" clasx²s="form-control" id="newEmail" name="email" value="<?php echo htmlspecialchars($_SESSION['user']['email']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($_SESSION['user']['password']); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                        <form action="delete_account.php" method="POST" class="mt-4">
                            <h3>Delete Account</h3>
                            <p class="text-danger">This action is irreversible. All your data will be permanently deleted.</p>
                            <button type="submit" class="btn btn-danger">Delete My Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-10 me-auto mb-4">
                        <h4 class="text-white mb-3"><a href="index.html">Little</a> Fashion</h4>
                        <p class="copyright-text text-muted mt-lg-5 mb-4 mb-lg-0">Copyright © 2022 <strong>Little Fashion</strong></p>
                        <p class="copyright-text">Designed by <a href="https://www.tooplate.com/" target="_blank">Tooplate</a></p>
                    </div>

                    <div class="col-lg-5 col-8">
                        <h5 class="text-white mb-3">Sitemap</h5>
                        <ul class="footer-menu d-flex flex-wrap">
                            <li class="footer-menu-item"><a href="about.html" class="footer-menu-link">Story</a></li>
                            <li class="footer-menu-item"><a href="products.html" class="footer-menu-link">Products</a></li>
                            <li class="footer-menu-item"><a href="privacy.html" class="footer-menu-link">Privacy policy</a></li>
                            <li class="footer-menu-item"><a href="faq.html" class="footer-menu-link">FAQs</a></li>
                            <li class="footer-menu-item"><a href="contact.html" class="footer-menu-link">Contact</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-4">
                        <h5 class="text-white mb-3">Social</h5>
                        <ul class="social-icon">
                            <li><a href="#" class="social-icon-link bi-youtube"></a></li>
                            <li><a href="#" class="social-icon-link bi-whatsapp"></a></li>
                            <li><a href="#" class="social-icon-link bi-instagram"></a></li>
                            <li><a href="#" class="social-icon-link bi-skype"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/Headroom.js"></script>
        <script src="js/jQuery.headroom.js"></script>
        <script src="js/slick.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>
