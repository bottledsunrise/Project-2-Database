<?php

try{
    require_once 'models/database.php';
    require_once 'models/course.php';
    
    $action = filter_input(INPUT_POST, "action");
    
    $code = filter_input(INPUT_POST, "code");
    $name = filter_input(INPUT_POST, "name");
    $description = filter_input(INPUT_POST, "description");
    $credits = filter_input(INPUT_POST, "credits", FILTER_VALIDATE_INT);
    
    if($action == "insert_or_update" && $code != "" && $name != "" && $description != "" && $credits !== false){
        $insert_or_update = filter_input(INPUT_POST, 'insert_or_update');
        
        $course = new Course($code, $name, $description, $credits);
        
        if($insert_or_update == "insert"){
            insert_course($course);
        } else if($insert_or_update == "update"){
            update_course($course);
        }
        
        header("Location: course.php");
        exit();
    } else if($action == "delete" && $code != ""){
        delete_course($code);
        header("Location: course.php");
        exit();
    } else if($action != ""){
        $error_message = "Missing course code, name, description, or credits";
        include('views/error.php');
    }
    
    $courses = list_course();
    
    include('views/course.php');
    
    
} catch (Exception $e) {
    $error_messafe = $e->getMessage();
    include('views/error.php');
}
?>