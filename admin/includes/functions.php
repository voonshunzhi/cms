<?php
function logInValidate($username,$password){
    global $pdo;
    try{
        $p = $pdo -> prepare("SELECT * FROM users WHERE username = :username AND user_password = :password");
        $p -> bindParam(':username',$username);
        $p -> bindParam(':password',$password);
        $p -> execute();
        
    }catch(Exception $e){
        echo $e -> getMessage();
        return false;
    }
    
    if($p -> rowCount() == 0){
        
        echo "Sorry, the username and password do not match.";
        
    }else{
        while($row = $p -> fetch(PDO::FETCH_ASSOC)){
            $user_role = $row['user_role'];
        }
        
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['user_role'] = $user_role;
        
        if($user_role == 'admin'){
            redirect('/cms/admin');
        }else{
            redirect('/cms/index');
        }
        
        
    }
    
}
function redirect($location){
    
    header("Location:".$location);
    exit;
    
}

function ifItIsMethod($method = null){
    
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        
        return true;
        
    }
    
    return false;
    
}

function isLoggedIn(){
    
    if(isset($_SESSION['user_role'])){
        return true;
    }
}


function checkIfUserIsLoggedInAndRedirect($redirectLocation){
    
    if(isLoggedIn()){
        redirect($redirectLocation);
    }
    
}

function email_exists($email){
    
    global $pdo;
    
    try{
        $prepare = $pdo -> prepare("SELECT * FROM users WHERE user_email = :email");
        $prepare -> bindParam(':email',$email);
        $prepare -> execute();
        
    }catch(Exception $e){
        echo $e -> getMessage();
        return false;
    }
    
    if($prepare -> rowCount() > 0){
        return true;
    }else{
        return false;
    }
    
    
    
    
    
    
    
    
    
    
}
function insertCategories(){
    global $pdo;
    if(isset($_POST['submit'])){
                                    $cat_title = $_POST['cat_title'];
                                    if($cat_title ==  "" || empty($cat_title)){
                                        echo "This filed should not be empty";
                                    }else{
                                        try{
                                            $prepare = $pdo -> prepare("INSERT INTO categories VALUES(:id,:cat_title)");
                                            $prepare -> bindValue(':id',"");
                                            $prepare ->  bindParam(':cat_title',$cat_title);
                                            $prepare -> execute();
                                        }catch(Exception $e){
                                            echo $e -> getMessage();
                                        }
                                    }
                                }
}
function deleteCategories(){
    global $pdo;
    if(isset($_GET['delete'])){
                                            $delete_id = $_GET['delete'];
                                            try{
                                                $prepare = $pdo -> prepare("DELETE FROM categories WHERE cat_id = :cat_id");
                                                $prepare -> bindParam(":cat_id",$delete_id);
                                                $prepare -> execute();
                                            }catch(Exception $e){
                                                echo $e -> getMessage();
                                            }
                                        }
}

function getAllCategories(){
    global $pdo;
    try{
                                        $prepare = $pdo -> prepare("SELECT * FROM categories");
                                        $prepare -> execute();
                                    }catch(Exception $e){
                                        echo $e -> getMessage();
                                        exit();
                                    }
                                
                                    while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
                                        $id = $row["cat_id"];
                                        $title = $row['cat_title'];
                                        echo "<tr>
                                        <td>{$id}</td>
                                        <td>{$title}</td>
                                        <td><a href='categories.php?delete={$id}'>Delete</a></td>
                                        <td><a href='categories.php?edit={$id}'>Edit</a></td>
                                        </tr>";
                                    }
}

    
?>