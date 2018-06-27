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
                            Welcome to admin
                            <small>Author</small>
                        </h1>
                 </div>       
                        <div class="col-xs-6">
                           <?php insertCategories();?>
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                               <div class="form-group">
                                  <label for="cat_title">Add category</label>
                                   <input type="text" name="cat_title" class="form-control" id="cat_title">
                               </div>
                               <div class="form-group">
                                   <input class="btn btn-primary "type="submit" name="submit" value="Add">
                               </div>
                            </form>
                            <form method="post">
                             
                              
                                    
                                <?php //Update categories
                                    if(isset($_GET['edit'])){
                                        $edit_id = filter_var($_GET['edit'],FILTER_SANITIZE_NUMBER_INT);
                                        include "includes/update_categories.php";
                                    }
                               ?>
                               
                            </form>
                        </div>
                        
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td>Id</td>
                                        <td>Category Title</td>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                  <?php //DELETE CATEGORIES
                                        deleteCategories();
                                    ?> 
                                    
                                   <?php //GET ALL CATEGORIES
                                        getAllCategories();
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

 <?php include "includes/footer.php"; ?> 