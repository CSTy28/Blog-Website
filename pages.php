<?php
    //require "includes/dbh.inc.php";
    require "includes/topics.inc.php";
    

    if(!(isset($_SESSION['uid']) || isset($_SESSION['uid']))) {
        
        echo "your session is not running";
        header("Location: Tatylogin.php");
    }
    
    $topics = selectAll('topics');
    $posts = selectAll('posts');
    

?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Topics</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/Tdashboard.css?rnd=128" rel="stylesheet">
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
            <li class="active"><a href="pages.php">Topics</a></li>
            <li><a href="posts.php">Posts</a></li>
            
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
            <h1><span aria-hidden="true"></span> Pages<small>Manage Site Topics</small></h1>
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
          <li class="active">Topics</li>
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
                <h3 class="panel-title">Topics</h3>
              </div>
                <?php //include "includes/messages.inc.php" ?>
              <div class="panel-body">
                  
                  <div class="Addition">
                  
                      <a type="button" data-toggle="modal" data-target="#addTopic" class="btn btn-atag">Add Topic</a>
                  
                  </div>
                
                <br>
                <table class="table table-striped table-hover">
                      <tr>
                        <th>Title</th>
                        
                        <th>Created</th>
                        <th></th>
                      </tr>
                    
                    <?php 
                    foreach($topics as $key => $topic): ?>
                        <tr>
                            <td><?php echo $topic['topic']; ?></td>
                            
                            <td>Dec 12, 2016</td>
                            <td><a class="btn btn-default" href="editTopic.php?t_id=<?php echo $topic['id'] ?>">Edit</a> 
                                <a class="btn btn btn-del" href="pages.php?del_id=<?php echo $topic['id'] ?>">Delete</a></td>
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

    <!-- Add Topic -->
    <div class="modal fade" id="addTopic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <!-- FORM -->
      <form action="includes/topics.inc.php" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Topic</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Topic Title</label>
          <input type="text" class="form-control" name="topic" value="<?php echo $name; ?>" placeholder="Page Title">
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea name="description" class="form-control" value="<?php echo $description ?>" placeholder="Topic Description"></textarea>
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
        <button type="submit" name="add-topic" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>
      


  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>