<!DOCTYPE>
<html>
<head lang="pl">
	<meta charset="UTF-8"/>
	<link rel="stylesheet" href="static/css/styl.css"/>
</head>
<body>
<main>
    <h2>Registration</h2>
    <a href="start">Main page</a>
    <form method="post">
		Login:<br />
        <input type="text" name="login" /><br />
		<?php if(isset($_POST['button']) && isset($_SESSION['error_reg_login'])) echo $_SESSION['error_reg_login'].'<br />'; ?>
		email:<br />
        <input type="email" name="email" /><br />
		<?php if(isset($_POST['button']) && isset($_SESSION['error_email'])) echo $_SESSION['error_email'].'<br />'; ?>
		password:<br />
		<input type="password" name="pass1" /><br />
		repeat password:<br />
		<input type="password" name="pass2" /><br /><br />
		<?php if(isset($_POST['button']) && isset($_SESSION['error_pass2'])) echo $_SESSION['error_pass2'].'<br />'; ?>
		<input type="submit" value="Register" name="button"/>
    </form>
</main>
</body>
</html>