<?php
session_start();
if(!$_SESSION['id'])
{
    header("location:index.php");
}
include_once ("connection.php");
$orderproductid=$_REQUEST['oid'];
?>
<html>
    <head>
        <TITLE>Prospect</TITLE>
        <LINK href="css/style.css" type="text/css" rel="stylesheet">

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
       
       <link href="css/jquery1.multiselect.css" rel="stylesheet" type="text/css">
    
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
        <form class="" action="#" method="get">
            <div class = "widget first">
                <div class="head"><h5 class="iAdd">Add product item</h5></div>
                <input type="hidden" value="<?php echo $orderproductid;?>" name="oid">
                <table style="border:2px solid black; width:100%;">
                <tr>
                    <th>item name</th>
                    <th>remaining qty in kg</th>
                    <th>remaining qty in gram</th>
                    <th>cost per kg</th>
                    <th>your required item in kg and gram</th>

                </tr>
                <?php
                    $selectproduct="select * from receivedorder where orderid=$orderproductid";
                    $objproduct=mysqli_query($conn,$selectproduct);
                    $resultproduct=mysqli_fetch_array($objproduct);
                    $productid=$resultproduct['productid'];
                    $selectorder="select * from productitem where productid=$productid";
                    $objorder=mysqli_query($conn,$selectorder);
                    $var=1;
                    while($result=mysqli_fetch_array($objorder))
                    {   
                        $itembasicid=$result['itembasicid'];
                        $selectitembasic="select * from itembasic,itemdetail where itembasic.itembasicid=$itembasicid and itembasic.itembasicid=itemdetail.itembasicid";
                        $objitembasic=mysqli_query($conn,$selectitembasic);
                        $resultitembasic=mysqli_fetch_array($objitembasic);
                        ?>
                        <tr>
                           <td><label><?php echo $resultitembasic['itemname']; ?></label></td>
                           <td><label><?php echo $resultitembasic['rqtykg']; ?></label></td>
                           <td><label><?php echo $resultitembasic['rqtygram']; ?></label></td>
                           <td><label><?php echo $resultitembasic['cost']; ?></label></td>
                            <td><input type="text" name="<?php echo "qtykg".$var;?>" placeholder = "Enter Qtantity in kilogram" title = "Please Enter qty in kilogram" required = "required">
                            <td><input type="text" name="<?php echo "qtygram".$var;?>" placeholder = "Enter Qtantity in gram" title = "Please Enter qty in gram" required = "required">
                            <input type="hidden" value="<?php echo $resultitembasic['itembasicid'];?>" name="<?php echo "itemid".$var;?>">
                            <tr>
                    <?php
                   
                        $var=$var+1;
                }
                        ?>
                
               <br>
            </table>
            <div style="position:absolute; width:76%">
                 <?php
                    
                 ?>
                
            </div>
            <div>
            <div class="submitForm">
                <input value="Submit form" class="blackBtn" type="submit" name="btnsubmit">
            </div>            
            </div>
        </form>

    </div>
    </div>

    <!-- Footer -->
    <?php
    include_once("footer.php");
?>


    <div style="position: absolute; display: none;" class="limiterBox" id="limiterBox"></div><a style="display: none;" href="#" id="toTop"><span id="toTopHover"></span>To Top</a>
      
    <script src="js/jquery1.min.js"></script>
<script src="js/jquery1.multiselect.js"></script> 
   
    <script>
        $('#itemid').multiselect({
            columns: 1,
            placeholder: 'Select raw material'
        });
    </script>
    </body>
    </html>
<?php
if(isset($_REQUEST['btnsubmit']))
{
$oid=$_REQUEST['oid'];
$prepareorderraw=0;

for($i=1;$i<$var;$i++)
{
    $itemid=$_REQUEST["itemid".$i];
       $qtygram=$_REQUEST["qtygram".$i];
       $qtykg=$_REQUEST["qtykg".$i];
       $pkg=($qtykg*1000)+$qtygram;
       $prepareorderraw=$prepareorderraw+$pkg;
}
$prepareqtygram=$prepareorderraw%1000;
$prepareorderraw=$prepareorderraw-$prepareqtygram;
$prepareqtykg=$prepareorderraw/1000;
$date = date("Y-m-d", strtotime("-100 year", strtotime($date)));
                    
    //$insertprepareorder="insert into prepareorder values(Null,$orderproductid,$prepareqtykg,$prepareqtygram,'$date')";
    echo $insertprepareorder;
    if(mysqli_query($conn,$insertprepareorder))
{

}
else
{
    echo "<script type=\"text/javascript\">alert(\"prepare order not inserted\");</script>";
}
$selectprepareorderid="select max(prepareorderid) from prepareorder where prepareqtykg=$prepareqtykg and prepareqtygram=$prepareqtygram";
$objprepareorder=mysqli_query($conn,$selectprepareorderid);
$resultprepareorderid=mysqli_fetch_array($objprepareorder);
$prepareorderid=$resultprepareorderid['max(prepareorderid)'];
   for($i=1;$i<$var;$i++)
   {
       $itemid=$_REQUEST["itemid".$i];
       $qtygram=$_REQUEST["qtygram".$i];
       $qtykg=$_REQUEST["qtykg".$i];
       $pkg=($qtykg*1000)+$qtygram;
       $prepareorderraw=$prepareorderraw+$pkg;
        $selectrawitem="Select * from itemdetail where itembasicid=$itemid";
        $objrawitem=mysqli_query($conn,$selectrawitem);
        $count=mysqli_num_rows($objrawitem);
        $cost=0;
        if($count > 1)
        {
            while($resultrawitem=mysqli_fetch_array($objrawitem))
            {
                $b=$resultrawitem['cost'];
                $cost=(int)$cost+(int)$b;  
            }
            $cost=$cost/$count;
        }   
        else
        {
            $resultrawitem=mysqli_fetch_array($objrawitem);
            $cost=$resultrawitem['cost'];
        }
        $cost=ceil($cost);
        $insert="insert into prepareorderitem values(Null,$prepareorderid,$itemid,$qtykg,$qtygram,$cost)";
     mysqli_query($conn,$insert);
       $newqtykg=$qtykg+1;
       $selectrawitem1="Select * from itemdetail where itembasicid=$itemid and rqtykg>$newqtykg";
       $objrawitem1=mysqli_query($conn,$selectrawitem1);
        $resultqty=mysqli_fetch_array($objrawitem1);
        $rqty=($resultqty['rqtykg']*1000)+$resultqty['rqtygram'];
       $useditem=($qtykg*1000)+$qtygram;
        $rqty=$rqty-$useditem;
        $newqtygram=$rqty%1000;
     $rqty=$rqty-$newqtygram;
        $newqtykg=($rqty/1000);

$update="update itemdetail set rqtykg=$newqtykg,rqtygram=$newqtygram where itembasicid=$itemid";
mysqli_query($conn,$update);

       }        
}
     // echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/addproductwiseexpense.php.pid=$prepareorderid'/>";
?>