<?php 
include("layouts/header.php"); 
include("db.php");
if(isset($_GET['contact_id'])){
    $id=$_GET['contact_id'];
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Read Mail</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
              <div class="card card-primary card-outline">
                      <?php 
                        $sql="select * from contact where id='$id'";
                        foreach($db->query($sql) as $row)
                        { 
                            $name=$row['name'];
                            $email=$row['email'];
                            $message=$row['message'];
                            $date=$row['date'];
                        }?>
                <div class="card-header">
                <h3 class="card-title"><?php echo $name;?></h3>

                </div>
                <br>

                <!-- /.card-header -->
                <div class="card-body p-0">
                    <!-- <div class="mailbox-read-info">
                    </div> -->

                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                      <p>
                        <i class=" fas fa-comment"></i>&nbsp;
                        <?php echo $message; ?>
                      </p>
                    </div>
                <!-- /.mailbox-read-message -->
                </div>
                <hr>
                <!-- /.card-body -->
                <div class="card-footer bg-white">
                <h6>From: <?php echo $email;?><h6>
                <span class="mailbox-read-time float-right "><?php echo $date;?></span>
                    
                </div>
            </div>
            <!-- /.card -->
            </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php include("layouts/footer.php"); ?>
