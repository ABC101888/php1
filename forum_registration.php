<?php
	session_start(); 
?>

<html>
    <head>
    <title>Forum Signup Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta charset="utf-8">
	<meta charset=""/>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

 <body>
	<ul>
		<li class="top"><a class="top" href="http://studentprojects.sis.pitt.edu/spring2019/joc101/homework.html">Home</a></li>
		<li class="top"><a class="top" href="#contact">Contact</a></li>
	</ul>
	 
	<?php include("signup.php"); ?>
	 
	<h1 align="center" style="margin:44px; font-weight: lighter; font-size:56px"> Sign Up </h1>

	<form method="POST">
		
		<table align="center" accesskey=""border="0" cellpadding="5" cellspacing="0">
            <tr> 
                <td align="center">
					<label for="username"><b> Username: <b/></label>
                    <input name="username" type="text" style="width: 260px" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>"/><br/>
					<?php echo "<font color='red'>".$_SESSION['error']."</font>";?><br/>
                </td> 
            </tr> 

            <tr>
                <td align="center"> 
                    <label for="password"><b>Password: </b></label>
                    <input name="password" type="text" style="width: 260px" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>"/><br/>
					<?php echo "<font color='red'>".$_SESSION['error']."</font>";?><br/>
                </td> 
            </tr> 
            
            <tr> 
                <td align="center">
                    <label for="email"><b>Email: </b></label>
                    <input name="email" type="text"  style="width: 260px" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>"/><br/>
					<?php echo "<font color='red'>".$_SESSION['error']."</font>";?><br/>
                </td> 
            </tr> 

            <tr> 
                <td colspan="2" style="text-align: center;">
                    <input name="submit" type="submit" value="submit"/>
					<br>
					<br>
					<?php echo "<font color='red'>".$_SESSION['error1']."</font>";?>
					<?php echo "<font color='red'>".$_SESSION['error2']."</font>";?>
					<?php echo "<font color='Black'>".$_SESSION['success']."</font>";?>
                </td> 
            </tr>
        </table>
		</form>
		
	<div class="footer">
		<div style="text-align:center">
			<h3 id="contact" style="font-size: 24px; margin:8px">Contact Me</h3>
			<p style="font-size: 14px; margin:4px;">University of Pittsburgh</p>
			<p style="font-size: 14px; margin:4px;"> Joc101@pitt.edu</p>
			<span class="footer_text" style="font-size: 10px;">Copyright © 2018 All Rights Reserved. </span>
		</div>
	</div>
</body>
</html>