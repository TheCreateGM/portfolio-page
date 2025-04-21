</main> <?php
/* Close main-content wrapper */
?>

<footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>Made by AxoGM</strong> - © <?php echo date("Y"); ?>
    </p>
  </div>
</footer>

<!-- Scroll to Top Button (Alpine.js) -->
<?php /* Alpine x-data is on html tag, local state is on the div */ ?>
<div x-init="$watch('scrolled', value => { /* Optional: add side effects if needed */ })"
     @scroll.window="scrolled = (window.scrollY > 200)"
     x-data="{ scrolled: window.scrollY > 200 }" <?php /* Local state for button visibility */ ?>
     id="scroll-to-top"
     :class="{ 'visible': scrolled }">
    <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            class="button is-link is-medium is-rounded"
            aria-label="Scroll to top">
        <span class="icon">
            <i class="fas fa-arrow-up"></i>
        </span>
    </button>
</div>

<!-- Library Scripts -->
<?php /* React and ReactDOM CDNs are in header.php */ ?>
<?php /* Alpine.js CDN is in header.php */ ?>
<!-- Main JS (can be empty or contain non-Alpine JS) -->
<script src="<?php echo $assetBaseUrl; ?>js/main.js"></script>

</body>
</html>