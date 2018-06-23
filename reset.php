<?php  include "include/db.php"; ?>
<?php  include "include/header.php"; ?>
<?php  include "admin/includes/functions.php"; ?>
<?php include "include/navigation.php"; ?>

 <?php 
    if(!isset($_GET['email']) || !isset($_GET['token'])){
        
        redirect('/cms/login');
        
    }



?>
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
               <div class="panel-body">
                        <div class="text-center">
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">
                                    <div class="form-wrap">
                                            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                                                <div class="form-group">
                                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Password">
                                                </div>
                                                 <div class="form-group">
                                                    <input type="text" name="email" id="email" class="form-control" placeholder="Confirm Password">
                                                </div>

                                                <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block btn-primary" value="Reset Password">
                                            </form>

                                        </div>
                                </div><!-- Body-->

                        </div>
                    </div>
                
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/footer.php";?>

