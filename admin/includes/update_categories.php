<?php //EDIT CATEGORIES
        $message = "";                                
        try{
            $prepare = $pdo -> prepare("SELECT * FROM categories WHERE cat_id = :cat_id");
            $prepare -> bindParam(":cat_id",$edit_id);
            $prepare -> execute();
        }catch(Exception $e){
            echo $e -> getMessage();
        }

        while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
            $id = $row["cat_id"];
            $title = $row['cat_title'];
?>
       <?php 
        if(isset($_POST['edit_submit'])){
            $edited_title = $_POST['edit_cat_title']; 
                if($_POST['edit_cat_title'] !== ""){
                    try{
                        $prepare = $pdo -> prepare("UPDATE categories SET cat_title = :cat_title WHERE cat_id = :id");
                        $prepare -> bindParam(':cat_title',$edited_title);
                        $prepare -> bindParam(':id',$id);
                        $prepare -> execute();
                        $message =  "Update Successful!";
                    }catch(Exception $e){
                        echo $e -> getMessage();
                    }
                }else{
                    $message =  "Please fill in something";
                }

            }
?>
        <div class="form-group">
          <label for="cat_edit">Edit category</label>
            <input type="text" name="edit_cat_title" class="form-control" id="cat_edit" value="<?php echo isset($title) ?  $title : ""; ?>">
        </div>
        <div class="form-group">
           <input class="btn btn-primary" type="submit" name="edit_submit" value="Edit"><?php echo $message; ?>
        </div>
<?php } ?>
  
