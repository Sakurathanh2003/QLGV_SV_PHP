<?php
class ClassDetail {
    public $id;
    public $classID;
    public $teacherID;
    public $studentID;

    public function __construct($id, $classID, $teacherID, $studentID) {
        $this->id = $id;
        $this->classID = $classID;
        $this->teacherID = $teacherID;
        $this->studentID = $studentID;
    }

    public function getID() {
        return $this->id;
    }

    public function getTeacherID() {
        return $this->teacherID;
    }

    public function getStudentID() {
        return $this->studentID;
    }
}
?>