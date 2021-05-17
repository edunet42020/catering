<?php
session_start();
if(!$_SESSION['id'])
{
    header("location:index.php");
}
include_once ("connection.php");
?>
<html>
<head>
    <TITLE>Prospect</TITLE>
    <LINK href="css/style.css" type="text/css" rel="stylesheet">

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>

    <script type="text/javascript" src="js/custom.js"></script>

</head>
<body>
<?php
include_once("header.php");
include_once("left.php");
?>
<div class="wrapper">
    <?php
    include_once("detail.php");
    ?>
<?php
    include_once("footer.php");
?>



<div style="position: absolute; display: none;" class="limiterBox" id="limiterBox"></div><a style="display: none;" href="#" id="toTop"><span id="toTopHover"></span>To Top</a>
</body>
</html>


