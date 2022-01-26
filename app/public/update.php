<?php
include 'db.php';
include 'functions.php';

if(isset($_GET['upd_task'])){
    $id = $_GET['upd_task'];
 if(isset($_POST['updatesubmit'])){
    $title = $_POST['newtitle'];
    $todo = $_POST['newtodo'];
    changeTask($id, $title, $todo);
}}

 
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
<div class="header">Update Task</div>
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
 <?php
    if(isset($_GET['upd_task'])){
      $id = $_GET['upd_task'];

      global $db;
      $statement = $db->prepare("SELECT * FROM todoapp WHERE id=:id");
      $statement->bindParam('id', $id, PDO::PARAM_INT);
      $statement->execute();

      if($statement->rowCount() > 0) {

          while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        ?>

<form action="update.php?upd_task=<?php echo $_GET['upd_task'] ?>" method="post">
              </select><br>
        <input class="task_input" type="text" name="newtitle" value="<?php echo $row['title'];?>"> <br>
        <input class="task_input" type="text" name="newtodo" value="<?php echo $row['task'];?>"> <br>
       <input class="button" type="submit" name="updatesubmit"></a>
    </form>
    <?php
            }
      }
    }

        ?>
<a href="index.php"><button class="button">Go back to first page</button></a>
</body>
</html>
