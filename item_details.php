<?php
session_start();
include("Admin/db.php");
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
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>စာရေးကိရိယာ နှင့် မိတ္တူ </title>
    <!-- icon start -->
    <link rel="apple-touch-icon" sizes="180x180" href="Admin/icon/Green/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="Admin/icon/Green/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="Admin/icon/Green/favicon-16x16.png">
  <link rel="manifest" href="icon/Green/site.webmanifest">
  <!-- icon end -->
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Impact
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/impact-bootstrap-business-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>

  <!-- ======= Header ======= -->
  <section id="topbar" class="topbar d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <?php if(isset($email)){ ?>
        <i class="bi bi-envelope d-flex align-items-center"><a href="<?php echo $email ?>"><?php echo $email ?></a></i>
         <?php } ?>
         <?php if(isset($phone)){ ?>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span><?php echo $phone ?></span></i>
        <?php } ?>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <?php if(isset($twt)){ ?>
          <a href="<?php echo $twt ?>" class="twitter"><i class="bi bi-twitter"></i></a>
         <?php } ?>
         <?php if(isset($fb)){ ?>
          <a href="<?php echo $fb ?>" class="facebook"><i class="bi bi-facebook"></i></a>
         <?php } ?>
         <?php if(isset($insta)){ ?>
          <a href="<?php echo $insta ?>" class="instagram"><i class="bi bi-instagram"></i></a>
         <?php } ?>
         <?php if(isset($linkin)){ ?>
          <a href="<?php echo $linkin ?>" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
         <?php } ?>
      </div>
    </div>
  </section><!-- End Top Bar -->

  <header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>Zaw<span>.</span></h1>
      </a>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Back</a></li>
          <li><a href="#item">Items</a></li>
        </ul>
      </nav><!-- .navbar -->

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Item Details</h2>
              <p>Explore a variety of available items at our store and don't miss out on the ongoing discount event! Discover quality products and enjoy exclusive savings on your favorite stationery essentials.</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Item Details</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->
    <style>
    .fixed-size-image {
        width: 100%;
        height: 200px;
        object-fit: cover; /* or object-fit: contain; depending on your preference */
    }
    
    </style>
    <!-- ======= Blog Details Section ======= -->
    <section id="item" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">
          <div class="col-lg-4">
            <article class="blog-details">
              <?php
              if(isset($_GET['id'])){
                $item_id=$_GET['id'];
              }else{
                echo '<script>window.location.href = "index.php";</script>';
              }
               $item_query = "SELECT * FROM item where item_id='$item_id'";
                foreach ($db->query($item_query) as $row) { ?>
              <div class="post-img">
                <img src="Admin/itemphoto/<?php echo $row['item_photo'] ?>" alt="" class="img-fluid fixed-size-image"  >
              </div>
              <h2 class="title"><?php echo $row['item_name'] ?></h2>
            </article><!-- End blog post -->
                  <?php } ?>
          </div>

          <div class="col-lg-4">

            <div class="sidebar">

              <div class="sidebar-item categories">
                <h3 class="sidebar-title">Item Details</h3>
                <ul class="mt-3">
                  <li><a href="#">Name: <span><?php echo $row['item_name'] ?></span></a></li>
                  <li><a href="#">Size: <span><?php echo $row['item_size'] ?></span></a></li>
                  <li><a href="#">Type: <span><?php echo $row['item_type'] ?></span></a></li>
                </ul>
              </div><!-- End sidebar categories-->


            </div><!-- End Blog Sidebar -->

          </div>
          <div class="col-lg-4">
          <h5 class="title"><?php echo $row['item_des'] ?></h5>
        </div>

        </div>

      </div>
    </section><!-- End Blog Details Section -->

  </main><!-- End #main -->


  <?php include("layouts/footer.php"); ?>
