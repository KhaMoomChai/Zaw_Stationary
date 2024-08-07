<?php
include("layouts/header.php");
if($_SESSION['role']=="Employee"){
  echo '<script>window.location.href = "dashboard.php";</script>';
 }
$check=0;
$message="";
$emp_name="";
$password="";
$ph_no="";
$nrc="";
$no="";
$address="";
$employeeid="";
$count=0;
$photodata="";
$value1="";
$value2="";
$value3="";
$value4="";
if(isset($_POST['create']))
{
$emp_name=$_POST['emp_name'];
$sqlcheck="SELECT count(*) from employee WHERE emp_name='$emp_name'";
$res = $db->query($sqlcheck);
$count = $res->fetchColumn();
if($count==0){
$password=$_POST['password'];
$ph_no=$_POST['ph_no'];
$state=$_POST['state'];
$township=$_POST['township'];
$npe=$_POST['npe'];
$no=$_POST['no'];
$nrc=$state."/".$township.$npe.$no;
$address=$_POST['address'];
$targetDir = "photo/";
    $fileName = basename($_FILES['photo']['name']);
    $targetFilePath = $targetDir . $fileName;

    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes))
        {
            move_uploaded_file($_FILES["photo"]["tmp_name"],$targetFilePath);
        }

$sql = "INSERT INTO employee(emp_name,password,phone,nrc,photo,address) VALUES ('$emp_name','$password','$ph_no','$nrc','$targetFilePath','$address')";
 $db->exec($sql);
 echo '<script type="text/javascript">alert("Successful.");window.location=\'employee.php\';</script>';
//echo $message;
}else
{
  $message ="Employee Name is not allowed Duplicate!";
}
}

if(isset($_GET['employee']))
{
    $testid=$_GET['employee'];
    $sql2="SELECT * from employee where emp_name='$testid'";
    $stmt = $db->query($sql2);
    /*** echo number of columns ***/
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $stmt->fetch()) {
    $emp_name=$row['emp_name'];
    $password=$row['password'];
    $ph_no=$row['phone'];
    $nrc=$row['nrc'];
    $input_string =  $nrc;
 // Remove question marks
$cleaned_string = str_replace('?', '', $input_string);

// Extract values between parentheses
$matches = [];
preg_match('/^(\d+)\/([^\(]+)\(([^)]+)\)(\d+)$/', $cleaned_string, $matches);

// Extracted values
$value1 = $matches[1] ?? "";
$value2 = $matches[2] ?? "";
$value3 = $matches[3] ?? "";
$value4 = $matches[4] ?? "";

    $photodata=$row['photo'];
    $address=$row['address'];

  }
  $check=1;
}


if(isset($_POST['update']))
{
  $name=$_POST['emp_name'];
    $pw=$_POST['password'];
    $ph=$_POST['ph_no'];
    $add=$_POST['address'];
    $st=$_POST['state'];
    $ts=$_POST['township'];
    $npe_type=$_POST['npe'];
    $nb=$_POST['no'];
    $nrc_no=$st."/".$ts.$npe_type.$nb;
    $targetDir = "photo/";
    $fileName = basename($_FILES['photo']['name']);

        if(empty($fileName))
        {
 $sqlphoto="select * from employee where emp_name='$name'";
 $stmt = $db->query($sqlphoto);
 /*** echo number of columns ***/
 $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
 while ($row = $stmt->fetch()) {
$photodata=$row['photo'];
 }
        }else{
          $targetFilePath = $targetDir . $fileName;
          $photodata=$targetFilePath;
          $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

          $allowTypes = array('jpg','png','jpeg');
          if(in_array($fileType, $allowTypes))
              {
                  move_uploaded_file($_FILES["photo"]["tmp_name"],$targetFilePath);
              }

        }
$sql3="UPDATE employee SET emp_name='$name',password='$pw',phone='$ph',nrc='$nrc_no',photo='$photodata',address='$add' WHERE emp_name='$name'";
$db->exec($sql3);
$message="Update is successful";
}
if(isset($_GET['emp_delete']))
{
    $emp=$_GET['emp_delete'];
   $sql4="DELETE FROM employee where emp_name='$emp'";
   $db->exec($sql4);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Employee</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Employee </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                <input type="hidden" name="testid" value="<?php echo $emp_name; ?>">
                <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                <label>Employee Name</label>
                        <input type="text" name="emp_name" class="form-control" placeholder="Enter employee name" value="<?php echo $emp_name; ?>" required>
                  </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                <label>Employee Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter employee password" value="<?php echo $password; ?>" required>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <?php if($check==0){ ?>
                      <div class="col-sm-12">
                      <label for="exampleInputPhoto">Employee Photo</label>
                        <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="photo" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      </div>
                    </div>
                    <?php }else{ ?>
                      <div class="col-sm-6">
                    <label>Old Employee Photo</label></br>
                    <img src="<?php echo $photodata?>" style="width:50px;height:50px;"/>
                    </div>
                    <div class="col-sm-6">
                    <label for="exampleInputPhoto">Employee Photo</label>
                        <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="photo" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>

                <div class="form-group">
                      <label>Employee Phone</label>
                        <input type="text" name="ph_no" id="" class="form-control" value="<?php echo $ph_no ?>" required>
                    </div>
                    <label>NRC</label>
                    <div class="row">
                  <div class="form-group">
                    <select name="state" id="category-dropdown" class="form-control border border-dark" value="" required style="width:63px;margin-left: 10px;">
                <option value="<?php echo $value1 ?>"><?php echo $value1 ?></option>
            <?php $result="SELECT * FROM nrc GROUP BY state";
            foreach($db->query($result) as $row)
            {?>
            <option value="<?php echo $row['state'];?>"><?php echo $row['state'];?></option>
                               <?php } ?>
                    </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="/" style="width:40px;height:38px;font-weight: bold;margin-left: 16px;">
                                    </div>

                                    <div class="form-group">
                                <select name="township" id="sub-category-dropdown" class="form-control border border-dark" value="" required style="width:120px;margin-left: 10px;">
                                  <?php if($check==1){ ?>
                                    <option value="<?php echo $value2 ?>"><?php echo $value2 ?></option>
                                    <?php } ?>
                                </select>
                                    </div>

                                    <div class="form-group">
                                        <select name="npe" id="npe" class="form-control border border-dark" value="" required style="width:70px;margin-left: 10px;">
                                        <?php if($check==1){ ?>
                                    <option value="<?php echo '('.$value3.')' ?>"><?php echo '('.$value3.')' ?></option>
                                    <?php } ?>
                                            <option value="(N)">(N)</option>
                                            <option value="(E)">(E)</option>
                                            <option value="(P)">(P)</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="nrc_number" class="form-control border border-dark" name="no" value="<?php echo $value4;?>" required style="width:75px;margin-left: 10px;">
                                    </div>

                </div>
                <div class="form-group">
                      <label>Employee Address</label>
                        <input type="text" name="address" value="<?php echo $address; ?>" class="form-control" placeholder="Enter employee address" required>
                </div>


                <!-- /.card-body -->
                <div class="card-footer">
                    <?php if($check==0){?>
                  <input type="submit" class="btn btn-primary" name="create" Value="Create"/>
                  <input type="submit" class="btn btn-primary" name="update" Value="Update" disabled/>
                  <?php }else {?>
                    <input type="submit" class="btn btn-primary" name="create" Value="Create" disabled />
                    <input type="submit" class="btn btn-primary" name="update" Value="Update"/>
                    <?php }?>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Employee Data list</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Password</th>
                    <th>Phone</th>
                    <th>Photo</th>
                    <th>NRC</th>
                    <th>Address</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                         $sql1 = "SELECT * FROM employee ";
                         foreach ($db->query($sql1) as $row)
                          {?>
                     <tr>
                    <td><?php echo $row['emp_name']?></td>
                    <td><?php echo $row['password']?></td>
                    <td><?php echo $row['phone']?></td>
                    <td><img src="<?php echo $row['photo']?>" style="width:50px;height:50px;"></td>
                    <td><?php echo $row['nrc']?></td>
                    <td><?php echo $row['address']?></td>
                    <td><a href="employee.php?employee=<?php echo $row['emp_name'] ?>"><i class="fas fa-edit"></i></a></td>
                    <td><a href="employee.php?emp_delete=<?php echo $row['emp_name'] ?>" onclick="return confirm('Are you sure delete?')"><i class="fa fa-trash" ></i></a></td>
                         <?php }
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Password</th>
                    <th>Phone</th>
                    <th>Photo</th>
                    <th>NRC</th>
                    <th>Address</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </tfoot>
              </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
    </div>
    </section>
    <div class="row">
    <!-- /.content -->
</div>
  </div>
  <?php include("layouts/footer.php"); ?>
  <script>
    $(document).ready(function()
    {
        $('#category-dropdown').on('change',function(){
            var state=this.value;
            $.ajax({
                url:"getuser.php",
                type:"POST",
                data:{state:state},cache:false,success:function(result){
                    $("#sub-category-dropdown").html(result);
                }
            });
        });
    });
</script>
