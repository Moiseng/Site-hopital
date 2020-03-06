<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/styles/css/compass.css">
    <title>404 - Page introuvable</title>
</head>
<body class="error__body">
    <!--===== the moon =====-->
    <div class="moon"></div>

    <!--===== the craters =====-->
    <div class="crater crater1"></div>
    <div class="crater crater2"></div>
    <div class="crater crater3"></div>

    <!--===== the stars =====-->
    <div class="star star1"></div>
    <div class="star star2"></div>
    <div class="star star3"></div>
    <div class="star star4"></div>
    <div class="star star5"></div>

    <!--===== the ERROR =====-->
    <div class="error">
        <div class="error__title">404</div>
        <div class="error__subtitle">Hmmm...</div>
        <div class="error__description">Il semble que l'un des développeurs se soit endormi</div>
        <a href="<?= $router->url("home") ?>" class="error_btn error__btn__active">
            ACCEUIL
        </a>
        <a href="<?= $router->url("contact") ?>" class="error_btn">
            CONTACT
        </a>
    </div>

    <!--===== the ASTRONAUT =====-->
    <div class="astronaut">
        <div class="backpack"></div>
        <div class="body__astronaut"></div>
        <div class="body__chest"></div>
        <div class="arm-left1"></div>
        <div class="arm-left2"></div>
        <div class="arm-right1"></div>
        <div class="arm-right2"></div>
        <div class="arm-thumb-left"></div>
        <div class="arm-thumb-right"></div>
        <div class="leg-left"></div>
        <div class="leg-right"></div>
        <div class="foot-left"></div>
        <div class="foot-right"></div>
        <div class="wrist-left"></div>
        <div class="wrist-right"></div>
        <div class="cord">
            <canvas id="cord" height="500px" width="500px"></canvas>
        </div>
        <div class="head">
            <canvas id="visor" width="60px" height="60px"></canvas>
            <div class="head-visor-flare1"></div>
            <div class="head-visor-flare2"></div>
        </div>
    </div>
    <script src="/js/e404.js"></script>
</body>
</html>