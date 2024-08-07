<?php
include("layouts/header.php");
?>

<div class="content-wrapper">
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
            <div class="card">
                <?php if (!empty($successMessage)): ?>
                    <center><label class="success"><?php echo $successMessage; ?></label></center>
                <?php endif; ?>

                <?php if (!empty($errorMessage)): ?>
                    <center><label class="error"><?php echo $errorMessage; ?></label></center>
                <?php endif; ?>

                <?php $count = 0; ?>
                <div class="card-header">
                    <h3 class="card-title">Item List</h3>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th style="color: darkblue;">No</th>
      <th style="color: darkblue;">Name</th>
      <th style="color: darkblue;">Category Name</th>
      <th style="color: darkblue;">Description</th>
      <th style="color: darkblue;">Limit Quantity</th>
      <th style="color: darkblue;">Size</th>
      <th style="color: darkblue;">Type</th>
      <th style="color: darkblue;">Photo</th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody id="myTable">
    <?php
    $count = 1;
    $sql1 = "SELECT * FROM item,category WHERE item.category_id=category.category_id";
    foreach ($db->query($sql1) as $row) {
    ?>
      <tr>
        <td class="py-1"><?php echo $count++; ?></td>
        <td class="py-1"><?php echo $row['item_name'] ?></td>
        <td class="py-1"><?php echo $row['category_name'] ?></td>
        <td class="py-1"><?php echo $row['item_des'] ?></td>
        <td class="py-1"><?php echo $row['limit_qty'] ?></td>
        <td class="py-1"><?php echo $row['item_size'] ?></td>
        <td class="py-1"><?php echo $row['item_type'] ?></td>
        <td class="py-1">
          <img src="itemphoto/<?php echo $row['item_photo'] ?>" style="width:50px;height:50px;">
        </td>
        <td class="py-1">
          <a href="in_stock.php?itemid=<?php echo $row['item_id'] ?>"><i class="fas fa-plus"></i></a>
        </td>
        <td class="py-1">
          <a href="item.php?edit=<?php echo $row['item_id'] ?>"><i class="fas fa-edit"></i></a>
        </td>
        <td class="py-1">
          <a href="item.php?delete=<?php echo $row['item_id'] ?>" onclick="return confirm('Are you sure to delete?')"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
  <tfoot>
    <tr>
      <th>No</th>
      <th>Name</th>
      <th>Category Name</th>
      <th>Description</th>
      <th>Limit Quantity</th>
      <th>Size</th>
      <th>Type</th>
      <th>Photo</th>
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
  </section>
  <div class="row">

  </div>
  <!-- /.content -->
</div>

          <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<?php include("layouts/footer.php");?>