<?php
$db = new PDO('mysql:host=mariadb;dbname=tutorial', 'tutorial', 'secret');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


 if(isset($_POST['updatesubmit'])){
    $title = $_POST['newtitle'];
    $todo = $_POST['newtodo'];
    changeTask($title, $todo);
}

function changeTask(string $newtitle, string $newtodo):void{
    global $db;
    global $id;
    $query = "UPDATE todoapp SET title = :title, task = :task WHERE id = :id";
    
        $statement = $db->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':title', $newtitle,);
        $statement->bindParam(':task', $newtodo);
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
    <title>UPDATE</title>
</head>
<body>
<table>
    <?php
    if(isset($_GET['upd_task'])){
        $id = $_GET['upd_task'];
        ?>
                <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Task</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        global $db;
        $statement = $db->prepare("SELECT * FROM todoapp WHERE id=:id");
        $statement->bindParam('id', $id, PDO::PARAM_INT);
        $statement->execute();

        if($statement->rowCount() > 0) {

            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td class="task"><?php echo $row['title'];?></td>
                <td class="task"><?php echo $row['task'];?></td>
            </tr>
        </tbody>
</table>
        <?php
            }
        }
    }
        ?>


<form action="update.php" method="post">
              </select><br>
        <input class="task_input" type="text" name="newtitle" placeholder="Update Title"> <br>
        <input class="task_input" type="text" name="newtodo" placeholder="Update What To Do"> <br>
        <input class="button" type="submit" name="updatesubmit">
    </form>

</body>
</html>
