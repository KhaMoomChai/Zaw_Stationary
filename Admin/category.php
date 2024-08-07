<?php
include("layouts/header.php");
$message="";
$cname="";
$cdescription="";
$check=0;
$cid="";

if(isset($_POST['create']))
{

$cname=$_POST['cname'];
$cdescription=$_POST['cdescription'];
$sql = "INSERT INTO category(category_name,category_des) VALUES ('$cname','$cdescription')";
$db->exec($sql);
 echo '<script type="text/javascript">alert("Successful.");window.location=\'category.php\';</script>';
}


if(isset($_GET['cid']))
{

    $cid=$_GET['cid'];
     $_SESSION['cid']=$cid;
    $sql2="SELECT * from category where category_id=$cid";
    foreach ($db->query($sql2) as $row)
  {
    $_SESSION['category_id']=$row['category_id'];
    $cname=$row['category_name'];
    $cdescription=$row['category_des'];

  }
  $check=1;
}


if(isset($_POST['update']))
{
  $cid=$_POST['cid'];
  $_SESSION['cid']=$cid;
    $name=$_POST['cname'];
    $des=$_POST['cdescription'];

$sql3="UPDATE category SET category_name='$name',category_des='$des' WHERE category_id='$cid'";
$db->exec($sql3);
$message="Update is successful";
}
if(isset($_GET['cdelete']))
{
    $cid=$_GET['cdelete'];
   $sql4="DELETE FROM category where Category_id=$cid";
   $db->exec($sql4);
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content-header">
      <div class="container-fluid">

      <div class="col-md-6">
    <div class="card card-primary ">

              <div class="card-header">
                <h3 class="card-title">Add Category</h3>

              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="card-body">
                    <input type="hidden" name="cid" value="<?php echo $cid;?>">

                  <div class="form-group">
                    <label for="exampleInputName">Category Name</label>
                    <input type="text" class="form-control" id="exampleInputName" name="cname" placeholder="Name" value="<?php echo $cname?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputDescription">Category Description</label>
                    <input type="text" class="form-control" id="exampleInputDescription" name="cdescription" placeholder="Enter Description" value="<?php echo $cdescription?>" >
                  </div>



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
                  </div>
                  </div>
                  </section>

            <section class="content-header">
      <div class="container-fluid">


    <div class="card">



    <div class="card-header">
        <h3 class="card-title">Category List</h3>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  $i=1;
                       $sql1 = "SELECT * FROM category ORDER BY category_id DESC";
                       foreach ($db->query($sql1) as $row)
                        {?>
                   <tr>
                  <td><?php echo $i++;?></td>
                  <td><?php echo $row['category_name']?>
                  </td>
                  <td><?php echo $row['category_des']?></td>
                  <td><a href="item.php?cid=<?php echo $row['category_id'] ?>"><i class="fas fa-plus"></i></a></td>
                  <td><a href="category.php?cid=<?php echo $row['category_id'] ?>"><i class="fas fa-edit"></i></a></td>
                  <td><a href="category.php?cdelete=<?php echo $row['category_id'] ?>" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash" ></i></a></td>


                       <?php }

                  ?>


                </tbody>
                <tfoot>
                <tr>
                  <th>Category_id</th>
                  <th>Category_name</th>
                  <th>Description</th>
                  <th></th>
                  <th></th>
                  <th></th>
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
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
      </div>
      </div>
  </section>
  <!-- /.content -->





  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <?php include("layouts/footer.php");?>


