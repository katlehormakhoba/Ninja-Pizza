<?php

include("config/db_connect.php");

// MY QUERY
$query = 'select title, email, ingredients, pzza_id from pizzas order by created_at ';
//MAKE QUERY
$result = mysqli_query($conn, $query);
//FETCH QUERY
$pizzas = mysqli_fetch_all($result,MYSQLI_ASSOC);  //variable $pizzas is now a array
//FREE MEMORY
mysqli_free_result($result);
//CLOSE CONNECTION
mysqli_close($conn);


?>


<!DOCTYPE html>
<html>

<?php include('templates/header.php')?>

<h4 class="center grey-text">Pizzas</h4>
<div class="container">
	<div class="row">

		<?php foreach ($pizzas as $pizza) : ?>
			<div class="col s6 md3">
				<div class="card z-depth-0">
					<img src="images/pizza.svg" class="pizza">
					<div class="card-content center">
						<h6><?php echo 'Title : ' . htmlspecialchars($pizza['title']); ?></h6>
							<ul>
								<?php foreach (explode(',',$pizza['ingredients']) as $ing): ?>
								<li><?php echo htmlspecialchars($ing); ?></li>
								<?php endforeach; ?>
							</ul>
						
					</div>
					<div class="card-action right-align">
						<a class="brand-text " href="details.php?id=<?php echo $pizza['pzza_id']?>">More info</a>
					</div>
				</div>
			</div>
			
		<?php endforeach; ?>
	</div>
</div>


<?php include('templates/footer.php')?>



</html>