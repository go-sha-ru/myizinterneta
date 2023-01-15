<?php
include('common\auth.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user->logout();
    header("Location: login.php", true, 301);
}
header("Location: admin.php", true, 301);
