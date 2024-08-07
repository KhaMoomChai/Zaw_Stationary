<?php
session_start();
include("db.php");
// Initialize variables
$nameErr = $passwordErr = "";
$name = $password =$login_error = "";
$flag=0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
    }
    // Validate user role
            $sql = "SELECT * FROM admin_table ";
            $data = $db->query($sql);
            foreach($data as $row){
              if(($name == $row['admin_name'])&&($password == $row['password'])){
                $flag=1;
              }
            }
            $sql2 = "SELECT * FROM employee";
            $data2 = $db->query($sql2);
            foreach($data2 as $row){
              if(($name == $row['emp_name'])&&($password == $row['password'])){
                $flag=2;
              }
            }
            if($flag==1){
              $_SESSION['name']=$name;
              $_SESSION['role']="Admin";
              header("location:dashboard.php");
            }elseif($flag==2){
              $_SESSION['name']=$name;
              $_SESSION['role']="Employee";
              header("location:dashboard.php");
            }else{
              $login_error="Invalid Sign in!";
            }
 }

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminZAW | Log in</title>
  <style>
.error {color: #FF0000;}
</style>
   <!-- icon start -->
   <link rel="apple-touch-icon" sizes="180x180" href="icon/Green/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="icon/Green/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="icon/Green/favicon-16x16.png">
  <link rel="manifest" href="icon/Green/site.webmanifest">
  <!-- icon end -->
  <link rel="icon" type="image/x-icon" href="images/logo.ico">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Admin</b>ZAW</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your ZAW</p>

      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <center><label class="error"><?php echo  $login_error;?></label></center>
      <div class="input-group mb-1">
        </div>
        <div class="input-group mb-3">

          <input type="text" class="form-control" placeholder="Name" name="name"  value="<?php echo $name ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-1">
        </div>
        <div class="input-group mb-3">

          <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $password ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">

            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input type="submit" class="btn btn-primary btn-block" value="Sign In"/>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <!-- /.social-auth-links -->



    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
