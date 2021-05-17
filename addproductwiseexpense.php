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
         <label>order :</label>
         <div class="formRight">
         <select  name="oid" style="width:100%">
                    <option>--select order--</option>
                <?php
                    $date = date("Y-m-d", strtotime("-100 year", strtotime($date)));
                    
                    $selectorder="select * from receivedorder where flag=0 and odate > '$date'";
                    $objorder=mysqli_query($conn,$selectorder);
                    $var=1;
                    while($result=mysqli_fetch_array($objorder))
                    {
                        $pid=$result['productid'];
                            $selectproduct="select * from product where productid=$pid";
                            $objproduct=mysqli_query($conn,$selectproduct);
                            $resultproduct=mysqli_fetch_array($objproduct);
                        ?>
                            
                        <option value="<?php echo $result['orderid'];?>"><?php echo $resultproduct['productname']." ".$result['oqtykg']." kg ".$result['oqtygram']." gram";?></option>
                    <?php }
                    ?>
                </select>
         </div>
     </div>
<?php
    $selectexpense="select * from expenses";
    $objexpense=mysqli_query($conn,$selectexpense);
?>
        <div class="rowElem noborder">
        <?php 
            while($resultexpense=mysqli_fetch_array($objexpense))
            {
        ?>
      <label><?php echo $resultexpense['expensename'];?></label>
      <div class="formRight">
       <input type="text" name="<?php echo "exp".$var;?>" placeholder = "Enter cost for <?php echo $resultexpense['expensename'];?>" title = "Please Enter cost for <?php echo $resultexpense['expensename'];?>" required = "required">
      </div>
      <?php
        $var=$var+1;   
        }
      ?>
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
    $orderid=$_REQUEST['oid'];
    $select="select prepareorderid from prepareorder where orderid=$orderid";
    $objpr=mysqli_query($conn,$select);
    $result=mysqli_fetch_array($objpr);
    $prepareorderid=$result['prepareorderid'];
    $selectexpense="select * from expenses";
    $objexpense=mysqli_query($conn,$selectexpense);
    $v=1;
    while($result=mysqli_fetch_array($objexpense))
    {
        $expenseid=$result['expenseid'];
        $expensecost=$_REQUEST["exp".$v];
        $v++;
        $insert="insert into prepareorderexpense values(Null,$expenseid,$expensecost,$prepareorderid)";
        //echo $insert;
        mysqli_query($conn,$insert);

    }
}
?>

