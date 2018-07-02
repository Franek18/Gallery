<?php
use MongoDB\BSON\ObjectID;
session_start();

function get_db()
	{
		$db = new mysqli("localhost","root", "", "gallery");
		if($db->connect_errno!=0)
		{
			echo "Error ".$db->connect_errno;
		}
		else{
				return $db;	
		}
	}

function get_images()
	{
		$db = get_db();	
		$result = $db->query("SELECT * FROM images");
		return $result;//->fetch_assoc();
	}

function check_login($db,$login)
	{
/*		$query = [
			'login' => $login
		];
		$result = $db->users->findOne($query);
		if($result['login'] == $login)*/
		$ask = $db->query("SELECT * FROM users WHERE login='$login'");
		if($ask->num_rows > 0)
			return true;
		else
			return false;
	}

function check_email($db,$email)
	{
		$ask = $db->query("SELECT * FROM users WHERE email='$email'");
		if($ask->num_rows > 0)		
			return true;
		else
			return false;
	}

function check($db,&$ok,$login,$email)
	{
		$result = check_login($db,$login);
		if( $result == true ){
			$_SESSION['error_reg_login'] = "The account with that login is already exist!";
			$ok = FALSE;
		}

		$result = check_email($db,$email);
		if($result == true){
			$_SESSION['error_email'] = "The account register on that email is already exist!";
			$ok = FALSE;
		}
	}

function equal_pass($pass1,$pass2,&$ok)
	{
		if($pass1 != $pass2){
			$_SESSION['error_pass2'] = "These passwords are not equal!";
			$ok = FALSE;
		}
	}
function to_register($user)
	{
			$db = get_db();

			$login = $user['login'];
			$email = $user['email'];
			$pass1 = $user['pass1'];
			$pass2 = $user['pass2'];

			$ok = TRUE;
			$num_of_users = $db->query("SELECT * FROM users");

			if( $num_of_users->num_rows > 0){
				check($db,$ok,$login,$email);
			}

			equal_pass($pass1,$pass2,$ok);

			if($ok == TRUE){
				unset($_SESSION['error_reg_login']);
				unset($_SESSION['error_email']);
				unset($_SESSION['error_pass2']);

				$hash = password_hash($pass1, PASSWORD_DEFAULT);
/*				$register = [
					'login' => $login,
					'email' => $email,
					'password' => $hash
				];	*/
				$db->query("INSERT INTO users VALUES(NULL,'$login','$hash','$email')");
				//$db->users->insertOne($register);
				return true;
			}
			else{
				return false;
			}
	}

function login($logins)
	{
		
		$db = get_db();	
		
		$login = $logins['login'];
		$pass = $logins['pass'];

		$result = check_login($db,$login);

			if($result == false){
				$_SESSION['error_login'] = "That login isn't exist";
				unset($_SESSION['error_pass']);
				return false;
			}
			else{
				$row = $db->query("SELECT * FROM users WHERE login='$login'");
				$user = $row->fetch_assoc();
				if(!password_verify($pass,$user['password'])){
					unset($_SESSION['error_login']);
					$_SESSION['error_pass'] = "Wrong password!";
					return false;	
				}

				unset($_SESSION['error_login']);
				unset($_SESSION['error_pass']);
				$_SESSION['login'] = $login;
				$_SESSION['is_login'] = TRUE;

				return true;
			}

	}

function set_logout()
	{
		session_destroy();
	}

function create_image($file,$mime_type)
	{	
		if($mime_type === 'image/png'){
			$image =  imagecreatefrompng($file);
		}else{
		$image =  imagecreatefromjpeg($file);	
		}

		return $image;
	}

function upload()
	{
/*		if($_SERVER["CONTENT_LENGTH"]>((int)ini_get('post_max_size')*1024*1024)){
			header('Location: gra');
		}*/
		if(isset($_SESSION['wrong_watermark'])){
			unset($_SESSION['wrong_watermark']);		
		}
		if(isset($_SESSION['wrong_empty'])){
			unset($_SESSION['wrong_empty']);		
		}
		if(isset($_SESSION['wrong_ftype'])){
			unset($_SESSION['wrong_ftype']);		
		}		
		if(isset($_SESSION['wrong_fsize'])){
			unset($_SESSION['wrong_fsize']);		
		}

		$ok = TRUE;
		if($_POST['watermark'] == null){
			$_SESSION['wrong_watermark'] = "Before uploading a file set a watermark!";
			return false;
		}
		if($_FILES['file']['error'] == 4){
			$_SESSION['wrong_empty'] = "No file was uploaded!";
			$ok = FALSE;
		}
		if($_FILES['file']['error'] == 1){
			$_SESSION['wrong_fsize'] = "The size of this file is larger than upload_max_filesize!";
			$ok = FALSE;
		}
		if($ok == TRUE){

			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$file_name = $_FILES['file']['tmp_name'];
			$mime_type = finfo_file($finfo,$file_name);


			if(!($mime_type === 'image/jpeg') && !($mime_type === 'image/png') && !($mime_type === 'image/JPEG') && !($mime_type === 'image/PNG')){
				$ok = FALSE;
				$_SESSION['wrong_ftype'] = "The file format is incorrect!";
			}

			if($_FILES['file']['size'] > (1024*1024)){
				$ok = FALSE;
				$_SESSION['wrong_fsize'] = "The size of this file is too large!";
				$ok = FALSE;
			}		
		}

		if($ok == TRUE){
			unset($_SESSION['wrong_ftype']);
			unset($_SESSION['wrong_fsize']);
			unset($_SESSION['wrong_empty']);

			//baza danych
			$db = get_db();
			if(isset($_SESSION['login']) && isset($_POST[''.$_SESSION['login'].''])){
				
				$title = $_POST['title'];
				$author = $_POST['author'];
				$fname = $_FILES['file']['name'];
				$login = $_SESSION['login'];
				$db->query("INSERT INTO images VALUES(NULL,'$title','$author','$fname','$login')");
			}
			else{
				
				$title = $_POST['title'];
				$author = $_POST['author'];
				$fname = $_FILES['file']['name'];
				$login = 'public';
				$db->query("INSERT INTO images VALUES(NULL,'$title','$author','$fname','$login')");	
			}


			$ask = $db->query("SELECT * FROM images WHERE title='$title'");
			$result = $ask->fetch_assoc();
			//baza danych
			//$upload_dir = '/var/www/dev/src/web/static/img/images/';
			$upload_dir = 'static/img/images/';
			$file = $_FILES['file'];
			$file_type = $result['_id'].basename($file['name']);
			$target = $upload_dir.$file_type;
			$tmp_path = $file['tmp_name'];

			if(move_uploaded_file($tmp_path,$target)){
				$image = create_image( $target,$mime_type);
				$im = imagecreatetruecolor(400, 300);
				$white = imagecolorallocate($im, 255, 255, 255);
				$black = imagecolorallocate($im, 0, 0, 0);

				$font = "static/fonts/OpenSans-Bold.ttf";
				//watermarks
				imagettftext($image,20,0,100,150,$white,$font,$_POST['watermark']);
				$path = 'static/img/watermarks/water_'.$result['_id'].$file['name'];
				imagejpeg($image,$path);

				//small images
				$image = create_image($target,$mime_type);
				$width = 200;
				$height = 125;
				$small_image = imagecreatetruecolor($width,$height);
				imagecopyresampled($small_image, $image, 0, 0, 0, 0, $width, $height, imagesx($image), imagesy($image));
				$path = 'static/img/small_images/small_'.$result['_id'].$file['name'];
				imagejpeg($small_image,$path);

			}
		}
	}
function add()
	{
		if(!isset($_SESSION['checkboxes']))
			$_SESSION['checkboxes'] = [];

		foreach($_POST as $key => $v){
			$_SESSION['checkboxes'][''.$key.''] = TRUE;
		}
	}

function delete_check()
	{
		foreach($_POST as $key => $v){
			$_SESSION['checkboxes'][''.$key.''] = FALSE;
		}
	}

function set_ajax()
	{
		$db = get_db();
		if(isset($_GET['q'])){	
			$char = $_GET['q'];
			return $db->query("SELECT * FROM images WHERE title REGEXP '^$char'");
		}
	}

