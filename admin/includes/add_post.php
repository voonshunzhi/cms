<?php 
    if(isset($_POST['create_post'])){
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_tags = $_POST['post_tags'];
        
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        
        $post_content = $_POST['post_content'];
        $post_date = date('y-m-d');
        $post_comment_count = 0;
        
        if(!move_uploaded_file($post_image_temp,"../images/$post_image")){
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
        
        try{
            $prepare = $pdo -> prepare("INSERT INTO posts VALUES(:post_id,:post_category_id,:post_title,:post_author,:post_date,:post_image,:post_content,:post_tags,:post_comment_count,:post_status,:post_view_count,:post_author)");
            $prepare -> bindValue(':post_id',"");
            $prepare -> bindParam(':post_category_id',$post_category_id);
            $prepare -> bindParam(':post_title',$post_title);
            $prepare -> bindParam(':post_author',$post_author);
            $prepare -> bindParam(':post_date',$post_date);
            $prepare -> bindValue(':post_image',"images/{$post_image}");
            $prepare -> bindParam(':post_content',$post_content);
            $prepare -> bindParam(':post_tags',$post_tags);
            $prepare -> bindValue(':post_comment_count','');
            $prepare -> bindParam(':post_status',$post_status);
            $prepare -> bindValue(':post_view_count',0);
            $prepare -> execute();
            $last_inserted_id = $pdo -> lastInsertId();
            echo "Post successfully added <a href='../post.php?post_id={$last_inserted_id}'>View Post</a>";
        }catch(Exception $e){
            echo $e -> getMessage();
        }
}
    
           
?>
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post title :</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <div><label for="post_category">Post Category:</label></div>
        <select name="post_category" id="post_category">
            <?php 
                try{
            $prepare = $pdo -> prepare("SELECT * FROM categories");
            $prepare -> execute();
                }catch(Exception $e){
                    echo $e -> getMessage();
                }
                while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <div><label for="author">User : </label></div>
        <select name="author" id="author">
            <?php 
            
                try{
                    $prepare = $pdo -> prepare("SELECT * FROM users");
                    $prepare -> execute();    
                }catch(Exception $e){
                    echo $e -> getMessage();
                }
                
                while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
                    echo "<option value={$row['username']}>{$row['username']}</option>";
                }
            
            ?>
        </select>
    </div>
    <div class="form-group">
        <div><label for="post_status">Post status :</label></div>
        <select name="post_status" id="post_status">
            <option value="draft">draft</option>
            <option value="published">published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Post image</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="5900000" />
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post tags :</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post content :</label>
        <textarea type="text" class="form-control" name="post_content" cols="30" rows="10" id="body"></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" name="create_post" type="submit" value="Publish Post">
    </div>
</form>