<?php

include("config/db_connect.php");

if(isset($_POST['delete']))
{
	$id_del = mysqli_real_escape_string($conn, $_POST['id_delete']);

	$query = "delete from pizzas where pzza_id = $id_del";

	$del_result = mysqli_query($conn, $query);

	if($del_result)
	{
		header('Location: index.php');
	}
	else
	{
		echo "connection error: " . mysqli_error($conn);
	}
}

if(isset($_GET['id']))
{
	$id = mysqli_real_escape_string($conn, $_GET['id']);

	$query = "select * from pizzas where pzza_id = $id";

	$result = mysqli_query($conn, $query);

	$pizza = mysqli_fetch_assoc($result);

	mysqli_free_result($result);
	mysqli_close($conn);
}

?>


<!DOCTYPE html>
<html>

<head>
	<title>Ninja Pizza</title>
	 <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <style type="text/css">
    	.brand{
    		background: #cbb09c !important;
    	}
    	.brand-text{
    		color: #cbb09c !important;
    	}
    	form{
    		max-width: 460px;
    		padding: 20px;
    		margin: 20px auto;

    	}
    </style>
</head>
<body class="grey lighten-4">
	<nav class="white z-depth-0"> <!--Nav bar creation starts here-->
		<div class"container>
			<a href="index.php" class="btn brand z-depth-0">Home</a>
			<a href="index.php" class="center brand-logo brand-text">Ninja Pizza</a>
		</div>
	</nav>

<h1 class="center brand-logo brand-text">Pizza Details</h1>
<div class="container center grey-text">
	<?php if($pizza): ?>
		<h4>Title: <?php echo htmlspecialchars($pizza['title']); ?></h4>
		<p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
		<p>Created at: <?php echo htmlspecialchars($pizza['created_at']); ?></p>
		<h5>Ingredients</h5>
		<ul>
			<?php foreach (explode(',',$pizza['ingredients']) as $ing): ?>
				<li><?php echo htmlspecialchars($ing); ?></li>
			<?php endforeach; ?>
		</ul>
		<!--DELETE FORM -->

		<form action="Details.php" method="POST">
			<input type="hidden" name="id_delete" value="<?php echo htmlspecialchars($pizza['pzza_id']) ?>">
			<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
		</form>

		<?php else: ?>
			<h1 class="center">Pizza Does Not Exist</h1>
	<?php endif; ?>
</div>


<?php include('templates/footer.php')?>

</html>