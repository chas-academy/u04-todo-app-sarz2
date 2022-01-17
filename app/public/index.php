<?php 

$db = new PDO('mysql:host=mariadb;dbname=tutorial', 'tutorial', 'secret');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $todo = $_POST['todo'];
$query = <<<SQL
INSERT INTO todoapp(title,task)
VALUES (?, ?)
SQL;
    $statement = $db->prepare($query);
    $statement->bindParam(1, $title);
    $statement->bindParam(2, $todo);
    $statement->execute();
}


if(isset($_POST['updatesubmit'])){
    $title = $_POST['newtitle'];
    $todo = $_POST['newtodo'];
    $id = $_POST['id'];
    changeTask($id, $title, $todo);
}

if(isset($_POST['delete'])){
    $id = $_POST['id'];
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
        <input class="form" type="text" name="title" placeholder="Enter Title"> <br>
        <input class="form" type="text" name="todo" placeholder="Enter What To Do"> <br>
        <input class="button" type="submit" name="submit">
    </form>
    <div class="tasks">
    <h2>TASKS:</h2><br>
    <?php $query = $db->query('SELECT * FROM todoapp');

foreach($query as $row){
    ?>
    <span>Title: </span> <?php echo $row['title'];?><br>
    <span>Description: </span> <?php echo $row['task'];?><br>
    <span>ID: </span> <?php echo $row['id'];?><br>

<?php
}
?>
</div>
    <form action="index.php" method="post">
        <h2>Enter the id of the task you would like to update</h2>
        <select name="id" id="">
            <?php 
            $query = $db->query('SELECT * FROM todoapp');

            foreach($query as $row){
                $id = $row['id'];
                echo "<option value ='$id'>$id</option>";
            }
            
            ?>
        </select><br>
        <input class="form" type="text" name="newtitle" placeholder="Update Title"> <br>
        <input class="form" type="text" name="newtodo" placeholder="Update What To Do"> <br>
        <input class="button" type="submit" name="updatesubmit">
    </form>
    <form action="index.php" method="post">
    <h2>Enter the id of the task you would like to delete</h2>
        <select name="id" id="">
            <?php 
            $query = $db->query('SELECT * FROM todoapp');

            foreach($query as $row){
                $id = $row['id'];
                echo "<option value ='$id'>$id</option>";
            }
            
            ?>
            </select><br>
            <input class="button" type="submit" name="delete">
    </form>
    <script type="text/javascript" src="js/script.js"></script>
</body>
</html> 