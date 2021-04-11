<?php
include_once("connection.php");
$id=$_REQUEST['oid'];
$delete="delete from orderestimate where oid=$id";
if(mysqli_query($conn,$delete))
{
    echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/view_order.php?m'/>";
}
else
{
    echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/view_order.php?msg=not'/>";
}
?>

