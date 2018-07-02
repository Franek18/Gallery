<!DOCTYPE>
<html>
<head>
	<link rel="stylesheet" href="static/css/styl.css"/>
	<script>
		function showImages(str){
			if (str.length == 0) { 
				document.getElementById("txt").innerHTML = "";
			return;
			} 
			else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() 
				{
					if (this.readyState == 4 && this.status == 200) 
					{
					document.getElementById("txt").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "ajax?q=" + str, true);
				xmlhttp.send();
			}
		}
	</script>
</head>
<body>
<main>
    <h2><?php if(isset($_SESSION['login'])){echo "Hi ".$_SESSION['login']."<br />";
    echo '<a href="logout">Logout</a><br /><br />';}
	else echo '<a href="logout">Back to login panel</a><br /><br />';?>
	<a href="gra">Main site</a><br /><br />
	<a href="chosen">Your chosen pictures</a><br /><br />
	<a href="gallery">Your gallery</a><br /><br /></h2>
	<form>
		Title:<input type="text" onkeyup="showImages(this.value)"/><br /><br />	
	</form>
	<div id="txt">
	</div>

</main>
</body>
</html>

	