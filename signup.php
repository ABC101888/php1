<?php
    $output = array();
	$_SESSION['error'] = $output;
	$_SESSION['error1'] = '';
	$_SESSION['error2'] = '';
	$_SESSION['success'] = '';

	if(isset($_POST['submit']))
	{
		validate_input();

        if(count($output) == 0)
        {
			$con = mysqli_connect("localhost","root","","hw7");
			if(mysqli_connect_errno())
			{
				die("Database connection failed: ".mysqli_connect_error()." (" .mysqli_connect_errno(). ")");
			}
			else
			{
				$userID = session_id();
				$username = $_POST['username'];
  				$password = $_POST['password'];
				$email = $_POST['email'];
  				$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND user_email= '$email'";

				$result=mysqli_query($con, $query);
				$count=mysqli_num_rows($result);

				if($count==1)
				{
					$_SESSION['error1'] = 'Invalid username or password, please check again!';
				}
				else
				{
					$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);

					$password = filter_var($_POST['password'], FILTER_SANITIZE_NUMBER_INT);

					$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

					$username1 = mysqli_real_escape_string($con, $username);
					$password1 = mysqli_real_escape_string($con, $password);
					$email1 = mysqli_real_escape_string($con, $email);

					$sql = "INSERT INTO users (userID, username, password, user_email) VALUES ('$userID', '$username1', '$password1', '$email1')";

					if(mysqli_query($con, $sql))
					{
						 $_SESSION['success'] = "Signup Confirmed"." "."|"." "." Please Login In</p>";
						header("Refresh:1; url=forum_login.php");
					} 
					else
					{
						$_SESSION['error2'] = "Signup not confirmed!";
					}
					
					mysqli_close($con);
				}
			 }
		}
	}

        /*Validation for application form fields */
        function validate_input()
		{   
            /*Validation for name field */
			$username = $_POST['username'];
            if (isset($_POST['username']) && !preg_match('/^(([a-zA-Z0-9]+)([^A-Za-z0-9]+))$/', $username)) 
			{
               $_SESSION['error'] = 'Invalid Input!';
            }

            /*Validation for password field */
            $password = $_POST['password'];
            if ((is_null($_POST['password'])) || (!preg_match('/^(([a-zA-Z0-9]+)([^A-Za-z0-9]+))$/', $password))) 
            {
                $_SESSION['error'] = 'Invalid Input!';
            }

            /*Validation for e-mail field */
            $email = $_POST['email'];
            if (isset($_POST['email']) && !preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $email)) 
            {
                $_SESSION['error'] = 'Invalid Input!';
            }
        }
?>