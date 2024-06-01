<?php
class ClassDetail {
    public $id;
    public $classID;
    public $studentID;

    public function __construct($id, $classID, $studentID) {
        $this->id = $id;
        $this->classID = $classID;
        $this->studentID = $studentID;
    }

    public function getID() {
        return $this->id;
    }

    public function getStudentID() {
        return $this->studentID;
    }
}
?>