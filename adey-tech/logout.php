<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

$auth = new Auth();
$auth->logout();

setFlashMessage('success', 'You have been logged out successfully');
redirect('index.php');
?>