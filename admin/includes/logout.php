<?php

include "../../include/db.php";
session_start();

$session = session_id();

try{
    $prepare = $pdo -> prepare("DELETE FROM users_online WHERE session = :session");
    $prepare -> bindParam(':session',$session);
    $prepare -> execute();
}catch(Exception $e){
    echo $e -> getMessage();
}

session_destroy();

header("Location:../../login");
?>