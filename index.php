<?php
$pageTitle = 'AxoGM - Home';
include 'templates/header.php';
?>

<section class="hero is-medium">
  <div class="hero-body has-text-centered">
    <p class="title is-1">
      Hello, Im AxoGM
    </p>
    <p class="subtitle is-4">
      Im a programmer and 3D model maker.
    </p>
  </div>
</section>

<section class="section">
    <div class="container">
        <div class="columns is-centered is-multiline">

            <div class="column is-one-third">
                 <a href="information.php" class="home-card-link">
                     <div class="card">
                         <div class="card-image">
                             <figure class="image is-4by3">
                                 <img src="img/card/2.png" alt="Information Thumbnail">
                             </figure>
                         </div>
                         <div class="card-content">
                             <p class="title is-4">Information</p>
                             <p class="subtitle is-6">The information about me.</p>
                         </div>
                         <footer class="card-footer">
                            <span class="card-footer-item">See More</span>
                         </footer>
                     </div>
                 </a>
            </div>

             <div class="column is-one-third">
                 <a href="project.php" class="home-card-link">
                     <div class="card">
                         <div class="card-image">
                             <figure class="image is-4by3">
                                 <img src="img/card/1.png" alt="Project Thumbnail">
                             </figure>
                         </div>
                         <div class="card-content">
                             <p class="title is-4">Projects</p>
                             <p class="subtitle is-6">The projects and stuff that I make.</p>
                         </div>
                          <footer class="card-footer">
                            <span class="card-footer-item">See More</span>
                         </footer>
                     </div>
                 </a>
            </div>

             <div class="column is-one-third">
                 <a href="media.php" class="home-card-link">
                     <div class="card">
                         <div class="card-image">
                             <figure class="image is-4by3">
                                 <img src="img/card/3.png" alt="Social Media Thumbnail">
                             </figure>
                         </div>
                         <div class="card-content">
                             <p class="title is-4">Social Media</p>
                             <p class="subtitle is-6">Media social where I post my projects.</p>
                         </div>
                          <footer class="card-footer">
                            <span class="card-footer-item">See More</span>
                         </footer>
                     </div>
                 </a>
            </div>

        </div>
    </div>
</section>


<?php include 'templates/footer.php'; ?>