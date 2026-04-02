<?php

try{
    require_once 'models/database.php';
    require_once 'models/faculty.php';
    
    $action = filter_input(INPUT_POST, "action");
    
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $name = filter_input(INPUT_POST, "name");
    $email = filter_input(INPUT_POST, "email");
    
    if($action == "insert_or_update" && $id !== false && $name != "" && $email != ""){
        $insert_or_update = filter_input(INPUT_POST, 'insert_or_update');
        
        $faculty = new Faculty($name, $email, null);
        
        if($insert_or_update == "insert"){
            insert_faculty($faculty);
        } else if($insert_or_update == "update"){
            update_faculty($faculty);
        }
        
        header("Location: faculty.php");
        exit();
    } else if($action == "delete" && $id !== false){
        delete_faculty($id);
        header("Location: faculty.php");
        exit();
    } else if($action != ""){
        $error_message = "Missing faculty ID, name, or email";
        include('views/error.php');
    }
    
    $faculty = list_faculty();
    
    include('views/faculty.php');
    
    
} catch (Exception $e) {
    $error_messafe = $e->getMessage();
    include('views/error.php');
}
?>