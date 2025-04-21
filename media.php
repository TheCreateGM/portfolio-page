<?php
$pageTitle = 'Social Media - AxoGM';
// Use the assetBaseUrl from header.php
$assetBaseUrl = '/'; // Make sure this matches the one in header.php
include 'templates/header.php';

// Social data is now fetched by the React component, so we don't need to load it here.
?>

<div class="container is-fluid px-0">
    <div class="columns is-gapless">
        <!-- Main Content Column -->
        <div class="column">
            <section class="section">
                <div class="container">
                    <h1 class="title is-2 has-text-centered">Social Media</h1>
                    <p class="subtitle is-5 has-text-centered">Find me on these platforms:</p>

                    <?php /* React component will render social links here */ ?>
                    <div id="social-links-root" class="buttons is-centered are-large">
                         <?php /* React will replace this content */ ?>
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

<!-- Include React components needed for this page -->
<script src="<?php echo $assetBaseUrl; ?>js/components/SocialLinks.js"></script>

<script>
    // Wait for the DOM to be fully loaded before rendering React
    document.addEventListener('DOMContentLoaded', () => {
        const assetBaseUrl = '<?php echo $assetBaseUrl; ?>'; // Pass assetBaseUrl to JS

        // Render SocialLinks component
        const socialLinksRoot = document.getElementById('social-links-root');
        if (socialLinksRoot) {
            ReactDOM.render(React.createElement(SocialLinks, { assetBaseUrl: assetBaseUrl }), socialLinksRoot);
        }
    });
</script>