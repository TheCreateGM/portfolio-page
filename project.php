<?php
$pageTitle = "Projects - AxoGM";
// Use the assetBaseUrl from header.php
$assetBaseUrl = '/'; // Make sure this matches the one in header.php
include "templates/header.php";

// Projects data is now fetched by the React component, so we don't need to load it here.
?>

<section class="section">
    <div class="container">
        <h1 class="title is-2 has-text-centered">Projects</h1>

        <?php /* React component will render projects here */ ?>
        <div id="projects-root" class="column is-full">
             <?php /* React will replace this content */ ?>
        </div>

    </div>
</section>

<?php include "templates/footer.php"; ?>

<!-- Include React components needed for this page -->
<script src="<?php echo $assetBaseUrl; ?>js/components/ProjectsList.js"></script>

<script>
    // Wait for the DOM to be fully loaded before rendering React
    document.addEventListener('DOMContentLoaded', () => {
         const assetBaseUrl = '<?php echo $assetBaseUrl; ?>'; // Pass assetBaseUrl to JS

        // Render ProjectsList component
        const projectsRoot = document.getElementById('projects-root');
        if (projectsRoot) {
            ReactDOM.render(React.createElement(ProjectsList, { assetBaseUrl: assetBaseUrl }), projectsRoot);
        }
    });
</script>