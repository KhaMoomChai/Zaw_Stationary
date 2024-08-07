<?php
include("layouts/header.php");
if($_SESSION['role']=="Employee"){
  echo '<script>window.location.href = "dashboard.php";</script>';
 }
$check=0;
$copier_type="";
$copier_photo="";
$copier_des="";
$copier_price="";
$copier_size="";
$copier_date="";
$emp_name="";
$cid="";

if(isset($_POST['create']))
{
  $copier_type=$_POST['copier_type'];
  $copier_des=$_POST['copier_des'];
  $copier_price=$_POST['copier_price'];
  $copier_size=$_POST['copier_size'];
  $copier_date=$_POST['copier_date'];
  $emp_name=$_POST['emp_name'];

  $targetDir = "photo/";
    $copier_photo = basename($_FILES['photo']['name']);
    $targetFilePath = $targetDir . $copier_photo;

    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes))
        {
            move_uploaded_file($_FILES["photo"]["tmp_name"],$targetFilePath);
        }

        $sql = "INSERT INTO copier(copier_type,copier_photo,copier_des,copier_price,copier_size,copier_date,emp_name) VALUES ('$copier_type','$targetFilePath','$copier_des','$copier_price','$copier_size','$copier_date','$emp_name')";
        $db->exec($sql);
         echo '<script type="text/javascript">alert("Successful.");window.location=\'copier.php\';</script>';
}
if(isset($_GET['copier_delete']))
{
  $copier_id=$_GET['copier_delete'];
  $copier_delete="DELETE FROM copier where copier_id=$copier_id";
  $db->exec($copier_delete);
}

if(isset($_GET['copier_update']))
{
  $cid=$_GET['copier_update'];
  $_SESSION['cid']=$cid;
  $copy="SELECT * from copier where copier_id='$cid'";
  foreach ($db->query($copy) as $row)
{
      $_SESSION['copier_id']=$row['copier_id'];
      $copier_type=$row['copier_type'];
      $copier_des=$row['copier_des'];
      $copier_price=$row['copier_price'];
      $copier_size=$row['copier_size'];
      $copier_date=$row['copier_date'];
      $emp_name=$row['emp_name'];
      $copier_photo=$row['copier_photo'];
  }
  $check=1;
}


if(isset($_POST['update']))
{
  $cid=$_SESSION['copier_id'];
  $type=$_POST['copier_type'];
  $des=$_POST['copier_des'];
  $price=$_POST['copier_price'];
  $size=$_POST['copier_size'];
  $date=$_POST['copier_date'];
  $name=$_POST['emp_name'];
  $targetDir = "photo/";
  $fileName = basename($_FILES['photo']['name']);

        if(empty($fileName))
        {

  $sqlphoto="select * from copier where copier_id='$cid'";
  $stmt = $db->query($sqlphoto);
  /*** echo number of columns ***/
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  while ($row = $stmt->fetch()) {
  $copier_photo=$row['copier_photo'];
 }
        }else{
          $targetFilePath = $targetDir . $fileName;
          $copier_photo=$targetFilePath;
          $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

          $allowTypes = array('jpg','png','jpeg');
          if(in_array($fileType, $allowTypes))
              {
                  move_uploaded_file($_FILES["photo"]["tmp_name"],$targetFilePath);
              }

        }
$update="UPDATE copier SET copier_type='$type', copier_photo='$copier_photo', copier_des='$des', copier_price='$price', copier_size='$size',copier_date='$date',emp_name='$name' where copier_id='$cid'";
$db->exec($update);
$message="Update is successful";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Copier</h1>
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
                <h3 class="card-title">Add Copier</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                <input type="hidden" name="copier_id" value="<?php echo $cid;?>">
                <label>Copier Type</label>
                        <input type="text" name="copier_type" class="form-control" placeholder="Enter copier type" value="<?php echo $copier_type; ?>" required>
                    </div>
                <div class="form-group">
                  <div class="row">
                    <?php if($check==0){ ?>
                      <div class="col-sm-12">
                      <label for="exampleInputPhoto">Copier Photo</label>
                        <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="photo" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      </div>
                    </div>
                    <?php }else{ ?>
                      <div class="col-sm-6">
                    <label>Old Copier Photo</label>
                    <img src="<?php echo $copier_photo?>" style="width:50px;height:50px;"/>
                    </div>
                    <div class="col-sm-6">
                    <label for="exampleInputPhoto">Copier Photo</label>
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
                      <label>Copier Description</label>
                        <input type="text" name="copier_des" value="<?php echo $copier_des; ?>" class="form-control" placeholder="Enter copier description" required>
                </div>
                <div class="form-group">
                      <label>Copier Price</label>
                        <input type="text" name="copier_price" value="<?php echo $copier_price; ?>" class="form-control" placeholder="Enter copier price" required>
                </div>
                <div class="form-group">
                      <label>Copier Size</label>
                        <input type="text" name="copier_size" value="<?php echo $copier_size; ?>" class="form-control" placeholder="Enter copier size" required>
                </div>
                <div class="form-group">
                      <label>Copier Date</label>
                        <input type="date" name="copier_date" value="<?php echo $copier_date?>" class="form-control" required>
                </div>
                <div class="form-group">
                      <label>Employee Name</label>
                        <select name="emp_name" id="" class="form-control" required>
                          <option value="<?php echo $emp_name ?>"><?php echo $emp_name ?></option>
                        <?php
                         $employee = "SELECT * FROM employee";
                         foreach ($db->query($employee) as $emp)
                          {?>
                          <option value="<?php echo $emp['emp_name'] ?>"><?php echo $emp['emp_name'] ?></option>
                        <?php } ?>
                        </select>
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
                <h3 class="card-title">Copier History</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Copier Type</th>
                    <th>Copier Photo</th>
                    <th>Copier Des</th>
                    <th>Copier Price</th>
                    <th>Copier size</th>
                    <th>Copier Date</th>
                    <th>Employee</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                         $copiers = "SELECT * FROM copier ORDER BY copier_id DESC";
                         foreach ($db->query($copiers) as $copier)
                          {?>
                     <tr>
                    <td><?php echo $copier['copier_type']?></td>
                    <td><img src="<?php echo $copier['copier_photo']?>" style="width:50px;height:50px;"></td>
                    <td><?php echo $copier['copier_des']?></td>
                    <td><?php echo $copier['copier_price']?></td>
                    <td><?php echo $copier['copier_size']?></td>
                    <td><?php echo $copier['copier_date']?></td>
                    <td><?php echo $copier['emp_name'] ?></td>
                    <td><a href="copier.php?copier_update=<?php echo $copier['copier_id'] ?>"><i class="fas fa-edit"></i></a></td>
                    <td><a href="copier.php?copier_delete=<?php echo $copier['copier_id'] ?>" onclick="return confirm('Are you sure delete?')"><i class="fa fa-trash" ></i></a></td>
                         <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Copier Type</th>
                    <th>Copier Photo</th>
                    <th>Copier Des</th>
                    <th>Copier Price</th>
                    <th>Copier size</th>
                    <th>Copier Date</th>
                    <th>Employee</th>
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

