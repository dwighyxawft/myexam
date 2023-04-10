<?php
include("../Examination.php");
$exam = new Examination;
$exam->admin_session_public();
$admin_id = $_SESSION["admin_id"];
$user_id = $_GET["user_id"];
$exam_id = $_GET["exam_id"];
$exam->query = "DELETE FROM user_enroll_exam_table WHERE (offerer_id = '$admin_id' AND enroller_id = '$user_id') AND (exam_id = '$exam_id' AND acceptance_status = 'pending')";
if($exam->execute_query()){
   echo $exam->redirect("admin/view_users.php?exam_id=".$exam_id."");
}


?>