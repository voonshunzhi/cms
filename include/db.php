<?php
//Setting up the data source name
$db = [];
$db['dns'] = "mysql:host=localhost;dbname=cms;port=3306";
$db['username'] = 'root';
$db['password'] = "Shunzhivoon112893332030";



foreach($db as $key => $value){
    define(strtoupper($key),$value);
}
try{
    $pdo = new PDO(DNS,USERNAME,PASSWORD);
}catch(Exception $e){
    echo $e -> getMessage();
}
?>