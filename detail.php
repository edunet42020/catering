<?php
include_once("left.php");
?>
<div class= "content">
    <div class="title">
        <h5>Prospect</h5>
    </div>

    <div class="stats">
        <ul>
            <li>
                <?php
                $sorder="select * from receivedorder";
                $objorder=mysqli_query($conn,$sorder);
                $countorder=mysqli_num_rows($objorder);
                ?>
                <a class="count grey" title="" href="#"><?php echo $countorder;?></a>
                <span>Total order</span>
            </li>

         <!--   <li>
                <?php
                $date=date("yy-m-d");
                $sorderpending="select * from orderestimate where odate>='$date'";
                $objorderpending=mysqli_query($conn,$sorderpending);
                $countorderpending=mysqli_num_rows($objorderpending);
                ?>
                <a class="count blue" title="" href="#"><?php echo $countorderpending;?></a>
                <span>Pending orders</span>
            </li>-->

            <li>
                <?php

                $sorderproduct="select * from product";
                $objorderproduct=mysqli_query($conn,$sorderproduct);
                $countorderproduct=mysqli_num_rows($objorderproduct);
                ?>
                <a class="count green" title="" href="#"><?php echo $countorderproduct;?></a>
                <span>Total product</span>
            </li>

         <!--   <li>
                <?php
                $sorderprofit="select sum(profit) as sumprofit from orderprofit";
                $objorderprofit=mysqli_query($conn,$sorderprofit);
                $countorderprofit=mysqli_fetch_array($objorderprofit);
                ?>
                <a class="count red" title="" href="#"><?php echo $countorderprofit['sumprofit'];?></a>
                <span>Total profit</span>
            </li>-->
        </ul>
    </div>
