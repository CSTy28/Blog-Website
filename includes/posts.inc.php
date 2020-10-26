<?php
session_start();
//var_dump(ROOT_PATH);
require "dbh.inc.php";
require "valPost.inc.php";
//require "messages.inc.php";

$table = 'posts';

$topics = selectAll('topics');
$posts = selectAll($table);

$id = "";
$title = "";

$body = "";
$topic_id = "";
$published = "";
$favorite = "";

$errors = array();


/*if (isset($_GET['id'])) {
    $post = selectOne($table, ['id' => $_GET['id']]);
    $id = $post['id'];
    $title = $post['title'];
    $body = $post['body'];
    $topic_id = $post['topic_id'];
    $published = $post['published'];
    $favorite = $post['favorite'];
}*/

if (isset($_POST['add-post'])){
    //dd($_FILES['image']['name']);
    //$errors = validatePost($_POST);
    
    if (!empty($_FILES['image']['name'])){
        
        //$image_name = time() . '_' . $_FILES['image']['name'];
        $image_name = $_FILES['image']['name'];
        
        //$destination = "uploads/" . $image_name;
        $destination = $_SERVER['DOCUMENT_ROOT'].'/pictures/'.$image_name;
        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
        
        if ($result){
            
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "failed to upload image");
        }
    } 
    
    if (count($errors) === 0){
        //dd($_POST);
        
        unset($_POST['add-post']);
        $_POST['title'] = strip_tags($_POST['title']);
        $_POST['body'] = ($_POST['body']);
        $_POST['user_id'] = 1;
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['favorite'] = isset($_POST['favorite']) ? 1 : 0;
        $_POST['topic_id'] = strip_tags($_POST['topic_id']);

        $post_id = create($table, $_POST);
        $_SESSION['message'] = 'Post created succesfully';
        $_SESSION['type'] = "success";
        header("Location: posts.php");
        exit();
    }
    else {
        //dd($errors);
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
        $favorite = isset($_POST['favorite']) ? 1 : 0;
    }
   
}


if (isset($_POST['update-post'])) {
    //$errors = validatePost($_POST);
    
    if (!empty($_FILES['image']['name'])){
        $image_name = $_FILES['image']['name'];
        $destination = $_SERVER['DOCUMENT_ROOT'].'/pictures/'.$image_name;
        
        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
        
        if ($result){
            $_POST['image'] = $image_name;
        } else {
            array_push($errors, "failed to upload image");
        }
    } 
    
    if (count($errors) === 0){
        //dd('no errors');
        $id = $_POST['id'];
        unset($_POST['update-post'], $_POST['id']);
        $_POST['title'] = strip_tags($_POST['title']);
        $_POST['body'] = ($_POST['body']);
        $_POST['user_id'] = 1;
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['favorite'] = isset($_POST['favorite']) ? 1 : 0;
        $_POST['topic_id'] = strip_tags($_POST['topic_id']);

        $post_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Post updated succesfully';
        $_SESSION['type'] = "success";
        header("Location: posts.php");
        exit();
    }
    else {
        
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
        $favorite = isset($_POST['favorite']) ? 1 : 0;
    }
}


if (isset($_GET['delP_id'])) {
    $count = delete($table, $_GET['delP_id']);
    
    $_SESSION['message'] = 'Post deleted succesfully';
    $_SESSION['type'] = "success";
    header("Location: posts.php");
    exit();
}


if (isset($_GET['published']) && isset($_GET['p_id'])) {
    $published = $_GET['published'];
    $p_id = $_GET['p_id'];
    $count = update($table, $p_id, ['published' => $published]);
    $_SESSION['message'] = 'Post published succesfully';
    $_SESSION['type'] = "success";
    header("Location: posts.php");
    exit();
    
}

if (isset($_GET['favorite']) && isset($_GET['p_id'])) {
    $favorite = $_GET['favorite'];
    $p_id = $_GET['p_id'];
    $count = update($table, $p_id, ['favorite' => $favorite]);
    $_SESSION['message'] = 'Post favorited succesfully';
    $_SESSION['type'] = "success";
    header("Location: posts.php");
    exit();
    
}