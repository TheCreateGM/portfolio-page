<?php
$pageTitle = isset($pageTitle) ? htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') : 'AxoGM';
// Simple base URL detection (adjust if site is in subfolder)
$baseUrl = rtrim(str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']), '/').'/';
if ($baseUrl === '//') $baseUrl = '/'; // Handle root case
// Base URL for assets assuming htdocs is web root. If site lives in /portfolio/, baseUrl should be /portfolio/
$assetBaseUrl = '/'; // Adjust if your site is in a subfolder relative to domain root e.g. /my-site/

?>
<!DOCTYPE html>
<html lang="en" x-data> <?php /* Add x-data for Alpine */ ?>
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
    <!-- Alpine.js CDN (defer is important) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body data-theme="light">

<nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="<?php echo $assetBaseUrl; ?>index.php">
            <img src="<?php echo $assetBaseUrl; ?>icon.png" width="28" height="28" alt="Logo">
            <span style="margin-left: 5px; font-weight: bold;">AxoGM</span>
        </a>
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span>
        </a>
    </div>
    <div id="navbarBasicExample" class="navbar-menu">
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
                <button id="theme-toggle" class="button is-ghost" aria-label="Toggle theme">
                    <img src="<?php echo $assetBaseUrl; ?>img/moon.png" alt="Theme Icon" width="24" height="24">
                </button>
            </div>
        </div>
    </div>
</nav>

<main class="main-content">