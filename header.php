<div class = "topnav">
    <div class = "fixed">
        <div class="wrapper">
            <div class="welcome">
                <a title="" href="#">
                    <img alt="user pic" src="images/userPic.png">
                </a>
                <?php
                $id=$_SESSION['id'];
                    $s="select * from login where id=$id";
                    $ss=mysqli_query($conn,$s);
                    $sss=mysqli_fetch_array($ss);

                ?>

                <span><?php echo $sss['username'];?></span>
            </div>
            <div class="userNav">
                <ul>
                    <li>
                        <a title="" href="#">
                            <img alt="" src="images/icons/topnav/profile.png">
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a title="" href="#">
                            <img alt="" src="images/icons/topnav/tasks.png">
                            <span>Tasks</span>
                        </a>
                    </li>
                    <li>
                        <a title="" href="#">
                            <img alt="" src="images/icons/topnav/messages.png">
                            <span>Messages</span>
                            <strong class="numberTop">8</strong>
                            <ul class="menu_body">
                                <li><a href="#" title="" class="sAdd">new message</a></li>
                                <li><a href="#" title="" class="sInbox">inbox</a></li>
                                <li><a href="#" title="" class="sOutbox">outbox</a></li>
                                <li><a href="#" title="" class="sTrash">trash</a></li>
                            </ul>
                        </a>
                    </li>
                    <li>
                        <a title="" href="#">
                            <img alt="" src="images/icons/topnav/settings.png">
                            <span>Settings</span>
                        </a>
                    </li>
                    <li>
                        <a title="" href="logout.php">
                            <img alt="" src="images/icons/topnav/logout.png">
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>