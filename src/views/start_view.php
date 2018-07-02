<?php
	require_once '../my_business.php';
?>
<!DOCTYPE>
<html>
<head>
	<link rel="stylesheet" href="static/css/styl.css"/>
</head>
<body>
<main>
    <h1>Wiedzmin Site</h1>
	<a href="gra">Enter without logging in</a><br /><br />
    <a href="register">It's your first time at our site?</a>
    <form method="post">
		Login:<br />
        <input type="text" name="login" value="<?php if(!isset($_SESSION['error_login']) && isset($_SESSION['error_pass'])) echo $_SESSION['this_login'];?>"/><br />
		<?php if(isset($_SESSION['error_login'])){
			echo $_SESSION['error_login'].'<br />';
		}?>
		password:<br />
		<input type="password" name="pass" /><br />
		<?php if(isset($_SESSION['error_pass'])){ 
		echo $_SESSION['error_pass'].'<br />';
		}?><br />
		<input type="submit" value="Login" name="button_log"/>
    </form>
</main>
</body>
</html>