<?php
$pageTitle = "About - AxoGM";
// Use the assetBaseUrl from header.php
$assetBaseUrl = '/'; // Make sure this matches the one in header.php
include "templates/header.php";

// Load data from info.json for the static bio part (optional, could also fetch in React)
$infoData = file_exists("data/info.json")
    ? json_decode(file_get_contents("data/info.json"), true)
    : null;
// Gallery data is now fetched by the React component, so we don't need to load it here.

?>

<section class="section">
    <div class="container">
        <h1 class="title is-2 has-text-centered">Information</h1>
    </div>
</section>

<section class="section" id="about-me">
     <div class="container">
        <h2 class="title is-3 has-text-centered">About Me</h2>
         <?php if ($infoData && isset($infoData["bio"])): ?>
            <p class="has-text-centered mb-5">Many people call me <?php echo htmlspecialchars(
                $infoData["bio"]["nickname"] ?? "Axo"
            ); ?> and you can call me <?php echo htmlspecialchars(
     $infoData["bio"]["nickname"] ?? "Axo"
 ); ?> if you want. Im from <?php echo htmlspecialchars(
     $infoData["bio"]["location"] ?? "Malaysia"
 ); ?>.</p>
         <?php endif; ?>

        <?php /* React component will render the columns and skill cards here */ ?>
        <?php /* Removed columns/column classes from this root div */ ?>
        <div id="skills-root">
            <?php /* React will replace this content. Optional: Add a loading placeholder div inside */ ?>
             <div class="columns is-multiline is-centered">
                 <div class="column is-full has-text-centered">
                     <p class="notification is-info is-light">Loading skills...</p>
                 </div>
             </div>
        </div>
     </div>
</section>

<section class="section" id="gallery">
    <div class="container">
        <h2 class="title is-3 has-text-centered">Gallery</h2>
        <p class="subtitle is-6 has-text-centered">Images of my work.</p>

        <?php /* React component will render the columns and gallery links here */ ?>
        <?php /* Removed columns/column classes from this root div */ ?>
        <div id="gallery-root">
            <?php /* React will replace this content. Optional: Add a loading placeholder div inside */ ?>
             <div class="columns is-multiline is-centered">
                 <div class="column is-full has-text-centered">
                     <p class="notification is-info is-light">Loading gallery...</p>
                 </div>
             </div>
        </div>
    </div>
</section>

<section class="section" id="my-projects">
    <div class="container has-text-centered">
         <h2 class="title is-3">My Projects</h2>
         <p class="mb-4">I still work on many things. Click the button below to see the projects page.</p>
         <a href="project.php" class="button is-link is-medium">
            <span class="icon"><i class="fas fa-folder-open"></i></span>
            <span>Go to Projects</span>
        </a>
    </div>
</section>

<?php include "templates/footer.php"; ?>

<!-- Include React components needed for this page -->
<script src="<?php echo $assetBaseUrl; ?>js/components/Skills.js"></script>
<script src="<?php echo $assetBaseUrl; ?>js/components/GalleryList.js"></script>

<script>
    // Wait for the DOM to be fully loaded before rendering React
    document.addEventListener('DOMContentLoaded', () => {
        const assetBaseUrl = '<?php echo $assetBaseUrl; ?>'; // Pass assetBaseUrl to JS

        // Render Skills component
        const skillsRoot = document.getElementById('skills-root');
        if (skillsRoot) {
            // Use createRoot for React 18+
            const root = ReactDOM.createRoot(skillsRoot);
            root.render(React.createElement(Skills, { assetBaseUrl: assetBaseUrl }));
        }

        // Render GalleryList component
        const galleryRoot = document.getElementById('gallery-root');
        if (galleryRoot) {
             // Use createRoot for React 18+
            const root = ReactDOM.createRoot(galleryRoot);
            root.render(React.createElement(GalleryList, { assetBaseUrl: assetBaseUrl }));
        }
    });
</script>