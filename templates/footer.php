</main> <?php /* Close main-content wrapper */ ?>

<footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>Made by AxoGM</strong> - © <?php echo date("Y"); ?>
    </p>
  </div>
</footer>

<!-- Scroll to Top Button (Alpine.js) -->
<div x-data="{ scrolled: false }"
     @scroll.window="scrolled = (window.scrollY > 200)"
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Anime.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js" integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptemedcv4LTXdXkzd9nKtnMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Axios CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Main JS -->
<script src="<?php echo $assetBaseUrl; ?>js/main.js"></script>

</body>
</html>