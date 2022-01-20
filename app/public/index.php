<?php 

$db = new PDO('mysql:host=mariadb;dbname=tutorial', 'tutorial', 'secret');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$errors = "";


if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $todo = $_POST['todo'];
     if(empty($title) || empty($todo)){
        $errors = "You must fill in the task title:{$title}, todo:{$todo}";
    } else{ 
$query = <<<SQL
INSERT INTO todoapp(title,task)
VALUES (?, ?)
SQL;
    $statement = $db->prepare($query);
    $statement->bindParam(1, $title);
    $statement->bindParam(2, $todo);
    $statement->execute();

}
}


if(isset($_POST['updatesubmit'])){
    $title = $_POST['newtitle'];
    $todo = $_POST['newtodo'];
    $id = $_POST['id'];
    changeTask($id, $title, $todo);
}

if(isset($_GET['del_task'])){
    $id = $_GET['del_task'];
    deleteTask($id);
}

function changeTask(int $id, string $newtitle, string $newtodo):void{
global $db;
$query = "UPDATE todoapp SET title = :title, task = :task WHERE id = :id";

    $statement = $db->prepare($query);
    $statement->bindParam(':id', $id);
    $statement->bindParam(':title', $newtitle,);
    $statement->bindParam(':task', $newtodo);
    $statement->execute();
}

function deleteTask(int $id){
    global $db;
    $query = 'DELETE FROM todoapp WHERE id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue('id', $id);
    $statement->execute();

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
                <th>ID</th>
                <th>Title</th>
                <th>Task</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php $query = $db->query('SELECT * FROM todoapp');

            foreach($query as $row){
            ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td class="task"><?php echo $row['title'];?></td>
                <td class="task"><?php echo $row['task'];?></td>
                <td class="update"> 
                    <a href="update.php?upd_task=<?php echo $row['id']; ?>">UPDATE</a>
                    <td class="delete">
                    <a href="index.php?del_task=<?php echo $row['id']; ?>">x</a>
                </td>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html> 