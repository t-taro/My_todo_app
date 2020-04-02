<?php
    try {
      $dsn = "mysql:host=mysql1;dbname=todo_db;";
      $db = new PDO($dsn, 'testuser', 'pass');
      
      // var_dump($_POST);
      // var_dump(isset($_POST['deadline']));
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
      
      // echo $sql;
      
      
      $stmt = $db->prepare($sql);
      $stmt->execute($executeArray);
      
      header('Location: .');
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }