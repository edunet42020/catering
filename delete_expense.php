<?php
include_once("connection.php");
$id=$_REQUEST['did'];
$delete="delete from expenses where expenseid=$id";
if(mysqli_query($conn,$delete))
{
    echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/view_expense.php?m'/>";
}
else
{
    echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/view_expense.php?msg=not'/>";
}
?>

