<?php
/** Admin logout */
require_once __DIR__ . '/../includes/page-shell.php';
$_SESSION['admin_auth'] = false;
session_destroy();
header('Location: /admin/login.php');
exit;
