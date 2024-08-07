<?php 
include("layouts/header.php");
include("db.php");

$iquantity=$stockprice=$date="";
$check=0;
$itemid="";

//echo $date;

$stockid="";
if(isset($_GET['itemid']))
{

    $itemid=$_GET['itemid'];
  }


if(isset($_POST['create']))
{
  $itemid=$_POST['itemid'];
$stockid=$_POST['stockid'];
$iquantity=$_POST['iquantity'];
//$stockprice=$_POST['stockprice'];
//$date=date("d/m/Y");

$stockprice = $_POST['stockprice']; // Assuming the input is submitted via POST
$pattern =  "/^\d+(\.\d{2})?$/";// Matches numbers with optional 2 decimal places
if (preg_match($pattern, $stockprice)) {
    // Valid input
    $successMessage="$stockprice is valid.";
} else {
    // Invalid input
    echo "$stockprice isn't a valid value with 2 decimals only.";
}


$date=$_POST['date'];
$dateFormatted = date("Y-m-d", strtotime($date));

    
$sql = "INSERT INTO in_stock(item_quantity,stock_item_price,in_stock_date,item_id) VALUES ('$iquantity',$stockprice,'$dateFormatted','$itemid')";
$db->exec($sql);


$sql_last= "SELECT * FROM in_stock WHERE stock_id = LAST_INSERT_ID()";
foreach($db->query($sql_last) as $row)
{
  $stock_id=$row["stock_id"];
}

$sqlremainstock = "INSERT INTO remain_stock(remain_quantity,remain_date,item_id,stock_id) 
VALUES ('$iquantity','$date','$itemid','$stock_id')";
$db->exec($sqlremainstock);

$total_item=$iquantity;

$sql_count="SELECT * FROM item_noti WHERE item_id = '$itemid'";
$stmt = $db->query($sql_count);


if ($stmt->rowCount() > 0) {
    // Item exists, update the quantity
    $sql_noti = "UPDATE item_noti SET total_item = total_item + '$total_item' WHERE item_id = '$itemid'";
    $db->exec($sql_noti);
} else {
    // Item does not exist, insert a new record
    $sql_noti = "INSERT INTO item_noti (item_id, total_item) VALUES ('$itemid', '$total_item')";
   $db->exec($sql_noti);
}


$iquantity=$stockprice=$dateFormatted="";
}

if (isset($_POST['update'])) 
{
  
  if (!(empty($_POST["iquantity"]))) {
  $iquantity=$_POST["iquantity"];}
  if (!(empty($_POST["stockprice"]))) {
  $stockprice=$_POST["stockprice"];}
 
  if (!(empty($_POST["date"]))) {
    $dateFormatted=$_POST["date"];}
  
  $stockid=$_POST['stockid'];
 
      $sqlupdate="Update in_stock SET item_quantity='$iquantity',stock_item_price='$stockprice',in_stock_date='$dateFormatted' where stock_id=$stockid";
      // use exec() because no results are returned
     $db->exec($sqlupdate);
     $iquantity=$stockprice=$dateFormatted="";

    }
     
   
    
 
?>
<?php
 if (isset($_GET['edit'])) {
  $stockid = $_GET['edit'];
  $update = true;

  $sqledit="SELECT * FROM in_stock WHERE stock_id=$stockid";
  
   foreach($db->query($sqledit) as $result){
   $iquantity=$result['item_quantity'];
   $stockprice=$result['stock_item_price'];
   $dateFormatted=$result['in_stock_date'];
   
   }
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
        
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content-header">
      <div class="container-fluid">
       
      
    <div class="card card-primary">
          <?php if (!empty($successMessage)){?>
         <center> <label class="success"><?php echo $successMessage;?></label></center>
      <?php }
      if(!empty($errorMessage)){?>
      <center> <label class="error"><?php echo $errorMessage;?></label></center>
    <?php }?>
          
              <div class="card-header">
                <h3 class="card-title">Add Item Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">

                <div class="card-body">
                  <input type="hidden" name="stockid" value="<?php echo $stockid;?>">
                  <input type="hidden" name="itemid" value="<?php echo $itemid;?>">
                  <div class="row">
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Item_Quantity</label>
                        <input type="number" required inputmode="numeric" class="form-control" placeholder="Enter Quantity" name="iquantity" value="<?php echo $iquantity;?>">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label >Stock_item_price</label>
                        <input type="number" required   inputmode="numeric" class="form-control"  placeholder="Enter Price" name="stockprice" value="<?php echo $stockprice;?>">
                      </div>
                    </div>
                    <!-- Date -->
                    <div class="form-group">
    <label>Date:</label>
    <div class="input-group date">
        <input type="date" required name="date" class="form-control datetimepicker-input" data-target="#reservationdate" value="<?php echo $dateFormatted; ?>"/>
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
       
      
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Stock' Data List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="color:darkblue;">No</th>
                    <th style="color:darkblue;">Item Name</th>
                    <th style="color:darkblue;">Item Quantity</th>
                    <th style="color:darkblue;">Stock Item Price</th>
                    <th style="color:darkblue;">In Stock Date</th>
                   
                   
                    <th></th>
                  
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $i=0;
                         $sql1 = "SELECT * FROM in_stock,item WHERE item.item_id=in_stock.item_id";
                         foreach ($db->query($sql1) as $row)
                          {?>
                     <tr>
                    <td class="py-1"><?php echo ++$i;?></td>
                    <td class="py-1"><?php echo $row['item_name']?></td>
                    <td class="py-1"><?php echo $row['item_quantity']?></td>
                    <td class="py-1"><?php echo $row['stock_item_price']?></td>
                    <td class="py-1"><?php echo $row['in_stock_date']?></td>
                   
                   
                
                    <td class="py-1"><a href="in_stock.php?edit=<?php echo $row['stock_id'] ?>"><i class="fas fa-edit"></i></a></td>  
                   


                         <?php }
                  
                    ?>
                 
                  
                  </tbody>
                  <tfoot>
                  <tr>
                  <th >No</th>
                    <th>Item Name</th>
                    <th>Item Quantity</th>
                    <th>Stock Item Price</th>
                    <th>In Stock Date</th>
                   
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
  </section>
  <div class="row">

  </div>
  <!-- /.content -->
</div>

          <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    


  <?php include("layouts/footer.php");?>