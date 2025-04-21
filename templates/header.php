<?php
$pageTitle = isset($pageTitle) ? htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') : 'AxoGM';
// Simple base URL detection (adjust if site is in subfolder)
// This is a basic example; for production, consider setting this in a config file or environment variable
$baseUrl = rtrim(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']), '/').'/';
if ($baseUrl === '//') $baseUrl = '/'; // Handle root case
// Asset Base URL: Assumes site is in the web root. If it's in a subdir like /portfolio/, change this to '/portfolio/'
$assetBaseUrl = '/';

?>
<!DOCTYPE html>
<html lang="en" x-data="{
    theme: localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
    navbarOpen: false
}" :data-theme="theme">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo $assetBaseUrl; ?>css/style.css">
    <link rel="icon" type="image/x-icon" href="<?php echo $assetBaseUrl; ?>icon.png">

    <!-- React and ReactDOM CDNs -->
    <script crossorigin src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <!-- Optional: Babel for JSX in the browser - NOT RECOMMENDED FOR PRODUCTION -->
    <!-- <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script> -->
    <?php /* We will compile JSX using simple tooling or write plain JS React */ ?>


    <!-- Alpine.js CDN (defer is important) - Keeping for site-wide UI like theme/navbar -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <?php /* Removed jQuery and Axios CDNs */ ?>

</head>
<body>
    <?php /* body data-theme is now handled by Alpine binding on html tag */ ?>

<nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation" x-data="{ navbarOpen: false }">
    <div class="navbar-brand">
        <a class="navbar-item" href="<?php echo $assetBaseUrl; ?>index.php">
            <img src="<?php echo $assetBaseUrl; ?>icon.png" width="28" height="28" alt="Logo">
            <span style="margin-left: 5px; font-weight: bold;">AxoGM</span>
        </a>
        <?php /* Alpine logic for burger toggle */ ?>
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
           @click="navbarOpen = !navbarOpen" :class="{ 'is-active': navbarOpen }"
           data-target="navbarBasicExample" x-ref="burger">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    <?php /* Alpine logic for menu open/close */ ?>
    <div id="navbarBasicExample" class="navbar-menu" :class="{ 'is-active': navbarOpen }">
        <div class="navbar-start">
            <a class="navbar-item" href="<?php echo $assetBaseUrl; ?>index.php">
                 Home
            </a>
            <a class="navbar-item" href="<?php echo $assetBaseUrl; ?>information.php">
                 About
            </a>
            <a class="navbar-item" href="<?php echo $assetBaseUrl; ?>project.php">
                 Projects
            </a>
            <a class="navbar-item" href="<?php echo $assetBaseUrl; ?>media.php">
                 Social Media
            </a>
        </div>
        <div class="navbar-end">
            <div class="navbar-item">
                <?php /* Alpine logic for theme toggle */ ?>
                <button id="theme-toggle" class="button is-ghost" aria-label="Toggle theme"
                        @click="theme = (theme === 'dark' ? 'light' : 'dark'); localStorage.setItem('theme', theme)">
                    <img :src="'<?php echo $assetBaseUrl; ?>img/' + (theme === 'dark' ? 'sun.png' : 'moon.png')"
                         alt="Theme Icon" width="24" height="24">
                </button>
            </div>
        </div>
    </div>
</nav>

<main class="main-content">