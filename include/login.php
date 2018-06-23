<?php
/*
include "db.php";

session_start();

if(isset($_POST['login'])){
    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);
    //$password = md5($password);
    echo $username;
    try{
        $prepare = $pdo -> prepare("SELECT * FROM users WHERE username = :username AND user_password = :password");
        $prepare -> bindParam(':username',$username);
        $prepare -> bindParam(':password',$password);
        $prepare -> execute();
    }catch(Exception $e){
        echo $e -> getMessage();
    }
    
     while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
            $username = $row['username'];
          $user_id = $row['user_id'];
           $user_role = $row['user_role'];
       }
    
    if($prepare -> rowCount() == 0){
        header("Location:../index.php");
    }else{
        while($row = $prepare -> fetch(PDO::FETCH_ASSOC)){
            $username = $row['username'];
            $user_id = $row['user_id'];
            $user_role = $row['user_role'];
            echo $username;
        }
        
        if($user_role == 'admin'){
            header("Location:../admin");
        }else if($user_role == 'subscriber'){
            header("Location:../index.php");
        }
    }
    
    $_SESSION['username'] = $username;
    $_SESSION['user_role'] = $user_role;
    
}
*/
?>






