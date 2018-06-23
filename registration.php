<?php  include "include/db.php"; ?>
 <?php  include "include/header.php"; ?>

<?php include "admin/includes/functions.php"; ?>
    <!-- Navigation -->
    
    <?php  include "include/navigation.php"; ?>
    
 <?php 
    if(isset($_POST['submit'])){
        $username = strip_tags($_POST['username']);
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        if(!empty($username) && !empty($email) && !empty($password)){
            $protected_password = md5($password);
            try{
                $prepare = $pdo -> prepare("INSERT INTO users VALUES(:user_id,:username,:password,:first,:last,:email,:role,:protect)");
                $prepare -> bindValue(':user_id',"");
                $prepare -> bindValue(':first',"");
                $prepare -> bindValue(':last',"");
                $prepare -> bindValue(':role',"subscriber");
                $prepare -> bindParam(":username",$username);
                $prepare -> bindParam(":email",$email);
                $prepare -> bindParam(":password",$password);
                $prepare -> bindParam(":protect",$protected_password);
                $prepare -> execute();
                echo "Your registration has been submitted for review";
            }catch(Exception $e){
                echo $e -> getMessage();
            }
        }else{
            echo "Please fill in all the blank field";
        }
    }




?>
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/footer.php";?>
