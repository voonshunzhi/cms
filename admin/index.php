<?php include "includes/header.php"; ?>
   
    <div id="wrapper">

       
        <!-- Navigation -->
        
        <?php include "includes/navigation.php"; ?>
       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo isset($_SESSION['username']) ? $_SESSION['username']: ""; ?></small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
                
                
                
                
                
                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                  <div class='huge'>
                      
                      <?php 
                      //Calculate the number of posts from db
                      
                      try{
                          $prepare = $pdo -> prepare("SELECT * FROM posts");
                          
                          $prepare -> execute();
                          
                      }catch(Exception $e){
                          
                          echo $e -> getMessage();
                          
                      }
                      
                      
                      $post_count = $prepare -> rowCount();
                      echo $post_count;
                      
                      ?>
                      
                      
                      
                      
                  </div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <div class='huge'>
                         
                         
                         <?php 
                      //Calculate the number of comments from db
                      
                      try{
                          $prepare = $pdo -> prepare("SELECT * FROM comments");
                          
                          $prepare -> execute();
                          
                      }catch(Exception $e){
                          
                          echo $e -> getMessage();
                          
                      }
                      
                    $comment_count = $prepare -> rowCount();
                         
                      echo $comment_count;
                      
                      ?>
                         
                         
                         
                         
                         
                         
                         
                         
                     </div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'>
                        
                        
                        <?php 
                      //Calculate the number of users from db
                      
                      try{
                          $prepare = $pdo -> prepare("SELECT * FROM users");
                          
                          $prepare -> execute();
                          
                      }catch(Exception $e){
                          
                          echo $e -> getMessage();
                          
                      }
                      
                        $user_count = $prepare -> rowCount();
                      echo $user_count;
                      
                      ?>
                        
                        
                    
                    </div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'>
                            
                            
                            
                            <?php 
                      //Calculate the number of categories from db
                      
                      try{
                          $prepare = $pdo -> prepare("SELECT * FROM categories");
                          
                          $prepare -> execute();
                          
                      }catch(Exception $e){
                          
                          echo $e -> getMessage();
                          
                      }
                      
                            
                        $category_count = $prepare -> rowCount();
                            
                      echo $category_count;
                      
                      ?>
                            
                            
                            
                            
                            
                            
                            
                            
                        </div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
              
              
<?php 
    // Adding some features into the graph like the status of the data
    //Get the draft posts
     try{
          $prepare = $pdo -> prepare("SELECT * FROM posts WHERE post_status = :post_status");
          $prepare -> bindValue(':post_status','draft');
          $prepare -> execute();

      }catch(Exception $e){

          echo $e -> getMessage();

      }


        $draft_post_count = $prepare -> rowCount();

                
                
                
     //Get the unapproved comments                            
     try{
          $prepare = $pdo -> prepare("SELECT * FROM comments WHERE comment_status = :comment_status");
          $prepare -> bindValue(':comment_status','unapproved');
          $prepare -> execute();

      }catch(Exception $e){

          echo $e -> getMessage();

      }


        $unapproved_comment_count = $prepare -> rowCount();

                
                
                
        //Get the number of subscriber
       try{
          $prepare = $pdo -> prepare("SELECT * FROM users WHERE user_role = :user_role");
          $prepare -> bindValue(':user_role','subscriber');
          $prepare -> execute();

      }catch(Exception $e){

          echo $e -> getMessage();

      }


        $subscriber_count = $prepare -> rowCount(); 
                
                
                
        //Get the number of published posts
                try{
          $prepare = $pdo -> prepare("SELECT * FROM posts WHERE post_status = :post_status");
          $prepare -> bindValue(':post_status','published');
          $prepare -> execute();

      }catch(Exception $e){

          echo $e -> getMessage();

      }


        $active_post_count = $prepare -> rowCount(); 
?>
               
<div class="row">
                   <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
            
            
            <?php 
            
            $element_text = ['Total posts','Active Posts','Draft Post Count','Categories','Users','Subscriber','Comments','Unapproved Comment Count'];
            $element_count = [$post_count,$active_post_count,$draft_post_count,$category_count,$user_count,$subscriber_count,$comment_count,$unapproved_comment_count];
            
            for($i =0; $i < count($element_text);$i ++){
                echo "['{$element_text[$i]}',{$element_count[$i]}],";
            }
            
            
            
            ?>
          ['Posts', 10]
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
              
              <div id="columnchart_material" style="width:100%; height: 500px;"></div>
               </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

 <?php include "includes/footer.php"; ?> 
