<?php
session_start();
include("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>စာရေးကိရိယာ နှင့် မိတ္တူ </title>

    <!-- icon start -->
  <link rel="apple-touch-icon" sizes="180x180" href="icon/Green/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="icon/Green/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="icon/Green/favicon-16x16.png">
  <link rel="manifest" href="icon/Green/site.webmanifest">
  <!-- icon end -->

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
    .error {color: #FF0000;}
    </style>
    <style>
    .success {color: #0000FF;}
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="dashboard.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <?php 
          $count=0;
          $sql="SELECT COUNT(*) AS row_count
          FROM contact";
          foreach($db->query($sql) as $row)
          {
            $count=$row['row_count'];
          }
          ?>
          <span class="badge badge-warning navbar-badge"><?php echo $count?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div >
            <?php 
              $sql_cm="SELECT * FROM contact ORDER BY id DESC LIMIT 3";
              foreach($db->query($sql_cm) as $row)
              {
                $name=$row['name'];
                $email=$row['email'];
                $date=$row['date'];?>
                
            <!-- Message Start -->
            <a class="dropdown-item" href="read_contact_message.php?contact_id=<?php echo $row['id']?>">
              <div class="media">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    <?php echo $name?>
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm"><?php echo $email?></p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php echo $date?></p>
                </div>
              </div>
            </a>
            <!-- Message End -->
          <div class="dropdown-divider"></div>
          <?php
              }
            ?>
          </div>
          <a href="contact_message.php" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <?php 

            // $sql = "SELECT 
            //  rs1.stock_id, rs1.remain_quantity, rs1.item_id, rs1.remain_date
            // FROM remain_stock rs1
            // LEFT JOIN change_price ON rs1.stock_id = change_price.stock_id
            // WHERE rs1.remain_quantity < change_price.limit_qty OR change_price.limit_qty IS NULL GROUP BY rs1.stock_id";

            $sql = "SELECT item.*, item_noti.noti_id, item_noti.total_item
                    FROM item
                    LEFT JOIN item_noti ON item.item_id = item_noti.item_id
                    WHERE item_noti.total_item < item.limit_qty OR item_noti.total_item IS NULL";
              
            $count_noti=$db->query($sql)->rowCount();
            
          ?>
          <?php if($count_noti!=0){?>
            <span class="badge badge-danger navbar-badge">
            <?php  echo $count_noti;?>
            </span>
            <?php }?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <?php if($count_noti!=0){?>
              <span class="dropdown-item dropdown-header">
             <?php echo $count_noti," Notifications";?>
             </span>
            <?php } ?>
          <div class="dropdown-divider"></div>
          
          <?php foreach($db->query($sql) as $row)
          {
           
                $item_name=$row['item_name'];
                $item_photo=$row['item_photo'];
              
            ?>
          
          <div>
          <a href="#" class="dropdown-item">
            <div class="row">
              <div class="col-sm-3">
              <img src="itemphoto/<?php echo $item_photo?>" class="img-size-50 mr-1" style="object-fit: cover;height: 50px;">
              </div>
              <div class="col-sm-6">
                <?php
                      echo $item_name."<br>";
                  ?>
              </div>
              <div class="col-sm-3">
                <span class="float-right px-2 rounded-circle btn-danger"><?php echo $row['total_item']?></span>
                
              </div>
            </div>
           
          </a>
          </div>
            <div class="dropdown-divider"></div>
            

          <?php
          }?>
          <?php if($count_noti!=0){?>
            <a href="#" class="dropdown-item dropdown-footer">Inventory is running low!</a>
            <?php }?>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="icon/White/android-chrome-512x512.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><small>စာရေးကိရိယာ နှင့် မိတ္တူ </small> </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <?php if($_SESSION['role']=="Admin"){
         $admin_name= $_SESSION['name'];
         $admin="SELECT * FROM admin_table where admin_name='$admin_name'";
         $result = $db->query($admin);
        foreach($result as $row){
         $admin_photo=$row['image'];
        }
      ?>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $admin_photo ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="admin.php" class="d-block"><?php echo $admin_name; ?></a>
        </div>
      </div>
      <?php }elseif($_SESSION['role']=="Employee"){
        $emp_name= $_SESSION['name'];
        $emp="SELECT * FROM employee where emp_name='$emp_name'";
        $result = $db->query($emp);
       foreach($result as $row){
        $emp_photo=$row['photo'];
       }
      ?>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $emp_photo ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $emp_name ?></a>
        </div>
      </div>
      <?php }else{
          echo '<script>window.location.href = "index.php";</script>';
      } ?>

      <!-- Sidebar Menu -->
      <?php if($_SESSION['role']=="Admin"){ ?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="category.php" class="nav-link">
            <i class="nav-icon fa fa-plus"></i>
              <p>
                Category
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="itemview.php" class="nav-link">
            <i class="nav-icon fas fa-boxes"></i>
              <p>
                Item
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="stock_view.php" class="nav-link">
            <i class="nav-icon fas fa-box"></i>
              <p>
                In Stock
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="setprice.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-file-invoice-dollar"></i>
               <p> Set Price
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="sale.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-cart-arrow-down"></i>
               <p> Sale
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="remain_instock.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-clipboard-check"></i>
            <p>
                Remain Stock
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="copier.php" class="nav-link" >
            <i class="nav-icon fas fa-solid fa-print"></i>
            <p>
                Copier
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="employee.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-users"></i>
            <p>
                Employee
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="home.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-heading"></i>
            <p>
                Home Page
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="about.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-inbox"></i>
            <p>
                About_Us Page
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="contact_message.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-comment"></i>
            <p>
               Contact_us
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="shop_info.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-info"></i>
            <p>
                Shop_Info
              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="logout.php" class="nav-link">
             <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
              Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <?php }elseif($_SESSION['role']=="Employee"){ ?>
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="itemview.php" class="nav-link">
            <i class="nav-icon fas fa-boxes"></i>
              <p>
                Item
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="sale.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-cart-arrow-down"></i>
               <p> Sale
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="remain_instock.php" class="nav-link">
            <i class="nav-icon fas fa-solid fa-clipboard-check"></i>
            <p>
                Remain Stock
              </p>
            </a>
          </li>
          <li class="nav-item">
          <a href="logout.php" class="nav-link">
             <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
              Logout
              </p>
            </a>
          </li>

        </ul>
      </nav>

     <?php } ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <script>
    $(document).ready(function () {
        // Get the current page URL
        var current_page = window.location.href;

        // Check each menu item and add "active" class if the href matches the current page
        $('.nav-link').each(function () {
            var menu_url = $(this).attr('href');
            if (current_page.includes(menu_url)) {
                $(this).addClass('active');
            }
        });
    });
</script>
