<?php require_once("configue.php");?>

<?php
/*installing a new instance of mysqli*/
$db=new mysqli(DBHOST,DBUSER,DBPASS,DBDATABASE);
    if($db->connect_errno>0){
        die('fel vid anslutning ['. $db->connect_error. ']');
        exit();
    }

    $sql="DROP TABLE IF EXISTS courses;";
    $sql.="CREATE TABLE courses(
        code INT(15)PRIMARY KEY AUTO_INCREMENT, 
        course_name VARCHAR(57)NOT NULL, 
        syllabus TEXT NOT NULL,
        progression VARCHAR (10)NOT NULL
        );";
        if($devMode) {
            echo "<pre>$sql<pre>";
        }

if ($db->multi_query($sql)){
    if($devMode) {
        echo "DB installed.";
    }
} else {
    if($devMode) {
        echo"DB installation error.";
    }
}
$db->close();/*closes the conection*/
?>