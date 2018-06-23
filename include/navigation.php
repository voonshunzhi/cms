<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/cms/index">Oz Blogger</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   
                   <?php
                        try{
                            $prepare = $pdo -> prepare("SELECT * FROM categories LIMIT 3");
                            $prepare -> execute();
                        }catch(Exception $e){
                            echo $e -> getMessage();
                        }
                    
                        while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            echo "<li><a href='/cms/category/{$cat_id}'>".$cat_title."</a></li>";
                        }
                   ?>
                    
                    <?php 
                    session_start();
                    if(isset($_SESSION['user_role'])){
                    if($_SESSION['user_role'] == 'admin'){ ?>
                        <li>
                            <a href="admin">Admin</a>
                        </li>
                    <?php }} ?>
                   
                    <li>
                        <a href="/cms/contact">Contact Us</a>
                    </li>
                    
                    <?php 
                    if(isset($_SESSION['username']) && isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){?>
                    <li>
                        <a href="/cms/admin/posts.php?source=edit_post">Edit Post</a>
                    </li>
                    <?php  }?>
                    <?php if(!isLoggedIn()){?>
                        <li>
                            <a href="/cms/login">Log In</a>
                        </li>
                        <li>
                            <a href="/cms/registration">Register</a>
                        </li>
                    <?php } ?>
                    <?php 
                        if(isLoggedIn() && ($_SESSION['user_role'] == 'subscriber')){
                    ?>
                    <li>
                            <a href="/cms/admin/includes/logout.php">Log Out</a>
                        </li>
                        
                        <li>
                            <a href="javascript:void(0)"><?php echo $_SESSION['username'];?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>