<?php
include("db.php");
$available_qty=$remain_qty=$temp_qty=0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $qr_code = $_POST['qr_code'];
    $sql_qr="select * from change_price where code='$qr_code'";

    if($qr_code == ""){

    }else if ($db->query($sql_qr)->rowCount() > 0) {
        foreach($db->query($sql_qr) as $row)
        {
            $price=$row['sale_price'];
            $item_id=$row['item_id'];
            $stock_id=$row['stock_id'];
        }

        $sql_stock="select * from item where item_id='$item_id'";
        foreach($db->query($sql_stock) as $row)
        {
            $item_name=$row['item_name'];
        }
        
        $sql_qty="SELECT * 
        FROM remain_stock 
        WHERE stock_id = $stock_id";
        foreach($db->query($sql_qty) as $row)
        {
          $remain_qty=$row['remain_quantity'];
        }

        $sql_temp="SELECT * FROM temp WHERE stock_id=$stock_id";
        foreach($db->query($sql_temp) as $row)
        {
          $temp_qty=$row['sale_quantity'];
        }

        $available_qty=$remain_qty-$temp_qty;
        //$available_qty=$remain_qty;


      ?>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="">Item Name</label>
            <input type="text" value="<?php echo $item_name?>" disabled class="form-control" />            
            <input type="hidden" value="<?php echo $stock_id?>" name="stock_id" />            
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label for="">Sale Price</label>
            <input type="text" value="<?php echo $price?>" disabled class="form-control"/>            
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Sale Quantity</label>
            <input type="number" min='1' id="total-dropdown" class="form-control" max="<?php echo $available_qty;?>" required placeholder="Enter Quantity" name="quantity" value="<?php echo $quantity?>" >
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            <label>Available Quantity</label>
            <input type="number" disabled id="total-dropdown" class="form-control" value="<?php echo $available_qty?>" >
          </div>
        </div>
      </div>
      
      <?php

    } else {?>

    <div style="color: red;">Invalid QR code.<br> Please check the code and try again.</div>

    <?php 
    }

  } else {?>

    <div style="color: red;">Invalid QR code.<br> Please check the code and try again.</div>


<?php 
}
?>

