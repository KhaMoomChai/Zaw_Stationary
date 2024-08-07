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
          <li><a href="#blog">Posts</a></li>
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
              <h2>Blog Details</h2>
              <p>Explore a variety of available items at our store and don't miss out on the ongoing discount event! Discover quality products and enjoy exclusive savings on your favorite stationery essentials.</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Blog Details</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->
    <style>
    .fixed-size-image {
        width: 100%;
        height: 500px;
        object-fit: cover; /* or object-fit: contain; depending on your preference */
    }
    .fixed-size-image2 {
        width: 100%;
        height: 50px;
        object-fit: cover; /* or object-fit: contain; depending on your preference */
    }
    </style>
    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">

          <div class="col-lg-8">

            <article class="blog-details">
              <?php
              if(isset($_GET['id'])){
                $id=$_GET['id'];
              }else{
                echo '<script>window.location.href = "index.php";</script>';
              }
               $copier_query = "SELECT * FROM copier where copier_id='$id'";
                foreach ($db->query($copier_query) as $row) { ?>
              <div class="post-img">
                <img src="Admin/<?php echo $row['copier_photo'] ?>" alt="" class="img-fluid fixed-size-image">
              </div>
              <h2 class="title"><?php echo $row['copier_type'] ?></h2>
              <p class="post-category"><?php echo $row['copier_des'] ?></p>
            </article><!-- End blog post -->

            <div class="post-author d-flex align-items-center">
                <?php $emp_name=$row['emp_name'];
                 $emp_query = "SELECT * FROM employee where emp_name='$emp_name'";
                foreach ($db->query($emp_query) as $emp) { ?>
              <img src="Admin/<?php echo $emp['photo'] ?>" class="rounded-circle flex-shrink-0" alt="">
              <div>
                <h4><?php echo $emp['emp_name'] ?></h4>
              </div>
            </div><!-- End post author -->
                  <?php } ?>
          </div>

          <div class="col-lg-4">

            <div class="sidebar">

              <div class="sidebar-item categories">
                <h3 class="sidebar-title">Copier</h3>
                <ul class="mt-3">
                  <li><a href="#">Type: <span><?php echo $row['copier_type'] ?></span></a></li>
                  <li><a href="#">Size: <span><?php echo $row['copier_size'] ?></span></a></li>
                  <li><a href="#">Price: <span><?php echo $row['copier_price'] ?> Ks</span></a></li>
                  <li><a href="#">Date: <span><?php echo $row['copier_date'] ?></span></a></li>
                </ul>
              </div><!-- End sidebar categories-->

              <div class="sidebar-item recent-posts">
                <h3 class="sidebar-title">Recent Posts</h3>
                <div class="mt-3">
                  <?php }
                  $copier_query = "SELECT * FROM copier order by copier_id desc limit 3";
                  foreach ($db->query($copier_query) as $row) { ?>
                  <div class="post-item">
                    <img src="Admin/<?php echo $row['copier_photo'] ?>" class="fixed-size-image2" alt="">
                    <div>
                      <h4><a href="blog-details.php?id=<?php echo $row['copier_id'] ?>"><?php echo $row['copier_type'] ?></a></h4>
                      <time datetime="<?php echo $row['copier_date'] ?>"><?php echo $row['copier_date'] ?></time>
                    </div>
                  </div><!-- End recent post item-->
                 <?php } ?>
                </div>

              </div><!-- End sidebar recent posts-->

            </div><!-- End Blog Sidebar -->

          </div>
        </div>

      </div>
    </section><!-- End Blog Details Section -->

  </main><!-- End #main -->


  <?php include("layouts/footer.php"); ?>
