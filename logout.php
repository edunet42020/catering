<?php
include_once("connection.php");
session_start();
if(!isset($_SESSION['id']))
{
	header("Location:index.php");
}
unset($_SESSION['id']);
echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/index.php'/>";
?>