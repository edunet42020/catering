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
                <div class="head"><h5 class="iAdd">Add New Expence</h5></div>
                <fieldset>

                    <div class="rowElem noborder">
                        <label>Expence Name :</label>
                        <div class="formRight">
                            <input type="text" name="inputtext" placeholder = "Enter Expence Name" title = "Please Enter Expence Name" required = "required">
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
    $item=$_REQUEST['inputtext'];
    $insert="insert into expenses values(null,'$item')";
    if(mysqli_query($conn,$insert))
    {
        echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/view_expense.php'/>";
    }
    else
    {
        echo "<script type=\"text/javascript\">alert(\"record not inserted\");</script>";
    }
}
?>