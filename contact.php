<?php  include "include/db.php"; ?>
 <?php  include "include/header.php"; ?>
<?php include "admin/includes/functions.php"; ?>

    <!-- Navigation -->
    
    <?php  include "include/navigation.php"; ?>
    
 <?php 
    
if(isset($_POST['submit'])){
    $email = strip_tags($_POST['email']);
    $subject = strip_tags($_POST['subject']);
    $query = strip_tags($_POST['query']);
    $to = 'voonshunzhi@gmail.com';
    $headers = "From: {$email}";
    mail($to,$subject,$query);
}




?>
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact Us today!</h1>
                    <form role="form" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="email" class="form-control" placeholder="What is your subject">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Query : </label>
                            <textarea name="query" id="query" cols="75" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/footer.php";?>
