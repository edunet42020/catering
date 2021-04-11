<?php
session_start();
if(!$_SESSION['id'])
{
    header("location:index.php");
}
include_once ("connection.php");
$id=$_REQUEST['expenseid'];
$select="select * from expenses where expenseid=$id";
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

               
                <input type="hidden" name="expenseid" value="<?php echo $result['expenseid'];?>">
                <div class="rowElem">
                    <label>expanse name</label>


                    <div class="formRight">
                        <input type="text" name="expensename" placeholder = "Enter  your expanse" title = "Please Enter your expanse" required = "required" value="<?php echo $result['expensename'];?>">
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
    $expenseid=$_REQUEST['expenseid'];
    $expensename=$_REQUEST['expensename'];
 
    //$date=date("yy-m-d");
    $insert="update expenses set expensename='$expensename' where expenseid=$expenseid";
    //echo $insert;
    if(mysqli_query($conn,$insert))
    {
        echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/view_expense.php'/>";
    }
    else
    {
        echo "<script type=\"text/javascript\">alert(\"record not updated\");</script>";
    }
}
?>
