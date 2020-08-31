<?php
include_once 'Connection.php';

class Task
{
    private $conn;

    public function __construct() {
        $this->conn = new Connection();
    }

    /**
     * @return mixed
     * Get all task from db
     */
    public function getTasks() {
        $sql = "SELECT * FROM tasks";
        $result = $this->conn->get_conection()->query($sql);
        $data = array();
        while ($row = $result->fetch_assoc()) {
            array_push($data, array(
                "id" => $row['id'],
                "task" => $row['task'],
                "date" => $row['date'],
                "time" => $row['time']
            ));
        }
        $paging['success'] = true;
        $paging['total'] = count($data);
        $paging['data'] = $data;
        return $paging;
    }

    public function addTask($task) {
            $sql = "INSERT INTO tasks(task,date,time)
                                VALUES('$task','".date('Y-m-d')."','".date('H:i:s')."')";
            $result = $this->conn->get_conection()->query($sql);
            $res = array();
            if ($result != '') {
                $res['Msg'] = "Task inserted successfully";
                $res['success'] = true;
                $res['data'] = array('id' => mysqli_insert_id($this->conn->get_conection()), 'task' => $task);
            } else {
                $res['msg'] = "The task was not inserted";
                $res['success'] = false;
            }
        return $res;
    }

    /**
     * @param $id
     * @return mixed
     * Delete a specific task
     */
    function deleteTask($id) {
        $sql = "DELETE FROM tasks WHERE id='$id'";
        $result = $this->conn->get_conection()->query($sql);
        if (mysqli_affected_rows($this->conn->get_conection()) > 0) {
            $men['msg'] = 'Task removed successfully';
            $men['success'] = true;
        } else {
            $men['msg'] = 'The task was not deleted';
            $men['success'] = false;
        }
        return $men;
    }
}