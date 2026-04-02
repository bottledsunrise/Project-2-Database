<?php

class Student{
    private $id, $name, $major;
    
    public function __construct($name, $major, $id){
        $this->set_name($name);
        $this->set_major($major);
        $this->set_id($id);
    }
    
    public function set_name($name){
        $this->name = $name;
    }
    
    public function set_major($major){
        $this->major = $major;
    }
    
    public function set_id($id){
        $this->id = $id;
    }
    
    public function get_name(){
        return $this->name;
    }
    
    public function get_major(){
        return $this->major;
    }
    
    public function get_id(){
        return $this->id;
    }
}

function get_student($id){
    global $database;
    
    $query = 'SELECT id, name, major FROM student WHERE id = :id';
    
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->execute();
    
    $student = $statement->fetch();
    
    $statement->closeCursor();
    
    return new Student(
            $student['name'],
            $student['major'],
            $student['id']
    );
}

function list_students(){
    global $database;
    
    $query = 'SELECT id, name, major FROM student';
    
    $statement = $database->prepare($query);
    $statement->execute();
    
    $students = $statement->fetchAll();
   
    $statement->closeCursor();
    
    $student_array = array();
    
    foreach($students as $student){
        $student_array[] = new Student(
                $student['name'],
                $student['major'],
                $student['id']
        );
    }
    
    return $student_array;
}

function insert_student($student){
    global $database;
    
    $query = "INSERT INTO student (name, major) VALUES (:name, :major)";
        
        $statement = $database->prepare($query);
        $statement->bindValue(":name", $student->get_name());
        $statement->bindValue(":major", $student->get_major());
        $statement->execute();
        $statement->closeCursor();
}

function update_student($student){
    global $database;
    
    $query = "UPDATE student SET name = :name, major = :major WHERE id = :id";
    
    $statement = $database->prepare($query);
    $statement->bindValue(":name", $student->get_name());
    $statement->bindValue(":major", $student->get_major());
    $statement->bindValue(":id", $student->get_id());
    $statement->execute();
    $statement->closeCursor();
}

function delete_student($id){
    global $database;
    
    $query = "DELETE FROM student WHERE id = :id";
    
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->execute();
    $statement->closeCursor();
}