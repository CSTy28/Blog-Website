<?php
    //session_start();
    require "includes/posts.inc.php";
    

    if(!(isset($_SESSION['uid']) || isset($_SESSION['uid']))) {
        
        echo "your session is not running";
        header("Location: Tatylogin.php");
    }
    
    $topics = selectAll('topics');
    $posts = selectAll('posts');
    $info = selectOne('posts');
    $t_id = selectOneTop('topics');
    //dd($t_id['topic']);
    
    
    
    
    
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Edit Page</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/Tdashboard.css" rel="stylesheet">
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
          <a class="navbar-brand" href="TatyBlog.php">BlogHome</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="TatyDashboard.php">Dashboard</a></li>
            <li><a href="pages.php">Topics</a></li>
            <li><a href="posts.php">Posts</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome, <?php echo $_SESSION['uid']; ?></a></li>
            <li><a href="login.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-10">
            <h1><span aria-hidden="true"></span> Edit Topic</h1>
          </div>
          <div class="col-md-2">
            
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="TatyDashboard.php">Dashboard</a></li>
          <li><a href="pages.php">Posts</a></li>
          <li class="active">Edit Post</li>
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
              <a href="pages.php" class="list-group-item"><span aria-hidden="true"></span> Topics <span class="badge"><?php echo count($topics); ?></span></a>
              <a href="posts.php" class="list-group-item"><span aria-hidden="true"></span> Posts <span class="badge"><?php echo count($posts);?></span></a>
              
            </div>

            
          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Edit Post</h3>
              </div>
              <div class="panel-body">
                <form action="editPost.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
                  <div class="form-group">
                    <label>Post Name</label>
                    <input type="text" name="title" value="<?php echo $info['title']; ?>" class="form-control" placeholder="Post Title" >
                  </div>
                    <div class="form-group">
                        <label>Post Image</label> 
                        <input type="file" class="form-control" name="image" placeholder="Post Image"/>
                    </div>
                  <div class="form-group">
                    <label>Post Body</label>
                    <textarea name="body" class="form-control" placeholder="Page Body" ><?php echo $info['body']; ?>
                    </textarea>
                  </div>
                  <div class="checkbox">
                    <?php if (empty($info['published'])): ?>
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
                    <?php if (empty($info['favorite'])): ?>
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
                <option value="<?php echo $t_id['id']; ?>"><?php echo $t_id['topic']; ?></option>

                <?php foreach ($topics as $key => $topic): ?>

                <option value="<?php echo $topic['id']; ?>"><?php echo $topic['topic']; ?></option>

                <?php endforeach; ?>

            </select>
          
            </div>
                  <input type="submit" name="update-post" class="btn btn-default" value="Update Post">
                </form>
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

    <!-- Add Page -->
    <div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Page</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Post Title</label>
          <input type="text" class="form-control" placeholder="Page Title">
        </div>
        <div class="form-group">
          <label>Post Body</label>
          <textarea name="editor1" class="form-control" placeholder="Page Body"></textarea>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox"> Published
          </label>
        </div>
        <div class="form-group">
          <label>Meta Tags</label>
          <input type="text" class="form-control" placeholder="Add Some Tags...">
        </div>
        <div class="form-group">
          <label>Meta Description</label>
          <input type="text" class="form-control" placeholder="Add Meta Description...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
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
