<?php
    require "includes/posts.inc.php";
    

    if(!(isset($_SESSION['uid']) || isset($_SESSION['uid']))) {
        
        echo "your session is not running";
        header("Location: Tatylogin.php");
    }

    $topics = selectAll('topics');
    //dd($posts[0]['topic_id']);
    
    /*foreach ($posts as $p){
        if ($p['topic_id'] == 42){
            dd($p['topic_id']);
        } 
    }*/
    
    
    
    
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Posts</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/Tdashboard.css?rnd=128" rel="stylesheet">
    <!--<link href="css/Tblog.css" rel="stylesheet">-->
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">BlogHome</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="TatyDashboard.php">Dashboard</a></li>
            <li><a href="pages.php">Topics</a></li>
            <li class="active"><a href="posts.php">Posts</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome, <?php echo $_SESSION['uid']; ?></a></li>
            <li>
            
                <form action="includes/logout.inc.php" >
                
                    <button type="submit" class="btn logout-btn" name="logout-submit" method="post">Logout</button>
                
                </form>
              
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
      
      
      
    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span class="" aria-hidden="true"></span> Posts<small>Manage Blog Posts</small></h1>
          </div>
          
        </div>
      </div>
    </header>
      
      
    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="TatyDashboard.php">Dashboard</a></li>
          <li class="active">Posts</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="TatyDashboard.php" class="list-group-item active main-color-bg">
                <span aria-hidden="true"></span> Dashboard
              </a>
              <a href="pages.php" class="list-group-item"><span  aria-hidden="true"></span> Topics <span class="badge"><?php echo count($topics) ?></span></a>
              <a href="posts.php" class="list-group-item"><span  aria-hidden="true"></span> Posts <span class="badge"><?php echo count($posts); ?></span></a>
              
            </div>

            <!-- Disk Space etc.
            <div class="well">
              <h4>Disk Space Used</h4>
              <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                      60%
              </div>
            </div>
            <h4>Bandwidth Used </h4>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                    40%
            </div>
          </div>
            </div> -->
              
          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Posts</h3>
              </div>
                <?php include "includes/messages.inc.php" ?>
              <div class="panel-body">
                
                <div class="Addition">
                  
                    <a type="button" data-toggle="modal" data-target="#addPost" class="btn btn-atag">Add Post</a>
                  
                </div>
                
                <br>
                <table class="table table-striped table-hover">
                      <tr>
                        <th>Title</th>
                        <th>Published</th>
                        <th>Favorite</th>
                        <th>Created</th>
                        <th></th>
                      </tr>
                    
                    <?php foreach($posts as $key => $post): ?>
                      <tr>
                        <td><?php echo $post['title']; ?></td>
                        
                        <?php if ($post['published']): ?>
                          <td><a href="posts.php?published=0&p_id=<?php echo $post['id']; ?>" class="unpublish">published</a></td>
                        <?php else: ?>
                          <td><a href="posts.php?published=1&p_id=<?php echo $post['id']; ?>" class="publish">Draft</a></td>
                        <?php endif; ?>
                          
                        <?php if ($post['favorite']): ?>
                          <td><a href="posts.php?favorite=0&p_id=<?php echo $post['id']; ?>" class="unfavorite">favorited</a></td>
                        <?php else: ?>
                          <td><a href="posts.php?favorite=1&p_id=<?php echo $post['id']; ?>" class="favorite">not favorited</a></td>
                        <?php endif; ?>
                          
                        <td><?php echo $post['created_at']; ?></td>
                        <td><a class="btn btn-default" href="editPost.php?id=<?php echo $post['id']; ?>&&t_id=<?php echo $post['topic_id']; ?>">Edit</a> 
                            <a class="btn btn-del" href="editPost.php?delP_id=<?php echo $post['id']; ?>">Delete</a></td>
                      </tr>
                      
                    <?php endforeach; ?>
                    </table>
              </div>
              </div>

          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright AdminStrap, &copy; 2017</p>
    </footer>

    <!-- Modals -->

   
      
<!--Add Post-->
<div class="modal fade" id="addPost" tabindex="-2" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        
      <form action="posts.php" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Post</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Post Title</label>
          <input type="text" class="form-control" name="title" placeholder="Post Title">
        </div>
        <div class="form-group">
            <label>Post Image</label> 
            <input type="file" class="form-control" name="image" placeholder="Post Image"/>
        </div>
        <div class="form-group">
          <label>Post Body</label>
          <textarea name="body" class="form-control" placeholder="Post Description"></textarea>
        </div>
        <div class="checkbox">
            <?php if (empty($published)): ?>
                <label>
                    <input type="checkbox" name="published"> Published
                </label>
            <?php else: ?>
                <label>
                    <input type="checkbox" name="published" checked> Published
                </label>
            <?php endif; ?>
        </div>
        
        <div class="checkbox">
            <?php if (empty($favorite)): ?>
                <label>
                    <input type="checkbox" name="favorite"> Favorite
                </label>
            <?php else: ?>
                <label>
                    <input type="checkbox" name="favorite" checked> Favorite
                </label>
            <?php endif; ?>
        </div>
            
        
        
        <label>Topic</label>
        <div>
          
            <select name="topic_id">
            <option value="<?php echo $topics[0]['id']; ?>"><?php echo $topics[0]['topic']; ?></option>
        
            <?php foreach ($topics as $key => $topic): ?>
            
            <option value="<?php echo $topic['id']; ?>"><?php echo $topic['topic']; ?></option>
            
            <?php endforeach; ?>
            
        </select>
          
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="add-post">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

  <script>
     CKEDITOR.replace( 'body' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>