<?php
session_start(); 
$name="";
if(isset($_SESSION['name']))
{
  $name=$_SESSION['name'];
}

if(isset($_GET['invoice_id']))
{
    include('db.php');
    $invoice_no=$_GET['invoice_id'];
    $sql="select * from sale where invoice_no='$invoice_no'";
    foreach($db->query($sql) as $row){
        $date=$row['day']."/".$row['month']."/".$row['year'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Page</title>
      <!-- DataTables -->
      <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <style>
    @media print {
      body * {
        visibility: hidden;
      }
      #print-table, #print-table * {
        visibility: visible;
      }
      #print-table {
        position: absolute;
        left: 0;
        top: 0;
      }
    }
  </style>
</head>
<body>
  <div id="print-table">
    <div class="card">
        <div class="card-body">
          <div class="container mb-5 mt-3">
            <div class="row d-flex align-items-baseline">
              <div class="col-sm-8">
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
                    <p style="color: #7e8d9f;font-size: 18px;">Date :<?php echo "  ".$date?></p>
                    <p style="color: #7e8d9f;font-size: 18px;">Employee : <?php echo $name; ?></p>
                    <p style="color: #7e8d9f;font-size: 18px;">Invoice : <?php echo $invoice_no;?></p>
                </div>
                <hr>
                <div class="container">
                  <div class="row mx-1 justify-content-center">
                    <table class="table table-striped table-borderless">
                        <thead style="background-color:#84B0CA ;" class="text-white">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $a=1;
                        $sale="SELECT item_id, sale_price, sale_quantity, sale_total_price,
                        SUM(sale_total_price) OVER () AS total_sale
                        FROM sale 
                        WHERE invoice_no = '$invoice_no'
                        GROUP BY item_id, sale_price, sale_quantity, sale_total_price";
                        
                        foreach($db->query($sale) as $row)
                        { 
                        ?>
                        <tr>
                            <th scope="row"><?php echo $a++?></th>
                            <?php 
                            $item_id=$row["item_id"];
                            $item_sql="select item_name from item where item_id=$item_id";
                            foreach($db->query($item_sql) as $row1)
                            {?>
                            <td><?php echo $row1['item_name'] ?></td>
                            <?php 
                            }?>
                            <td><?php echo $row['sale_price'] ?></td>
                            <td><?php echo $row["sale_quantity"] ?></td>
                            <td><?php echo $row["sale_total_price"]; ?></td>
                        </tr>
                            <?php
                            $total = $row["total_sale"];
                            
                        }
                            ?>
                        <tr>
                            <td colspan="3">Thank you for your purchase</td>
                            <th class="text-end" class="me-0">Total</th>
                            <th style="font-size: 20px;"><?php echo $total;?> Kyats</th>
                        </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
          </div>
        </div>
    </div>
  </div>
<div class="container">
  <div class="row">
    <div class="col-md-6 float-left">
      <a  href="sale.php" class="btn btn-info text-capitalize border-0">
      <i class="fas fa-arrow-left "></i> Back</a>
    </div>
  </div>
</div>

  <script>
    window.onload = function() {
      window.print();
      window.onafterprint = function () {
        window.close();
      }
    };
  </script>
</body>
</html>
<?php } ?>