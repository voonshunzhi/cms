<?php 
    if(isset($_GET['edit'])){
        $edit_id = filter_var($_GET['edit'],FILTER_SANITIZE_NUMBER_INT);
    }else{
        header("Location:posts.php");
    }

    //SUBMIT BUTTON IS CLICKED
    if(isset($_POST['update_post'])){
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_tags = $_POST['post_tags'];
        
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        
        $post_content = $_POST['post_content'];
        $post_date = date('y-m-d');
        
        
        
        if(empty($post_image)){
            $string = "UPDATE posts SET ";
            $string .= "post_title = :post_title, ";
            $string .= "post_author = :post_author, ";
            $string .= "post_category_id = :post_category_id, ";
            $string .= "post_date = :post_date, ";
            $string .= "post_content = :post_content, ";
            $string .= "post_tags = :post_tags, ";
            $string .= "post_comment_count = :post_comment_count, ";
            $string .= "post_status = :post_status ";
            $string .= "WHERE post_id = :post_id";
            
            try{
                $prepare = $pdo -> prepare($string);
                $prepare -> bindParam(':post_title',$post_title);
                $prepare -> bindParam(':post_author',$post_author);
                $prepare -> bindParam(':post_category_id',$post_category_id);
                $prepare -> bindParam(':post_date',$post_date);
                $prepare -> bindParam(':post_content',$post_content);
                $prepare -> bindParam(':post_tags',$post_tags);
                $prepare -> bindParam(':post_comment_count',$post_comment_count);
                $prepare -> bindParam(':post_status',$post_status);
                $prepare -> bindParam(':post_id',$edit_id);
                $prepare -> execute();
                echo "<p class='bg-success'>Post updated <a href='../post.php?post_id={$edit_id}'>View Post</a><a href='posts.php'>           Edit more Post</a></p>";
            }catch(Exception $e){
                echo $e -> getMessage();
            }
        }else{
        
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
            
            $string = "UPDATE posts SET ";
            $string .= "post_title = :post_title, ";
            $string .= "post_author = :post_author, ";
            $string .= "post_category_id = :post_category_id, ";
            $string .= "post_date = :post_date, ";
            $string .= "post_image = :post_image, ";
            $string .= "post_content = :post_content, ";
            $string .= "post_tags = :post_tags, ";
            $string .= "post_comment_count = :post_comment_count, ";
            $string .= "post_status = :post_status ";
            $string .= "WHERE post_id = :post_id";
        
     //UPDATING THE DATA IN THE DATABASE
            try{
                $prepare = $pdo -> prepare($string);
                $prepare -> bindParam(':post_title',$post_title);
                $prepare -> bindParam(':post_author',$post_author);
                $prepare -> bindParam(':post_category_id',$post_category_id);
                $prepare -> bindParam(':post_date',$post_date);
                $prepare -> bindValue(':post_image',"images/" . $post_image);
                $prepare -> bindParam(':post_content',$post_content);
                $prepare -> bindParam(':post_tags',$post_tags);
                $prepare -> bindParam(':post_comment_count',$post_comment_count);
                $prepare -> bindParam(':post_status',$post_status);
                $prepare -> bindParam(':post_id',$edit_id);
                $prepare -> execute();
                echo "<p class='bg-success'>Post updated <a href='../post.php?post_id={$edit_id}'>View Post</a><a href='posts.php'>Edit more Post</a></p>";
            }catch(Exception $e){
                echo $e -> getMessage();
            }
          
    }
}


      //GETTING DATA OF THE POST TO BE CHANGED
    try{
        $prepare = $pdo -> prepare("SELECT * FROM posts INNER JOIN categories ON posts.post_category_id = categories.cat_id WHERE post_id = :edit_id");
        $prepare -> bindParam(':edit_id',$edit_id);
        $prepare -> execute();
    }catch(Exception $e){
        echo $e -> getMessage();
    }
    while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
        $post_categories = $row['cat_title'];
        $post_category_id = $row['post_category_id'];
        
        
        
?>
 
                           
<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post title :</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
       <div><label for="post_category">Post Category :</label></div>
        <select name="post_category" id="post_category">
           <?php 
                try{
                    $prepare = $pdo -> prepare("SELECT * FROM categories");
                    $prepare -> execute();
                }catch(Exception $e){
                    echo $e -> getMessage();
                }
        
                while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                    echo "<option value={$cat_id}>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author : </label>
        <input type="text" class="form-control" name="author" value="<?php echo $post_author; ?>">
    </div>
    <div class="form-group">
        <div><label for="post_status">Post status :</label></div>
        <select name="post_status" id="post_status">
        <?php 
            if($post_status == 'draft'){
                echo "<option value='draft'>draft</option>";
                echo "<option value='published'>published</option>";
            }else{
                 echo "<option value='published'>published</option>";
                echo "<option value='draft'>draft</option>";
            }
        
        ?>
        </select>
    </div>
    <div class="form-group">
        <div><label for="post_image">Post Image :</label></div>
        <img src="../<?php echo $post_image; ?>" alt="" class="small">
        <input type="hidden" name="MAX_FILE_SIZE" value="5900000" />
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post tags :</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post content :</label>
        <textarea type="text" class="form-control" name="post_content" cols="30" rows="10" id="body"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" name="update_post" type="submit" value="Edit Post">
    </div>
</form>
<?php   }

?>


