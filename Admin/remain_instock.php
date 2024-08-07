<?php 

include('db.php');
include("layouts/header.php"); 

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Remain In stock</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Remain stock</li>
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
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Remain stock List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table class="table table-bordered table-striped" id="example1">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Instock Date</th>
                        <th>Remain Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;

                        $sql1 = "SELECT rs1.remain_id, rs1.stock_id, rs1.remain_quantity, rs1.item_id, rs1.remain_date
                                FROM remain_stock rs1
                                LEFT JOIN remain_stock rs2 ON rs1.stock_id = rs2.stock_id AND rs2.remain_id > rs1.remain_id
                                WHERE rs2.remain_id IS NULL ORDER BY remain_id DESC";

                        foreach ($db->query($sql1) as $row) {

                            $item_id = $row['item_id'];
                            $sql_item = "SELECT * FROM item WHERE item_id='$item_id'";
                            foreach($db->query($sql_item) as $row1)
                            {
                              $item_name= $row1['item_name'];
                            } 

                            $stock_id= $row['stock_id'];

                            $stock_sql = "SELECT * FROM in_stock WHERE stock_id='$stock_id'";
                            foreach($db->query($stock_sql) as $row2)
                            {
                              $date= $row2['in_stock_date'];
                            }
                            $price_sql = "SELECT * FROM change_price WHERE stock_id='$stock_id'";
                            foreach($db->query($price_sql) as $row3)
                            {
                              $price = $row3['sale_price'];
                            }


                        ?>
                        <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $item_name; ?></td>
                            <td><?php if(isset($price)){ echo $price; }else { echo " - ";} ?></td>
                            <td><?php echo $row['remain_quantity']?></td>
                            <td><?php echo $date ?></td>
                            <td><?php echo $row['remain_date']?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Instock Date</th>
                        <th>Remain Date</th>
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

<?php include("layouts/footer.php"); ?>
