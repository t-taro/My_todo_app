<?php
    try {
      $dsn = "mysql:host=mysql1;dbname=todo_db;";
      $db = new PDO($dsn, 'testuser', 'pass');
      $sql = 'select * from todos order by deadline is null asc, deadline asc';
      $stmt = $db->query($sql);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }