<?php
    try {
      $dsn = "mysql:host=mysql1;dbname=todo_db;";
      $db = new PDO($dsn, 'testuser', 'pass');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $newTitle = $_POST['newTitle'];
      $executeArray = array(":newTitle" => "$newTitle");
      
      $sql;
      
      if ($_POST['deadline'] !== ""){
        $deadline = $_POST['deadline'];
        $executeArray[":deadline"] = "$deadline";
        $sql = 'insert into todos (title, deadline) values (:newTitle, :deadline)';
      }else{
        $sql = 'insert into todos (title) values (:newTitle)';
      }      
      
      $stmt = $db->prepare($sql);
      $stmt->execute($executeArray);
      
      header('Location: .');
    } catch (PDOException $e) {
      // echo $e->getMessage();
      var_dump($e);
      exit;
    }