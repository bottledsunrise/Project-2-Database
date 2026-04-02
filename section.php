<?php

try {
    require_once 'models/database.php';
    require_once 'models/section.php';

    $action = filter_input(INPUT_POST, "action");

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $course_code = filter_input(INPUT_POST, "course_code");
    $faculty_id = filter_input(INPUT_POST, "faculty_id", FILTER_VALIDATE_INT);
    $semester = filter_input(INPUT_POST, "semester");

    if ($action == "insert_or_update") {
        $insert_or_update = filter_input(INPUT_POST, 'insert_or_update');

        if ($insert_or_update == "insert" && $course_code != "" && $faculty_id !== false && $semester != "") {
            $section = new Section($course_code, $faculty_id, $semester, null);
            insert_section($section);
            header("Location: section.php");
            exit();
        } else if ($insert_or_update == "update" && $course_code != "" && $faculty_id !== false && $semester != "" && $id !== false) {
            $section = new Section($course_code, $faculty_id, $semester, $id);
            update_section($section);
            header("Location: section.php");
            exit();
        } else if ($action != "") {
            $error_message = "Missing course code, faculty ID, semester, or section ID";
            include('views/error.php');
        }
    } else if ($action == "delete" && $id !== false) {
        delete_section($id);
        header("Location: section.php");
        exit();
    } else if ($action != "") {
        $error_message = "Missing ID for delete";
        include('views/error.php');
    }

    $sections = list_sections();

    include('views/section.php');

} catch (Exception $e) {
    $error_message = $e->getMessage();
    include('views/error.php');
}
?>