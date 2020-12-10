<?php

/*********************************************************************
 * Kursregister med objektorienterad PHP
 * Written by Cristina Löfqvist/ Mid Swewden University in Oct-2020.
 *********************************************************************/


class Course {
    private $name;
    private $code;
    private $progression;
    private $courseSyllabus;

    public function __construct(string $code, string $name, string $courseSyllabus, string $progression) {
        $this->name=$name; 
        $this->courseSyllabus=$courseSyllabus;
        $this->progression=$progression;
        $this->code=$code;
    }

    /*getters*/

    public function getCourse(){
       $course = (object)array();
       $course->name = $this->name;
       $course->code = $this->code;
       $course->syllabus = $this->courseSyllabus;
       $course->progression = $this->progression;
       return $course;
    }

    public function getName(){
        return $this->name;
    }

    public function getSyll(){
        return $this->courseSyllabus;
    }

    public function getProgr(){
        return $this->progression;
    }

    public function getCode(){
        return $this->code;
    }
    
    /*setters*/
    
    public function setName(string $name){
        $this->name = $name; 
    }
    public function setSyll(string $courseSyllabus){
        $this->courseSyllabus = $courseSyllabus;
    }
    public function setProgr(string $progression){
        $this->progression = $progression;
    }
    public function setCode(string $code){
        $this->code = $code;
    }

    public function setCourse(Course $course){
        $this->setName($course->getName());
        $this->setSyll($course->getSyll());
        $this->setProgr($course->getProgr());
        $this->setCode($course->getCode());
    }
}
