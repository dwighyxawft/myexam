<?php
include("../Examination.php");
$exam = new Examination;
$admin_id = $_GET["enroller_id"];
$exam_id = $_GET["exam_id"];
$exam->query = "DELETE FROM user_enroll_exam_table WHERE exam_id = '$exam_id' AND ((offerer_id = '$admin_id' AND enroller_id = '$user_id') OR (enroller_id = '$admin_id' AND offerer_id = '$user_id'))";
if($exam->execute_query()){
    echo $exam->redirect("user/your_exams.php");
}


?>