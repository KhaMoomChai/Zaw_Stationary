 <!-- ======= Footer ======= -->
 <footer id="footer" class="footer">
 <?php
$shopInfo_query = "SELECT * FROM shop_info";
                foreach ($db->query($shopInfo_query) as $row) {
                  $location=$row['location'];
                  $email=$row['email'];
                  $phone=$row['phone'];
                  $open_hour=$row['open_hour'];
                  $fb=$row['fb_link'];
                  $insta=$row['insta_link'];
                  $twt=$row['twt_link'];
                  $linkin=$row['linkin_link'];
                 }
?>
<div class="container">
  <div class="row gy-4">
    <div class="col-lg-5 col-md-12 footer-info">
      <a href="index.html" class="logo d-flex align-items-center">
        <span>Zaw</span>
      </a>
      <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
      <div class="social-links d-flex mt-4">
      <?php if(!empty($twt)){ ?>
          <a href="<?php echo $twt ?>" class="twitter"><i class="bi bi-twitter"></i></a>
         <?php } ?>
         <?php if(!empty($fb)){ ?>
          <a href="<?php echo $fb ?>" class="facebook"><i class="bi bi-facebook"></i></a>
         <?php } ?>
         <?php if(!empty($insta)){ ?>
          <a href="<?php echo $insta ?>" class="instagram"><i class="bi bi-instagram"></i></a>
         <?php } ?>
         <?php if(!empty($linkin)){ ?>
          <a href="<?php echo $linkin ?>" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
         <?php } ?>
      </div>
    </div>

    <div class="col-lg-2 col-6 footer-links">
      <h4>Useful Links</h4>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About us</a></li>
        <li><a href="#">Posts</a></li>
        <li><a href="#">Items</a></li>
      </ul>
    </div>

    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
      <h4>Contact Us</h4>
      <p>
        <?php echo $location ?>
        <strong>Phone:</strong> <?php echo $phone ?><br>
        <strong>Email:</strong> <?php echo $email ?><br>
      </p>

    </div>

  </div>
</div>

<div class="container mt-4">
  <div class="copyright">
    &copy; Copyright <strong><span>Golden TKM Company Ltd.</span></strong>. All Rights Reserved
</div>
</div>
</footer><!-- End Footer -->
<!-- End Footer -->

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>
