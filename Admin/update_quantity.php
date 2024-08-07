<?php
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stockId = $_POST['id'];
    $action = $_POST['action'];

        $sql_getQty="Select * from temp where stock_id='$stock_id'";
        foreach($db->query($sql_getQty) as $row)
        {
            $currentQuantity=$row["sale_quantity"];
            $price=$row["price"];
        }

        if ($action === 'increase') {
            $newQuantity = $currentQuantity + 1;
        } elseif ($action === 'decrease' && $currentQuantity > 0) {
            $newQuantity = $currentQuantity - 1;
        } else {
            $newQuantity = $currentQuantity; // No change if decreasing below 0
        }

        $newSaleTotal = $newQuantity * $price;
        $sql_updateQty="update temp set sale_quantity=$quantity, price=$price where stock_id=$stock_id";
        $db->exec($sql_updateQty);

        // Send a JSON response with updated quantity and sale total
        echo json_encode(['quantity' => $newQuantity, 'saleTotal' => $newSaleTotal]);
    
    }
?>
