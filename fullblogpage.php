<?php

//require "includes/posts.inc.php";
require "includes/topics.inc.php";

if(!(isset($_GET['id']) )) {
        
        echo "your session is not running";
        header("Location: TatyBlog.php");
    }
/*
$posts = getPublishedPosts();




if (isset($_GET['id'])){
    $post = selectOne('posts', ['id' => $_GET['id']]);
    
}

$posts = selectAll('posts', ['published' => 1]);
$topics = selectAll('topics');
$user = selectOne('users', ['uidUsers' => 'tot']);

*/
$topics = selectAll('topics');

$post = selectOne('posts');
//$post = $data[0];
$posts = selectAll('posts');

$users = getUsers('users');
//$post = $data_array[0];
//dd($post);

    


//$one = selectOne('post', '25');
//dd($one);

?>

<!DOCTYPE html>
<html>

    <head>
        <title><?php echo $post['title']; ?> | uptothetable</title>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Nanum+Myeongjo:wght@400;700&display=swap" rel="stylesheet">
        <!-- favicon -->
        <!--<link rel="icon" type="image/png" href="images/favicon.png">-->
        <script src="https://kit.fontawesome.com/8e1c759baf.js" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
        
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        
		<link rel="stylesheet" type="text/css" href="css/Tblog.css?rnd=128">
         
    </head>
    <body>
    
        <?php include "header.php" ?>
        
        <div class="page-wrapper">
        
            <div class="content clearfix">
            
                <div class="main-content single">
                    <div class="post-title">
                    
                        <h1><?php echo $post['title']; ?></h1>
                        <i class="far fa-user"><?php echo $users['uidUsers']; ?></i>
                            &nbsp;
                        <i class="far fa-calendar"><?php echo date('F j, Y', strtotime($post['created_at'])); ?></i>
                        
                    </div>
                    
                    <div class="post-image">
                    
                        <img src="<?php echo 'pictures/' . $post['image']; ?>">
                        
                    </div>
                    
                    
                    <div class="post-content">
                    
                        <p><?php echo html_entity_decode($post['body']); ?></p>
                        
                    </div>
                
                </div>
                
                <div class="sidebar single">
            
                    <div class="section-popular">
                    
                        <h2 class="section-title">Popular</h2>
                        
                        <?php foreach($posts as $p): ?>
                            <div class="post clearfix">

                                <img src="<?php echo 'pictures/' . $p['image']; ?>">
                                <a href="fullblogpage.php?id=<?php echo $p['id']; ?>" class="title"><?php echo $p['title']; ?></a>


                            </div>
                        <?php endforeach; ?>
                        
                        
                    
                    </div>
                
                    <div class="section topics">

                        <h2 class="section-title">Topics</h2>
                        <ul>

                            <?php foreach($topics as $topic): ?>
                                <li><a href="<?php echo 'TatyBlog.php?t_id=' . $topic['id'] . '&topic=' . $topic['topic']; ?>"><?php echo $topic['topic']; ?></a></li>
                            <?php endforeach; ?>

                        </ul>

                    </div>
            
            </div>
            
            </div>
        
        </div>
        
        
        
    
    </body>

</html>