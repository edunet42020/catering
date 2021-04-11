<?php
include_once("connection.php");
$id=$_REQUEST['did'];
$delete="delete from product where productid=$id";
if(mysqli_query($conn,$delete))
{
    echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/view_product.php?m'/>";
}
else
{
    echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/view_product.php?msg=not'/>";
}
?>

