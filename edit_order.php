<?php
session_start();
if(!$_SESSION['id'])
{
    header("location:index.php");
}
include_once ("connection.php");
$id=$_REQUEST['oid'];
$select="select * from orderestimate where oid=$id";
$obj=mysqli_query($conn,$select);
$result=mysqli_fetch_array($obj);
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


                            <?php
                            $pid=$result['productid'];
                            $select="select * from product where pid=$pid";
                           // echo $select;
                            $ob=mysqli_query($conn,$select);
                            $re=mysqli_fetch_array($ob);
                            { ?>
                               <input type="text" value="<?php echo $re['pname'];?>" readonly>
                            <?php }
                            ?>

                    </div>
                </div>
                <input type="hidden" name="oid" value="<?php echo $result['oid'];?>"
                <div class="rowElem">
                    <label>order quantity in kilo gram:</label>


                    <div class="formRight">
                        <input type="text" name="oqty" placeholder = "Enter  your quantity in kilogram" title = "Please Enter your quantity in kilogram" required = "required" value="<?php echo $result['oqty'];?>">
                    </div>
                </div>
                <div class="rowElem">
                    <label>order date :</label>
                    <div class="formRight">
                        <input type="date" name="odate" placeholder = "Enter Reference" title = "Please Enter Reference" required = "required" value="<?php echo $result['odate'];?>">
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
    $oid=$_REQUEST['oid'];
    $oqty=$_REQUEST['oqty'];
    $odate=$_REQUEST['odate'];
    //$date=date("yy-m-d");
    $insert="update orderestimate set oqty=$oqty,odate='$odate' where oid=$oid";
    //echo $insert;
    if(mysqli_query($conn,$insert))
    {
        echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/view_order.php'/>";
    }
    else
    {
        echo "<script type=\"text/javascript\">alert(\"record not updated\");</script>";
    }
}
?>
