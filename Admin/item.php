<?php 

include("layouts/header.php");


$iname=$idescription=$size=$type=$qty=$filename="";
$check=0;
$cid="";
$width="";
$height="";
$item_id="";
if(isset($_GET['cid']))
{

    $cid=$_GET['cid'];
  }

  if(isset($_POST['create'])) {
    $cid = $_POST['cid'];
    $iname = $_POST['iname'];
    $idescription = $_POST['idescription'];
    $size = $_POST['size'];
    $type = $_POST['type'];
    $qty=$_POST['qty'];

    // Check if an image file was uploaded
    if((!empty($_FILES["photo"])) && ($_FILES['photo']['error'] == 0)) {
        // $fileinfo = @getimagesize($_FILES["photo"]["tmp_name"]);
        // $width = $fileinfo[0];
        // $height = $fileinfo[1];

        // Check if the file is a JPEG image
        $filename = basename($_FILES['photo']['name']);
        $ext = substr($filename, strrpos($filename, '.') + 1);
        if (($ext == "jpg") || ($ext == "png") || ($ext == "jpeg")) {
            $newname = dirname(__FILE__) . '/itemphoto/' . $filename;
            if (!file_exists($newname)) {
                // Attempt to move the uploaded file to its new location
               
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $newname)) {
                        $successmessage = "Item info successfully updated: Width - $width & Height - $height";
                    } else {
                        $errorMessage = "Error: A problem occurred during file upload!";
                    }
                }
            else {
                $errorMessage = "Error: File $filename already exists";
            }
        } else {
            $errorMessage = "Error: Only .jpg,.png,.jpeg images  are accepted for upload";
        }
    } else {
        $errorMessage = "Error: No file uploaded";
    }
  
    

    $sql = "SELECT * FROM item where item_name= '$iname' ";
    $data = $db->query($sql);
    foreach($data as $row){
      if(($iname == $row['item_name'])){
        //$flag=1;
        $errorMessage="Same item name,insert different item name";
      
    } 
  }
        
       if(empty($errorMessage)) {
            $sqlInsert = "INSERT INTO item (item_name, item_des, item_photo, item_size, item_type,limit_qty, category_id) VALUES ('$iname','$idescription','$filename','$size','$type','$qty',$cid)";
           $db->exec($sqlInsert);
            // Set success message only if no errors occurred
            $successMessage = "Item info successfully created";
            
        }
    }
$iname=$idescription=$filename=$size=$type=$qty="";

if (isset($_POST['update'])) 
{

  if (!(empty($_POST["iname"]))) {
  $iname=$_POST["iname"];}
  if (!(empty($_POST["idescription"]))) {
  $idescription=$_POST["idescription"];}
  if (!(empty($_POST["size"]))) {
  $size=$_POST["size"];}
 
  if (!(empty($_POST["type"]))) {
    $type=$_POST["type"];}
    if (!(empty($_POST["qty"]))) {
      $qty=$_POST["qty"];}
  $item_id=$_POST['item_id'];
 
 

  if((!empty($_FILES["photo"])) && ($_FILES['photo']['error'] == 0)) {
    //get image's width and height to check
  //    $fileinfo = @getimagesize($_FILES["photo"]["tmp_name"]);
  // $width = $fileinfo[0];
  // $height = $fileinfo[1];
//check for delete image
        $sqlphoto="select * from item where item_id=$item_id";
$stmtm2 = $db->query($sqlphoto); 
          $resultm2=$stmtm2->setFetchMode(PDO::FETCH_ASSOC);
       
          while($rowm2=$stmtm2->fetch()){
         $filename1=$rowm2['item_photo'];
          }
    //Check if the file is JPEG image
    $filename = basename($_FILES['photo']['name']);
   // echo $filename;echo "<br>";
  $ext = substr($filename, strrpos($filename, '.') + 1);
    //echo $ext;echo "<br>";
    if (($ext == "jpg")||($ext == "png")||($ext == "jpeg"))
      {
  //Determine the path to which we want to save this file

      $newname = dirname(__FILE__).'/itemphoto/'.$filename;
  //Check if the file with the same name is already exists on the server
        if (!file_exists($newname)) {
          //check width and height

  //Attempt to move the uploaded file to it's new place
    if ((move_uploaded_file($_FILES["photo"]["tmp_name"],$newname))) 
  {
     $newname1 = 'itemphoto/' . $filename1;

  if (file_exists($newname1)) {
     unlink($newname1);
  }
  $successMessage="Item info successfully update";
   } else {
    $errorMessage="Error: A problem occurred during file upload!";}
  }
  }
  else {
    $errorMessage="Error: File ".$_FILES["photo"]["name"]." already exists";}
    } 
     else {

      $sqlphoto="select * from item where item_id=$item_id";
$stmtm2 = $db->query($sqlphoto); 
          $resultm2=$stmtm2->setFetchMode(PDO::FETCH_ASSOC);
          $contn1=0;
          $filename="";
          while($rowm2=$stmtm2->fetch()){
         $filename=$rowm2['item_photo'];

          }
        }

    if(empty($errorMessage)){

      $sqlupdate="Update item SET item_name='$iname',item_des='$idescription',item_photo='$filename',item_size='$size',item_type='$type',limit_qty='$qty' where item_id=$item_id";
  
      // use exec() because no results are returned
     $db->exec($sqlupdate);
     $iname=$idescription=$filename=$size=$type=$qty="";
     echo '<script type="text/javascript">alert("Updated Successfully."); window.location=\'item.php\';</script>';
     

    }
     
  }
      
?>
<?php
 if (isset($_GET['edit'])) {
  $item_id = $_GET['edit'];
  $update = true;

  $sqledit="SELECT * FROM item WHERE item_id=$item_id";
  
   foreach($db->query($sqledit) as $result){
   $iname=$result['item_name'];
   $idescription=$result['item_des'];
   $filename=$result['item_photo'];
   
   $size=$result['item_size'];

   $type=$result['item_type'];
   $qty=$result['limit_qty'];
  
   
  }
}

  if(isset($_GET['delete']))
  {
    $item_id=$_GET['delete'];
    $filename1="";
 $sqlphoto1="select * from item where item_id=$item_id";
$stmtm2 = $db->query($sqlphoto1); 
            $resultm2=$stmtm2->setFetchMode(PDO::FETCH_ASSOC);
         
            while($rowm2=$stmtm2->fetch()){
           $filename1=$rowm2['item_photo'];
            }
            $newname1 = 'itemphoto/' . $filename1;
    if (file_exists($newname1)) {
       unlink($newname1);
    }else
    {
      $echmessage="File is Not Found!";
    }
   $sqldelete="DELETE FROM item WHERE item_id=".$_GET['delete'];
   $db->exec($sqldelete);
   
  }


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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

    <!-- Main content -->
    
    <section class="content-header">
      <div class="container-fluid">
       
      
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Item Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">

                <div class="card-body">
                  <input type="hidden" name="cid" value="<?php echo $cid;?>">
                  <input type="hidden" name="item_id" value="<?php echo $item_id;?>">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" required class="form-control" placeholder="Enter Name" name="iname" value="<?php echo $iname;?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Description</label>
                        <input type="text" required class="form-control" placeholder="Enter Description" name="idescription" value="<?php echo $idescription;?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-2">
                      <div class="form-group">
                        <label>Size</label>
                        <input type="text" class="form-control" placeholder="Enter Size" name="size" value="<?php echo $size;?>">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Type</label>
                        <input type="text" class="form-control" placeholder="Enter Type" name="type" value="<?php echo $type;?>">
                      </div>
                     </div>
                     <div class="col-sm-2">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Limit Quantity</label>
                        <input type="text" class="form-control" placeholder="Enter Limit Qty" name="qty" value="<?php echo $qty;?>" required>
                      </div>
                     </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Photo</label>
                        <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="photo">
                        <label class="custom-file-label" for="exampleInputFile">Choose photo file</label>
                      </div>
                     
                    </div>
                  </div>
                 
                  </div>

                <div class="card-footer">
                <?php if (!(isset($_GET['edit']))) {?>
                  <input type="submit" class="btn btn-primary" name="create" Value="Create"/>
                  <input type="submit" class="btn btn-primary" name="update" Value="Update" disabled/>
                  <?php }?>
                  <?php if ((isset($_GET['edit']))) {?>
                    <input type="submit" class="btn btn-primary" name="create" Value="Create" disabled />
                    <input type="submit" class="btn btn-primary" name="update" Value="Update"/>
                    <?php }?>
                </div>
              </form>
            </div>
                  </div>
               
                  </section>
          
            <section class="content-header">
      <div class="container-fluid">
       
      <?php if (!empty($successMessage)){?>
         <center> <label class="success"><?php echo $successMessage;?></label></center>
      <?php }
      if(!empty($errorMessage)){?>
      <center> <label class="error"><?php echo $errorMessage;?></label></center>
      
    <?php }?>
    <div class="card">
   
    <?php
    //Check There is no learning courses
    $tview=0;
    $arrayt=array();
    $tcount=0;
    $mtview="";
    $sql = "SELECT * FROM item";
          foreach ($db->query($sql) as $row)
          {
          $tview=$row['item_id'];
          $arrayt[] = $tview;
           } 
 $tcount=count($arrayt);
          if($tcount>0){ ?>
          <div class="card-header">
        <h3 class="card-title">Item List</h3>
      </div>
      <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="color:darkblue;">No</th>
                <th style="color:darkblue;">Name</th>
                <th style="color:darkblue;">Category Name</th>
                <th style="color:darkblue;">Description</th>
                <th style="color:darkblue;">Size</th>
                <th style="color:darkblue;">Type</th>
                <th style="color:darkblue;">Limit Qty</th>
                <th style="color:darkblue;">Photo</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            $sql1 = "SELECT * FROM item,category WHERE item.category_id=category.category_id";
            foreach ($db->query($sql1) as $row) { ?>
                <tr>
                    <td class="py-1"><?php echo $count++; ?></td>
                    <td class="py-1"><?php echo $row['item_name'] ?></td>
                    <td class="py-1"><?php echo $row['category_name'] ?></td>
                    <td class="py-1"><?php echo $row['item_des'] ?></td>
                    <td class="py-1"><?php echo $row['item_size'] ?></td>
                    <td class="py-1"><?php echo $row['item_type'] ?></td>
                    <td class="py-1"><?php echo $row['limit_qty'] ?></td>
                    <td class="py-1"><img src="itemphoto/<?php echo $row['item_photo'] ?>" style="width:50px;height:50px;"></td>
                    <td class="py-1"><a href="in_stock.php?itemid=<?php echo $row['item_id'] ?>"><i class="fas fa-plus"></i></a></td>
                    <td class="py-1"><a href="item.php?edit=<?php echo $row['item_id'] ?>"><i class="fas fa-edit"></i></a></td>
                    <td class="py-1"><a href="item.php?delete=<?php echo $row['item_id'] ?>" onclick="return confirm('Are you sure delete?')"><i class="fa fa-trash"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Size</th>
                <th>Type</th>
                <th>Limit Qty</th>
                <th>Photo</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>
          </div>
          <?php } else {
    $mtview="There is no item list";
   } ?>
  
<!-- ./wrapper -->
    <!-- Main content -->
    
    <?php 

//Display NO Learning Courses
    if (!empty($mtview)){?>
         <center> <label class="success"><?php echo $mtview;?></label></center>
      <?php }?>
   
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
    </div>
  </section>
  <div class="row">

  </div>
  <!-- /.content -->
</div>

          </section>
       

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>      
<?php include("layouts/footer.php");?>