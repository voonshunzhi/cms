<?php 
    if(isset($_POST['create_user'])){
        $username = $_POST['username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $protected_password = md5($_POST['user_password']);
        
        if(isset($_FILES['image']['name']) && isset($_FILES['image']['temp_name'])){
            $user_image = $_FILES['image']['name'];
            $user_image_temp = $_FILES['image']['tmp_name'];
            
                    if(!move_uploaded_file($user_image_temp,"../images/$user_image")){
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
        }else{
            $user_image = "default.png";
        }
        
        
     //   $post_content = $_POST['post_content'];
    //    $post_date = date('y-m-d');
     //   $post_comment_count = 4;
        

        
        try{
            $prepare = $pdo -> prepare("INSERT INTO users VALUES(:user_id,:username,:user_password,:user_firstname,:user_lastname,:user_email,:user_img,:user_role,:protected_password)");
            $prepare -> bindValue(':user_id','');
            $prepare -> bindParam(':username',$username);
            $prepare -> bindParam(':user_password',$user_password);
            $prepare -> bindParam(':user_firstname',$user_firstname);
            $prepare -> bindParam(':user_lastname',$user_lastname);
            $prepare -> bindParam(':user_email',$user_email);
            $prepare -> bindParam(':user_img',$user_image);
            $prepare -> bindParam(':user_role',$user_role);
            $prepare -> bindParam(':protected_password',$protected_password);
            $prepare -> execute();
            echo "User successfully created : <a href='users.php'>View User</a>";
        }catch(Exception $e){
            echo $e -> getMessage();
        }
}
    
       if(isset($_GET['edit'])){
           
       }    
?>
<form method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="author">Firstname : </label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="post_status">Lastname :</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    
    <div class="form-group">
        <div><label for="post_category">User role :</label></div>
        <select name="user_role" id="post_category">
            
                <option value='admin'>admin</option>
                <option value='user'>user</option>
                <option value='user'>subscriber</option>    
        </select>
    </div>

    
    <div class="form-group">
        <label for="image">Profile image</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="5900000" />
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Username :</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="post_content">Email:</label>
        <input type="text" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="post_content">Password:</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" name="create_user" type="submit" value="Create User">
    </div>
</form>