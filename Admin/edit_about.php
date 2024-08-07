<?php
include("layouts/header.php");
if($_SESSION['role']=="Employee"){
  echo '<script>window.location.href = "dashboard.php";</script>';
 }
$title=$des=$img1=$img2=$c1=$c2="";
$error_title=$des_error=$img1_error=$img2_error=$c1_error=$c2_error="";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$data="SELECT * from about_us";
  foreach ($db->query($data) as $row)
{
      $title=$row['title'];
      $_SESSION['title']=$title;
      $des=$row['description'];
      $img1=$row['image1'];
      $_SESSION['img1']=$img1;
      $img2=$row['image2'];
      $_SESSION['img2']=$img2;
      $c1=$row['content1'];
      $c2=$row['content2'];
}
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ab_title=test_input($_POST["title"]);
    $ab_des=test_input($_POST["des"]);
    $con_1=test_input($_POST["content1"]);
    $con_2=test_input($_POST["content2"]);
if (!empty($_FILES['image1']['name'])) {
  $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
  $temp = explode('.', $_FILES['image1']['name']);
  $fileExtension = strtolower(end($temp));

  if (!in_array($fileExtension, $allowedExtensions)) {
    $img_error = 'Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed.';
  }else{
    $targetDir = "img/";
    $fileName = basename($_FILES['image1']['name']);
    $targetFilePath1 = $targetDir . $fileName;

    $fileType = pathinfo($targetFilePath1,PATHINFO_EXTENSION);

    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes))
        {
            move_uploaded_file($_FILES["image1"]["tmp_name"],$targetFilePath1);
        }
  }
}else{
  $img1=$_SESSION['img1'];
  $targetFilePath1=$img1;
}

if (!empty($_FILES['image2']['name'])) {
  $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
  $temp = explode('.', $_FILES['image2']['name']);
  $fileExtension = strtolower(end($temp));

  if (!in_array($fileExtension, $allowedExtensions)) {
    $img2_error = 'Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed.';
  }else{
    $targetDir = "img/";
    $fileName = basename($_FILES['image2']['name']);
    $targetFilePath2 = $targetDir . $fileName;

    $fileType = pathinfo($targetFilePath2,PATHINFO_EXTENSION);

    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes))
        {
            move_uploaded_file($_FILES["image2"]["tmp_name"],$targetFilePath2);
        }
  }
}else{
  $img2=$_SESSION['img2'];
  $targetFilePath2=$img2;
}
if ((empty($img1_error))&&(empty($img2_error))) {
  $title=$_SESSION['title'];
  $update = "UPDATE about_us SET title='$ab_title', description='$ab_des', image1='$targetFilePath1' , content1='$con_1', image2='$targetFilePath2', content2='$con_2' WHERE title='$title'";
  $db->exec($update);
 echo '<script>window.location.href = "about.php";</script>';
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
            <!-- /.card -->
        <div class="col-md-12">
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
                        <label>Description</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="des" required><?php echo $des; ?></textarea>
                        <span class="error-message"><?php echo $des_error; ?></span>
                  </div>

                  <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6">
                    <label>Old Photo</label></br>
                    <img src="<?php echo $img1 ?>" style="width:50px;height:50px;"/>
                    </div>
                      <div class="col-sm-6">
                    <label>Image One</label>
                        <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image1" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <span class="error-message"><?php echo $img1_error; ?></span>
                      </div>
                  </div>
                  </div>

                <div class="form-group">
                        <label>First Content</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="content1" required><?php echo $c1; ?></textarea>
                        <span class="error-message"><?php echo $c1_error; ?></span>
                </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6">
                    <label>Old Photo</label></br>
                    <img src="<?php echo $img2 ?>" style="width:50px;height:50px;"/>
                    </div>
                      <div class="col-sm-6">
                    <label>Image Two</label>
                        <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image2" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <span class="error-message"><?php echo $img2_error; ?></span>
                      </div>
                     </div>
                </div>
                <div class="form-group">
                        <label>Second Content</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="content2" required><?php echo $c2; ?></textarea>
                        <span class="error-message"><?php echo $c2_error; ?></span>
                </div>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary btn-block" name="update" Value="Update"  onclick="return confirm('Are you sure to update?')"/>
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


