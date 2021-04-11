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
             
                <select  name="pid" style="width:100%">
                    <option>--select product--</option>
                    <?php  $select="select * from product";
                    $obj=mysqli_query($conn,$select);
                    while($result=mysqli_fetch_array($obj))
                    {
                        ?>

                        <option value="<?php echo $result['productid'];?>"><?php echo $result['productname'];?></option>
                    <?php }
                    ?>
                </select>
               <br>
            
            <div style="position:absolute; width:76%">
                 <select name="itemid[]" size="3" multiple="multiple" id="itemid">
                    <?php
                       $select ="select * from itembasic";
                        $query=mysqli_query($conn,$select);
                    ?>
                        <?php
                            while($resultitem=mysqli_fetch_array($query))
                            {
                        ?>
                            <option value="<?php echo $resultitem['itembasicid'];?>"><?php echo $resultitem['itemname'];?></option>                        
                           <?php
                           }
                            ?>
                    </select>
                    </div>
            </div>
            <div>
            <div class="submitForm">
                <input value="Submit form" class="blackBtn" type="submit" name="btn">
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
if(isset($_REQUEST['btn']))
{
$pid=$_REQUEST['pid'];
    foreach ($_REQUEST['itemid'] as $itemid) {
        $insert="insert into productitem values(null,$pid,$itemid)";
        mysqli_query($conn,$insert);
        
}
  
        echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/view_product_item.php'/>";
}
?>