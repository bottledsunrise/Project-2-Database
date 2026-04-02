<?php

try {
    require_once 'models/database.php';
    require_once 'models/student.php';

    $action = filter_input(INPUT_POST, "action");

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $name = filter_input(INPUT_POST, "name");
    $major = filter_input(INPUT_POST, "major");

    if ($action == "insert_or_update") {
        $insert_or_update = filter_input(INPUT_POST, 'insert_or_update');

        if ($insert_or_update == "insert" && $name != "" && $major != "") {
            $student = new Student($name, $major, null);
            insert_student($student);
            header("Location: student.php");
            exit();
        } else if ($insert_or_update == "update" && $name != "" && $major != "" && $id !== false) {
            $student = new Student($name, $major, $id);
            update_student($student);
            header("Location: student.php");
            exit();
        } else if ($action != "") {
            $error_message = "Missing name, major, or ID";
            include('views/error.php');
        }
    } else if ($action == "delete" && $id !== false) {
        delete_student($id);
        header("Location: student.php");
        exit();
    } else if ($action != "") {
        $error_message = "Missing ID for delete";
        include('views/error.php');
    }

    $students = list_students();

    include('views/student.php');

} catch (Exception $e) {
    $error_message = $e->getMessage();
    include('views/error.php');
}
?>