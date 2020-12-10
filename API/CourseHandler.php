<?php

/*********************************************************************
 * Kursregister med objektorienterad PHP
 * Written by Cristina Löfqvist/ Mid Swewden University in Oct-2020.
 *********************************************************************/

require('Database.php');
require('../data_classes/Course.php');

class CourseHandler
{
    private $database;
    private $last_retrieved_result;

    public function __construct()
    {
        /*Initialize the class Database object*/
        $this->database = new Database();
    }

    public function getLastRetrievedResult()
    {
        return $this->last_retrieved_result;
    }

    public function getCourses()
    {
        /**
         * Open the connection to the sql database
         */
        $this->database->connect();
        /**
         * Initialize empty array to fill with Course objects
         * that will later be returned
         */
        $courses = [];

        /**
         * Query the sql database for everything regarding courses
         */
        $this->database->make_query("SELECT * FROM courses");

        /**
         * Parse result from query into Course objects and add the to the
         * $courses array
         */
        if ($this->database->get_last_query_result()->num_rows > 0) {
            while ($row = $this->database->get_last_query_result()->fetch_assoc()) {
                $code = $row['code'];
                $name = $row['course_name'];
                $syllabus = $row['syllabus'];
                $progression = $row['progression'];
                $course = new Course($code, $name, $syllabus, $progression);
                array_push($courses, $course);
            }
            $this->database->free_last_query_result();
            $this->database->disconnect();
        }
        $this->last_retrieved_result = $courses;
        return $courses;
    }

    public function insertCourseByValues(string $code, string $name, string $courseSyllabus, string $progression)
    {
        $this->database->connect();
        $this->last_retrieved_result = $this->database->make_query("INSERT INTO" .
         "`courses` (`code`, `course_name`, `syllabus`, `progression`)" . " VALUES (" . '"' .
            $code . '"' . "," . '"' . $name . '"' . "," . '"' .  $courseSyllabus . '"' . "," . '"' . $progression . '"' . ")");
        $this->database->free_last_query_result();
        $this->database->disconnect();
        return true;
    }

    public function deleteCourseByCode(string $code, bool $updateInternalCourseList)
    {
        $this->database->connect();
        $this->last_retrieved_result = $this->database->make_query("DELETE FROM courses WHERE code=" . '"' . $code . '"');
        $this->database->free_last_query_result();
        if ($updateInternalCourseList) {
            $this->getCourses();
        }
        $this->database->disconnect();
        return $this->getLastRetrievedResult();
    }

    /*updates values to course*/
    public function updateCourseByCodeAndValues(
        string $codeToBeUpdated,
        string $newCode = "",
        string $newName = "",
        string $newCourseSyllabus = "",
        string $newProgression = ""
    ) {
        if (empty($codeToBeUpdated)) {
            return false;
        }
        $field = 0;
        if (!empty($newCode) && !empty($newName) && !empty($newProgression) && !empty($newCourseSyllabus)) {
            $this->database->connect();
            $this->last_retrieved_result = $this->database->make_query(
                "UPDATE courses SET" .
                    " code=" . '"' . $newCode . '"' .
                    " course_name=" . '"'.  $newName .'"'.
                    " syllabus=" . '"'. $newCourseSyllabus .'"'.
                    " progression=" . '"'. $newProgression .'"'.
                    " WHERE code=" . '"'. $codeToBeUpdated .'"'
            );

            $this->database->free_last_query_result();
            $this->database->disconnect();
            return true;
        } else if (!empty($newName) && !empty($newProgression) && !empty($newCourseSyllabus) && empty($newCode)) {
            $this->database->connect();
            $this->last_retrieved_result = $this->database->make_query(
                "UPDATE courses SET" .
                    " course_name=" . '"'. $newName . '",'. 
                    " syllabus=" . '"'. $newCourseSyllabus . '",'. 
                    " progression=" . '"'. $newProgression . '"'. 
                    " WHERE code=" . '"'. $codeToBeUpdated . '"' 
            );
            $this->database->free_last_query_result();
            $this->database->disconnect();
            return true;
        }
        return false;
    }
    public function toString() {
        return "CourseHandler";
    }
}
