<?php
include("../Examination.php");
$exam = new Examination;
$user_id = $_SESSION["user_id"];
$admin_id = $_GET["enroller_id"];
$exam_id = $_GET["exam_id"];
$exam->query = "UPDATE user_enroll_exam_table SET acceptance_status = 'accepted' WHERE exam_id = '$exam_id' AND (offerer_id = '$admin_id' AND enroller_id = '$user_id')";
if($exam->execute_query()){
    echo $exam->redirect("user/your_exams.php");
}


?>