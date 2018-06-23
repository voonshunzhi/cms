<div class="col-md-4">
    <?php 
    
        
    ?>
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>
                
                
                <!-- Login -->
<!--
                <div class="well">
                    <h4>Login here:</h4>
                    <form action="include/login.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" name="login">Submit
                                </button>
                            </span>
                        </div>
                    </form>
                     /.input-group 
                </div>
-->

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                               <?php
                                    try{
                                        $prepare = $pdo -> prepare("SELECT * FROM categories");
                                        $prepare -> execute();
                                    }catch(Exception $e){
                                        echo $e -> getMessage();
                                        exit();
                                    }
                                
                                    while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
                                        $cat_id = $row['cat_id'];
                                        $title = $row['cat_title'];
                                        echo "<li><a href='category.php?id={$cat_id}'>{$title}</a></li>";
                                    }
                                ?>
                                
                            </ul>
                        </div>
                    
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <?php include "include/widget.php"; ?>

            </div>