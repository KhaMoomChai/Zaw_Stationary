<?php
include("layouts/header.php");

// Set a default image path
$defaultImage = "Admin/img/home.jpg";
$hm_img=$defaultImage;
// Fetch data from the database
$data = "SELECT * from home";
foreach ($db->query($data) as $row)
{
    $hm_title=$row['title'];
    $hm_des=$row['description'];
    if (!empty($row['image'])) {
      $hm_img = 'Admin/'.$row['image'];
  }else{
    $hm_img=$defaultImage;
  }
}
function getBackgroundImage()
{
    global $hm_img;
    return $hm_img;
}
?>
<style>
        .hero-section {
            background-image: url('<?php echo getBackgroundImage(); ?>');
            background-size: cover;
            background-position: center;
            text-align: center;
            height:80vh;
            /* You can add additional styles as needed */
        }
    </style>
  <!-- ======= Hero Section ======= -->

  <section id="hero" class="hero">
  <div class="hero-section">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h2><?php echo $hm_title ?></h2>
          <p><?php echo $hm_des ?></p>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#about" class="btn-get-started">Get Started</a>
          </div>
        </div>
      </div>
    </div>
    </div>
        </div>
      </div>
    </div>

    </div>
  </section>

  <!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">
        <?php
        $data2 = "SELECT * from about_us";
        foreach ($db->query($data2) as $row)
        {
          $ab_title=$row['title'];
          $ab_des=$row['description'];
          $ab_image1=$row['image1'];
          $ab_image2=$row['image2'];
          $ab_content1=$row['content1'];
          $ab_content2=$row['content2'];
        }
         ?>
        <div class="section-header">
          <h2>About Us</h2>
          <p><?php echo $ab_des ?></p>
        </div>
        <style>
          .fixed-size-image3 {
        width: 100%;
        height: 500px;
        object-fit: cover; /* or object-fit: contain; depending on your preference */
    }
        </style>
        <div class="row gy-4">
          <div class="col-lg-6">
            <h3><?php echo $ab_title ?></h3>
            <img src="Admin/<?php echo $ab_image1 ?>" class="img-fluid rounded-4 mb-4 fixed-size-image3" alt="">
            <p><?php echo $ab_content1 ?></p>
          </div>
          <div class="col-lg-6">
            <div class="content ps-0 ps-lg-5">
              <p class="fst-italic">
                <?php echo $ab_content2 ?>
              </p>
              <div class="position-relative mt-4">
                <img src="Admin/<?php echo $ab_image2 ?>" class="img-fluid rounded-4 fixed-size-image3" alt="">
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Stats Counter Section ======= -->
    <section id="stats-counter" class="stats-counter">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4 align-items-center">

          <div class="col-lg-6">
            <img src="assets/img/analysis.svg" alt="" class="img-fluid">
          </div>

          <div class="col-lg-6">
            <?php
            $item="select count(*) as item_count from item ";
                  foreach($db->query($item) as $row)
                  {
                    $item_count=$row["item_count"];
                  }
                  ?>
            <div class="stats-item d-flex align-items-center">
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $item_count ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Items sold.</strong> Shop with confidence — our total solds speak volumes.</p>
            </div><!-- End Stats Item -->
            <?php
                $sale="select count(*) as sale_count from sale ";
                foreach($db->query($sale) as $row)
                {
                  $sale_count=$row["sale_count"];
                }
                ?>
            <div class="stats-item d-flex align-items-center">
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $sale_count ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Items</strong> on sale – endless possibilities, limited time.</p>
            </div><!-- End Stats Item -->
            <?php
                  $emp="select count(*) as emp_count from employee ";
                  foreach($db->query($emp) as $row)
                  {
                    $emp_count=$row["emp_count"];
                  }
                  ?>
            <div class="stats-item d-flex align-items-center">
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $emp_count ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p><strong>Employee</strong> one mission: Your business success.</p>
            </div><!-- End Stats Item -->

          </div>

        </div>

      </div>
    </section><!-- End Stats Counter Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio sections-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <h2>Items</h2>
            <p>Upgrade your workspace with our stylish and functional stationery items, perfect for bringing creativity and organization to your desk.</p>
        </div>

        <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">
            <ul class="portfolio-flters">
                <li data-filter="*" class="filter-active">All</li>
                <?php
                $category_query = "SELECT * FROM category";
                foreach ($db->query($category_query) as $row) { ?>
                    <li data-filter=".category-<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></li>
                <?php } ?>
            </ul><!-- End item Filters -->
<style>
    .fixed-size-image {
        width: 360px;
        height: 200px;
        object-fit: cover; /* or object-fit: contain; depending on your preference */
    }
</style>
            <div class="row gy-4 portfolio-container">
                <?php
                $item_query = "SELECT * FROM item";
                foreach ($db->query($item_query) as $row) { ?>
                    <div class="col-xl-4 col-md-6 portfolio-item category-<?php echo $row['category_id'] ?>">
                        <div class="portfolio-wrap">
                            <a href="Admin/itemphoto/<?php echo $row['item_photo'] ?>" data-gallery="portfolio-gallery-app" class="glightbox"><img src="Admin/itemphoto/<?php echo $row['item_photo'] ?>" class="img-fluid fixed-size-image" alt="" width="300" height="200"></a>
                            <div class="portfolio-info">
                                <h4><a href="item_details.php?id=<?php echo $row['item_id'] ?>" title="More Details"><?php echo $row['item_name'] ?></a></h4>
                            </div>
                        </div>
                    </div><!-- End Portfolio Item -->
                <?php } ?>
            </div><!-- End Portfolio Container -->
        </div>
    </div>
</section><!-- End Portfolio Section -->

    <!-- ======= Recent Blog Posts Section ======= -->
    <section id="blog" class="recent-posts sections-bg">
      <div class="container" data-aos="fade-up">
      <style>
        .fixed-size-image2 {
        width: 380px;
        height: 200px;
        object-fit: cover; /* or object-fit: contain; depending on your preference */
          }
        </style>
        <div class="section-header">
          <h2>Recent Blog Posts</h2>
          <p>Explore a variety of available items at our store and don't miss out on the ongoing discount event! Discover quality products and enjoy exclusive savings on your favorite stationery essentials.</p>
        </div>
        <!-- -- -->
        <div class="row gy-4">
        <?php
                $copier_query = "SELECT * FROM copier";
                foreach ($db->query($copier_query) as $row) { ?>
                    <div class="col-xl-4 col-md-6">
            <article>

              <div class="post-img">
                <img src="Admin/<?php echo $row['copier_photo'] ?>" alt="" class="img-fluid fixed-size-image2">
              </div>
              <h2 class="title">
                <a href="blog-details.php?id=<?php echo $row['copier_id'] ?>"><?php echo $row['copier_type'] ?></a>
              </h2>

              <div class="d-flex align-items-center">
                <?php
                $emp_name=$row['emp_name'];
                 $emp_query = "SELECT * FROM employee where emp_name='$emp_name'";
                foreach ($db->query($emp_query) as $emp) { ?>
                <img src="Admin/<?php echo $emp['photo'] ?>" alt="" class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                  <p class="post-author"><?php echo $row['emp_name'] ?></p>
                  <p class="post-date">
                    <time datetime="<?php echo $row['copier_date'] ?>"><?php echo $row['copier_date'] ?></time>
                  </p>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->
                <?php }} ?>


        </div><!-- End recent posts list -->

      </div>
    </section><!-- End Recent Blog Posts Section -->

       <!-- ======= Contact Section ======= -->
       <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contact</h2>
          <p>Feel free to reach out to us through our web contact form, and we'll get back to you as soon as possible.</p>
        </div>

        <div class="row gx-lg-0 gy-4">

        <?php
                $shopInfo_query = "SELECT * FROM shop_info";
                foreach ($db->query($shopInfo_query) as $row) { ?>
                  <div class="col-lg-4 m-3">
                  <div class="info-container d-flex flex-column align-items-center justify-content-center">
              <div class="info-item d-flex">
                 <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
               <h4>Location:</h4>
                <p><?php echo $row['location'] ?></p>
                 </div>
              </div><!-- End Info Item -->

  <div class="info-item d-flex">
    <i class="bi bi-envelope flex-shrink-0"></i>
    <div>
      <h4>Email:</h4>
      <p><?php echo $row['email'] ?></p>
    </div>
  </div><!-- End Info Item -->

  <div class="info-item d-flex">
    <i class="bi bi-phone flex-shrink-0"></i>
    <div>
      <h4>Call:</h4>
      <p><?php echo $row['phone'] ?></p>
    </div>
  </div><!-- End Info Item -->

  <div class="info-item d-flex">
    <i class="bi bi-clock flex-shrink-0"></i>
    <div>
      <h4>Open Hours:</h4>
      <p><?php echo $row['open_hour'] ?></p>
    </div>
  </div><!-- End Info Item -->
  <?php } ?>

</div>
</div>
<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name=test_input($_POST['name']);
$email=test_input($_POST['email']);
$msg=test_input($_POST['message']);
$date=date("Y/m/d");
$sent = "INSERT INTO contact(name,email,message,date) VALUES ('$name','$email','$msg','$date')";
  $db->exec($sent);
  echo '<script type="text/javascript">alert("Message has sent successful.");window.location=\'index.php\';</script>';
exit();
}
?>

          <div class="col-lg-6 m-3">
          <form action="index.php" method="post" class="">
    <div class="row">
        <div class="col-md-6 form-group">
            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
        </div>
        <div class="col-md-6 form-group mt-3 mt-md-0">
            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
        </div>
    </div>
    <div class="form-group mt-3">
        <textarea class="form-control" name="message" rows="7" placeholder="Message" required></textarea>
    </div>
    <div class="my-3">
    </div>
    <div class="text-center">
        <button class="btn btn-info rounded-5" type="submit" name="submit">Send Message</button>
    </div>
</form>

          </div><!-- End Contact Form -->

        </div>

      </div>
    </section><!-- End Contact Section -->


  </main><!-- End #main -->

 <?php include("layouts/footer.php"); ?>
