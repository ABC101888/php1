<?php 

	$output = array();
	$image_err = array();

  	if (isset($_POST['update']))
	{
		validate_input();
						
		$desc = "<pre>";
		$desc .= $_POST['desc'];
		$desc .= "</pre>";
		
		$ingredients = "<pre>";
		$ingredients .= $_POST['ingredients'];
		$ingredients .= "</pre>";
		
		$directions = "<pre>";
		$directions .= $_POST['directions'];
		$directions .= "</pre>";

		if(count($output) == 0)
        {			

			$id = $_GET['id'];
			
			$check = getimagesize($_FILES["image"]["tmp_name"]);
			if($check !== false)
			{
				$image = $_FILES['image']['tmp_name'];
				$imgContent = addslashes(file_get_contents($image));
			}
			
			$catID = $_POST['category'];
			$serve = filter_var($_POST['serve'], FILTER_SANITIZE_NUMBER_INT);
		
			$title = mysqli_real_escape_string($con, $_POST['title']);
			$desc1 = mysqli_real_escape_string($con, $desc);
			$ingredients1 = mysqli_real_escape_string($con, $ingredients);
			$directions1 = mysqli_real_escape_string($con, $directions);
			$prep = mysqli_real_escape_string($con, $_POST['prep']);
			$cook = mysqli_real_escape_string($con, $_POST['cook']);
			$serve1 = mysqli_real_escape_string($con, $serve);
			$view = mysqli_real_escape_string($con, $_POST['view']);

			$sql = "UPDATE recipes SET image='$imgContent', recipeTitle='$title', recipeDesc='$desc1', ingredients='$ingredients1', directions ='$directions1', prepTime = '$prep', cookTime = '$cook', servings = '$serve1', view = '$view', r_catID = '$catID' WHERE recipeID =".$_GET['id'];
						
			header("Location: recipe.php?id='$id'");
			exit();
		}
	}

	function validate_input()
	{
		global $output;
		global $image_err;

		$image_size = $_FILES['image']['size'];
		$image_ext = strtolower(end(explode('.',$_FILES['image']['name'])));

		$extensions = array("jpeg","jpg","png");

		if(in_array($image_ext,$extensions)=== false)
		{
			$image_err['file']="Extension is not allowed, please choose a JPEG or PNG file.";
		}
			
		if($image_size > 16097152)
		{
			$image_err['size']='File size must not exceed 16 MB';
		}
		
		$title = $_POST['title'];
		if (isset($_POST['title']) && !preg_match('/([a-zA-Z0-9\s\&\'\-\/\|\~\:\[\]\(\)]+)/', $title)) 
		{
			$output['title'] = 'Title is invalid.';
        }
		
		$desc = $_POST['desc'];
		if ((is_null($_POST['desc'])) || (!preg_match('/(([a-zA-Z0-9\s\!\#\$\%\&\'\*\+\-\=\?\^\_\`\{\|\}\~\@\.\[\]\/\:\;\,])+)/', $desc))) 
        {
			$output['desc'] = 'Invalid Description!';
        }
		
		$ingredients = $_POST['ingredients'];
		if ((is_null($_POST['ingredients'])) || (!preg_match('/(([a-zA-Z0-9\s\!\#\$\%\&\'\*\+\-\=\?\^\_\`\{\|\}\~\@\.\[\]\/\:\;\,])+)/', $ingredients))) 
        {
			$output['ingredients'] = 'Entered ingredients are invalid!';
        }
		
		$directions = $_POST['directions'];
		if ((is_null($_POST['directions'])) || (!preg_match('/(([a-zA-Z0-9\s\!\#\$\%\&\'\*\+\-\=\?\^\_\`\{\|\}\~\@\.\[\]\/\:\;\,])+)/', $directions))) 
        {
			$output['directions'] = 'Entered directions are invalid!';
        }
		
		$prep = $_POST['prep'];
		if (isset($_POST['prep']) && !preg_match('/([a-zA-Z0-9\s\&\-\+\|\~\(\)]+)/', $prep)) 
		{
			$output['prep'] = 'Entered prep time is invalid.';
        }

		$cook = $_POST['cook'];
		if (isset($_POST['cook']) && !preg_match('/([a-zA-Z0-9\s\&\-\+\|\~\(\)]+)/', $cook)) 
		{
			$output['cook'] = 'Entered cook time is invalid.';
        }
		
		$serve = $_POST['serve'];
		if (isset($_POST['serve']) && !preg_match('/([0-9\s\-]+)/', $serve)) 
		{
			$output['serve'] = 'Entered serving size is invalid.';
        }
		
		if($_POST['category'] == "N/A")
        {
			$output['category'] = "Please select Category!";
        }
	}
?>