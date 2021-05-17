<?php
session_start();
if(!$_SESSION['id'])
{
    header("location:index.php");
}
include_once ("connection.php");

    $select="select * from receivedorder order by odate desc";
    $obj=mysqli_query($conn,$select);
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
    ?>        <!-- Contact list -->
        <form class="mainForm" action="">
            <div class="widget first">
                <div class="head"><h5 class="iFrames">Prospect List</h5></div>
                <div id="myList-nav"><div class="ln-letters"><a class="all ln-selected" href="#">ALL</a><a style="position: relative;" class="a" href="#">A</a><a class="b" href="#">B</a><a class="c" href="#">C</a><a class="d" href="#">D</a><a class="e" href="#">E</a><a class="f ln-disabled" href="#">F</a><a class="g" href="#">G</a><a class="h" href="#">H</a><a class="i ln-disabled" href="#">I</a><a class="j" href="#">J</a><a class="k" href="#">K</a><a class="l" href="#">L</a><a class="m" href="#">M</a><a class="n" href="#">N</a><a class="o ln-disabled" href="#">O</a><a class="p" href="#">P</a><a class="q ln-disabled" href="#">Q</a><a class="r" href="#">R</a><a class="s" href="#">S</a><a class="t" href="#">T</a><a class="u ln-disabled" href="#">U</a><a class="v" href="#">V</a><a class="w ln-disabled" href="#">W</a><a class="x ln-disabled" href="#">X</a><a class="y" href="#">Y</a><a class="z ln-disabled" href="#">Z</a></div></div>
                <div id="example_wrapper" class="dataTables_wrapper" role="grid">
                    <div class="datatable-header"><div id="example_filter" class="dataTables_filter">
                            <label><input aria-controls="example" type="text" placeholder = "Name" class = "search"></label>
                            <label><input aria-controls="example" type="text" placeholder = "Email Id"></label>
                            <label><input aria-controls="example" type="text" placeholder = "Phone No."></label>
                        </div>
                    </div>

                    <table class="tableStatic" cellpadding="0" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <td width="15%">product Name</td>
                            <td width="10%">order quantity in kilo</td>
                            <td width="10%">order quantity in gram</td>
                            <td width="15%">order date</td>
                            <td width="15%">order place date</td>
                            <td width="10%">cost</td>
                            <td width="15%">Operations</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($result=mysqli_fetch_array($obj)) {
                            ?>
                            <tr>
                                <?php
                                $p=$result['productid'];
                                    $s="select productname from product where productid=$p";
                                    $r=mysqli_query($conn,$s);
                                    $res=mysqli_fetch_array($r);
                                ?>
                                <td><?php echo $res['productname']; ?></td>
                                <td><?php echo $result['oqtykg']; ?></td>
                                <td><?php echo $result['oqtygram']; ?></td>
                                <td><?php echo $result['odate']; ?></td>
                                <td><?php echo $result['date']; ?></td>
                                <td><?php echo $result['ocost']; ?></td>
                                <td STYLE="text-align : center">
                                    <a href="edit_order.php?oid=<?php echo $result[0];?>" class="btn14"><img src = "images/edit1.png" title = "Edit"></a>
                                    <a href="delete_order.php?oid=<?php echo $result[0];?>" class="btn14"><img src = "images/delete.png" title = "follow_up"></a>
                                </td>
                            </tr>




                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
        </form>
    </div>
</div>
</div>
<!-- Footer -->
<?php
    include_once("footer.php");
?>



<div style="position: absolute; display: none;" class="limiterBox" id="limiterBox"></div><a style="display: none;" href="#" id="toTop"><span id="toTopHover"></span>To Top</a>
</body>
</html>


