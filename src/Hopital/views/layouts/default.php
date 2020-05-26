<?php
$page = $_SERVER["PHP_SELF"] ;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= isset($title) ? $title : "Hôpital" ?></title>
    <link rel="stylesheet" href="/styles/css/compass.css">
    <script src="https://kit.fontawesome.com/5ed943be7f.js" crossorigin="anonymous"></script>
    <script
            src="https://code.jquery.com/jquery-1.12.4.min.js">
    </script>
</head>
<body>

    <div class="container">
        <section class="banner">
            <div class="top-bar-both-bar top-header-bar">
                <div>
                    <i class="far fa-clock"> Opening Hours: Mon - Tues: 6.00 am - 10.00 pm, Sunday closed</i>
                </div>
                <div>
                    <ul class="top-bar-link">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Service d'assistance</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
            </div>
            <?php if ($_SERVER["REQUEST_URI"] !== "/contact") : ?>
                <div class="top-bar-both-bar second-bar">
                    <div class="top-bar-logo">
                        <img src="/images/logo-wide.png" alt="">
                    </div>
                    <div class="top-bar-mail">
                        <div>
                            <i class="fas fa-envelope"></i>
                            <a href="#">MAIL US TODAY</a>
                            <h5>info@maildomain.com</h5>
                        </div>
                    </div>
                    <div class="top-bar-phone">
                        <div>
                            <i class="fas fa-phone-square-alt"></i>
                            <a href="#">CALL US FOR MORE DETAILS</a>
                            <h5>+(33) 0000 000</h5>
                        </div>
                    </div>
                    <div class="top-bar-location">
                        <div>
                            <i class="far fa-building"></i>
                            <a href="#">COMPANY LOCATION</a>
                            <h5>13 Rue de Jean, Paris</h5>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </section>
        <!--===== Navbar web ======-->
        <header>
            <ul class="pain">
                <li <?php if(strpos($page,'acceuil')) echo ' class="active"'; ?>><a href="<?= $router->url("home") ?>">Acceuil</a></li>
                <li <?php if(strpos($page,'a-propos')) echo ' class="active"'; ?>><a href="<?= $router->url("about") ?>">À-Propos</a></li>
                <li><a href="#">Link</a></li>
                <li <?php if(strpos($page,'contact')) echo ' class="active"'; ?>><a href="<?= $router->url("contact") ?>">Nous-contacter</a></li>
            </ul>
            <a href="" class="logo">Register Now</a>
        </header>

        <?= $content ?>
    </div>


    <!--===================== FOOTER ====================-->
    <footer class="footer">
        <section class="footer-container">
            <section class="footer-left">
                <img src="/images/logo-wide-white.png" alt="">
                <p>Lorem ipsum dolor adipisicing amet, consectetur sit elit. Aspernatur incidihil quo officia.</p>
                <p><i class="fas fa-map-marker-alt"></i> 203, Envato Labs, Behind Alis Steet, Melbourne, Australia</p>
                <a href="#"><i class="fas fa-phone-alt"></i> 123-456-789</a>
                <a href="#"><i class="far fa-envelope"></i> contact@yourdomain.com</a>
                <a href="#"><i class="fas fa-globe-africa"></i> www.yourdomain.com</a>
                <div class="connect-with-us">
                    <h3>Nous Suivre</h3>
                    <ul class="footer-socials">
                        <li>
                            <a href="#">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-skype"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </section>
            <section class="useful-links">
                <h2 class="useful_links_title">Useful Links</h2>
                <div class="useful__links">
                    <ul class="list_useful_links">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="#">About us</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="other_links">
                    <h2 class="other_links_title">Other Links</h2>
                    <ul class="list_other_links">
                        <li>
                            <a href="#">FAQ</a>
                        </li>
                        <li>
                            <a href="#">Sitemap</a>
                        </li>
                        <li>
                            <a href="#">Policy</a>
                        </li>
                    </ul>
                </div>
            </section>
            <section class="lates-news-footer">
                <h2>Latest News</h2>
                <div class="lates__news__top">
                    <ul class="list__lates_news">
                        <li>
                            <img src="/images/80x55.png" alt="">
                            <div>
                                <a href="#">Substainable Construction</a>
                                <p>Mar 03, 2020</p>
                            </div>
                        </li>
                        <li>
                            <img src="/images/news3.jpg" alt="">
                            <div>
                                <a href="#">Substainable Construction</a>
                                <p>Mar 03, 2020</p>
                            </div>
                        </li>
                        <li>
                            <img src="/images/80x55.png" alt="">
                            <div>
                                <a href="#">Substainable Construction</a>
                                <p>Mar 03, 2020</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="lates__news_bottom">
                    <h2>Call Us Now</h2>
                    <ul class="bottom__news">
                        <li>
                            <p>+61 3 1234 5678</p>
                        </li>
                        <li>
                            <p>+12 3 1234 5678</p>
                        </li>
                    </ul>
                </div>
            </section>
            <section class="opening-hours">
                <h2>Opening Hours</h2>
                <div class="opening__top">
                    <ul class="list__opening_hours">
                        <li>
                            <p>Mon - Tues:</p>
                            <p>6.00 am - 10.00 pm</p>
                        </li>
                        <li>
                            <p>Wednes - Thurs:</p>
                            <p>8.00 am - 6.00 pm</p>
                        </li>
                        <li>
                            <p>Fri:</p>
                            <p>3.00 am - 8.00 pm</p>
                        </li>
                        <li>
                            <p>Sat:</p>
                            <p>10.00 am - 2.00 pm</p>
                        </li>
                        <li>
                            <p>Sun:</p>
                            <p>Closed</p>
                        </li>
                    </ul>
                </div>
                <div class="opening__bottom">
                    <h2>Suscribe Us</h2>
                    <form action="#" class="news__letter">
                        <input type="email" id="email" class="input__news__leter both" placeholder="Votre email">
                        <button type="submit" class="btn_news__leter both">Subscribe</button>
                    </form>
                </div>
            </section>
        </section>
        <section class="footer__bottom">
            <div>
                <p>Copyright ©2020 Coding Factory. All Rights Reserved</p>
            </div>
            <div class="footer__bottom__connect">
                <ul class="footer__bottom__socials">
                    <li>
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-skype"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </section>
    </footer>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="/js/jquery.counterup.min.js"></script>
    <script src="/js/main.js"></script>
    <script>
        $(document).ready(function ($){
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });
        });
    </script>
</body>
</html>