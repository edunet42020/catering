<?php
include_once("connection.php");
$id=$_REQUEST['did'];
$delete="delete from itembasic where itembasicid=$id";
if(mysqli_query($conn,$delete))
{
    echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/view_item.php?m'/>";
}
else
{
    echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/view_item.php?msg=not'/>";
}
?>


