<?php

include("config/db_connect.php");



$email = $title = $ingredients ='';
$errors = array('email' =>'' , 'title' =>'' , 'ingredients' =>'');
if(isset($_POST['submit']))
{

//VALIDATION FOR ENTERY
	if(empty($_POST['email']))
	{
		$errors['email'] = 'Email is required';
	}
	else
	{
			$email = $_POST['email'];

			if(!filter_var($email,FILTER_VALIDATE_EMAIL))
			{
				$errors['email'] = 'Email is invalid';
			}
	}

	if(empty($_POST['title']))
	{
		$errors['title'] = 'Title is required';
	}
	else
	{
			$title = $_POST['title'];

			if(!preg_match('/^[a-zA-Z\s]+$/', $title))
			{
				$errors['title'] = 'Title must not contain special charactors';
			}
	}

	if(empty($_POST['ingredients']))
	{
		$errors['ingredients'] = 'Ingredients is required';
	}
	else
	{
			$ingredients = $_POST['ingredients'];

			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients))
			{
				$errors['ingredients'] = 'Ingredients must be separated by comma ","';
			}
	}

	if(array_filter($errors))
	{

	} 
	else
	{
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

		// MY QUERY
		$insert = "insert into pizzas(title, email, ingredients) values('$title', '$email', '$ingredients')";

		//save to db
		if(mysqli_query($conn, $insert))
		{
			//IF SUCCESSFULLY SAVE THEN REDIRECT TO HOME PAGE
			header('Location: index.php');

		}
		else
		{
			//ECHO ERROR MESSAGE;
			echo 'connection error ' . mysqli_connect_error();
		}
	}




		
}

?>


<!DOCTYPE html>
<html>

<?php include('templates/header.php')?>

<section class="container grey-text">
	<h4 class="center">Add Pizza</h4>
	<form class="white" action="add.php" method="POST">
		<label>Enter Your Email</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email)?>">
		<div class="red-text"><?php echo $errors['email']?></div>
		<label>Enter Pizza Titlte</label>
		<input type="text" name="title" value="<?php echo htmlspecialchars($title)?>">
		<div class="red-text"><?php echo $errors['title']?></div>
		<label>Enter Ingredients</label>
		<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients)?>">
		<div class="red-text"><?php echo $errors['ingredients']?></div>
		<div >
			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
		</div>
	</form>

<?php include('templates/footer.php')?>



</html>