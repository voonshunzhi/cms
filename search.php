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
                

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

               
               
                <!-- First Blog Post -->
                <?php
                    if(isset($_POST['submit'])){
                        $search = $_POST["search"];
                        try{
                            $prepare = $pdo -> prepare("SELECT * FROM posts WHERE post_tags LIKE :post_tags");
                            $prepare -> bindValue(":post_tags","%".$search."%");
                            $prepare -> execute();
                        }catch(Exception $e){
                            echo $e -> getMessage();
                            exit();
                        }

                        if($prepare -> rowCount() == 0){
                            echo "<h1>No Result</h1>";
                        }else{
                            while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];

                                echo "<h2>
                                        <a href='#'>{$post_title}</a>
                                    </h2>
                                    <p class='lead'>
                                        by <a href='index.php'>{$post_author}</a>
                                    </p>
                                    <p><span class='glyphicon glyphicon-time'></span> Posted on August 28, 2013 at 10:00 PM</p>
                                    <hr>
                                    <img class='img-responsive' src='{$post_image}' alt=''>
                                    <hr>
                                    <p>{$post_content}</p>
                                    <a class='btn btn-primary' href='#'>Read More <span class='glyphicon glyphicon-chevron-right'></span></a>

                                    <hr>";
                            }
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