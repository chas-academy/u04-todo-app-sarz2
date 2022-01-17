<?php 

$db = new PDO('mysql:host=mariadb;dbname=tutorial', 'tutorial', 'secret');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){
    $username = $_POST['newUsername'];
    $password = $_POST['newPassword'];
    $email = $_POST['newEmail'];

    $query = <<<SQL
INSERT INTO loginapp(username,password,email)
VALUES (?, ?, ?)
SQL;
    $statement = $db->prepare($query);
    $statement->bindParam(1, $username);
    $statement->bindParam(2, $password);
    $statement->bindParam(3, $email);
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
    <form action="createuser.php" method="post">
        <input type="text" placeholder="Enter new username" name="newUsername">
        <input type="text" name="newPassword" placeholder="Enter new password">
        <input type="email" name="newEmail" placeholder="Enter your email">
        <input type="submit">
    </form>
    
</body>
</html>