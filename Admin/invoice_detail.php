<?php 
if(isset($_GET['invoice_detail']))
{
    include('db.php');
    include("layouts/header.php");
    $invoice_no=$_GET['invoice_detail'];
    $sql="select * from sale where invoice_no='$invoice_no'";
    foreach($db->query($sql) as $row){
        $date=$row['day']."/".$row['month']."/".$row['year'];
        $emp_name=$row['emp_name'];
    }

?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Invoice Details</h1>
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

<div class="col-md-8 col-sm-12">

    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
            <div class="row d-flex align-items-baseline">
                <div class="col-md-8">
                    <div class="row">
                        <i class="fab fa-3x ms-0" style="color:#5d9fc5;">ZAW</i>
                    </div>
                    <p class="">Zaw Stationary</p>
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
                <div class="col-md-4">
                    <p style="color: #7e8d9f;font-size: 18px;">Date :<?php echo "  ".$date?></p>
                    <p style="color: #7e8d9f;font-size: 18px;">Employee : <?php echo $emp_name; ?></p>
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
                <div class="row">
                <div class="col-md-6"></div>
                    <div class="col-md-2">
                        <a  href="print_page2.php?invoice_id=<?php echo $invoice_no?>" class="btn btn-primary text-capitalize border-0" data-mdb-ripple-color="dark"><i
                        class="fas fa-print "></i> Print</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
  </div>
<?php include("layouts/footer.php"); 
    }
?>
