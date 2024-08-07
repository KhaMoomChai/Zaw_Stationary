<?php
include("layouts/header.php");
if($_SESSION['role']=="Employee"){
  echo '<script>window.location.href = "dashboard.php";</script>';
 }
 $title=$des=$img1=$content1=$img2=$content2="";
$data="SELECT * from about_us";
  foreach ($db->query($data) as $row)
{
      $title=$row['title'];
      $des=$row['description'];
      $img1=$row['image1'];
      $content1=$row['content1'];
      $img2=$row['image2'];
      $content2=$row['content2'];

}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>About Us Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="edit_about.php" ><i class="fas fa-edit fa-2x"></i></a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content-header">
<div class="container-fluid">
    <!-- Profile Image -->
      <div class="row">
        <div class="col-sm-6">
          <div class="card mb-3">
            <img class="card-img-top" src="<?php echo $img1 ?>" alt="Card image cap" style="width: 100%; height: 300px;">
              <div class="card-body">
                  <p class="card-text"><?php echo $content1 ?></p>
              </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <p class="card-text"><?php echo $content2 ?></p>
            </div>
              <img class="card-img-bottom" src="<?php echo $img2 ?>" alt="Card image cap" style="width: 100%; height: 300px;">
          </div>
        </div>
      </div>
</div>
    </section>
</div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <?php include("layouts/footer.php");?>


