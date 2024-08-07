<?php
include("layouts/header.php");
if($_SESSION['role']=="Employee"){
  echo '<script>window.location.href = "dashboard.php";</script>';
 }
$name=$password=$img="";
$error_name=$pw_error=$img_error="";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$data="SELECT * from admin_table";
  foreach ($db->query($data) as $row)
{
      $Admin_name=$row['admin_name'];
      $_SESSION['admin_name']=$Admin_name;
      $Admin_pw=$row['password'];
      $Admin_img=$row['image'];
      $_SESSION['admin_img']=$Admin_img;
}
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
      if (preg_match('/^[A-Za-z\s]+$/u', $name)) {
        $name = test_input($_POST["name"]);
        } else {
          $error_name = 'Admin name should be alphabet!';
      }
      $password = $_POST["password"];
      // Validate password strength
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
if(!$uppercase || !$lowercase || !$number ) {
  $pw_error = 'Password should be include at least one upper case letter and one number.';
}else{
  $password = test_input($_POST["password"]);
}
if (!empty($_FILES['image']['name'])) {
  $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
  $temp = explode('.', $_FILES['image']['name']);
  $fileExtension = strtolower(end($temp));

  if (!in_array($fileExtension, $allowedExtensions)) {
    $img_error = 'Invalid image format. Only JPG, JPEG, PNG, and GIF are allowed.';
  }else{
    $targetDir = "photo/";
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
  $Admin_img=$_SESSION['admin_img'];
  $targetFilePath=$Admin_img;
}
if ((empty($error_name)) && (empty($pw_error)) && (empty($img_error))) {
  $Admin_name=$_SESSION['admin_name'];
  $update = "UPDATE admin_table SET admin_name='$name', password='$password', image='$targetFilePath' WHERE admin_name='$Admin_name'";
  $db->exec($update);
  echo '<script>window.location.href = "admin.php";</script>';
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
            <h1>Admin Account</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content-header">
      <div class="container-fluid">
    <!-- Profile Image -->
    <div class="row">
    <div class="col-md-4">
    <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo $Admin_img ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $Admin_name ?></h3>

                <p class="text-muted text-center">Admin</p>

              </div>
              <!-- /.card-body -->
            </div>
      </div>
            <!-- /.card -->
        <div class="col-md-8">
    <div class="card card-primary ">
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="form-group">
                    <label for="exampleInputName">Admin Name</label>
                    <input type="text" class="form-control" id="exampleInputName" name="name" placeholder="Enter Admin Name" value="<?php echo $Admin_name ?>" required>
                    <span class="error-message"><?php echo $error_name ?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputDescription">Password</label>
                    <input type="password" class="form-control" id="exampleInputDescription" name="password" value="<?php echo $Admin_pw ?>"  minlength="6" required>
                    <span class="error-message"><?php echo $pw_error; ?></span>
                  </div>
                  <div class="form-group">
                  <div class="row">
                    <div class="col-sm-6">
                    <label>Old Photo</label></br>
                    <img src="<?php echo $Admin_img ?>" style="width:50px;height:50px;"/>
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


