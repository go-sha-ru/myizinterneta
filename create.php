<?php
include('common\auth.php');
require_once('common\Data.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title']) && $_POST['title'] !== '') {
    $parent_id = $_POST['parent_id'];
    $parent_id = ($parent_id === 'null') ? null : $parent_id;
    $title = $_POST['title'];
    $description = $_POST['description'];
    $data = new Data(null, $parent_id, $title, $description);
    $data->save();
} 
header("Location: admin.php", true, 301);