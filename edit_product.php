<?php
session_start();
if(!$_SESSION['id'])
{
    header("location:index.php");
}

?>
<?php
include_once ("connection.php");
$id=$_REQUEST['pid'];
$s="select * from product where productid=$id";
//echo $s;
$obj=mysqli_query($conn,$s);
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
                <div class="head"><h5 class="iAdd">Add New Product</h5></div>
                <fieldset>
                    <input type="hidden" name="pid" value="<?php if(isset($_REQUEST['pid'])){ echo $result['productid'];}?>"
                    <div class="rowElem noborder">
                        <label>product Name :</label>
                        <div class="formRight">
                        <input type="text" name="inputtext" placeholder = "Enter Name" title = "Please Enter Name" required = "required" value="<?php if(isset($_REQUEST['pid'])){ echo $result['productname'];}?>">
                        </div>
                    </div>
                    <div class="rowElem">
                        <label>product rate :</label>
                        <div class="formRight">
                            <input type="text" name="rate" placeholder = "Enter product rate" title = "Please Enter product rate" required = "required" value="<?php if(isset($_REQUEST['pid'])){ echo $result['productprice'];}?>">
                        </div>
                    </div>
                    <div class="submitForm">
                        <input value="update" class="blackBtn" type="submit" name="btn">
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
    $pname=$_REQUEST['inputtext'];
    $rate=$_REQUEST['rate'];
    $update="update product set productname='$pname',productprice=$rate where productid=$id";
    if(mysqli_query($conn,$update))
    {
        echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/view_product.php'/>";
    }
    else
    {
        echo "<script type=\"text/javascript\">alert(\"record not updated\");</script>";
    }
}
?>