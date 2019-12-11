<?php
session_start();
function __autoload($classname){
	if (file_exists("c/$classname.php")) include_once("c/$classname.php");
	elseif (file_exists("m/$classname.php")) include_once("m/$classname.php");
}

$action = 'action_';
$action .= (isset($_GET['act'])) ? $_GET['act'] : 'index';

switch ($_GET['c'])
{
	case 'articles':
		$controller = new C_Page();
	case 'users':
		$controller = new C_User();
		break;
	default:
		$controller = new C_Page();
}

$controller->Request($action);
