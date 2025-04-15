<?php
$pageTitle = 'Social Media - AxoGM';
$assetBaseUrl = './';
include 'templates/header.php';

// Load data from JSON - with basic error check
$socialData = file_exists('data/social.json') ? json_decode(file_get_contents('data/social.json'), true) : null;
?>

<div class="container is-fluid px-0">
    <div class="columns is-gapless">
        <!-- Main Content Column -->
        <div class="column">
            <section class="section">
                <div class="container">
                    <h1 class="title is-2 has-text-centered">Social Media</h1>
                    <p class="subtitle is-5 has-text-centered">Find me on these platforms:</p>

                    <div class="buttons is-centered are-large"> <!-- Use Bulma buttons for alignment -->
                        <?php if ($socialData && !empty($socialData)): ?>
                            <?php foreach ($socialData as $platform): ?>
                                 <?php if (!empty($platform['url']) && !empty($platform['fa_class']) && !empty($platform['name'])): ?>
                                <a href="<?php echo htmlspecialchars($platform['url']); ?>" target="_blank" rel="noopener noreferrer" class="button is-ghost social-icon-link" title="<?php echo htmlspecialchars($platform['name']); ?>">
                                    <span class="icon is-large">
                                        <i class="<?php echo htmlspecialchars($platform['fa_class']); ?>"></i>
                                    </span>
                                </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php elseif($socialData === null): ?>
                             <p class="has-text-centered notification is-warning">Could not load social media links.</p>
                        <?php endif; ?>
                    </div>

                    <hr>

                     <div class="columns is-centered mt-6">
                         <div class="column is-half has-text-centered">
                             <div class="box">
                                 <h3 class="title is-4">Support My Work</h3>
                                 <p class="mb-4">Donations help me create more projects!</p>
                                 <a href="https://www.paypal.com/paypalme/axogm" class="button is-link is-large" target="_blank" rel="noopener noreferrer">
                                     <span class="icon is-medium">
                                         <i class="fab fa-paypal"></i> <!-- Font Awesome PayPal icon -->
                                     </span>
                                     <span>Donate via PayPal</span>
                                 </a>
                             </div>
                         </div>
                     </div>
                </div>
        </div>
</div><!-- End container -->


<?php include 'templates/footer.php'; ?>