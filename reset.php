<?php  include "include/db.php"; ?>
<?php  include "include/header.php"; ?>
<?php  include "admin/includes/functions.php"; ?>
<?php include "include/navigation.php"; ?>

 <?php 
    if(!isset($_GET['email']) || !isset($_GET['token'])){
        
        redirect('/cms/login');
        
    }else{
        
        $email = $_GET['email'];
        $token = $_GET['token'];
        
        try{
            $prepare = $pdo -> prepare("SELECT * FROM users WHERE user_email = :email AND token = :token");
            $prepare -> bindParam(':email',$email);
            $prepare -> bindParam(':token',$token);
            $prepare -> execute();
        }catch(Exception $e){
            echo $e -> getMessage();
        }
        
        if($prepare -> rowCount() == 0){
            
            redirect('/cms/login');
            
        }else{
            
            while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
                
                $email_get = $row['user_email'];
                $token_get = $row['token'];
                $username = $row['username'];
                
                
                
            } 
        }
        
        if(isset($_POST['submit'])){
            
        
        if(isset($_POST['password']) && isset($_POST['confirmPassword'])){
            
            if($_POST['password'] == $_POST['confirmPassword']){
                
                $successful = false;
                
                $password = $_POST['password'];
                
                $hashed_password = md5($password);
                
                $token = '';
                
                try{
                    
                    $prepare = $pdo -> prepare("UPDATE users SET token = :token, user_password = :password,randSalt = :hashed_password");
                    $prepare -> bindParam(':token',$token);
                    $prepare -> bindParam(':password',$password);
                    $prepare -> bindParam(':hashed_password',$hashed_password);
                    $prepare -> execute();
                    
                    $successful = true;
                    
                }catch(Exception $e){
                    
                    echo $e -> getMessage();
                    
                }
                
                
                if($successful){
                    
                    redirect("/cms/login");
                    
                }
                
            }
            
            
            
        }
        }
        
        
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
                                            <form role="form" method="post" id="login-form" autocomplete="off">
                                                <div class="form-group">
                                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                                                </div>
                                                 <div class="form-group">
                                                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm Password">
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

