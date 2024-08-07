<?php
include("db.php");
include("layouts/header.php");
if(isset($_POST['update_location']))
{
    $location=$_POST['location'];
    $sql="UPDATE shop_info SET location='$location'";
    $db->query($sql_location);
}
if(isset($_POST['update_email']))
{
    $email=$_POST['email'];
    $sql="UPDATE shop_info SET email='$email'";
    $db->query($sql);
}
if(isset($_POST['update_phone']))
{
    $phone=$_POST['phone'];
    $sql="UPDATE shop_info SET phone='$phone'";
    $db->query($sql);
}
if(isset($_POST['update_open_hour']))
{
    $open_hour=$_POST['open_hour'];
    $sql="UPDATE shop_info SET open_hour='$open_hour'";
    $db->query($sql);
}
if(isset($_POST['fb_link']))
{
    $fb_link=$_POST['fb_link'];
    $sql="UPDATE shop_info SET fb_link='$fb_link'";
    $db->query($sql);
}
if(isset($_POST['insta_link']))
{
    $insta_link=$_POST['insta_link'];
    $sql="UPDATE shop_info SET insta_link='$insta_link'";
    $db->query($sql);
}
if(isset($_POST['twt_link']))
{
    $twt_link=$_POST['twt_link'];
    $sql="UPDATE shop_info SET twt_link='$twt_link'";
    $db->query($sql);
}
if(isset($_POST['linkin_link']))
{
    $linkin_link=$_POST['linkin_link'];
    $sql="UPDATE shop_info SET linkin_link='$linkin_link'";
    $db->query($sql);
}

$sql_info="select * from shop_info";
foreach($db->query($sql_info) as $row)
{
    $location=$row["location"];
    $email=$row["email"];
    $phone=$row["phone"];
    $open_hour=$row["open_hour"];
    $fb_link=$row["fb_link"];
    $insta_link=$row["insta_link"];
    $twt_link=$row["twt_link"];
    $linkin_link=$row["linkin_link"];
}
?>
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Shop Information</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-map"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Location</span>
                        <span class="info-box-number"><?php echo $location; ?></span>
                    </div>
                    <a href="shop_info.php?edit_location=1?>" class="btn text-info">
                        <span class="info-box-text"><i class="far fa-edit"></i></span>
                    </a>
                </div>
            </div>
            <?php if(isset($_GET['edit_location'])){
            ?>
            <div class="col-md-6">
                            <!-- general form elements -->
                <div class="card card-primary">
                    <!-- form start -->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="location" value="<?php echo $location ?>" required>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" name="update_location" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <?php  } ?>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Email</span>
                        <span class="info-box-number"><?php echo $email; ?></span>
                    </div>
                    <a href="shop_info.php?edit_email=1?>" class="btn text-info">
                        <span class="info-box-text"><i class="far fa-edit"></i></span>
                    </a>
                </div>
            </div>
            <?php if(isset($_GET['edit_email'])){
            ?>
            <div class="col-md-6">
                            <!-- general form elements -->
                <div class="card card-primary">
                    <!-- form start -->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" value="<?php echo $email ?>" required>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" name="update_email" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <?php  } ?>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fa fa-phone"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Phone</span>
                        <span class="info-box-number"><?php echo $phone; ?></span>
                    </div>
                    <a href="shop_info.php?edit_phone=1?>" class="btn text-info">
                        <span class="info-box-text"><i class="far fa-edit"></i></span>
                    </a>
                </div>
            </div>
            <?php if(isset($_GET['edit_phone'])){
            ?>
            <div class="col-md-6">
                            <!-- general form elements -->
                <div class="card card-primary">
                    <!-- form start -->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="phone" class="form-control" name="phone" value="<?php echo $phone ?>" required>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" name="update_phone" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <?php  } ?>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fa-regular fa fa-clock"></i><i class="far fa-clock-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Open Hour</span>
                        <span class="info-box-number"><?php echo $open_hour; ?></span>
                    </div>
                    <a href="shop_info.php?edit_open_hour=1?>" class="btn text-info">
                        <span class="info-box-text"><i class="far fa-edit"></i></span>
                    </a>
                </div>
            </div>
            <?php if(isset($_GET['edit_open_hour'])){
            ?>
            <div class="col-md-6">
                            <!-- general form elements -->
                <div class="card card-primary">
                    <!-- form start -->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="open_hour" value="<?php echo $open_hour ?>" required>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" name="update_open_hour" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <?php  } ?>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon" style="color: #1877F2;"><i class="fab fa-facebook"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Facebook Link</span>
                        <span class="info-box-number"><?php echo $fb_link; ?></span>
                    </div>
                    <a href="shop_info.php?edit_fb_link=1?>" class="btn text-info">
                        <span class="info-box-text"><i class="far fa-edit"></i></span>
                    </a>
                </div>
            </div>
            <?php if(isset($_GET['edit_fb_link'])){
            ?>
            <div class="col-md-6">
                            <!-- general form elements -->
                <div class="card card-primary">
                    <!-- form start -->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="fb_link" value="<?php echo $fb_link ?>" >
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" name="update_fb_link" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <?php  } ?>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon" style="color: white;background: linear-gradient(45deg, #833AB4, #E1306C);"><i class="fab fa-instagram"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Instagram Link</span>
                        <span class="info-box-number"><?php echo $insta_link; ?></span>
                    </div>
                    <a href="shop_info.php?edit_insta_link=1?>" class="btn text-info">
                        <span class="info-box-text"><i class="far fa-edit"></i></span>
                    </a>
                </div>
            </div>
            <?php if(isset($_GET['edit_insta_link'])){
            ?>
            <div class="col-md-6">
                            <!-- general form elements -->
                <div class="card card-primary">
                    <!-- form start -->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="insta_link" value="<?php echo $insta_link ?>" >
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" name="update_insta_link" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <?php  } ?>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon" style="color: #1DA1F2;"><i class="fab fa-twitter"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Twitter Link</span>
                        <span class="info-box-number"><?php echo $twt_link; ?></span>
                    </div>
                    <a href="shop_info.php?edit_twt_link=1?>" class="btn text-info">
                        <span class="info-box-text"><i class="far fa-edit"></i></span>
                    </a>
                </div>
            </div>
            <?php if(isset($_GET['edit_twt_link'])){
            ?>
            <div class="col-md-6">
                            <!-- general form elements -->
                <div class="card card-primary">
                    <!-- form start -->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="twt_link" value="<?php echo $twt_link ?>">
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" name="update_twt_link" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <?php  } ?>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon" style="color: #0077B5;"><i class="fab fa-linkedin"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Linkedin Link</span>
                        <span class="info-box-number"><?php echo $linkin_link; ?></span>
                    </div>
                    <a href="shop_info.php?edit_linkin_link=1?>" class="btn text-info">
                        <span class="info-box-text"><i class="far fa-edit"></i></span>
                    </a>
                </div>
            </div>
            <?php if(isset($_GET['edit_linkin_link'])){
            ?>
            <div class="col-md-6">
                            <!-- general form elements -->
                <div class="card card-primary">
                    <!-- form start -->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="linkin_link" value="<?php echo $linkin_link ?>" >
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" name="update_linkin_link" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <?php  } ?>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php include("layouts/footer.php"); ?>
