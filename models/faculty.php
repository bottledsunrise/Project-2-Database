<?php

class Faculty{
    private $id, $name, $email;
    
    public function __construct($name, $email, $id){
        $this->set_name($name);
        $this->set_email($email);
        $this->set_id($id);
    }
    
    public function set_name($name){
        $this->name = $name;
    }
    
    public function set_email($email){
        $this->email = $email;
    }
    
    public function set_id($id){
        $this->id = $id;
    }
    
    public function get_name(){
        return $this->name;
    }
    
    public function get_email(){
        return $this->email;
    }
    
    public function get_id(){
        return $this->id;
    }
}

function get_faculty($id){
    global $database;
    
    $query = 'SELECT id, name, email FROM faculty WHERE id = :id';
    
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->execute();
    
    $faculty = $statement->fetch();
    
    $statement->closeCursor();
    
    return new Faculty(
            $faculty['name'],
            $faculty['email'],
            $faculty['id']
    );
}

function list_faculty(){
    global $database;
    
    $query = 'SELECT id, name, email FROM faculty';
    
    $statement = $database->prepare($query);
    $statement->execute();
    
    $faculty_rows = $statement->fetchAll();
   
    $statement->closeCursor();
    
    $faculty_array = array();
    
    foreach($faculty_rows as $faculty){
        $faculty_array[] = new Faculty(
                $faculty['name'],
                $faculty['email'],
                $faculty['id']
        );
    }
    
    return $faculty_array;
}

function insert_faculty($faculty){
    global $database;
    
    $query = "INSERT INTO faculty (name, email) VALUES (:name, :email)";
        
        $statement = $database->prepare($query);
        $statement->bindValue(":name", $faculty->get_name());
        $statement->bindValue(":email", $faculty->get_email());
        $statement->execute();
        $statement->closeCursor();
}

function update_faculty($faculty){
    global $database;
    
    $query = "UPDATE faculty SET name = :name, email = :email WHERE id = :id";
    
    $statement = $database->prepare($query);
    $statement->bindValue(":name", $faculty->get_name());
    $statement->bindValue(":email", $faculty->get_email());
    $statement->bindValue(":id", $faculty->get_id());
    $statement->execute();
    $statement->closeCursor();
}

function delete_faculty($id){
    global $database;
    
    $query = "DELETE FROM faculty WHERE id = :id";
    
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->execute();
    $statement->closeCursor();
}
