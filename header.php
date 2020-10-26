

            <nav class="nav-sections">
                
                <div class="nav-links">
                    
                    <ul>
                        
                         <li><a href="index.php">Home</a></li>
                     
                    </ul>
                
                </div>
                 
                
                <div class="nav-links logo">
                    <h2>Up To The Table</h2>
                    <p >Where You Are Always Invited</p>
                    <div class="resp">
                        <ul>
                        
                            <li><a href="index.php">Home</a></li>
                            <?php if(!(isset($_SESSION['uid']))):   ?>
                                <li><a class="log" href="Tatylogin.php">Login</a></li>
                                <style>
                                   
                                    .log {margin-left: 100px;}
                                    
                            
                                </style>
                            <?php else: ?>
                                <li>

                                    <a href="TatyDashboard.php">Dashboard</a>
                                    

                                </li>
                                <li>

                                    <form action="includes/logout.inc.php" >


                                                <button type="submit" class="btn logout-btn" name="logout-submit" method="post">Logout</button>

                                    </form>

                                </li>
                            <?php endif; ?>
                        
                        </ul>
                        
                    </div>
                    
                </div>
                
                <div class="nav-links">
                    
                    <ul>
                        <!--<li><a href="#">All Posts</a></li>-->
                        <?php if(!(isset($_SESSION['uid']))):  ?>
                            <li><a href="Tatylogin.php">Login</a></li>
                        <?php else: ?>
                            <li>
                            
                                <a href="TatyDashboard.php">Dashboard</a>
                        
                            </li>
                            <li>
                                
                                <form action="includes/logout.inc.php" >
                                    
                                    
                                            <button type="submit" class="btn logout-btn" name="logout-submit" method="post">Logout</button>
                                        
                                </form>
                                
                            </li>
                        <?php endif; ?>
                        
                    </ul>
                
                </div>
                
            </nav>