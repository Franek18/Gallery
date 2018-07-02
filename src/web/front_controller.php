<?php
require '../../vendor/autoload.php';
require_once '../my_routing.php';
require_once '../my_dispatcher.php';
require_once '../my_controllers.php';

$action_url = $_GET['action'];

dispatch($routing,$action_url);