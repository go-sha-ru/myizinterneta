<?php
session_start();
require_once('common\User.php');

$user = new User();

if (!$user->isLogged && $_SERVER['REQUEST_URI'] !== '/login.php') {
  header("Location: login.php", true, 301);
}
