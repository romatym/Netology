<?php
require_once 'functions.php';

session_destroy();
setcookie('user', "", time() - 3600);
setcookie('PHPSESSID', "", time() - 3600);
$_SESSION = [];

redirect('index.php');