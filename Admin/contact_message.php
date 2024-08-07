<?php 
include("layouts/header.php");
include("db.php");
if(isset($_GET['delete_id']))
{
    $id=$_GET['delete_id'];
    $sql_delete="DELETE FROM contact WHERE id ='$id'";
    $db->exec($sql_delete);
}
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Contact Message</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Inbox</h3>
                <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                        <tbody>
                        <?php 
                        $sql="select * from contact ORDER BY id DESC";
                        foreach($db->query($sql) as $row)
                        { ?>
                        <tr>
                        <td class="mailbox-star"><a class="btn"
                                onclick="return confirm('Are you sure delete?')" href="contact_message.php?delete_id=<?php echo $row['id']; ?>"><i class="fas fa-trash text-danger"></i></a></td>
                        <td class="mailbox-name"><?php echo $row['name']; ?></td>
                        <td colspan="2" class="mailbox-subject">
                            <div class="container">
                              <b><?php echo $row['email']." - "; ?></b>
                              <a href="read_contact_message.php?contact_id=<?php echo $row["id"] ?>">Read Message</a>
                            </div>                            
                        </td>                    
                        <td colspan="2" class="mailbox-date"><p><?php echo $row['date']; ?></p></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
          </div>
          </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php include("layouts/footer.php"); ?>
