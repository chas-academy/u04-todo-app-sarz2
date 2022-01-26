<?php 
$db = new PDO('mysql:host=mariadb;dbname=tutorial', 'tutorial', 'secret');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>