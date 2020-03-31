<?php
    try {
      $dsn = "mysql:host=mysql1;dbname=todo_db;";
      $db = new PDO($dsn, 'testuser', 'pass');
      
      $executeArray = [];
      
      // タイトルの指定の有無を確認してSQL文を作成
      $titleSql;
      
      if ($_GET['titleSearch']){
        $titleSql = 'title like :searchTitle';
        // $titleSql = 'title = :searchTitle';
        $titleSearch = "%".$_GET['titleSearch']."%";
        $executeArray[':searchTitle'] = $titleSearch;
      }else{
        $titleSql = '';
      }
      
      // 完了フラグの指定の有無を確認してSQL文を作成
      $doneSql;
      
      if ($_GET['doneSearch'][0] == '1' || $_GET['doneSearch'][0] == '0' and !$_GET['doneSearch'][1]){
        $doneSql = ' STATE = :searchState';
        $doneSearch = $_GET['doneSearch'][0];
        $executeArray[':searchState'] = (int)$doneSearch;
      }else{
        $doneSql = '';
      }
      
      // 検索条件に合わせてSQL全文を作成
      $sql;
      if ($titleSql || $doneSql){
        $sql = 'select * from todos where ' . $titleSql . $doneSql;
      }else{
        $sql = 'select * from todos';
      }
      
      // var_dump($sql);
      // test
      
      // DBにSQL文の実行
      $stmt = $db->prepare($sql);
      $stmt->execute($executeArray);
      $searchResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      foreach($searchResult as $row){
        echo $row['title'].PHP_EOL;
      }

      // header('Location: .');
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }