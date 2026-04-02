<?php

class Course {
    private $code, $name, $description, $credits;
    
    public function __construct($code, $name, $description, $credits){
        $this->set_code($code);
        $this->set_name($name);
        $this->set_description($description);
        $this->set_credits($credits);
    }
    
    public function set_code($code){
        $this->code = $code;
    }
    
    public function set_name($name){
        $this->name = $name;
    }
    
    public function set_description($description){
        $this->description = $description;
    }
    
    public function set_credits($credits){
        $this->credits = $credits;
    }
    
    public function get_code(){
        return $this->code;
    }
    
    public function get_name(){
        return $this->name;
    }
    
    public function get_description(){
        return $this->description;
    }
    
    public function get_credits(){
        return $this->credits;
    }
}
    function get_course($code){
        global $database;
        
        $query = 'SELECT code, name, description, credits'
                . 'FROM course'
                . 'WHERE code = :code';
        $statement = $database->prepare($query);
        $statement->bindValue(":code", $code);
        $statement->execute();
        $course = $statement->fetch();
        $statement->closeCursor();
        
        return new Course(
                $course['code'],
                $course['name'],
                $course['description'],
                $course['credits']
        );      
    }
    
    function list_course(){
        global $database;
        
        $query = 'SELECT code, name, description, credits FROM course';
        
        $statement = $database->prepare($query);
        $statement->execute();
        $courses = $statement->fetchAll();
        $statement->closeCursor();
        $course_array = array();
        
        foreach($courses as $course){
            $course_array[] = new Course(
                    $course['code'],
                    $course['name'],
                    $course['description'],
                    $course['credits']
            );
        }
        
        return $course_array;
    }
    
    function insert_course($course){
        global $database;
        
        $query = "INSERT INTO course (code, name, description, credits) VALUES (:code, :name, :description, :credits)";
        
        $statement = $database->prepare($query);
        $statement->bindValue(":code", $course->get_code());
        $statement->bindValue(":name", $course->get_name());
        $statement->bindValue(":description", $course->get_description());
        $statement->bindValue(":credits", $course->get_credits());
        $statement->execute();
        $statement->closeCursor();
    }
    
    function update_course($course){
        global $database;
        
        $query = "UPDATE course SET name = :name, description = :description, credits = :credits WHERE code = :code";
        $statement = $database->prepare($query);
        $statement->bindValue(":code", $course->get_code());
        $statement->bindValue(":name", $course->get_name());
        $statement->bindValue(":description", $course->get_description());
        $statement->bindValue(":credits", $course->get_credits());
        $statement->execute();
        $statement->closeCursor();
    }
    
    function delete_course($code){
        global $database;
        
        $query = "DELETE FROM course WHERE code = :code";
        $statement = $database->prepare($query);
        $statement->bindValue(":code", $code);
        $statement->execute();
        $statement->closeCursor();
    }