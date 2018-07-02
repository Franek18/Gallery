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
	<a href="chosen">Your chosen pictures</a><br /><br />
	<a href="browser">Browse images</a><br /><br /></h2>
	<form method="post">
	<input type="submit" value="Remember all chosen images" name="choose">
	<table>
		<tr>
			<th>Author</th>
			<th>Title</th>
			<th>Image</th>
			<th>Your favourites</th>
		</tr>
		
<?php 	
/*	require_once '../my_business.php';
	$db = get_db();
	$query = [
		'title' => 'Garkain'
	];	//porzadki
	$db->images->deleteOne($query);*/
	require 'includes/table_view.php'; ?>
	</table>
	</form>
</main>
</body>
</html>

	