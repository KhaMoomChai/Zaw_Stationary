<?php
include("layouts/header.php");
include("db.php");
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">

      </div><!-- /.container-fluid -->
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
                         $sql1 = "SELECT * FROM in_stock,item WHERE item.item_id=in_stock.item_id ORDER BY stock_id DESC";
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
