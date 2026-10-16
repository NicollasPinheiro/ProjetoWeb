<?php
    include 'config/env.php';
    include 'function/functions.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameRave - <?php echo $title; ?></title>
    <link rel="canonical" href="https://www.site.com.br">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="Jogos, Computadores, Drivers, GPU, CPU">
    <meta name="author" content="Nicollas Vinicius">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="description" content="Site de tecnologia para divulgação de serviços e contato">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="<?= getenv('URL_SITE') ?>/assets/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="57x57" href="<?= getenv('URL_SITE') ?>/assets/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= getenv('URL_SITE') ?>/assets/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= getenv('URL_SITE') ?>/assets/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= getenv('URL_SITE') ?>/assets/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= getenv('URL_SITE') ?>/assets/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= getenv('URL_SITE') ?>/assets/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= getenv('URL_SITE') ?>/assets/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= getenv('URL_SITE') ?>/assets/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= getenv('URL_SITE') ?>/assets/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= getenv('URL_SITE') ?>/assets/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= getenv('URL_SITE') ?>/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= getenv('URL_SITE') ?>/assets/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= getenv('URL_SITE') ?>/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Open Graph (Facebook/LinkedIn/WhatsApp) -->
    <meta property="og:locale" content="pt_BR">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Manicure">
    <meta property="og:title" content="Manicure - Cuidados com as Unhas">
    <meta property="og:description" content="Site de manicure para divulgação de serviços">
    <meta property="og:url" content="https://www.site.com.br">
    <meta property="og:image" content="https://www.site.com.br/assets/img/">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Manicure - Cuidados com as Unhas">

    <!-- Twitter Cards (opcional, mas recomendado) -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Manicure - Cuidados com as Unhas">
    <meta name="twitter:description" content="Site de manicure para divulgação de serviços">
    <meta name="twitter:image" content="https://www.site.com.br/assets/img/">

    <link rel="stylesheet" href="<?= getenv('URL_SITE') ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= getenv('URL_SITE') ?>/assets/css/font-awesome-4.7.0/css/font-awesome.min.css">

</head>