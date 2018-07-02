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
	<a href="gallery">Your gallery</a><br /><br />
	<a href="chosen">Your chosen pictures</a><br /><br />
	<a href="browser">Browse images</a><br /><br /></h2>
	<form method="post" enctype="multipart/form-data">
		<input type="file" name="file"/><br />
			<?php if(isset($_SESSION['wrong_ftype']))echo $_SESSION['wrong_ftype']."<br />";
		if(isset($_SESSION['wrong_fsize']))echo $_SESSION['wrong_fsize']."<br />";
		if(isset($_SESSION['wrong_empty']))echo $_SESSION['wrong_empty']."<br />";
	?><br />
		Title:<br />
		<input type="text" name="title"/><br />
		Author:<br />
		<input type="text" name="author" value="<?php if(isset($_SESSION['login'])) echo $_SESSION['login'];?>"/><br />
		Watermark:<br />
		<input type="text" name="watermark"/><br />
		<?php if(isset($_SESSION['wrong_watermark']))echo $_SESSION['wrong_watermark']."<br />";
		?><br />
		<?php if(isset($_SESSION['login']))
			echo '<input type="radio" name="'.$_SESSION['login'].'"/> Add to private<br /><br />'
		?>
		<input type="submit" value="Upload" name="photo_button"/>
	</form>
</main>
</body>
</html>

	