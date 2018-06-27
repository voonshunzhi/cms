<?php 
    if(isset($_SESSION['username']) && isset($_SESSION['user_role'])){
        
        $user_role = $_SESSION['user_role'];
        
        if($user_role != 'admin'){
            
            header("Location:../index");
            exit;
        }
    }


?>