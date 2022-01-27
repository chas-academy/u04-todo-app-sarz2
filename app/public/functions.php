<?php 
include 'db.php';

//Function for deleting task
function deleteTask(int $id){
    global $db;
    $query = 'DELETE FROM todoapp WHERE id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue('id', $id);
    $statement->execute();

}
//Function for adding task
function addTask(string $title, string $todo){
global $db;
$query = <<<SQL
INSERT INTO todoapp(title,task,isDone)
VALUES (?, ?, 0)
SQL;
    $statement = $db->prepare($query);
    $statement->bindParam(1, $title);
    $statement->bindParam(2, $todo);
    $statement->execute();

}
//Function for changing task
function changeTask(int $id, string $newtitle, string $newtodo):void{
    global $db;
    $query = "UPDATE todoapp SET title = :title, task = :task WHERE id = :id";
    
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':title', $newtitle,);
        $statement->bindParam(':task', $newtodo);
        $statement->execute();
    }


    

?>