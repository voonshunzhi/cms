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
                    
                    <?php 
                    //Get username from session text file in the server
                    if(isset($_SESSION['username'])){
                        $username = $_SESSION['username'];
                    }
                    
                    ?>
                    
                    <?php 
                    
    if(isset($_POST['update_profile'])){
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_protected_password = md5($user_password);
        $user_role = $_POST['user_role'];
        
        $profile_image = $_FILES['image']['name'];
        $profile_image_temp = $_FILES['image']['tmp_name'];
        
        
        if(empty($profile_image)){
            $string = "UPDATE users SET ";
            $string .= "user_firstname = :user_firstname, ";
            $string .= "user_lastname = :user_lastname, ";
            $string .= "username = :username, ";
            $string .= "user_password = :user_password, ";
            $string .= "user_role = :user_role, ";
            $string .= "user_email = :user_email, ";
            $string .= "randSalt = :randSalt ";
            $string .= "WHERE username = :username";
            try{
                $prepare = $pdo -> prepare($string);
                $prepare -> bindParam(':user_firstname',$user_firstname);
                $prepare -> bindParam(':user_lastname',$user_lastname);
                $prepare -> bindParam(':user_email',$user_email);
                $prepare -> bindParam(':user_password',$user_password);
                $prepare -> bindParam(':user_role',$user_role);
                $prepare -> bindParam(':username',$username);
                $prepare -> bindParam(':randSalt',$user_protected_password);
                $prepare -> bindParam(':username',$username);
                $prepare -> execute();
                echo "Update Successful";
            }catch(Exception $e){
                echo $e -> getMessage();
            }
        }else{
        
            if(!move_uploaded_file($profile_image_temp,"../images/$profile_image")){
            $error_types = array(
                1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
                'The uploaded file exceeds 7MB',
                'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
                'The uploaded file was only partially uploaded.',
                'No file was uploaded.',
                6 => 'Missing a temporary folder.',
                'Failed to write file to disk.',
                'A PHP extension stopped the file upload.'
            );

            // Outside a loop...
            if ($_FILES['image']['error'] == 0) {
                // here userfile is the name
                // i.e(<input type="file" name="*userfile*" size="30" id="userfile">
                echo "no error ";
            } else {
                $error_message = $error_types[$_FILES['image']['error']];
                echo $error_message;
            }

        }
            
            $string = "UPDATE users SET ";
            $string .= "user_firstname = :user_firstname, ";
            $string .= "user_lastname = :user_lastname, ";
            $string .= "username = :username, ";
            $string .= "user_password = :user_password, ";
            $string .= "user_role = :user_role, ";
            $string .= "user_email = :user_email, ";
            $string .= "randSalt = :randSalt, ";
            $string .= "user_img = :profile_image ";
            $string .= "WHERE username = :username";
        
     //UPDATING THE DATA IN THE DATABASE
            try{
                $prepare = $pdo -> prepare($string);
                $prepare -> bindParam(':user_firstname',$user_firstname);
                $prepare -> bindParam(':user_lastname',$user_lastname);
                $prepare -> bindParam(':user_email',$user_email);
                $prepare -> bindParam(':user_password',$user_password);
                $prepare -> bindParam(':user_role',$user_role);
                $prepare -> bindParam(':username',$username);
                $prepare -> bindParam(':randSalt',$user_protected_password);
                $prepare -> bindParam(':profile_image',$profile_image);
                $prepare -> bindParam(':username',$username);
                $prepare -> execute();
            }catch(Exception $e){
                echo $e -> getMessage();
            }
          
    }
}
  
  

    //Getting user data from the users table to be edited
    
          try{
        $prepare = $pdo -> prepare("SELECT * FROM users WHERE username = :username");
        $prepare -> bindParam(':username',$username);
        $prepare -> execute();
    }catch(Exception $e){
        echo $e -> getMessage();
    }
    while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $profile_image = $row['user_img'];
        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
         
?>
<form method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="author">Firstname : </label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>
    <div class="form-group">
        <label for="post_status">Lastname :</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
    </div>
    
    <div class="form-group">
        <div><label for="post_category">User role :</label></div>
        <select name="user_role" id="post_category">
                <?php 
                    if($user_role == 'admin'){
                        echo "<option value='admin'>admin</option>";
                        echo "<option value='subscriber'>subscriber</option>";
                    }else{
                        echo "<option value='subscriber'>subscriber</option>";
                        echo "<option value='admin'>admin</option>";
                    }
            
                ?>
                
                <option value='user'>user</option>
                    
        </select>
    </div>
    
    <div class="form-group">
        <div><label for="image">Profile image</label></div>
        <img src="../images/<?php echo $profile_image; ?>" alt="" class="small">
    </div>
    
    <div class="form-group">
        <input type="hidden" name="MAX_FILE_SIZE" value="5900000" />
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Username :</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Email:</label>
        <input type="text" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Password:</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" name="update_profile" type="submit" value="Update Profile">
    </div>
</form>


<?php } ?>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

 <?php include "includes/footer.php"; ?> 
