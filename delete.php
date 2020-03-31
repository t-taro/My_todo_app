<?php
    try {
      $dsn = "mysql:host=mysql1;dbname=todo_db;";
      $db = new PDO($dsn, 'testuser', 'pass');
      
      $stmt = $db->prepare('delete from todos where id = :id');
      $deleteTitleId = $_POST['deleteTitleId'];
      $deleteTitle = array(":id" => "$deleteTitleId");
      $stmt->execute($deleteTitle);
      
      header('Location: .');
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }