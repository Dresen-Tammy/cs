<?php

include_once('./dbconnect.php');

$book = $_GET['book'];
$chapter;
$verse;

$scriptureListQuery = $db->query("SELECT id, chapter, verse FROM public.scriptures WHERE (book = '{$book}');");
$scriptureListQuery->execute();
$scriptureList = $scriptureListQuery->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($scriptureList);