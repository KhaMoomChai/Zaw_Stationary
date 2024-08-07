<?php
include ("db.php");
$state= $_POST["state"];
$result = "SELECT * FROM nrc where state='$state'";
?>
<option value="">Select</option>
<?php
foreach($db->query($result) as $row)
 {
?>
<option value="<?php echo $row["township"];?>"><?php echo $row["township"];?></option>
<?php
}
?>
