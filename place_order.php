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
    <!-- Left navigation -->
    <?php
    include_once("detail.php");
    ?>
        <form class="mainForm" action="#" method="get">
            <div class = "widget first">
                <div class="head"><h5 class="iAdd">Add New Prospect</h5></div>
                <fieldset>

                    <div class="rowElem noborder">
                        <label>product :</label>
                        <div class="formRight">
                        <select  name="pid">
                            <option>--select product--</option>
                            <?php  $select="select * from product";
                            $obj=mysqli_query($conn,$select);
                            while($result=mysqli_fetch_array($obj))
                            { ?>
                                <option value="<?php echo $result['productid'];?>"><?php echo $result['productname'];?></option>
                            <?php }
                            ?>
                        </select>
                        </div>
                    </div>
                    <div class="rowElem">
                        <label>order quantity in kilo gram:</label>
                        <div class="formRight">
                            <input type="text" name="oqty" placeholder = "Enter  your quantity in kilogram" title = "Please Enter your quantity in kilogram" required = "required">
                        </div>
                    </div>
                    <div class="rowElem">
                        <label>order quantity in gram:</label>
                        <div class="formRight">
                            <input type="text" name="oqtygm" placeholder = "Enter  your quantity in gram" title = "Please Enter your quantity in gram" required = "required">
                        </div>
                    </div>
                    <div class="rowElem">
                        <label>order date :</label>
                        <div class="formRight">
                            <input type="date" name="odate" placeholder = "Enter Reference" title = "Please Enter Reference" required = "required">
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
</body>
</html>

<?php
if(isset($_REQUEST['btn']))
{
    $pid=$_REQUEST['pid'];
    $oqty=$_REQUEST['oqty'];
    $oqtygm=$_REQUEST['oqtygm'];
    $odate=$_REQUEST['odate'];
    $s="select productprice from product where productid=$pid";
    $objproduct=mysqli_query($conn,$s);
    $resultproduct=mysqli_fetch_array($objproduct);
    $priceperkg=$resultproduct['productprice'];
    $ckg=$priceperkg * $oqty;
    $cgm=($oqtygm * $priceperkg) / 1000;
    $totalcost=$ckg+$cgm;
    $date=date("yy-m-d");
    $insert="insert into receivedorder values(null,$pid,'$odate',$oqty,$oqtygm,$totalcost,'$date',0)";
    //echo $insert;
    if(mysqli_query($conn,$insert))
    {
        echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/view_order.php'/>";
    }
    else
    {
        echo "<script type=\"text/javascript\">alert(\"record not inserted\");</script>";
    }
}
?>
