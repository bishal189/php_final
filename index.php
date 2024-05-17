
<?php
ob_start();
session_start();

require_once("config/config.php");
require_once("config/db.php");

$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$url = str_replace('.php', '', $url);

$url .= '.php';

$pagePath = root('pages/' . $url);

$basename = pathinfo($pagePath, PATHINFO_BASENAME);

$basename = str_replace('.php', '', $basename);

// echo $basename;

if (file_exists($pagePath) && is_file($pagePath)) {
	require_once root('includes/header.php');
	require_once $pagePath;
} else {
	require_once root('includes/header-files.php');
	echo "<p style='text-align:center;font-size:1.5rem;margin-top:80px;line-height:1.7;margin-bottom:55vh;'><i class='fas fa-exclamation-triangle' style='color:red!important'></i> Page not found.<br/>We're sorry, we couldn't find the page you requested.<br>
	<button class='btn btn-primary'> <a href='index.php' class='text-white'>Go to Home </a></button></p>";
}

require_once root('includes/footer.php');
