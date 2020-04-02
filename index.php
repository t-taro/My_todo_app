<?php
  require_once(__DIR__.'/get.php');
  // require_once(__DIR__.'/search.php');
  
  function h($message){
    return htmlspecialchars($message, ENT_QUOTES, 'utf-8');
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="index.css">
  <script src="https://kit.fontawesome.com/ea3c053da1.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <header>
      <h1>Todos</h1>
      <i id="openSearch" class="fas fa-search"></i>
    </header>
    <div id="searchArea">
      <form action="search.php" method="get">
        <i id="searchAreaClose" class="fas fa-times"></i>
        <p>Title</p>
        <input type="text" name="titleSearch" id="titleSearch">
        <p>Condition</p>
        <label><input type="checkbox" name="doneSearch[]" value="0">not completed</label>
        <label><input type="checkbox" name="doneSearch[]" value="1">completed</label>
        <input type="submit" id="searchBtn" value="Search">
      </form>
    </div>
    <section id="add_todo">
      <form action="post.php" method="post">
        <input type="text" id="add_new_todo" name="newTitle" placeholder="input new todo">
        <input type="submit" value="Add to list">
      </form>
    </section>
    
    <section id="todo_list">
      <ul>
        <li>
          <p class="columnTitle">Todo title</p>
          <p class="columnTitle">Created Date</p>
          <p class="columnTitle">Updated Date</p>
        </li>
        <?php foreach($result as $row){ ?>
            <li>
              <form action="check.php" method="post">
                <!-- $_POSTに$row[id]を渡したいが、渡し方がわからない。。。 -->
                <input type="checkbox" class="checkbox" name="newState[]" value="<?php
                if ($row['state'] == 0){
                  echo 0;
                }else{
                  echo 1;
                }; ?>">
                <input type="text" class="hidden" name="checkedId" value="<?= $row['id'] ?>" readonly>
                <input type="submit" class="checkboxSubmit hidden" value= "">
              </form>
              
              <p><?= h($row['title']) ?></p>
              
              <p><?php
              $dsh = $db->query('select date_format(created_at, "%Y-%m-%d") as formatedCreatedDate from todos where id = '.$row['id']);
              $createdDate = $dsh->fetch(PDO::FETCH_ASSOC);
              echo $createdDate['formatedCreatedDate'];
              ?></p>
              
              <p><?php
              $dsh = $db->query('select date_format(updated_at, "%Y-%m-%d") as formatedUpdatedDate from todos where id = '.$row['id']);
              $updatedDate = $dsh->fetch(PDO::FETCH_ASSOC);
              echo $updatedDate['formatedUpdatedDate'];
              ?></p>
              
              <form action="delete.php" method="post">
                <input type="text" class="hidden" name="deleteTitleId" value="<?= $row['id'] ?>" readonly>
                <input type="submit" value="x">
              </form>
            </li>
        <?php
          }
        ?>
      </ul>
    </section>
  </div>  
  <script src="checkbox.js"></script>
  <script src="searchUI.js"></script>  
</body>
</html>