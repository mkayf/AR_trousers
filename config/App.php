<?php
session_start();

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $envPath = __DIR__ . '/../.env';
} else {
    // Live server ke liye (public_html ke bahar .env)
    $envPath = dirname(__DIR__, 2) . '.env';  // 2 levels upar jao
}

if (file_exists($envPath)) {
    $env = parse_ini_file($envPath);
} else {
    die("Error: .env file not found! Path: " . $envPath);
}

define("SERVER_NAME", $env['SERVER_NAME']);
define("USERNAME", $env['USERNAME']);
define("PASSWORD", $env['PASSWORD']);
define("DATABASE", $env['DATABASE']);
define("ROOT_URL", (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', dirname(__DIR__, 1))) . '/');
define("ROOT_INCLUDE_PATH", realpath(__DIR__ . '/..'));

// Database connection
include 'DB_connection.php';
$DB = new DB_Connection($env['SERVER_NAME'], $env['USERNAME'], $env['PASSWORD'], $env['DATABASE']);

// To show any message and redirect to a page

function redirect($msg = "", $msgColor = "", $url)
{
    $redirectTo = $url;
    $_SESSION['message'] = ["msg" => $msg, "msgColor" => $msgColor];
    header("Location: $redirectTo");
    exit(0);
}
