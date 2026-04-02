<?php

class Enrollment{
    private $id, $student_id, $section_id, $grade;
    
    public function __construct($id, $student_id, $section_id, $grade){
        $this->set_id($id);
        $this->set_student_id($student_id);
        $this->set_section_id($section_id);
        $this->set_grade($grade);
    }
    
    public function set_id($id){
        $this->id = $id;
    }
    
    public function set_student_id($student_id){
        $this->student_id = $student_id;
    }
    
    public function set_section_id($section_id){
        $this->section_id = $section_id;
    }
    
    public function set_grade($grade){
        $this->grade = $grade;
    }
    
    public function get_id(){
        return $this->id;
    }
    
    public function get_student_id(){
        return $this->student_id;
    }
    
    public function get_section_id(){
        return $this->section_id;
    }
    
    public function get_grade(){
        return $this->grade;
    }
}

function get_enrollment($id){
    global $database;
    
    $query = 'SELECT id, student_id, section_id, grade FROM enrollment WHERE id = :id';
    
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->execute();
    
    $enrollment = $statement->fetch();
    
    $statement->closeCursor();
    
    return new Enrollment(
            $enrollment['id'],
            $enrollment['student_id'],
            $enrollment['section_id'],
            $enrollment['grade']
    );
}

function list_enrollment(){
    global $database;
    
    $query = 'SELECT id, student_id, section_id, grade FROM enrollment';
    
    $statement = $database->prepare($query);
    $statement->execute();
    
    $enrollments = $statement->fetchAll();
    
    $statement->closeCursor();
    
    $enrollment_array = array();
    
    foreach($enrollments as $enrollment){
        $enrollment_array[] = new Enrollment(
                $enrollment['id'],
                $enrollment['student_id'],
                $enrollment['ection_id'],
                $enrollment['grade']
        );
    }
    
    return $enrollment_array;
}

function insert_enrollment($enrollment){
    global $database;
    
    $query = "INSERT INTO enrollment (student_id, section_id, grade) VALUES (:student_id, :section_id, :grade)";
        
        $statement = $database->prepare($query);
        $statement->bindValue(":student_id", $enrollment->get_student_id());
        $statement->bindValue(":section_id", $enrollment->get_section_id());
        $statement->bindValue(":grade", $enrollment->get_grade());
        $statement->execute();
        $statement->closeCursor();
}

function update_enrollment($enrollment){
    global $database;
    
    $query = "UPDATE enrollment SET student_id = :student_id, section_id = :section_id, grade = :grade WHERE id = :id";
    
    $statement = $database->prepare($query);
    $statement->bindValue(":student_id", $enrollment->get_student_id());
    $statement->bindValue(":section_id", $enrollment->get_section_id());
    $statement->bindValue(":grade", $enrollment->get_grade());
    $statement->bindValue(":id", $enrollment->get_id());
    $statement->execute();
    $statement->closeCursor();
}

function delete_enrollment($id){
    global $database;
    
    $query = "DELETE FROM enrollment WHERE id = :id";
    
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->execute();
    $statement->closeCursor();
}