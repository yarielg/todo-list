<?php

header("Content-Type:application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

include_once '../Models/Task.php';

$task = new Task();


if(isset($_POST['task']) && $_POST['task'] != ''){
    $newTask = $task->addTask($_POST['task']);
    echo json_encode($newTask);
}else{
    echo json_encode(array('msg', 'Missing Resource Url'));
}




