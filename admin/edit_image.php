<?php
    include("../Examination.php");
    $exam = new Examination;
$admin_id = $_SESSION["admin_id"];
if(isset($_POST["chg_pic"])){
    $image = $_FILES["chg_pro"]["name"];
    $image_tmp = $_FILES["chg_pro"]["tmp_name"];
    $allowed = ["jpg", "png", "jpeg"];
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    if(in_array($ext, $allowed)){
        move_uploaded_file($image_tmp, "../images/$image");
        move_uploaded_file($image_tmp, "images/$image");
        $exam->query = "UPDATE admin_table SET admin_image = '$image' WHERE admin_id = '$admin_id'";
        if($exam->execute_query()){
            echo '<script>alert("Your Account Has been Updated")</script>';
            echo '<script>window.open("myaccount.php", "_self")</script>';
        }
    }




}


?>