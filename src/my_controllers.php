<?php
require_once 'my_business.php';

function index(&$model){
	return 'includes/index';
}
function opcja1(&$model){
	return 'includes/opcja1';
}
function opcja2(&$model){
	return 'includes/opcja2';
}
function opcja3(&$model){
	return 'includes/opcja3';
}
function start(&$model){
	if(isset($_SESSION['is_login'])){
		return 'redirect:gra';
	}
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(isset($_POST['button_log'])){
			$logins = [
				'login' => $_POST['login'],
				'pass' => $_POST['pass']
			];
			if(login($logins)){
				return 'redirect:gra';
			}		
		}

	}
	return 'start';
}
function register(&$model)
{
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(isset($_POST['button'])){
			$user = [
				'login' => $_POST['login'],
				'email' => $_POST['email'],
				'pass1' => $_POST['pass1'],
				'pass2' => $_POST['pass2']
			];
			if(to_register($user)){
				return 'redirect:start';
			}		
		}

	}
	return 'register';
}
function gra(&$model)
{
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(isset($_POST['photo_button'])){	
			upload();
		}

	}
	return 'gra';
}
function logout(&$model)
{
	set_logout();
	return 'redirect:start';
}
function gallery(&$model)
{
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(isset($_POST['choose'])){
			add();
		}
	}
	$results = get_images();
	$model['results'] = $results;
	return 'gallery';
}
function chosen(&$model)
{
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(isset($_POST['delete'])){
			delete_check();
		}
	}
	$results = get_images();
	$model['results'] = $results;
	return 'chosen';
}

function browser(&$model)
{
	return 'browser';
}
function ajax(&$model)
{
	$results = set_ajax();
	$model['results'] = $results;
	return 'ajax';
}