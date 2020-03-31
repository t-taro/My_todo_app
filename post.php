<?php
    try {
      $dsn = "mysql:host=mysql1;dbname=todo_db;";
      $db = new PDO($dsn, 'testuser', 'pass');
      
      $stmt = $db->prepare('insert into todos (title) values (:newTitle)');
      $newTitle = $_POST['newTitle'];
      $Title = array(":newTitle" => "$newTitle");
      $stmt->execute($Title);
      
      header('Location: .');
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }