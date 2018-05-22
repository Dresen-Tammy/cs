<?php
  include_once('./dbconnect.php');

  $bookListQuery = $db->query('SELECT DISTINCT book FROM public.scriptures;');
  $bookListQuery->execute();
  $bookList = $bookListQuery->fetchAll(PDO::FETCH_NUM);
  
  function flattenBooks($item) { return $item[0]; }
  
  $bookList = array_map("flattenBooks", $bookList);
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <script src="./main.js"></script>
    <title>Teach 05</title>
  </head>
  <body>
  <h1>Scripture Resources</h1>
  <h2>Select a Book</h2>
  <select class="book-dropdown">
  <?php
    echo "<option value='' selected></option>";
    foreach ($bookList as $book) {
      echo "<option value='{$book}'>";
        echo $book;
      echo "</option>";
    }
  ?>
  </select>
  <ul class="scripture-list"></ul>
  </body>
</html>