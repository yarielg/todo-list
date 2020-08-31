<?php

header("Content-Type:application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods');

include_once '../Models/Task.php';

$task = new Task();

$tasks = $task->getTasks();

echo json_encode($tasks);
