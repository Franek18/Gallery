<!DOCTYPE>
<html>
<head>
	<link rel="stylesheet" href="static/css/styl.css"/>
</head>
<body>
<main>
    <h2><?php if(isset($_SESSION['login'])){echo "Hi ".$_SESSION['login']."<br />";
    echo '<a href="logout">Logout</a><br /><br />';}
	else echo '<a href="logout">Back to login panel</a><br /><br />';?>
	<a href="gra">Main site</a><br /><br />
	<a href="gallery">Your gallery</a><br /><br />
	<a href="browser">Browse images</a><br /><br /></h2>

   <form method="post">
	<input type="submit" value="Delete chosen pictures" name="delete">
	<table>
		<tr>
			<th>Author</th>
			<th>Title</th>
			<th>Image</th>
			<th>Your favourites</th>
		</tr>
		
		<?php	
		if($results != null){
			//$results = $results->fetch_assoc();
		foreach($results as $result){
		if(isset($_SESSION['checkboxes'][''.$result['_id'].'']) && $_SESSION['checkboxes'][''.$result['_id'].''] == TRUE)
			$check = TRUE;
		else
			$check = FALSE;		
		
		if(isset($check) && $check){
		echo '<tr>';
			$target_small = '/static/img/small_images/small_'.$result['_id'].$result['name'];
			$target_water = '/static/img/watermarks/water_'.$result['_id'].$result['name'];
			
			echo '<td>'.$result['author'].'</td>';
			echo '<td>'.$result['title'].'</td>';
			echo '<td><a href="'.$target_water.'" target="_blank"><img src="'.$target_small.'"></a>'.'</td>';
			echo '<td><input type="checkbox" name="'.$result['_id'].'">'.' delete</td>';			
		echo '</tr>';		
		}

		}
		}

		
		?>
	</table>
	</form>
</main>
</body>
</html>

	