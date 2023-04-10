<?php
include("../Examination.php");
$exam = new Examination;
$exam->admin_session_public();
$admin_id = $_SESSION["admin_id"];
$user_id = $_GET["user_id"];
$exam_id = $_GET["exam_id"];
$exam->query = "INSERT INTO user_enroll_exam_table (enroller_id, offerer_id, exam_id, acceptance_status) VALUES ('$user_id', '$admin_id', '$exam_id', 'pending')";
if($exam->execute_query()){
   echo $exam->redirect("admin/view_users.php?exam_id=".$exam_id."");
}


?>