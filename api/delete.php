<?php

header("Content-Type:application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

include_once '../Models/Task.php';

$task = new Task();


if((isset($_POST['id']) && $_POST['id'] > 0)){
    $deletedTask = $task->deleteTask($_POST['id']);
    echo json_encode($deletedTask);
}else{
    echo json_encode(array('msg', 'Missing Resource Url'));
}



