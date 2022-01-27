<?php 
include 'db.php';
include 'functions.php';
$errors = "";

if(isset($_GET['check_task'])){
    $id = $_GET['check_task'];
    $query = 'UPDATE todoapp SET isDone = ABS(isDone - 1) WHERE id = :id';
    $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();

}


//Query for adding a new task when form is filled
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $todo = $_POST['todo'];
     if(empty($title) || empty($todo)){
        $errors = "You must fill in the tasks";
    } else{ 
        addTask($title, $todo);

}}

if(isset($_GET['del_task'])){
    $id = $_GET['del_task'];
    deleteTask($id);
}

?>


 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css"/>
    <title>Document</title>
</head>
<body>
    <div class="header">Todo List</div>
<h1>ADD NEW TASK</h1>
    <form action="index.php" method="post">
        <?php if(isset($errors)){ ?>
            <p><?php echo $errors; ?></p>
            <?php } ?>
        <input class="task_input" type="text" name="title" placeholder="Enter Title"> <br>
        <input class="task_input" type="text" name="todo" placeholder="Enter What To Do"> <br>
        <input class="button" type="submit" name="submit">
    </form>
    <h2>TASKS:</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Task</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Done</th>
            </tr>
        </thead>
        <tbody>
        <?php $query = $db->query('SELECT * FROM todoapp');

            foreach($query as $row){
            ?>
            <?php 
            if($row['isDone'] == 1){
            ?> 
                <tr class="markAsDone">
            <?php 
            } else {
            ?>
                <tr>
            <?php 
            }
            ?>
                <td class="task"><?php echo $row['title'];?></td>
                <td class="task"><?php echo $row['task'];?></td>
                <td class="update"> 
                    <a href="update.php?upd_task=<?php echo $row['id']; ?>">UPDATE</a>
                </td>
                <td class="delete">
                    <a href="index.php?del_task=<?php echo $row['id']; ?>">x</a>
                </td>
                <td class="done">
                    <a href="index.php?check_task=<?php echo $row['id']; ?>" name="done" >✓</a>                
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html> 