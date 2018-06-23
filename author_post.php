<?php
    include "include/db.php";
    include "include/header.php";
    include "include/navigation.php";
?>
    

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            
            
            <div class="col-md-8">
                
                <?php 
                    if(isset($_GET['post_id'])){
                        $post_id = filter_var($_GET['post_id'],FILTER_SANITIZE_NUMBER_INT);
                        $post_author = $_GET['author'];
                    }else{
                        header("Location:index.php");
                    }
                    
                    try{
                        $prepare = $pdo -> prepare("SELECT * FROM posts WHERE post_author = :post_author");
                        $prepare -> bindParam(':post_author',$post_author);
                        $prepare -> execute();
                    }catch(Exception $e){
                        echo $e -> getMessage();
                    }

                    while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                    ?>
                        <h1><?php echo $post_title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    All posts by <a href="#"><?php echo $post_author; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="<?php echo $post_image; ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $post_content; ?></p>

                <hr>
                <?php
                    }
                    
                
                ?>
                
               <?php 
                    if(isset($_POST['create_comment'])){
                        
                        $blank = true;
                        
                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                            $blank = false;
                            $comment_author = $_POST['comment_author'];
                            $comment_email = $_POST['comment_email'];
                            $comment_content = $_POST['comment_content'];
                            $comment_post_id = $_GET['post_id'];
                            $comment_date = date("Y-m-d");

                            try{
                            $prepare = $pdo -> prepare("INSERT INTO comments VALUES(:id,:comment_post_id,:comment_author,:comment_email,:comment_content,'unapproved',:comment_date)");

                            $prepare -> bindValue(':id','');
                            $prepare -> bindParam(':comment_post_id',$comment_post_id);
                            $prepare -> bindParam(':comment_author',$comment_author);
                            $prepare -> bindParam(':comment_email',$comment_email);
                            $prepare -> bindParam(':comment_content',$comment_content);
                            $prepare -> bindParam(':comment_date',$comment_date);
                            $prepare -> execute();
                            }catch(Exception $e){
                                echo $e -> getMessage();
                            }
                            
                            
                            
                            
                             try{
                        $prepare = $pdo -> prepare("UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = :comment_post_id");
                        $prepare -> bindParam(':comment_post_id',$comment_post_id);
                        $prepare -> execute();
                        }catch(Exception $e){
                            echo $e -> getMessage();
                        }
                            
                            
                            
                        }else{
                            
                            $blank = true;
                        }
                       
                    }
                
                
                
                ?>
               
                



                <!-- Blog Post -->

                <!-- Title -->
                

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                   <?php 
                    
                    if(isset($_POST['create_comment']) && $blank == true){
                        echo "Please fill in all the blank";   
                    }
                    
                    
                    ?>
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                       <div class="form-group">
                          <label for="Author">Author</label>
                           <input type="text" name="comment_author" class="form-control">
                       </div>
                       <div class="form-group">
                          <label for="">Email</label>  
                           <input type="text" name="comment_email" class="form-control">
                       </div>
                        <div class="form-group">
                           <label for="">Your Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php 
                
                    try{
                        $prepare = $pdo -> prepare("SELECT * FROM comments WHERE comment_post_id = :comment_post_id AND comment_status = :comment_status");
                        $prepare -> bindValue(':comment_status','approved');
                        $prepare -> bindParam(':comment_post_id',$_GET['post_id']);
                        $prepare -> execute();
                        }catch(Exception $e){
                            echo $e -> getMessage();
                        }

                        while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
                            $comment_id = $row['comment_id'];
                            $comment_author = $row['comment_author'];
                            $comment_date = $row['comment_date'];
                            $comment_content = $row['comment_content'];
                    
                ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

               <?php
                        }
                ?>
               
               
               
               
               
                
               

            </div>


        </div>
        <!-- /.row -->

        <hr>
        <?php include "include/footer.php"; ?>

        