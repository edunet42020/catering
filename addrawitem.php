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
  <form class="mainForm" action="" enctype="multipart/form-data">
   <div class = "widget first">
    <div class="head"><h5 class="iAdd">Add New Prospect</h5></div>
    <fieldset>

     <div class="rowElem noborder">
         <label>Item Name :</label>
         <div class="formRight">
             <select  name="itemid">
                 <option>--select item--</option>
             <?php  $select="select * from itembasic";
             $obj=mysqli_query($conn,$select);
             while($result=mysqli_fetch_array($obj))
             { ?>
                 <option value="<?php echo $result['itembasicid'];?>"><?php echo $result['itemname'];?></option>
             <?php }
             ?>
             </select>
         </div>
     </div>
        <div class="rowElem noborder">
      <label>quantity in kg:</label>
      <div class="formRight">
       <input type="text" name="qtykg" placeholder = "Enter quantity in kg" title = "Please Enter quantity in kg" required = "required">
      </div>
        <label>quantity in gram:</label>
        <div class="formRight">
            <input type="text" name="qtygram" placeholder = "Enter quantity in gram" title = "Please Enter quantity in gram" required = "required">
        </div>
            <label>cost:</label>
            <div class="formRight">
                <input type="text" name="cost" placeholder = "Enter cost" title = "Please Enter cost" required = "required">
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
    $itemid=$_REQUEST['itemid'];
    $qtykg=$_REQUEST['qtykg'];
    $qtygram=$_REQUEST['qtygram'];
    $cost=$_REQUEST['cost'];
  //  $price=$_REQUEST['price'];
$pricekg=$qtykg*$cost;
$pricegram=($qtygram*$cost)/1000;
$price=$pricekg+$pricegram;
echo $price;
   //$date = $_REQUEST['date'];

$date=date("yy-m-d");
    $insert="insert into itemdetail values(null,$itemid,$qtykg,$qtygram,$cost,$price,$qtykg,$qtygram,'$date',1)";
    echo $insert;
    if(mysqli_query($conn,$insert))
    {
        echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/view_rawitem.php'/>";
    }
    else
    {
        echo "<script type=\"text/javascript\">alert(\"record not inserted\");</script>";
    }
}
?>

