<?php
include("layouts/header.php");
if($_SESSION['role']=="Employee"){
  echo '<script>window.location.href = "dashboard.php";</script>';
 }
$title=$des=$img="";
$error_title=$des_error=$img_error="";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$data="SELECT * from home";
  foreach ($db->query($data) as $row)
{
      $title=$row['title'];
      $_SESSION['title']=$title;
      $des=$row['description'];
      $bg_img=$row['image'];
      $_SESSION['bg_img']=$bg_img;
}
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hm_title=test_input($_POST["title"]);
    $hm_des=test_input($_POST["des"]);

if (!empty($_FILES['image']['name'])) {
  $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
  $temp = explode('.', $_FILES['image']['name']);
  $fileExtension = strtolower(end($temp));

  if (!in_array($fileExtension, $allowedExtensions)) {
    $img_error = 'Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed.';
  }else{
    $targetDir = "img/";
    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . $fileName;

    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes))
        {
            move_uploaded_file($_FILES["image"]["tmp_name"],$targetFilePath);
        }
  }
  // You can also set additional checks like file size, etc.
  // For example: if ($_FILES['image']['size'] > 2097152) {
  //     $errors['image'] = 'File size exceeds 2MB limit.';
  // }
}else{
  $img=$_SESSION['bg_img'];
  $targetFilePath=$img;
}
if ((empty($img_error))) {
  $title=$_SESSION['title'];
  $update = "UPDATE home SET title='$hm_title', description='$hm_des', image='$targetFilePath' WHERE title='$title'";
  $db->exec($update);
  echo '<script>window.location.href = "home.php";</script>';
}

  }

?>
 <style>
        .error-message {
            color: red;
            font-size:14px;
        }
    </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home Page</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content-header">
      <div class="container-fluid">
    <!-- Profile Image -->
    <div class="row">
    <div class="col-md-6">
                <div class="card mb-2 bg-gradient-dark">
                  <img class="card-img-top" src="<?php echo $bg_img ?>" alt="Dist Photo 1">
                  <div class="card-img-overlay d-flex flex-column justify-content-end">
                    <h4 class="card-title text-primary text-white"><?php echo $title ?></h4>
                    <p class="card-text text-white pd-2 pt-1"><?php echo $des ?></p>
                  </div>
                </div>
              </div>
            <!-- /.card -->
        <div class="col-md-6">
    <div class="card card-primary ">
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputName">Title</label>
                    <input type="text" class="form-control" id="exampleInputName" name="title" placeholder="Enter Page Title" value="<?php echo $title ?>" required>
                    <span class="error-message"><?php echo $error_title ?></span>
                  </div>
                  <div class="form-group">
                  <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="des" required><?php echo $des; ?></textarea>
                      </div>
                    <span class="error-message"><?php echo $des_error; ?></span>
                  </div>
                  <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6">
                    <label>Old Photo</label></br>
                    <img src="<?php echo $bg_img ?>" style="width:50px;height:50px;"/>
                    </div>
                      <div class="col-sm-6">
                    <label>Photo</label>
                        <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <span class="error-message"><?php echo $img_error; ?></span>
                      </div>
                  </div>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary btn-block" name="update" Value="Update"/>
                </div>
              </form>
              </div>
                  </div>
                  </div>
                  </div>
                  </section>
</div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <?php include("layouts/footer.php");?>


