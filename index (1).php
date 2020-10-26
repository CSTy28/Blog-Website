<?php

require "includes/topics.inc.php";



$postsTitle = 'Recent Posts';



$topics = selectAll('topics');
$posts = getPublished('posts');
$favorites = getFavorites('posts');

$users = getUsers('users');

$top = selectTopicPosts('posts');
//dd($top);

/*if (isset($_GET['t_id'])){
    
}*/
        
//dd($users['uidUsers']);

//$un = selectOne('posts', '25');
/*$sql = "SELECT * FROM posts WHERE published = 1";
    global $conn;
    $result = mysqli_query($conn, $sql);
    $data_array = array();
    if (empty($conditions)){
        while($row = mysqli_fetch_assoc($result)) {
            $data_array[] = $row;
        }

    }*/



//dd($un);
//dd($favorites);
//dd($data_array);
//dd($posts);
//dd($topics);










?>

<!DOCTYPE html>
<html>
    <head>
        <title>Taty Blog </title>
        
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
        
		<link rel="stylesheet" type="text/css" href="css/Tblog.css?rnd=129">
    </head>
    <body>
        <header class="space">
            
            <?php include "header.php" ?>
            
            <section class="about row">
                <div class="about-left col-md-6">
                
                    <img src="pictures/about-image.jpg">
                
                </div>
                <div class="about-right col-md-6">
                
                    <div class="about-text">
                        
                        <h2>About Me</h2>
                
                        <p>I started this blog so I could have a space to be real. I thought the name Up To The Table because by writing, I am essentially inviting everyone and anyone up to the table, my table. A place to learn more about me and my heart but also to interact with you. So welcome, you have been kindly welcomed up to the table.</p>
                
                </div>
                
                </div>
                
                
            
            </section>
        
        </header>
        
        <div class="page-wrapper">
        
            <div class="post-slider">
            
                <h1 class="slider-title">Favorite Posts</h1>
                <i class="fas fa-chevron-left prev"></i>
                <i class="fas fa-chevron-right next"></i>
                
                
                <div class="post-wrapper">
                    
                    <?php foreach($favorites as $fav):?>
                        <div class="pos ">
                    
                            <img src="<?php echo "pictures/" . $fav['image']; ?>" class="slider-img">
                            <div class="post-info">

                                <h4><a href="fullblogpage.php?id=<?php echo $fav['id']; ?>"><?php echo $fav['title']; ?></a></h4>
                                <i class="far fa-user"><?php echo $users['uidUsers']; ?></i>
                                &nbsp;
                                <i class="far fa-calendar"><?php echo date('F j, Y', strtotime($fav['created_at'])); ?></i>

                            </div>
                    
                        </div>
                    
                    <?php endforeach; ?>
                
                    
                </div>
            
            </div>
        
        </div>
        
        <section class="content clearfix">
            
            <div class="main-content">
                
                <?php if (!(isset($_GET['t_id']))): ?>
                    <h1 class="recent-posts-title"><?php echo $postsTitle ?></h1>

                    <?php foreach($posts as $post): ?>
                        <div class="post clearfix">


                            <img src="<?php echo "pictures/" . $post['image']; ?>" alt="images" class="post-image">
                            <div class="post-preview">

                                <h2><a href="fullblogpage.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>

                                <i class="far fa-user"><?php echo $users['uidUsers']; ?></i>
                                        &nbsp;
                                <i class="far fa-calendar"><?php echo date('F j, Y', strtotime($post['created_at'])); ?></i>

                                <p class="preview-text"><?php echo html_entity_decode(substr($post['body'], 0, 150) . '...'); ?></p>
                                <a href="fullblogpage.php?id=<?php echo $post['id']; ?>" class="btn read-more">Read More</a>

                            </div>



                        </div>

                    <?php endforeach; ?>
                <?php elseif(isset($_GET['t_id'])): ?>
                    
                    <h1 class="recent-posts-title"><?php echo $postsTitle ?></h1>

                    <?php foreach($top as $t): ?>
                        <div class="post clearfix">


                            <img src="<?php echo "pictures/" . $t['image']; ?>" alt="images" class="post-image">
                            <div class="post-preview">

                                <h2><a href="fullblogpage.php?id=<?php echo $t['id']; ?>"><?php echo $t['title']; ?></a></h2>

                                <i class="far fa-user"><?php echo $users['uidUsers']; ?></i>
                                        &nbsp;
                                <i class="far fa-calendar"><?php echo date('F j, Y', strtotime($t['created_at'])); ?></i>

                                <p class="preview-text"><?php echo html_entity_decode(substr($t['body'], 0, 150) . '...'); ?></p>
                                <a href="fullblogpage.php?id=<?php echo $t['id']; ?>" class="btn read-more">Read More</a>

                            </div>



                        </div>
                
                    <?php endforeach; ?>
                <?php endif; ?>
                
            
            </div>
            
            <div class="sidebar">
            
                <!--<div class="section search">
                
                    <h2 class="section-title">Search</h2>
                    <form action="index.php" method="post">
                        <input type="text" name="search-term" class="text-input" placeholder="Search...">
                    </form>
                
                </div>-->
                
                <div class="section topics">
                
                    <h2 class="section-title">Topics</h2>
                    <ul>
                    
                        <li><a href="index.php">All Topics</a></li>
                        <?php foreach($topics as $topic): ?>
                            <li><a href="index.php?t_id=<?php echo $topic['id']; ?>"><?php echo $topic['topic'];?></a></li>
                        <?php endforeach; ?>
                            
                        
                      


                        
                        
                        
                        
                    </ul>
                
                </div>
            
            </div>
            
        
        
            
        
        </section>
        
        <div class="footer">
        
            <div class="footer-content">
            
                <div class="footer-section about"></div>
                <div class="footer-section links"></div>
                <div class="footer-section contact"></div>
                
            </div>
            
            <div class="footer-bottom">
            
                
            </div>
        
        </div>
        
        
        
        
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        
        <script type="text/javascript" src="js/Tblog.js"></script>
    </body>
</html>