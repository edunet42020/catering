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
    <link href="css/jquery.multiselect.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/custom.js"></script>

</head>
<body>
<?php
include_once("header.php");
include_once("left.php");
?>
<div class="wrapper">
    <!-- Left navigation -->
    <?php
    include_once("detail.php");
    ?>
			<form class="mainForm" action="#" method="get">
				<div class = "widget first">
					<div class="head"><h5 class="iAdd">Add New Product</h5></div>
					<fieldset>

						<div class="rowElem noborder">
							<label>product Name :</label>
							<div class="formRight">
								<input type="text" name="inputtext" placeholder = "Enter Name" title = "Please Enter Name" required = "required">
							</div>
						</div>
						<div class="rowElem">
							<label>product rate :</label>
							<div class="formRight">
								<input type="text" name="rate" placeholder = "Enter product rate" title = "Please Enter product rate" required = "required">
							</div>
						</div>
												<div class="submitForm">
							<input value="Submit form" class="blackBtn" type="submit" name="btn">
						</div>

					</fieldset>
				</div>
			</form>

		</div>
	</div>

	<!-- Footer -->
	<?php
    include_once("footer.php");
?>


<div style="position: absolute; display: none;" class="limiterBox" id="limiterBox"></div><a style="display: none;" href="#" id="toTop"><span id="toTopHover"></span>To Top</a>

<script src="js/jquery.min.js"></script>
<script src="js/jquery.multiselect.js"></script>
</body>
</html>
<?php
if(isset($_REQUEST['btn']))
{
    $pname=$_REQUEST['inputtext'];
    $rate=$_REQUEST['rate'];
    $insert="insert into product values(null,'$pname',$rate)";
    if(mysqli_query($conn,$insert))
    {
        $s="select * from product where productname='$pname' and productprice='$rate'";
        $o=mysqli_query($conn,$s);
        $r=mysqli_fetch_array($o);
        $id=$r['productid'];
        echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/addproductitem.php?pid=$id'/>";
    }
    else
    {
        echo "<script type=\"text/javascript\">alert(\"record not inserted\");</script>";
    }
}
?>