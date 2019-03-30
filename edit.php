<?php
// including the database connection file
	session_start();

	include 'connect.php';
	include 'edit_action.php';

	$sql = "SELECT * FROM recipes 
	JOIN category ON recipes.r_catID = category.catID
	WHERE recipes.recipeID=".$_GET['id'];

	$result = mysqli_query($con, $sql);

	while($row = mysqli_fetch_array($result))
	{
		$title = $row['recipeTitle'];
		$prep = $row['prepTime'];
		$cook = $row['cookTime'];
		$serve = $row['servings'];
		$desc = $row['recipeDesc'];
		$ingr = $row['ingredients'];
		$dir = $row['directions'];
		$image = $row['image']; 
		$catID = $row['r_catID'];
		$catName = $row['catName'];
	}

	if($_SESSION['logged_in'] !== "login")
	{
		header("Location: login.php");  
	}
?>

<html>
<head>    
    <title>Edit Data</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta charset="utf-8">
	<meta charset=""/>
	<link rel="stylesheet" type="text/css" href="upload.css">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
</head>
 
<body>
	<div class="header">
		<img src="login_banner.jpg" style="height:33vh; width:100%">
	</div>

	<div class="topnav">
	  	<a href="index_login.php">Home</a>
	  	<a href="#contact">Contact</a>
	  	<a href="#about">About Us</a>
		<a href="index.php" style="float:right">Log Off</a>
		<a href="user_profile.php" style="float:right"><?php echo $_SESSION['username'];?></a>
	</div>
    
	<form method="post" action=" " enctype="multipart/form-data">
		<div class="row">
			<div class="column side">
				<h2>Photos</h2>
				<p style = "border-style: double; border-width: 4px; border-color: #00bfff; background-color: white; width: 75%; transform: translate(18%);">
					<label for="image">
						<input type="file" name="image" id="image" style="display:none">
						<?php 
							echo '<img src="data:image/jpeg;base64,'.base64_encode($image).'"style =" max-width: 100%; max-height: 100%; padding: 11px"/>';
						?>
						<br>
						<?php if(isset($image_err['file'])){echo "<font color='red'>".$image_err['file']."</font>";}?>  
						<?php if(isset($image_err['size'])){echo "<font color='red'>".$image_err['size']."</font>";}?> 
					</label>
				</p>

				<table style= "width: 100%; transform: translate(7%);" align="left" accesskey=""border="0" cellpadding="5" cellspacing="0">
					<tr> 
						<td width=50%>
							<label for="prep"><b>Prep Time<b/></label>
							<br>
							<input type="text" name="prep" value="<?php echo $prep; ?>"/>
							<br/> 
							<?php if(isset($output['prep'])){echo "<font color='red'>".$output['prep']."</font>";}?>   
						</td> 

						<td width=50%>
							<label for="cook"><b>Cook Time</b></label><br/>
							<input type="text" name="cook" value="<?php echo $cook; ?>"/>
							<br/>
							<?php if(isset($output['cook'])){echo "<font color='red'>".$output['cook']."</font>";}?>  
						</td> 
					</tr>

					<tr>
						<td width=50%>
							<br>
							<label for="serving"><b>Number of Servings</b></label><br/>	
							<input type="text" name="serve" value="<?php echo $serve; ?>"/>
							<br/>
							<?php if(isset($output['serve'])){echo "<font color='red'>".$output['serve']."</font>";}?>   
						</td> 
					</tr> 
				</table>
			</div>

			<div class="column middle">
				<h2>Recipe</h2>

				<table style= "width: 100%" align="left" accesskey=""border="0" cellpadding="5" cellspacing="0">
				<tr> 
					<td>
						<label for="title"><b>Recipe Title<b/></label><br>
						<input type="text" name="title" value="<?php echo $title;?>"/><br/>
						<?php if(isset($output['title'])){echo "<font color='red'>".$output['title']."</font>";}?>  
					</td> 
				</tr>

				<tr>
					<td>
						<br>
						<label for="category" style="font-size: 18px">Category</label><br/>
						<select name="category" style="width: 260px">
							<option <?php if($_POST['category']=="N/A")echo 'selected="selected"'; ?> value="N/A"> </option>
							<option <?php echo 'selected="selected"'; ?> value="<?php echo $catID;?>"><?php echo $catName; ?> </option>
								<?php 
									$sql = "SELECT * FROM category";
									if($result = mysqli_query($con, $sql))
									{
										if(mysqli_num_rows($result) > 0)
										{
											while($row = mysqli_fetch_assoc($result))
											{
								?>	
							<option value="<?php echo $row['catID']; ?>" <?php if($_POST['category'] == $row['catID'])  echo 'selected="selected"';?>><?php echo $row['catName']; ?> </option>
								<?php
											}
										}
									}
								?>
						</select>
						<br/>
						<?php if(isset($output['category'])){echo "<font color='red'>".$output['category']."</font>";}?>
						<br>
					</td> 
				</tr>

				<tr> 
					<td>
						<label for="desc"><b>Recipe Description</b></label><br/>
						<textarea rows="4" name="desc"><?php echo $desc; ?></textarea>
						<br/> 
						<?php if(isset($output['desc'])){echo "<font color='red'>".$output['desc']."</font>";}?>
					</td> 
				</tr>

				<tr>
					<td>
						<br>
						<label for="ingredients"><b>Ingredients</b></label><br/>
						<textarea rows="4" name="ingredients" placeholder="Put each ingredients on its own line."><?php echo $ingr; ?></textarea>
						<br/> 
						<?php if(isset($output['ingredients'])){echo "<font color='red'>".$output['ingredients']."</font>";}?>
					</td> 
				</tr> 

				<tr>
					<td>
						<br>
						<label for="directions"><b>Directions</b></label><br/>
						<textarea rows="4" name="directions" placeholder="Put each step on its own line."><?php echo $dir; ?></textarea>		
						<br/> 
						<?php if(isset($output['directions'])){echo "<font color='red'>".$output['directions']."</font>";}?>
					</td> 
				</tr> 

				<script type="text/javascript" src="autoexpand.js"></script>

				<tr> 
					<td>
						<br>
						<label class="container">Private
							<input type="radio" checked="checked" name="view" value="private">
							<span class="checkmark"></span>
						</label>
						<label class="container">Public
							<input type="radio" name="view" value="public">
							<span class="checkmark"></span>
						</label>   
					</td> 
				</tr> 

				<tr> 
					<td colspan="2" style="text-align: left;">
						<br>
						<input type="submit" name="update" value="Update" style="font-size: 16px"/>
						<span style="font-size: 22px">&ensp;|&ensp;</span>
						<a href="javascript:history.go(-1)" style="text-decoration: none">&laquo; Cancel</a>
					</td> 
				</tr>
				</table>
			</div>
		</div>
	</form>
		


	<div class="footer">
		<div style="text-align:center">
			<h3 id="contact" style="font-size: 24px; margin:8px">Contact Me</h3>
			<p style="font-size: 14px; margin:4px;">University of Pittsburgh</p>
			<p style="font-size: 14px; margin:4px;"> Joc101@pitt.edu</p>
			<span class="footer_text" style="font-size: 10px;">Copyright © 2019 All Rights Reserved. </span>
		</div>
	</div>
</body>
</html>