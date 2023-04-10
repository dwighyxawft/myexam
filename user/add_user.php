<?php
include("../Examination.php");
$exam = new Examination;
$exam->user_session_public();
$user_id = $_SESSION["user_id"];
$admin_id = $_GET["enroller_id"];
$exam_id = $_GET["exam_id"];
$exam->query = "INSERT INTO user_enroll_exam_table (enroller_id, offerer_id, exam_id, acceptance_status) VALUES ('$admin_id', '$user_id', '$exam_id', 'pending')";
if($exam->execute_query()){
   echo $exam->redirect("user/exams.php");
}


?>