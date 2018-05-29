<?php
include_once('dbconnect.php');



function getScriptures() {
    global $db;
    $query = 'SELECT *
              FROM topic_scripture ts
              INNER JOIN scriptures s ON s.id = ts.scripture_id
              INNER JOIN topic t ON t.id = ts.topic_id
              ';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $e->getMessage();
        echo $e;
    }
}

function getTopics() {
    global $db;
    $query = 'SELECT * FROM topic';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_NAMED);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $e->getMessage();
        echo $e;
    }
}

function setTopicScripture($topic_id, $scripture_id) {
    global $db;
    try {
        $query = "INSERT INTO topic_scripture (topic_id, scripture_id)
                 VALUES ('$topic_id','$scripture_id')";
        $db->exec($query);
    } catch (PDOException $e) {
        $e->getMessage();
        echo $e;
    }
}

function setScripture($book, $chapter, $verse, $content) {
    global $db;
    try {
        $query = "INSERT INTO scriptures (book, chapter, verse, content)
                 VALUES ('$book','$chapter','$verse','$content')";
        $db->exec($query);
        $newId = $db->lastInsertId('scriptures_id_seq');
        return $newId;
    } catch (PDOException $e) {
        $e->getMessage();
        echo $e;
    }
}

function setTopic($topicName) {
    global $db;
    try {
        $query = "INSERT INTO topic (name)
                  VALUES ('$topicName')";
        $db->exec($query);
        $newId = $db->lastInsertId('topic_id_seq');
        return $newId;
    } catch (PDOException $e) {
        echo $e;
    }
}



$scriptures = getScriptures();

$allTopics = getTopics();


if (isset($_POST)) {
    $book = $_POST['book'];
    $chapter = $_POST['chapter'];
    $verse = $_POST['verse'];
    $content = $_POST['content'];
    $topics = $_POST['topics'];
    $newTopic = $_POST['newTopic'];
    $topicName = $_POST['newTopicName'];




    if (empty($book) || empty($chapter) || empty($verse) || empty($content)) {
        $message = "All fields are required.";
    } else {

        $scripture_id = setScripture($book, $chapter, $verse, $content);

        foreach ($topics as $topic) {
            setTopicScripture($topic, $scripture_id);

        }
        if (!empty($newTopic) && !empty($topicName)) {
            $topicId = setTopic($topicName);
            setTopicScripture($topicId, $scripture_id);
            $allTopics = getTopics();
        }
        $scriptures = getScriptures();
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teach 06</title>
</head>
<body>
<h1>Scripture Topics</h1>
<h2>Add a scripture</h2>
<section>

</section>
<form action="index.php" method="post">
    Book <input type="text"  id="book" name="book" placeholder="Book Name"><br>
    Chapter <input type="number" id="chapter" name="chapter"><br>
    Verse <input type="number"  id="verse" name="verse" ><br>
    Content <textarea   id="content" name="content" placeholder="Scripture Text"></textarea><br>

        <?php foreach ($allTopics as $topic): ?>
                <input type="checkbox" name="topics[]" value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?><br>
            <?php endforeach; ?>
    </input>
    <input type="checkbox" name="newTopic">
    <input type="text" name="newTopicName" id="newTopic" placeholder="Enter Topic"><br>
    <input type="submit" value="Save">
</form>
<table>
    <tr>
        <th>Reference</th>
        <th>Content</th>
        <th>Topic</th>
    </tr>
    <?php foreach ($scriptures as $scripture): ?>
        <tr>
            <td nowrap><?php echo $scripture['book'] ?> <?php echo $scripture['chapter'] ?>:<?php echo $scripture['verse'] ?></td>
            <td><?php echo $scripture['content'] ?></td>
            <td><?php echo $scripture['name'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>