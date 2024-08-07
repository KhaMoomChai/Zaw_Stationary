<?php
include("layouts/header.php");
if($_SESSION['role']=="Employee"){
  echo '<script>window.location.href = "dashboard.php";</script>';
 }
if(isset($_GET['id'])){
  $price_id=$_GET['id'];
  $data="SELECT * from change_price where price_id='$price_id'";
  foreach ($db->query($data) as $row)
  {
    $barcode=$row['barcode'];
    $code=$row['code'];
  }
}else{
  echo '<script>window.location.href = "setprice.php";</script>';
}
?>
<style>
          #myDiv {
            text-align: center;
            margin: 20px;
        }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Barcode Details</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center ">
                <div id="myDiv" class="col-md-6">
                    <center>
                        <img src="temp/<?php echo $barcode ?>" alt="barcode" class="img-fluid"><br>
                        <span><b>Code No:</b><?php echo $code ?></span>
                    </center>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <button class="btn btn-primary" onclick="printDiv('myDiv')"> <i class="fas fa-print "></i> Print</button>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
    <!-- /.content -->
</div>
                          </div>

      <script>
        function printDiv(divId) {
            var divToPrint = document.getElementById(divId);
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print</title><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"></head><body>' + divToPrint.innerHTML + '</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
<?php include("layouts/footer.php"); ?>

