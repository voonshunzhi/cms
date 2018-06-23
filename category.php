<?php
    include "include/db.php";
    include "include/header.php";
    include "admin/includes/functions.php";
    include "include/navigation.php";
?>

<?php 
    if(isset($_SESSION['username']) && isset($_SESSION['user_role'])){
        
    }else{
        header("Location:index.php");
    }
?>
    

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            
            <?php 
                if(isset($_GET['id'])){
                    $category_id = $_GET['id'];
                    try{
                        $prepare = $pdo -> prepare("SELECT cat_title FROM categories WHERE cat_id = :cat_id");
                        $prepare -> bindParam(':cat_id',$category_id);
                        $prepare -> execute();
                    }catch(Exception $e){
                        echo $e -> getMessage();
                    }
                    $row = $prepare -> fetch(PDO::FETCH_ASSOC);
                    $header = $row['cat_title'];
                }
            ?>
            <div class="col-md-8">
                

                <h1 class="page-header">
                    <?php echo $header; ?>
                    <small>Secondary Text</small>
                </h1>

               
               
                <!-- First Blog Post -->
                <?php
                    try{
                        $prepare = $pdo -> prepare("SELECT * FROM posts WHERE post_category_id = :cat_id");
                        $prepare -> bindParam(':cat_id',$category_id);
                        $prepare -> execute();
                    }catch(Exception $e){
                        echo $e -> getMessage();
                    }
                    
                
                
                    if($prepare -> rowCount() > 0){
                    while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        
                        echo "<h2>
                                <a href='post.php?post_id={$post_id}'>{$post_title}</a>
                            </h2>
                            <p class='lead'>
                                by <a href='index.php'>{$post_author}</a>
                            </p>
                            <p><span class='glyphicon glyphicon-time'></span> Posted on August 28, 2013 at 10:00 PM</p>
                            <hr>
                            <img class='img-responsive' src='/cms/{$post_image}' alt=''>
                            <hr>
                            <p>{$post_content}</p>
                            <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>

                            <hr>";
                    }
                    }else{
                        echo "<h1>No post for this category!</h1>";
                    }
                ?>
                


            </div>

           
           
           
            <!-- Blog Sidebar Widgets Column -->
            <?php include "include/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "include/footer.php"; ?>