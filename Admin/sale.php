<?php 
include('db.php');
include("layouts/header.php");

$check=0;
$item_name=$item_id=$date=$quantity=$emp_name=$stock_id=$invoice_no="";
$sale_price=0;
$message="";

if(isset($_SESSION['name'])){
  $emp_name=$_SESSION['name'];
}

if(isset($_GET['sale']))
{ 

  $date=date("Y/m/d");
  $year  = substr($date,0,4); 
  $month = substr($date,5,2);  
  $day   = substr($date,8);

  $sql_temp2="select * from temp";

    foreach($db->query($sql_temp2) as $row)
    { 
      $stock_id=$row['stock_id'];
      $sale_qty=$row['sale_quantity'];
      $sale_total_price=$row['sale_total_price'];
      $invoice_no=$row['invoice_no'];
      $sql_stock="select * from in_stock where stock_id=$stock_id";
      $item_id=$row['item_id'];

      $sql_changeprice="select * from change_price where stock_id='$stock_id'";
      foreach($db->query($sql_changeprice) as $row3)
      {
        $price_id=$row3['price_id'];
        $sale_price=$row3['sale_price'];
      }
      
      $sql_sale="insert into sale
      (item_id,sale_quantity,price_id,sale_total_price,day,month,year,emp_name,invoice_no,sale_price) 
      values('$item_id','$sale_qty','$price_id','$sale_total_price','$day','$month','$year','$emp_name','$invoice_no','$sale_price')";
      $db->exec($sql_sale);
    
      $sql_getRqty="select * from remain_stock where stock_id='$stock_id'";
        foreach($db->query($sql_getRqty) as $row2)
        {
        $remain_quantity=$row2['remain_quantity'];
        }
    
      $remain_quantity=$remain_quantity-$sale_qty;
    
      $sql_remain="insert into remain_stock(item_id,remain_quantity,remain_date,stock_id) values ('$item_id','$remain_quantity','$date','$stock_id')";
      $db->exec($sql_remain);
    

      $sql_noti= $db->query("SELECT * FROM item_noti WHERE item_id = '$item_id'");
      foreach($sql_noti as $row)
      {
        $total=$row['total_item'];
      }

      $total_item=$total-$sale_qty;
      
      if ($sql_noti->rowCount() > 0) {
          // Item exists, update the quantity after sale
          $sql_noti_update = "UPDATE item_noti SET total_item = '$total_item' WHERE item_id = '$item_id'";
          $db->exec($sql_noti_update);

      } else {
          echo "Item not found in the inventory.";
      }

     }

    $sql_delete_temp="delete from temp";
    $db->exec($sql_delete_temp);
    $_SESSION['invoice_no']=$invoice_no;

    echo '<script type="text/javascript">alert("Sale Data Added Successful.");window.location=\'invoice_detail.php?invoice_detail=' . $invoice_no . '\';</script>';
  
}

if(isset($_POST['item']))
{ 
  
  if(empty($_POST['stock_id']) || empty($_POST['quantity'])){
    echo '<script type="text/javascript">alert("You need to scan bar code to add item!");</script>';
  }else if(isset($_POST['stock_id'] ) && isset($_POST['quantity'])){
  $stock_id=$_POST['stock_id'];
  $sale_qty=$_POST['quantity'];
  $date=date("Y/m/d");

  // invoice
  function getLastInvoiceNumberFromDatabase($db) {
    // Query to get the last invoice number from the database
    $sql = "SELECT MAX(invoice_no) AS last_invoice_number FROM sale";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // If there are rows returned, return the last invoice number
    if ($result && $result['last_invoice_number'] !== null) {
        return $result['last_invoice_number'];
    } else {
        // If no rows are returned, return 0 (indicating no previous invoice number)
        return 0;
    }
}


function generateInvoiceNumber($db) {
  // Retrieve the last invoice number from the database
  $lastInvoiceNumber = getLastInvoiceNumberFromDatabase($db);

  // Extract numeric part and increment
  $newInvoiceNumber = ($lastInvoiceNumber) ? (int)substr($lastInvoiceNumber, -4) + 1 : 1;

  // Concatenate the current date and the new invoice number
  $invoiceNumber = 'INV' . date('Ymd') . '-' . str_pad((string)$newInvoiceNumber, 4, '0', STR_PAD_LEFT);

  return $invoiceNumber;
}

// Example usage
 $invoice_no = generateInvoiceNumber($db);

  $sql_price="select * from change_price where stock_id='$stock_id' ";

    foreach($db->query($sql_price) as $row)
    {
    $sale_price=$row['sale_price'];
    $price_id=$row['price_id'];
    $item_id=$row['item_id'];
    }
  $sql_item="select * from item where item_id='$item_id'";
    foreach($db->query($sql_item) as $row){
      $item_name=$row['item_name'];
    }

  $total_price=$sale_price*$sale_qty;
  $sql_temp="insert into temp(sale_quantity,sale_total_price,emp_name,item_name,price,invoice_no,stock_id,item_id) 
  values('$sale_qty','$total_price','$emp_name','$item_name','$sale_price','$invoice_no','$stock_id','$item_id')
  ON DUPLICATE KEY UPDATE sale_quantity = sale_quantity + '$sale_qty',
  sale_total_price = sale_quantity * '$sale_price'";
  $db->exec($sql_temp);

  }

}


//edit qty
if(isset($_GET['editstock_id']))
{
  $stock_id=$_GET['editstock_id'];

  $sql="SELECT * FROM temp WHERE stock_id='$stock_id'";
  foreach($db->query($sql) as $row){
    
  }
}

// delete add item
if(isset($_GET['delstock_id'])){
  $stock_id=$_GET['delstock_id'];
  $sql_delete_item="DELETE FROM temp where stock_id=$stock_id";
  $db->exec($sql_delete_item);

}
?>

<!-- for qr scanner -->
<script src="./node_modules/html5-qrcode/html5-qrcode.min.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sale</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sale</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     
        <!-- Main content -->
        <section class="content">
      <div class="container-fluid">

        <div class="row">
          <style>
            #main {
            display: flex;
            justify-content: center;
            align-items: center;
            }
            #reader {
            width: 200px;
            }
            #result {
            text-align: center;
            font-size: 1.5rem;
            }
          </style>
          <div id="main">
            <!-- <div id="reader"></div> -->
          </div>
        </div>

        <div class="row">
          <!-- left column -->         
          <div class="col-md-4 col-sm-12">           
           <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Item</h3><span>&nbsp;</span>
                <!-- <span><?php //echo date("Y/m/d");?></span> -->
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="row">
                      <div class="form-group">
                        <label>Barcode</label>
                        <!-- scan result -->
                        <input type="text" id="result" placeholder="Scan Barcode" oninput="handleManualEntry()"
                         name="qr_code" class="form-control" autofocus required>
                      </div>
                      <div class="form-group">
                        <label class="text-danger"><?php echo $message; ?></label>
                      </div>
                  </div>
                </div>
                <div class="card-body">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                  <!-- from scan_process ajax -->
                  <div id="itemInfo">
                    
                  </div>
                                 
                </div>
                <div class="card-footer">
                  <div class="container">
                    <div class="row">
                      <div class="col-sm-6"><a href="sale.php" class="btn btn-light" >Cancel</a></div>
                      <div class="col-sm-6"><input type="submit" class="btn btn-primary ml-3" name="item" Value="Item Add"/></div>
                    </div>
                  </div>
                </div>
              </form>

            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-8 col-sm-12">

            <div class="card">
              <div class="card-body">
                <div class="container mb-5 mt-3" id="print-container">
                  <div class="row d-flex align-items-baseline">
                      <div class="col-md-8">
                          <div class="row">
                              <i class="fab fa-3x ms-0" style="color:#5d9fc5;">ဇော်</i>
                          </div>
                          <p class=""style="color:#5d9fc5;">စာရေးကိရိယာ နှင့် စတိုး</p>
                          <div class="row">
                              <div class="col-sm-12">
                                  <?php 
                                    $sql_shopInfo="select * from shop_info";
                                    foreach($db->query($sql_shopInfo) as $row)
                                    {
                                      $address = $row["location"];
                                      $phone = $row["phone"];
                                    }
                                  ?>
                                  <p style="color: #7e8d9f;"><i class="fas fa-home"></i>&nbsp;<?php echo $address; ?></p>
                                  <p style="color: #7e8d9f;"><i class="fas fa-phone"></i>&nbsp;<?php echo $phone; ?></p>
                              </div>  
                                        
                          </div>
                      </div>
                      <div class="col-sm-4">
                          <p style="color: #7e8d9f;font-size: 18px;">Date :<?php echo "  ".date("d/m/Y")?></p>
                          <p style="color: #7e8d9f;font-size: 18px;">Employee : <?php echo $emp_name; ?></p>
                          <?php $sql_invoice="select * from temp";
                              foreach($db->query($sql_invoice) as $row)
                              {
                                $invoice_no=$row['invoice_no'];
                              }
                          ?>
                          <p style="color: #7e8d9f;font-size: 18px;">Invoice : <?php echo $invoice_no;?></p>
                      </div>
                      <hr>
                      <div class="container">
                        <div class="row">                          
                        </div>
                        <div class="row mx-1 justify-content-center">
                          <table class="table table-striped table-borderless">
                            <thead style="background-color:#84B0CA ;" class="text-white">
                              <tr>
                                <th></th>
                                <th scope="col">#</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                                $total=0;
                                $a=1;
                              $add_item="select * from temp";
                              foreach($db->query($add_item) as $row)
                              { 
                              ?>
                              <tr>
                                <td><a href="sale.php?delstock_id=<?php echo $row['stock_id'] ?>" class="delete-button"
                                onclick="return confirm('Are you sure delete?')"><i class="fa fa-minus" style="font-size:18px;color:#fc5c9c;"></i></a>
                                </td>
                                <th scope="row"><?php echo $a++?></th>
                                <td><?php echo $row["item_name"] ?></td>
                                <td><?php echo $row["price"] ?></td>
                                <td><?php echo $row["sale_quantity"] ?>
                                  <!-- <a href="sale.php?edit_stock_id=<?php //echo $row['stock_id'] ?>">
                                  <i class="fas fa-edit"></i></a> -->
                                </td>
                                <td class="sale-total"><?php echo $row["sale_total_price"]; ?></td>
                              </tr>
                                <?php
                                  $total += $row["sale_total_price"];
                                  
                              }
                                  ?>
                              <tr>
                                  <td colspan="4">Thank you for your purchase</td>
                                  <th class="text-end" class="me-0">Total</th>
                                  <th style="font-size: 20px;"><?php echo $total;?> Kyats</th>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                      <div class="row">
                        <div class="col-md-6"></div>
                        <?php
                          $count_temp = "SELECT COUNT(*) AS rowCount FROM temp";
                          $stmt = $db->prepare($count_temp);
                          $stmt->execute();
                          $result = $stmt->fetch(PDO::FETCH_ASSOC);
                          $rowCount = $result['rowCount'];
                          if(!empty($rowCount)){?>
                          <div class="col-md-2 ml-auto">
                            <a href="sale.php?sale=<?php echo $invoice_no; ?>" class="btn btn-primary text-capitalize border-0">&nbsp;Sale&nbsp;</a>
                          </div>
                        <?php  
                        }
                        ?>
                        
                      </div>

                  </div>
            </div>
          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sale Data List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Invoice Number</th>
                    <th>Total Sale Amount</th>
                    <th>Date</th>
                    <th>Employee Name</th>
                    <th>Details</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $i=1;
                         $sql1 = "SELECT invoice_no,emp_name,day,month,year, SUM(sale_total_price) AS total_sale
                         FROM sale
                         GROUP BY invoice_no
                         ORDER BY sale_id DESC";
                         foreach ($db->query($sql1) as $row)
                          {
                    ?>
                     <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo $row['invoice_no'] ?></td>
                    <td><?php echo $row['total_sale'] ." Kyats"?></td>
                    <td><?php echo $row['day']."-".$row['month']."-".$row['year'] ?></td>
                    <td><?php echo $row['emp_name']?></td>
                    <td><a  href="invoice_detail.php?invoice_detail=<?php echo $row['invoice_no'] ?>" class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                          class="fas fa-eye text-primary"></i> Detail</a></td>
                   <?php }
                    ?>

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Invoice Number</th>
                    <th>Total Sale Amount</th>
                    <th>Date</th>
                    <th>Employee Name</th>
                    <th>Details</th>
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<script>
    function handleManualEntry() {
        // Get the manually entered QR code value
        var result = document.getElementById('result').value;

        processQRCodeResult(result);

    }

    function processQRCodeResult(result) {
        // $.ajax({
        //     type: 'POST',
        //     url: 'check_qr_code.php',
        //     data: { qr_code: result },
        //     success: function (response) {

                    document.getElementById('result').value = result;

                    $.ajax({
                        type: 'POST',
                        url: 'scan_process.php',
                        data: { qr_code: result },
                        success: function (response) {
                            $('#itemInfo').html(response);
                        },
                        error: function () {
                            alert('Error while processing request.');
                        }
                    });

                // }
        //     },
        //     error: function () {
        //         console.error('Error while checking QR code.');
        //         alert('Error while checking QR code.');
        //     }
        // });
    }
</script>
<?php include("layouts/footer.php"); ?>
