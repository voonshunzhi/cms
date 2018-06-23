<?php
    include "include/db.php";
    include "include/header.php";
    include "admin/includes/functions.php";
    include "include/navigation.php";

    if(!isset($_SESSION['username']) && !isset($_SESSION['user_role'])){
        
        
        redirect('/cms/login');
        
        
    }
?>
    

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            
            
            <div class="col-md-8">
                

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

               
               
                <!-- First Blog Post -->
                <?php
                
                if(isset($_GET['page'])){
                    $current_page = $_GET['page'];
                }else{
                    $current_page = 1;
                }
                
                //1
                $num_of_items_per_page = 10;
                
                //Get the number of total post
                    try{
                        $prepare = $pdo -> prepare("SELECT * FROM posts WHERE post_status = :post_status");
                        $prepare -> bindValue(':post_status','published');
                        $prepare -> execute();
                    }catch(Exception $e){
                        echo $e -> getMessage();
                        exit;
                    }
                
                //2
                $total = $prepare -> rowCount();
                $offset = ($current_page - 1)*10;
                
                    try{
                        $prepare = $pdo -> prepare("SELECT * FROM posts WHERE post_status = :post_status LIMIT 10 OFFSET {$offset}");
                        $prepare -> bindValue(':post_status','published');
                        $prepare -> execute();
                    }catch(Exception $e){
                        echo $e -> getMessage();
                        exit;
                    }
                
                    if($prepare -> rowCount() == 0){
                        echo "<h1>No post found!</h1>";
                    }
                else{

                    while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,200) . " ..........";
                        
                        echo "<h2>
                                <a href='post.php?post_id={$post_id}'>{$post_title}</a>
                            </h2>
                            <p class='lead'>
                                by <a href='author_post.php?author={$post_author}&post_id={$post_id}'>{$post_author}</a>
                            </p>
                            <p><span class='glyphicon glyphicon-time'></span> Posted on August 28, 2013 at 10:00 PM</p>
                            <hr>
                            <img class='img-responsive' src='{$post_image}' alt=''>
                            <hr>
                            <p>{$post_content}</p>
                            <a class='btn btn-primary' href='post.php?post_id={$post_id}'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>

                            <hr>";
                    }
                    }
                ?>
                

             <?php 
            //Building the page navigation number
            $num_of_pages = ceil($total/$num_of_items_per_page);
                echo "Pages : ";
            for($i = 1; $i <= $num_of_pages; $i++){
                if($i == $current_page){
                    echo "<span class='margin'>{$i}</span>";
                }else{
                    echo "<span class='margin'><a href='index.php?page={$i}'>{$i}</a></span>";
                }
            }
            
            ?>
           
           
            </div>

          
           
            <!-- Blog Sidebar Widgets Column -->
            <?php include "include/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "include/footer.php"; ?>