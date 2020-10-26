<?php
session_start();
require "dbh.inc.php";
require "valTopic.inc.php";
//require "messages.inc.php";

$table = 'topics';

$errors = array();
$id = '';
$name = '';
$description = '';

$topics = selectAll($table);


function getAllTopics() {
	global $conn;
	$sql = "SELECT * FROM topics";
	$result = mysqli_query($conn, $sql);
	$topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $topics;
    dd($topics);
}


if (isset($_POST['add-topic'])) {
    $errors = validateTopic($_POST);
    
    if(count($errors) === 0) {
        unset($_POST['add-topic']);
        validateTopic($_POST);
        $_POST['topic'] = strip_tags($_POST['topic']);
        $topic_id = create($table, $_POST);
        $_SESSION['message'] = 'topic created successfully';
        $_SESSION['type'] = 'success';
        header("Location: ../pages.php");
        exit();
    }
    else {
        $name = $_POST['topic'];
        $description = $_POST['description'];
        header("Location: ../pages.php?emptyfields");
        exit();
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $topic = selectOne($table, ['id' => $id]);
    $id = $topic['id'];
    $name = $topic['topic'];
    $description = $topic['description'];
    
}

if (isset($_POST['update-topic'])) {
    
    $errors = validateTopic($_POST);
    
    if(count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['update-topic'], $_POST['id']);
        $topic_id = update($table, $id, $_POST);
        header("Location: pages.php");
        exit();
    }
    else {
        $id = $_POST['id'];
        $name = $_POST['topic'];
        $description = $_POST['description'];
        
        
    }
    
    
}

if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    delete($table, $id);
    $_SESSION['message'] = 'topic deleted successfully';
    $_SESSION['type'] = 'success';
    header("Location: pages.php");
    exit();
}



?>