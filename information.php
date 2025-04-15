<?php
$pageTitle = 'About - AxoGM';
$assetBaseUrl = './';
include 'templates/header.php';

// Load data from JSON - with basic error check
$infoData = file_exists('data/info.json') ? json_decode(file_get_contents('data/info.json'), true) : null;
$galleryData = file_exists('data/gallery.json') ? json_decode(file_get_contents('data/gallery.json'), true) : null;

?>

<section class="section">
    <div class="container">
        <h1 class="title is-2 has-text-centered">Information</h1>
    </div>
</section>

<section class="section" id="about-me">
     <div class="container">
        <h2 class="title is-3 has-text-centered">About Me</h2>
         <?php if ($infoData && isset($infoData['bio'])): ?>
            <p class="has-text-centered mb-5">Many people call me <?php echo htmlspecialchars($infoData['bio']['nickname'] ?? 'Axo'); ?> and you can call me <?php echo htmlspecialchars($infoData['bio']['nickname'] ?? 'Axo'); ?> if you want. Im from <?php echo htmlspecialchars($infoData['bio']['location'] ?? 'Malaysia'); ?>.</p>
         <?php endif; ?>

        <div class="columns is-multiline is-centered">
            <?php if ($infoData && !empty($infoData['skills'])): ?>
                <?php foreach ($infoData['skills'] as $skill): ?>
                    <div class="column is-half-tablet is-one-third-desktop">
                        <div class="card">
                            <?php if (!empty($skill['image']) && file_exists($skill['image'])): ?>
                            <div class="card-image">
                                <figure class="image is-4by3">
                                    <img src="<?php echo htmlspecialchars($skill['image']); ?>" alt="Skill image" class="info-skill-image">
                                </figure>
                            </div>
                             <?php endif; ?>
                            <div class="card-content">
                                <p><?php echo isset($skill['description']) ? htmlspecialchars($skill['description']) : ''; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
             <?php elseif ($infoData === null): ?>
                 <div class="column"><p class="has-text-centered notification is-warning">Could not load skill information.</p></div>
            <?php endif; ?>
        </div>
     </div>
</section>

<section class="section" id="gallery">
    <div class="container">
        <h2 class="title is-3 has-text-centered">Gallery</h2>
        <p class="subtitle is-6 has-text-centered">Images of my work.</p>

        <div class="columns is-multiline is-centered">
             <?php if ($galleryData && !empty($galleryData)): ?>
                <?php foreach ($galleryData as $item): ?>
                    <div class="column is-one-third">
                        <div class="card gallery-item">
                            <div class="card-image">
                                <figure class="image is-16by9">
                                    <?php $imgSrc = !empty($item['image']) && file_exists($item['image']) ? htmlspecialchars($item['image']) : 'https://via.placeholder.com/480x270.png?text=No+Image'; ?>
                                    <?php if (!empty($item['link'])): ?>
                                        <a href="<?php echo htmlspecialchars($item['link']); ?>">
                                            <img src="<?php echo $imgSrc; ?>" alt="<?php echo isset($item['category']) ? htmlspecialchars($item['category']) : 'Gallery Item'; ?>">
                                        </a>
                                    <?php else: ?>
                                         <img src="<?php echo $imgSrc; ?>" alt="<?php echo isset($item['category']) ? htmlspecialchars($item['category']) : 'Gallery Item'; ?>">
                                    <?php endif; ?>
                                </figure>
                            </div>
                             <div class="card-content has-text-centered">
                                 <p class="title is-5"><?php echo isset($item['category']) ? htmlspecialchars($item['category']) : ''; ?></p>
                             </div>
                             <?php if (!empty($item['link'])): ?>
                             <footer class="card-footer">
                                 <a href="<?php echo htmlspecialchars($item['link']); ?>" class="card-footer-item">
                                     <span class="icon is-small"><i class="fas fa-images"></i></span> View Gallery
                                 </a>
                             </footer>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php elseif ($galleryData === null): ?>
                <div class="column"><p class="has-text-centered notification is-warning">Could not load gallery information.</p></div>
            <?php endif; ?>
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

<?php include 'templates/footer.php'; ?>