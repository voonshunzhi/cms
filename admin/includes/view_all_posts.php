<?php 

include "includes/delete_modal.php";


if(isset($_POST['submit'])){
    if(isset($_POST['checkBoxArray']) && isset($_POST['bulk_options'])){
        
        $bulk_options = $_POST['bulk_options'];
        foreach($_POST['checkBoxArray'] as $checkBoxValue){
            
            switch($bulk_options){
                    case 'published';
                    try{
                $prepare = $pdo -> prepare("UPDATE posts SET post_status = :post_status WHERE post_id = :post_id");
                $prepare -> bindParam(':post_status',$bulk_options);
                $prepare -> bindParam(':post_id',$checkBoxValue);
                $prepare -> execute();
            }catch(Exception $e){
                echo $e -> getMessage();
            }    
                    break;
                    
                    
                    
                    case 'draft';
                    try{
                $prepare = $pdo -> prepare("UPDATE posts SET post_status = :post_status WHERE post_id = :post_id");
                $prepare -> bindParam(':post_status',$bulk_options);
                $prepare -> bindParam(':post_id',$checkBoxValue);
                $prepare -> execute();
            }catch(Exception $e){
                echo $e -> getMessage();
            }        
                    break;
                    
                    
                   case 'delete';
                    try{
                $prepare = $pdo -> prepare("DELETE FROM posts WHERE post_id = :post_id");
                $prepare -> bindParam(':post_id',$checkBoxValue);
                $prepare -> execute();
            }catch(Exception $e){
                echo $e -> getMessage();
            }        
                    break; 
                    
                    
                   case 'clone';
                    try{
                $prepare = $pdo -> prepare("SELECT * FROM posts WHERE post_id = :post_id");
                $prepare -> bindParam(':post_id',$checkBoxValue);
                $prepare -> execute();
            }catch(Exception $e){
                echo $e -> getMessage();
            }
                    
                while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_date = $row['post_date'];
                    $post_author = $row['post_author'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                }
                    
                try{
            $prepare = $pdo -> prepare("INSERT INTO posts VALUES(:post_id,:post_category_id,:post_title,:post_author,:post_date,:post_image,:post_content,:post_tags,:post_comment_count,:post_status,'')");
            $prepare -> bindValue(':post_id',"");
            $prepare -> bindParam(':post_category_id',$post_category_id);
            $prepare -> bindParam(':post_title',$post_title);
            $prepare -> bindParam(':post_author',$post_author);
            $prepare -> bindParam(':post_date',$post_date);
            $prepare -> bindParam(':post_image',$post_image);
            $prepare -> bindParam(':post_content',$post_content);
            $prepare -> bindParam(':post_tags',$post_tags);
            $prepare -> bindValue(':post_comment_count','');
            $prepare -> bindParam(':post_status',$post_status);
            $prepare -> execute();
        }catch(Exception $e){
            echo $e -> getMessage();
        }
                    break;  
            }
            
            
            
        }
    }
}

    if(isset($_GET['reset'])){
        $post_id = filter_var($_GET['reset'],FILTER_SANITIZE_NUMBER_INT);
        try{
                $prepare = $pdo -> prepare("UPDATE posts SET post_view_count = :post_status WHERE post_id = :post_id");
                $prepare -> bindValue(':post_status',0);
                $prepare -> bindParam(':post_id',$checkBoxValue);
                $prepare -> execute();
            }catch(Exception $e){
                echo $e -> getMessage();
            }        
    }


?>
                          

                          
    <form method="post">
                           <table class="table table-bordered table-hover">
                           <div id="bulkOptionsContainer" class="col-xs-4">
                               <select name="bulk_options" id="bulk_option" class="form-control">
                                   <option value="">Select options</option>
                                   <option value="published">Publish</option>
                                   <option value="draft">Draft</option>
                                   <option value="delete">Delete</option>
                                   <option value="clone">Clone</option>
                               </select>
                           </div>
                           
                           <div class="col-xs-4">
                               <input type="submit" name="submit" class="btn btn-success" value="Apply">
                               <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
                           </div>
                            <thead>
                                <tr>
                                   <td><input type="checkbox" id="selectAllBoxes"></td>
                                    <td>ID</td>
                                    <td>User</td>
                                    <td>Title</td>
                                    <td>Category</td>
                                    <td>Status</td>
                                    <td>Image</td>
                                    <td>Tags</td>
                                    <td>Comment</td>
                                    <td>Date</td>
                                    <td>Total Views</td>
                                    <td>View Posts</td>
                                    <td>Edit</td>
                                    <td>Delete</td>
                                </tr>
                            </thead>
                            <tbody>
                                  <?php 
                                    try{
                                        $prepare = $pdo -> prepare("SELECT * FROM posts INNER JOIN categories WHERE posts.post_category_id = categories.cat_id");
                                        $prepare -> execute();
                                    }catch(Exception $e){
                                        echo $e -> getMessage();
                                        exit();
                                    }
                                    while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
                                        
                                        $post_id = $row['post_id'];
                                        $post_title = $row['post_title'];
                                        $post_author = $row['post_author'];
                                        $post_date = $row['post_date'];
                                        $post_image = $row['post_image'];
                                        $post_content = $row['post_content'];
                                        $post_tags = $row['post_tags'];
                                        $post_status = $row['post_status'];
                                        $post_categories = $row['cat_title'];
                                        $post_view_count = $row['post_view_count'];
                                        $post_user = $row['post_user'];
                                        
                                        
                                        
                                echo "<tr>
                                            <td><input type='checkbox' class='checkBoxes' value='{$post_id}' name='checkBoxArray[]'></td>
                                             <td>{$post_id}</td>";
                                                 
                                if(isset($post_author) || !empty($post_author)){
                                    echo "<td>{$post_author}</td>";
                                }elseif(isset($post_user) || !empty($post_user)){
                                    echo "<td>{$post_user}</td>";
                                }
                                        
                                echo         "<td>{$post_title}</td>
                                             <td>{$post_categories}</td>
                                             <td>{$post_status}</td>
                                             <td><img src='../$post_image' class='small'></td>
                                             <td>{$post_tags}</td>";
                                                
                                                 
                                            try{
                                                $prep =  $pdo -> prepare("SELECT * FROM comments WHERE comment_post_id = :post_id");
                                                $prep -> bindParam(':post_id',$post_id);
                                                $prep -> execute();
                                                $post_comment_count = $prep -> rowCount();
                                                while($row = $prep -> fetch(PDO::FETCH_ASSOC)){
                                                    $comment_id = $row['comment_id'];
                                                }
                                            }catch(Exception $e){
                                                echo $e -> getMessage();
                                            }
                                              
                                                 
                                  echo       "<td><a href='comments.php?source=post_comment&id={$post_id}'>{$post_comment_count}</a></td>";
                                      
                                  echo       "<td>{$post_date}</td>
                                             <td><a href='posts.php?reset={$post_id}'>{$post_view_count}</a></td>
                                             <td><a href='../post.php?post_id={$post_id}'>View Post</a></td>
                                             <td><a href='posts.php?source=edit_post&edit={$post_id}'>EDIT</td>
                                             <td><a href='#' rel={$post_id} class='delete_link'>DELETE</a></td>";
                                    }
                                ?>
                               

                               

                                    
                                
                            </tbody>
                        </table>
 </form>
                                  
<script>
    $(function(){
        $('#selectAllBoxes').click(function(e){
            if (this.checked){
                $('.checkBoxes').each(function(){
                    this.checked = true;
                })
            }else{
                $('.checkBoxes').each(function(){
                    this.checked = false;
                })
            }
        })
        
        
        
      
        $('.delete_link').on('click',function(e){
            e.preventDefault();
            var id = $(this).attr('rel');
            var delete_link = "posts.php?delete=" + id;
            $('#delete_link').attr('href',delete_link);
            $('#myModal').modal('show');
        })
        
        
    })
</script>
                                   