<?php
include('common\auth.php');
require_once('common\Data.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['id']) && !empty($_POST['title'])) {
    if ($_POST['isDelete'] == 1) {
        Data::delete($_POST['id']);
    } else {
        $id = $_POST['id'];
        $parent_id = $_POST['parent_id'];
        $parent_id = ($parent_id === 'null') ? null : $parent_id;
        $title = $_POST['title'];
        $description = $_POST['description'];
        $data = new Data($id, $parent_id, $title, $description);
        $data->save();    
    }
} 
header("Location: admin.php", true, 301);