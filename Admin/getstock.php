<?php
session_start();
include ("db.php");
$item_id= $_POST["item"];
//$result = "SELECT * FROM in_stock where item_id='$item_id'";
$result = "SELECT in_stock.*
FROM in_stock
LEFT JOIN change_price ON in_stock.item_id = change_price.item_id AND in_stock.stock_id = change_price.stock_id
WHERE in_stock.item_id = '$item_id' AND change_price.stock_id IS NULL";

foreach ($db->query($result) as $stock)
                          {?>
                     <tr>
                    <td>
                    <input type="radio" name="stock_id" id="" value="<?php echo $stock['stock_id']?> " onclick="getRadioValue(this)" >
                    </td>
                    <td>
                    <?php echo $stock['stock_item_price']?>
                    </td>
                    <td><?php echo $stock['in_stock_date']?></td>
                    </tr>

<?php } ?>
<script>
function getRadioValue(radio) {
    var selectedValue = radio.value;

    // Send the selected value to a PHP file using AJAX
    $.ajax({
        type: "POST",
        url: "setprice.php",
        data: { radioValue: selectedValue },
        success: function(response) {
            console.log(response); // You can handle the response from the PHP file here
        }
    });
}
</script>
<!-- <script>
    const table = document.getElementById('radioTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        rows[i].addEventListener('click', function () {
            // Clear previous selection
            for (let j = 0; j < rows.length; j++) {
                rows[j].classList.remove('selected');
            }

            // Highlight the clicked row
            this.classList.add('selected');

            // Check the radio button in the clicked row
            const radio = this.getElementsByTagName('input')[0];
            if (radio) {
                radio.checked = true;
            }
        });
    }
</script> -->



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
