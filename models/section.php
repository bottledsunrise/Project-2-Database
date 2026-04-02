<?php

class Section {

    private $course_code, $faculty_id, $semester, $id;

    public function __construct($course_code, $faculty_id, $semester, $id) {
        $this->set_course_code($course_code);
        $this->set_faculty_id($faculty_id);
        $this->set_semester($semester);
        $this->set_id($id);
    }

    public function set_course_code($course_code) {
        $this->course_code = $course_code;
    }

    public function set_faculty_id($faculty_id) {
        $this->faculty_id = $faculty_id;
    }

    public function set_semester($semester) {
        $this->semester = $semester;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_course_code() {
        return $this->course_code;
    }

    public function get_faculty_id() {
        return $this->faculty_id;
    }

    public function get_semester() {
        return $this->semester;
    }

    public function get_id() {
        return $this->id;
    }
}

function get_section($id) {
    global $database;

    $query = 'SELECT id, course_code, faculty_id, semester
              FROM section
              WHERE id = :id';

    $statement = $database->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->execute();

    $section = $statement->fetch();

    $statement->closeCursor();

    return new Section(
        $section['course_code'],
        $section['faculty_id'],
        $section['semester'],
        $section['id']
    );
}

function list_sections() {
    global $database;

    $query = 'SELECT id, course_code, faculty_id, semester
              FROM section';

    $statement = $database->prepare($query);
    $statement->execute();

    $sections = $statement->fetchAll();

    $statement->closeCursor();

    $sections_array = array();

    foreach ($sections as $section) {
        $sections_array[] = new Section(
            $section['course_code'],
            $section['faculty_id'],
            $section['semester'],
            $section['id']
        );
    }

    return $sections_array;
}

function insert_section($section) {
    global $database;

    $query = "INSERT INTO section (course_code, faculty_id, semester)
              VALUES (:course_code, :faculty_id, :semester)";

    $statement = $database->prepare($query);
    $statement->bindValue(":course_code", $section->get_course_code());
    $statement->bindValue(":faculty_id", $section->get_faculty_id());
    $statement->bindValue(":semester", $section->get_semester());
    $statement->execute();
    $statement->closeCursor();
}

function update_section($section) {
    global $database;

    $query = "UPDATE section
              SET course_code = :course_code,
                  faculty_id = :faculty_id,
                  semester = :semester
              WHERE id = :id";

    $statement = $database->prepare($query);
    $statement->bindValue(":course_code", $section->get_course_code());
    $statement->bindValue(":faculty_id", $section->get_faculty_id());
    $statement->bindValue(":semester", $section->get_semester());
    $statement->bindValue(":id", $section->get_id());
    $statement->execute();
    $statement->closeCursor();
}

function delete_section($id) {
    global $database;

    $query = "DELETE FROM section
              WHERE id = :id";

    $statement = $database->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->execute();
    $statement->closeCursor();
}