<table class="table table-bordered table-hover">
                           <?php 
    
    
                                if(isset($_GET['id'])){
                                    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
                                }
                                if(isset($_GET['delete'])){
                                    $delete_comment_id = filter_var($_GET['delete'],FILTER_SANITIZE_NUMBER_INT);
                                    try{
                                        $prepare = $pdo -> prepare("DELETE FROM comments WHERE comment_id = :comment_id");
                                        $prepare -> bindParam(':comment_id',$delete_comment_id);
                                        $prepare -> execute();
                                    }catch(Exception $e){
                                        echo $e -> getMessage();
                                    }
                                    
                                    header("Location:comments.php?source=post_comment&id={$id}");
                                }
                                if(isset($_GET['unapprove'])){
                                    $unapprove_comment_id = filter_var($_GET['unapprove'],FILTER_SANITIZE_NUMBER_INT);
                                    try{
                                        $prepare = $pdo -> prepare("UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = :comment_id");
                                        $prepare -> bindParam(':comment_id',$unapprove_comment_id);
                                        $prepare -> execute();
                                    }catch(Exception $e){
                                        echo $e -> getMessage();
                                    }
                                }
                                if(isset($_GET['approve'])){
                                    $approve_comment_id = filter_var($_GET['approve'],FILTER_SANITIZE_NUMBER_INT);
                                    try{
                                        $prepare = $pdo -> prepare("UPDATE comments SET comment_status = 'approved' WHERE comment_id = :comment_id");
                                        $prepare -> bindParam(':comment_id',$approve_comment_id);
                                        $prepare -> execute();
                                    }catch(Exception $e){
                                        echo $e -> getMessage();
                                    }
                                }
                            ?>
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Author</td>
                                    <td>Comment</td>
                                    <td>Email</td>
                                    <td>Status</td>
                                    <td>Date</td>
                                    <td>In response to</td>
                                    <td>Approve</td>
                                    <td>Unapprove</td>
                                    <td>Edit</td>
                                    <td>Delete</td>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                  <?php 
                                    global $pdo;
                                    try{
                                        $prepare = $pdo -> prepare("SELECT * FROM comments WHERE comment_post_id = :id");
                                        $prepare -> bindParam(':id',$id);
                                        $prepare -> execute();
                                    }catch(Exception $e){
                                        echo $e -> getMessage();
                                    }
                                    while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
                                        $comment_id = $row['comment_id'];
                                        $comment_post_id = $row['comment_post_id'];
                                        $comment_author = $row['comment_author'];
                                        $comment_email = $row['comment_email'];
                                        $comment_content = $row['comment_content'];
                                        $comment_status = $row['comment_status'];
                                        $comment_date = $row['comment_date'];
                                        
                                        
                                        echo "<tr>
                                             <td>{$comment_id}</td>
                                             <td>{$comment_author}</td>
                                             <td>{$comment_content}</td>
                                             <td>{$comment_email}</td>
                                             <td>{$comment_status}</td>
                                             <td>{$comment_date}</td>
                                             <td><a href='../post.php?post_id={$comment_post_id}'>Post No {$comment_post_id} </a></td>
                                             <td><a href='comments.php?approve={$comment_id}'>Approve</a></td>
                                             <td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>
                                             <td><a href='comments.php?source=edit_post&edit={$comment_id}'>EDIT</a></td>
                                             <td><a href='comments.php?source=post_comment&delete={$comment_id}&id={$id}'>DELETE</a></td>
                                             </tr>";
                                    }
                                ?>
                               

                               

                                    
                                
                            </tbody>
                        </table>
                                   