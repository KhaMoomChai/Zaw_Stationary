<?php

include("layouts/header.php");
require 'vendor/autoload.php'; // Include the Composer autoloader

use Picqer\Barcode\BarcodeGeneratorPNG;
if($_SESSION['role']=="Employee"){
  echo '<script>window.location.href = "dashboard.php";</script>';
 }
$check=0;
$stock_id="";
$sale_price="";
$sale_date="";
$item_id="";
$code="";
$barcodeImage="";
$bar='';
$fullPath="";
$Err="";
$fullCode="";
$checkDigit="";
if(isset($_POST['radioValue'])){
    $stock_id = $_POST['radioValue'];
    $_SESSION['stock_id']=$stock_id;
}
if(isset($_POST['create']) ) {
  if(isset($_SESSION['stock_id'])){
	$tempDir = 'temp/';
	$item_id = $_POST['item'];
  $name="SELECT * from item where item_id='$item_id'";
  foreach ($db->query($name) as $row){
    $iname=$row['item_name'];
  }

	$stock_id =  $_SESSION['stock_id'];
  unset($_SESSION['stock_id']);
	$price =  $_POST['sale_price'];
  $filename=$iname.'$'.$price;
  $bar = $filename . '.png';

  function getLastCodeNumberFromDatabase($db) {
    try {
        $sql = "SELECT MAX(code) AS last_code FROM change_price";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['last_code'] !== null) {
            $lastCode = $result['last_code'];
            // Exclude the last digit
            $lastCodeWithoutLastDigit = substr($lastCode, 0, -1);
            return $lastCodeWithoutLastDigit;
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        // handle the exception, log the error, or rethrow it
        echo "Error: " . $e->getMessage();
    }
}

function generateCodeNumber($db) {

$lastCodeNumber = getLastCodeNumberFromDatabase($db);


$newCodeNumber = ($lastCodeNumber) ? (int)substr($lastCodeNumber, -4) + 1 : 1;


$code =  date('Ymd').str_pad((string)$newCodeNumber, 4, '0', STR_PAD_LEFT);

return $code;
}
function calculateEAN13CheckDigit($code) {
  // Remove any non-numeric characters from the code
  $code = preg_replace('/[^0-9]/', '', $code);

  // Calculate the check digit
  $sum = 0;
  for ($i = 0; $i < 12; $i++) {
      $sum += ($i % 2 === 0) ? (int)$code[$i] : (int)$code[$i] * 3;
  }

  $checkDigit = (10 - ($sum % 10)) % 10;

  return $checkDigit;
}
// Your EAN-13 code (without the check digit)
$code = generateCodeNumber($db);

// Calculate the check digit
$checkDigit = calculateEAN13CheckDigit($code);

// Add the check digit to the code
$fullCode = $code . $checkDigit;

// Generate the barcode image
$generator = new BarcodeGeneratorPNG();
$barcodeImage = $generator->getBarcode($fullCode, 'EAN13');

// Example usage
// $code = generateCodeNumber($db);
// $generator = new BarcodeGeneratorPNG();
// $barcodeImage = $generator->getBarcode((string) $code, 'EAN13');
$folderPath = 'temp/'; // Replace with your actual folder path
$fullPath = $folderPath . '/' . $bar;
file_put_contents($fullPath, $barcodeImage);
$date=date("Y/m/d");
$price_add = "INSERT INTO change_price(sale_price,sale_date,item_id,stock_id,barcode,code) VALUES ('$price','$date','$item_id','$stock_id','$bar','$fullCode')";
  $db->exec($price_add);
  $message="Data added successfully!";
}else{
  $Err="You must select instock data to generate barcode!";
}
 }


if(isset($_GET['price_delete']))
{
  // $price_id=$_GET['price_delete'];
  // $price_delete="DELETE FROM change_price where price_id=$price_id";
  // $db->exec( $price_delete);
  $price_id=$_GET['price_delete'];
$filename1="";
$sqlphoto1="select * from change_price where price_id=$price_id";
$stmtm2 = $db->query($sqlphoto1);
          $resultm2=$stmtm2->setFetchMode(PDO::FETCH_ASSOC);

          while($rowm2=$stmtm2->fetch()){
         $filename1=$rowm2['barcode'];
          }
          $newname1 = 'temp/' . $filename1;
  if (file_exists($newname1)) {
     unlink($newname1);
  }else
  {
    $echmessage="File is Not Found!";
  }
 $sqldelete="DELETE FROM change_price where price_id=".$_GET['price_delete'];
 $db->exec($sqldelete);
}
if(isset($_GET['price_update']))
{
  $pid=$_GET['price_update'];
  $_SESSION['pid']=$pid;
  $change_price="SELECT * from change_price where price_id='$pid'";
  foreach ($db->query($change_price) as $row)
{
      $_SESSION['price_id']=$row['price_id'];
      $item_id=$row['item_id'];
      $_SESSION['item']=$item_id;
      $stock_id=$row['stock_id'];
      $_SESSION['stock']=$stock_id;
      $sale_price=$row['sale_price'];
  }
  $check=1;
}


if(isset($_POST['update']))
{
  $pid=$_SESSION['pid'];
  if(isset($_POST['item'])){
    $item = $_POST['item'];
  }else{
  $item =  $_SESSION['item'];
  unset( $_SESSION['item']);
  }
  $name="SELECT * from item where item_id='$item'";
  foreach ($db->query($name) as $row){
    $iname=$row['item_name'];
  }
  $date=date("Y/m/d");
  $price=$_POST['sale_price'];
  if(isset($_SESSION['stock_id'])){
  $stock = $_SESSION['stock_id'];
 unset( $_SESSION['stock_id']);
  }else{
  $stock =  $_SESSION['stock'];
  unset( $_SESSION['stock']);
  }
  $tempDir = 'temp/';
  $filename=$iname.'$'.$price;
  $filename=$iname.'$'.$price;
  $bar = $filename . '.png';
  function getLastCodeNumberFromDatabase($db) {
    try {
        $sql = "SELECT MAX(code) AS last_code FROM change_price";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['last_code'] !== null) {
            $lastCode = $result['last_code'];
            // Exclude the last digit
            $lastCodeWithoutLastDigit = substr($lastCode, 0, -1);
            return $lastCodeWithoutLastDigit;
        } else {
            return 0;
        }
    } catch (PDOException $e) {
        // handle the exception, log the error, or rethrow it
        echo "Error: " . $e->getMessage();
    }
}

function generateCodeNumber($db) {

$lastCodeNumber = getLastCodeNumberFromDatabase($db);


$newCodeNumber = ($lastCodeNumber) ? (int)substr($lastCodeNumber, -4) + 1 : 1;


$code =  date('Ymd').str_pad((string)$newCodeNumber, 4, '0', STR_PAD_LEFT);

return $code;
}

function calculateEAN13CheckDigit($code) {
  // Remove any non-numeric characters from the code
  $code = preg_replace('/[^0-9]/', '', $code);

  // Calculate the check digit
  $sum = 0;
  for ($i = 0; $i < 12; $i++) {
      $sum += ($i % 2 === 0) ? (int)$code[$i] : (int)$code[$i] * 3;
  }

  $checkDigit = (10 - ($sum % 10)) % 10;

  return $checkDigit;
}
// Your EAN-13 code (without the check digit)
$code = generateCodeNumber($db);

// Calculate the check digit
$checkDigit = calculateEAN13CheckDigit($code);

// Add the check digit to the code
$fullCode = $code . $checkDigit;

// Generate the barcode image
$generator = new BarcodeGeneratorPNG();
$barcodeImage = $generator->getBarcode($fullCode, 'EAN13');
$folderPath = 'temp/'; // Replace with your actual folder path
$fullPath = $folderPath . '/' . $bar;
file_put_contents($fullPath, $barcodeImage);
$date=date("Y/m/d");

$filename1="";
$sqlphoto1="select * from change_price where price_id=$pid";
$stmtm2 = $db->query($sqlphoto1);
          $resultm2=$stmtm2->setFetchMode(PDO::FETCH_ASSOC);

          while($rowm2=$stmtm2->fetch()){
         $filename1=$rowm2['barcode'];
          }
          $newname1 = 'temp/' . $filename1;
  if (file_exists($newname1)) {
     unlink($newname1);
  }else
  {
    $echmessage="File is Not Found!";
  }
$update="UPDATE change_price SET sale_price='$price', sale_date='$date', item_id='$item',barcode='$bar',stock_id='$stock',code='$fullCode' where price_id='$pid'";
$db->exec($update);
$message="Update is successful";

}


?>
<style>
  .span-box1 {
  color: red;
  animation: fadeOut 10s forwards;
}
.span-box2 {
  color: green;
  animation: fadeOut 10s forwards;
}

@keyframes fadeOut {
  to {
    opacity: 0;
  }
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Price Setting</h1>
            <?php if(isset($Err)){ ?>
            <span class="span-box1">
              <?php echo $Err; ?>
            </span> <?php } ?>
            <?php if(isset($message)){ ?>
             <span class="span-box2">
              <?php echo $message; ?>
           </span><?php  } ?>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-4">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Price</h3><div id="result"></div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
              <div class="card-body myoutput">

                <div class="form-group">
                        <label>Item Name</label>
                        <select name="item"  id="category-dropdown" class="form-control border border-dark" value="" required>
                        <?php if($check==1){
                          $it = "SELECT * FROM item where item_id=$item_id";
                          foreach ($db->query($it) as $ite)
                          {?>
                       <option value="<?php echo $ite['item_id']; ?>"><?php echo $ite['item_name']; ?></option>
                        <?php }} ?>
                        <option value=""></option>
                        <?php
                            // $sql = "SELECT item.*
                            // FROM item
                            // JOIN in_stock ON item.item_id = in_stock.item_id
                            // WHERE in_stock.item_quantity > 0";
                            $sql = "SELECT DISTINCT item.*
                            FROM item
                            JOIN in_stock ON item.item_id = in_stock.item_id
                            WHERE in_stock.item_quantity > 0";
                            foreach ($db->query($sql) as $item)
                            {
                          ?>
                          <option value="<?php echo $item['item_id']; ?>"><?php echo $item['item_name']; ?></option>
                          <?php } ?>
                        </select>
                </div>
                <div class="form-group">
                    <label>Sale Price</label>
                        <input type="text" name="sale_price" class="form-control" placeholder="Enter sale price" value="<?php echo $sale_price ?>" required>
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

        </div>
        <div class="col-md-4">
         <div class="card">
              <div class="card-header">
                <h3 class="card-title">Please Select The Instock Data!</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table  class="table table-bordered table-hover" id="radioTable">
                  <thead>
                  <tr>
                    <th></th>
                    <th>Stock Price</th>
                    <th>Stock Date</th>
                  </tr>
                  </thead>
                  <tbody id="sub-category-dropdown">



                  </tbody>
                </table>

              </div>

         </div>
        </div>
        <?php
			if(!isset($filename)){
				$filename = "author";
			}
			?>
        <div class="col-md-4">
        <div class="qr-field">
				<h2 style="text-align:center">Barcode Result: </h2>
        <center>
          <?php
          if($filename=='author'){ ?>
            <div style=" width:210px; height:210px;">
							<?php echo '<img src="photo/baravt.jpg" style="width:200px; height:200px;"><br>'; ?>
              <a class="btn btn-primary submitBtn" style="width:210px; margin:5px 0;" href="#" >Download Barcode</a>
					</div>
          <?php }else{ ?>
          <img src="temp/<?php echo $bar ?>" alt="barcode">
          <a class="btn btn-primary submitBtn" style="width:210px; margin:5px 0;" href="download.php?file=<?php echo $fullPath ; ?> ">Download Barcode</a>
          <?php } ?>

				</center>

			</div>
        </div>


        <!-- /.row -->
    </div><!-- /.container-fluid -->
    <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Price History</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>Item Name</th>
                    <th>Sale Price</th>
                    <th>Set Date</th>
                    <th>Stock Date</th>
                    <th>Stock Price</th>
                    <th>Barcode</th>
                    <th>Edit</th>
                    <!-- <th>Delete</th> -->
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                         $sql1 = "SELECT * FROM change_price ORDER BY price_id DESC";
                         foreach ($db->query($sql1) as $row)
                          {?>
                     <tr>
                      <?php
                      $item_id=$row['item_id'];
                       $items = "SELECT * FROM item where item_id='$item_id'";
                         foreach ($db->query($items) as $item)
                          {?>
                    <td><?php echo $item['item_name']?></td>
                      <?php } ?>
                    <td><?php echo $row['sale_price']?></td>
                    <td><?php echo $row['sale_date']?></td>
                    <?php
                    $stock_id=$row['stock_id'];
                    $stocks = "SELECT * FROM in_stock where stock_id='$stock_id'";
                      foreach ($db->query($stocks) as $stock)
                       {?>
                    <td><?php echo $stock['in_stock_date']?></td>
                    <td><?php echo $stock['stock_item_price']?></td>
                    <?php } ?>
                    <td><a  href="view_barcode.php?id=<?php echo $row['price_id'] ?>" class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                          class="fas fa-eye text-primary"></i> Detail</a></td>

                    <td><a href="setprice.php?price_update=<?php echo $row['price_id'] ?>"><i class="fas fa-edit"></i></a></td>
                    <!-- <td><a href="setprice.php?price_delete=<?php echo $row['price_id'] ?>" onclick="return confirm('Are you sure delete?')"><i class="fa fa-trash" ></i></a></td> -->
                         <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Item Name</th>
                    <th>Sale Price</th>
                    <th>Set Date</th>
                    <th>Stock Date</th>
                    <th>Stock Price</th>
                    <th>Barcode</th>
                    <th>Edit</th>
                    <!-- <th>Delete</th> -->
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

  </div>
  <!-- /.content -->
</div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script>
    $(document).ready(function()
    {
        $('#category-dropdown').on('change',function(){
            var item=this.value;
            $.ajax({
                url:"getstock.php",
                type:"POST",
                data:{item:item},cache:false,success:function(result){
                    $("#sub-category-dropdown").html(result);
                }
            });
        });
    });
</script>



<?php include("layouts/footer.php"); ?>


