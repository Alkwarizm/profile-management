<?php 
//session
// ob_start();
session_start();

require_once 'config.php';
require_once 'db_functions.php';

//FILE PATH
define('PRIVATE_PATH', dirname(__FILE__));
define('PROJECT_PATH', dirname(PRIVATE_PATH));
define('PUBLIC_PATH', PROJECT_PATH . '/public');
define('INCLUDES_PATH', PRIVATE_PATH . '/includes');

$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);

//URL PATH
define('URL_ROOT', $doc_root);

require 'PHPMailer/PHPMailerAutoload.php';
require 'functions.php';
require 'validate_functions.php';
require 'query_functions.php';

$db = db_connect();

$restricted_pages = [
	'/cauth/public/profile.php',
	'/cauth/public/change_password.php',
	'/cauth/public/edit_profile.php',
	'/cauth/public/process/p_logout.php'
];

$public_pages = [
	'/cauth/public/index.php',
	'/cauth/public/login.php',
	'/cauth/public/register.php',
	'/cauth/public/forgot_password.php'
];

if (!isUserLoggedIn() && in_array($_SERVER['REQUEST_URI'], $restricted_pages)) {
	redirect_to(url_for('login.php'));
}
if (isUserLoggedIn() && in_array($_SERVER['REQUEST_URI'], $public_pages)) {
	redirect_to(url_for('profile.php'));
}

$user;

if (isset($_SESSION['user']) || isset($_COOKIE['user'])) {
	$user = isset($_COOKIE['user']) ? unserialize($_COOKIE['user']) : $_SESSION['user'];
} else {
	$user = '';
}

