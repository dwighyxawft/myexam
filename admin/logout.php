<?php
include("../Examination.php");
$exam = new Examination;
session_start();
session_destroy();
echo $exam->redirect("admin/login.php");



?>