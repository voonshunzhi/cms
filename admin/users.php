<?php include "includes/header.php"; ?>
<?php include "includes/redirect.php"; ?>
    <div id="wrapper">

        <!-- Navigation -->
        
        <?php include "includes/navigation.php"; ?>
       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small>Author</small>
                        </h1>
                        
                              <?php //DELETE POSTS FROM VIEW_ALL_POSTS
                                if(isset($_GET['delete'])){
                                    $delete_id = filter_var($_GET['delete'],FILTER_SANITIZE_NUMBER_INT);
                                    try{
                                        $prepare = $pdo -> prepare("DELETE FROM posts WHERE post_id = :delete_id");
                                        $prepare -> bindParam(":delete_id",$delete_id);
                                        $prepare -> execute();
                                    }catch(Exception $e){
                                        echo $e -> getMessage();
                                    }
                                }  
                                
                              ?>
                               

                                <?php 
                                
                                if(isset($_GET['source'])){
                                    $source = $_GET['source'];
                                }else{
                                    $source = "";
                                }
                                
                                    switch($source){
                                            
                                        case 'add_user':
                                            include "includes/add_user.php";
                                            break;
                                            
                                        case 'edit_user':
                                            include "includes/edit_user.php";
                                            break;
                                            
                                        default:
                                            include "includes/view_all_users.php";
                                            break;
                                    }
                                ?>

                                    
                             
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

 <?php include "includes/footer.php"; ?> 
