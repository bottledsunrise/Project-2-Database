<?php

try{
    require_once 'models/database.php';
    require_once 'models/enrollment.php';
    
    $action = filter_input(INPUT_POST, "action");
    
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $student_id = filter_input(INPUT_POST, "student_id", FILTER_VALIDATE_INT);
    $section_id = filter_input(INPUT_POST, "section_id", FILTER_VALIDATE_INT);
    $grade = filter_input(INPUT_POST, "grade");
    
    if($action == "insert" && $student_id !== false && $section_id !== false && $grade != ""){
        $enrollment = new Enrollment(0, $student_id, $section_id, $grade);
        insert_enrollment($enrollment);
        header("Location: enrollment.php");
        exit();
    } else if($action == "update" && $id !== false && $student_id !== false && $section_id !== false && $grade != ""){
        $enrollment = new Enrollment($id, $student_id, $section_id, $grade);
        update_enrollment($enrollment);
        header("Location: enrollment.php");
        exit();
    } else if($action == "delete" && $id !== false){
        delete_enrollment($id);
        header("Location: enrollment.php");
        exit();
    } else if($action != ""){
        $error_message = "Missing student ID, section ID, grade, or enrollment ID";
        include('views/error.php');
    }
    
    $enrollments = list_enrollment();
    
    include('views/enrollment.php');
    
} catch (Exception $e) {
    $error_message = $e->getMessage();
    include('views/error.php');
}
?>
