<?php
const REDIRECT = 'redirect:';

	function dispatch($routing,$action_url){
	
		$controller_name = $routing[$action_url];
	
		$model = [];
		$view_name = $controller_name($model);

		build_response($view_name, $model);
	}

	function build_response($view, $model){
	
		if(strpos($view, REDIRECT) === 0){
			$url = substr($view,strlen(REDIRECT));
			header('Location: '.$url);
			exit();
		}
		else{
			render($view, $model);
		}
	}

	function render($view_name, $model){
		
		extract($model);
		include 'views/'.$view_name.'_view.php';
	}
	function is_ajax()
	{
		return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
	}