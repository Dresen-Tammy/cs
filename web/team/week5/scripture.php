<?php
  include_once('./dbconnect.php');

  $book = $_GET['book'];
  $chapter = $_GET['chapter'];
  $verse = $_GET['verse'];

  $scriptureQuery = $db->query("SELECT content FROM public.scriptures WHERE book='{$book}' AND chapter={$chapter} AND verse={$verse};");
  $scriptureQuery->execute();
  $content = $scriptureQuery->fetch()['content'];
  
  
?>

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <title>Teach 05</title>
  </head>
  <body>
  <h1>Scripture Details</h1>
  <a href="./index.php">back</a>
  <?php
    echo "<h3>{$book} {$chapter}:{$verse}</h3>";
    echo "<p>{$content}</p>";
  ?>
  </body>
</html>