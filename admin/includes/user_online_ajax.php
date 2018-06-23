<?php 
include "../../include/db.php";
session_start();
        
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 60;
        $time_out = $time - $time_out_in_seconds;
        
        try{
          $prepare = $pdo -> prepare("SELECT * FROM users_online WHERE session = :session");
          $prepare -> bindParam(':session',$session);
          $prepare -> execute();

      }catch(Exception $e){

          echo $e -> getMessage();

      }
        
        if($prepare -> rowCount() == 0 ){
             try{
          $prepare = $pdo -> prepare("INSERT INTO users_online VALUES('',:session,:time)");
          $prepare -> bindParam(':session',$session);
          $prepare -> bindParam(':time',$time);
          $prepare -> execute();

      }catch(Exception $e){

          echo $e -> getMessage();

      }
        }else{
            try{
          $prepare = $pdo -> prepare("UPDATE users_online SET time = :time WHERE session = :session)");
          $prepare -> bindParam(':session',$session);
          $prepare -> bindParam(':time',$time);
          $prepare -> execute();

      }catch(Exception $e){

          echo $e -> getMessage();

      }
        }
        
        
        
        
        try{
          $prepare = $pdo -> prepare("SELECT * FROM users_online WHERE time < :time");
          $prepare -> bindParam(':time',$time);
          $prepare -> execute();
            
            
        echo $count_user = $prepare -> rowCount();
      }catch(Exception $e){

          echo $e -> getMessage();

      }
        
        
        
        
        
        
        
        
        
        ?>