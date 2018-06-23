<table class="table table-bordered">
   <?php 
    if(isset($_GET['delete'])){
        
        if(isset($_SESSION['user_role'])){
            
            
            if($_SESSION['user_role'] == 'admin'){
                $user_id = filter_var($_GET['delete'],FILTER_SANITIZE_NUMBER_INT);
                try{
                    $prepare = $pdo -> prepare("DELETE FROM users WHERE user_id = :user_id");
                    $prepare -> bindParam(':user_id',$user_id);
                    $prepare -> execute();
                }catch(Exception $e){
                    echo $e -> getMessage();
                }
            }
        }
        
    }
    if(isset($_GET['change_to_admin'])){
        $user_id = filter_var($_GET['change_to_admin'],FILTER_SANITIZE_NUMBER_INT);
        try{
            $prepare = $pdo -> prepare("UPDATE users SET user_role = 'admin' WHERE user_id = :user_id");
            $prepare -> bindParam(':user_id',$user_id);
            $prepare -> execute();
        }catch(Exception $e){
            echo $e -> getMessage();
        }
    }
    if(isset($_GET['change_to_sub'])){
        $user_id = filter_var($_GET['change_to_sub'],FILTER_SANITIZE_NUMBER_INT);
        try{
            $prepare = $pdo -> prepare("UPDATE users SET user_role = 'subscriber' WHERE user_id = :user_id");
            $prepare -> bindParam(':user_id',$user_id);
            $prepare -> execute();
        }catch(Exception $e){
            echo $e -> getMessage();
        }
    }
    ?>
    <thead>
        <tr>
            <td>User_id</td>
            <td>Username</td>
            <td>Firstname</td>
            <td>Lastname</td>
            <td>Email</td>
            <td>Role</td>
            <td>Approve as</td>
            <td>Approve as </td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
    </thead>
    <?php 
        try{
            $prepare = $pdo -> prepare("SELECT * FROM users");
            $prepare -> execute();
        }catch(Exception $e){
            echo $e -> getMessage();
        }
        
        while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_img'];
            $user_password = $row['user_password'];
            $user_role = $row['user_role'];
            
            ?>
    
    <tbody>
        <tr>
            <td><?php echo $user_id; ?></td>
            <td><?php echo $username; ?></td>
            <td><?php echo $user_firstname; ?></td>
            <td><?php echo $user_lastname; ?></td>
            <td><?php echo $user_email; ?></td>
            <td><?php echo $user_role; ?></td>
            <td><a href="users.php?change_to_admin=<?php echo $user_id; ?>">Admin</a></td>
            <td><a href="users.php?change_to_sub=<?php echo $user_id; ?>">Subscriber</a></td>
            <td><a href="users.php?source=edit_user&edit=<?php echo $user_id; ?>">EDIT</a></td>
            <td><a href="users.php?delete=<?php echo $user_id; ?>">DELETE</a></td>
        </tr>
    </tbody>
    
            
    <?php
        }
    
    
    
    ?>
</table>