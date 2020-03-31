<?php
    try {
      $dsn = "mysql:host=mysql1;dbname=todo_db;";
      $db = new PDO($dsn, 'testuser', 'pass');
      
      $executeArray = [];
      
      // タイトルの指定の有無を確認してSQL文を作成
      $titleSql;
      
      if ($_GET['titleSearch']){
        $titleSql = 'title like :searchTitle';
        $titleSearch = "%".$_GET['titleSearch']."%"; //%を付けてあいまい検索を可能にしている
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
      
      // DBにSQL文の実行
      $stmt = $db->prepare($sql);
      $stmt->execute($executeArray);
      $searchResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      
      // header('Location: .');
    } catch (PDOException $e) {
      echo $e->getMessage();
      exit;
    }
?>
    
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="search.css">
  <script src="https://kit.fontawesome.com/ea3c053da1.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
  <header>
      <h1>Todos</h1>
    </header>
    
    <section>
      <p><?= "検索結果：".count($searchResult)."件".PHP_EOL; ?></p>
      <ul>  
        <?php foreach($searchResult as $row){ ?>
          <li><?= $row['title'].PHP_EOL; ?></li>
        <?php } ?>
      </ul>
    </section>
    
    <a href="/"><p>return to home</p></a>
  </div>

</body>
</html>