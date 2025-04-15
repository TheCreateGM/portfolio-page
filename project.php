<?php
$pageTitle = 'Projects - AxoGM';
$assetBaseUrl = './';
include 'templates/header.php';

// Load data from JSON - with basic error check
$projectsData = file_exists('data/projects.json') ? json_decode(file_get_contents('data/projects.json'), true) : null;

function display_projects($category_data, $assetBaseUrl) {
    if (empty($category_data)) return;

    echo '<div class="columns is-multiline">';
    foreach ($category_data as $project) {
        if (empty($project['title'])) continue;

        echo '<div class="column is-one-third-desktop is-half-tablet project-card">';
        echo '<div class="card" style="height: 100%; display: flex; flex-direction: column;">';

        // Image
        if (!empty($project['image']) && file_exists($project['image'])) {
             $imgSrc = htmlspecialchars($project['image']);
            echo '<div class="card-image">';
            echo '<figure class="image is-16by9">';
            $linkTarget = !empty($project['live_link']) ? htmlspecialchars($project['live_link']) : (!empty($project['repo_link']) ? htmlspecialchars($project['repo_link']) : null);
            if ($linkTarget) echo '<a href="' . $linkTarget . '" target="_blank">';
            echo '<img src="' . $imgSrc . '" alt="' . htmlspecialchars($project['title']) . '">';
            if ($linkTarget) echo '</a>';
            echo '</figure>';
            echo '</div>';
        }

        // Content
        echo '<div class="card-content" style="flex-grow: 1;">';
        echo '<p class="title is-5">' . htmlspecialchars($project['title']) . '</p>';
        if (!empty($project['logos']) && is_array($project['logos'])) {
            echo '<div class="tech-logos mb-2">';
            foreach($project['logos'] as $logo) {
                if (!empty($logo) && file_exists($logo)) {
                     echo '<img src="' . htmlspecialchars($logo) . '" alt="Tech logo" style="height: 24px; width: auto; margin-right: 5px; display: inline-block; vertical-align: middle;">';
                }
            }
            echo '</div>';
        }
        echo '</div>';

        // Footer links with Icons
        echo '<footer class="card-footer">';
        $hasLink = false;
        if (!empty($project['live_link'])) {
            echo '<a href="' . htmlspecialchars($project['live_link']) . '" class="card-footer-item" target="_blank"><span class="icon is-small"><i class="fas fa-external-link-alt"></i></span> View Live</a>';
             $hasLink = true;
        }
         if (!empty($project['repo_link'])) {
            echo '<a href="' . htmlspecialchars($project['repo_link']) . '" class="card-footer-item" target="_blank"><span class="icon is-small"><i class="fab fa-github"></i></span> View Code</a>';
             $hasLink = true;
        }
        if (!$hasLink && (empty($linkTarget) && !empty($project['image'])) || !$hasLink && empty($project['image'])) {
             echo '<span class="card-footer-item has-text-grey-light">No Links</span>';
        }
        echo '</footer>';

        echo '</div>'; // End card
        echo '</div>'; // End column
    }
    echo '</div>'; // End columns
}

?>

<section class="section">
    <div class="container">
        <h1 class="title is-2 has-text-centered">Projects</h1>

        <?php if ($projectsData): ?>
            <?php foreach ($projectsData as $category => $projects): ?>
                <?php if (!empty($projects)): ?>
                    <div class="mb-6">
                        <h2 class="title is-3 is-capitalized"><?php echo str_replace('_', ' ', htmlspecialchars($category)); ?></h2>
                         <?php display_projects($projects, $assetBaseUrl); ?>
                    </div>
                     <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
             <div class="notification is-warning">Could not load projects. Check data/projects.json.</div>
        <?php endif; ?>

    </div>
</section>

<?php include 'templates/footer.php'; ?>