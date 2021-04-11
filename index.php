<?php
    include_once("connection.php");
    session_start();
    if(isset($_SESSION['id']))
    {
        echo "<script type=\"text/javascript\">alert(\"Already logged in\");</script>";
        echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/dashboard.php'/>";
    }   
?>
<html>
<head>
	<TITLE>Login</TITLE>
	<LINK href="css/style.css" type="text/css" rel="stylesheet">

</head>
<body>
<!-- Top navigation bar -->
<div class="topNav">
    <div class="fixed">
        <div class="wrapper">
            <div class="backTo"><a href="#" title=""><img src="images/icons/topnav/mainWebsite.png" alt=""><span>Main website</span></a></div>
            <div class="userNav">
                <ul>
                    <li><a href="registration.php" title=""><img src="images/icons/topnav/register.png" alt=""><span>Register</span></a></li>
                    <li><a href="#" title=""><img src="images/icons/topnav/contactAdmin.png" alt=""><span>Contact admin</span></a></li>
                    <li><a href="#" title=""><img src="images/icons/topnav/help.png" alt=""><span>Help</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
	
	<div style="margin: 80px 0 0 -160px; position: absolute; left: 50%;">
    <div class="loginLogo"><img src="images/loginLogo.png" alt=""></div>
    <div class="loginPanel">
        <div class="head"><h5 class="iUser">Login</h5></div>
        <form action="index.php" id="valid" class="mainForm" method="post">
            <fieldset>
					<div class="loginRow noborder">
						<label for="req1">Username:</label>
						<div class="loginInput"><input name="login"  class="validate[required]" id="req1" type="text" placeholder = "Enter Login Name" title = "Enter Login Name" required = "required"></div>
					</div>
					
					<div class="loginRow">
						<label for="req2">Password:</label>
						<div class="loginInput"><input name="password" class="validate[required]" id="req2" type="password"  placeholder = "Enter Password" title = "Enter Password" required = "required"></div>
					</div>
					
					<div class="loginRow">
						<div class="rememberMe"><input id="checkbox1" type="checkbox" name="checkbox" value="1"><label for="checkbox1"><span></span>Remember Me</label></div>
						<div class="rememberMe"><label for="check2"><a href = "">Forget Password</a></label></div>
						<div class="submitForm"><input value="Log me in" class="redBtn" type="submit" name="btn"></div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>

<!-- Footer -->
<?php
    include_once("footer.php");
?>	

</body>
</html>
<?php
if(isset($_REQUEST['btn']))
{
$name=$_REQUEST['login'];
        $pwd=$_REQUEST['password'];
    $select="select * from login where username='$name' and password='$pwd'";

    //echo $select;
    $obj=mysqli_query($conn,$select);
    $count=mysqli_num_rows($obj);
    $result=mysqli_fetch_array($obj);
    if($count > 0)
    {
        $_SESSION["id"] = $result['id'];
        echo "<meta http-equiv='Refresh' content='1; URL=http://localhost/catering/dashboard.php'/>";
    }
    else
    {
        echo "<script type=\"text/javascript\">alert(\"incorrect username or password\");</script>";
    }
    }

?>