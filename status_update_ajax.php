<?php
    try {
      $dsn = "mysql:host=mysql1;dbname=todo_db;";
      $db = new PDO($dsn, 'testuser', 'pass');
      
      $title = $_POST['title'];
      $state;

      if ($_POST['state'] == 0){
        $state = 1;
      }else{
        $state = 0;
      }
      
      $stmt = $db->prepare('update todos set state = :state where title = :title');
      $param = array(':state' => (int)$state, ':title' => $title);
      $stmt->execute($param); 
      
      var_dump($param);
      
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
    
