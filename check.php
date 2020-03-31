<?php
    try {
      $dsn = "mysql:host=mysql1;dbname=todo_db;";
      $db = new PDO($dsn, 'testuser', 'pass');
      
      $stmt = $db->prepare('update todos set STATE = :newState where id = :id');
      $newState = $_POST['newState'][0];
      $id = $_POST['checkedId'];
      // var_dump($id);
      
      $State = array(":newState" => (int)"$newState", ":id" => (int)"$id");
      $stmt->execute($State);

      header('Location: .');
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }